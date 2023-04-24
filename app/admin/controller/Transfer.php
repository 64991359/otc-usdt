<?php
// +----------------------------------------------------------------------
// | 小牛Admin
// +----------------------------------------------------------------------
// | Website: www.xnadmin.cn
// +----------------------------------------------------------------------
// | Author: dav <85168163@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\model\RechargeRecord;
use app\admin\model\TransferConfig;
use app\admin\model\TransferRecord;
use app\common\controller\AdminBase;
use think\facade\Db;
use think\facade\Log;
use think\facade\Session;

class Transfer extends AdminBase
{
    //配置文件目录
    protected $folder = 'cfg';

    //提现记录
    public function index()
    {

        if ($this->request->isAjax() || input('end_time')) {
            $limit = input('param.limit');

            $param = $this->request->param();

            $where = [];

            $Model = new TransferRecord();
            if ($param['address'] && $param['address'] != '') {
                $where[] = ['form_address|form_address', '=', $param['address']];
            }
            if (isset($param['status']) && $param['status'] != '') {
                $where[] = ['status', '=', $param['status']];
            }
            if (isset($param['order_no']) && $param['order_no'] != '') {
                $where[] = ['order_no', '=', $param['order_no']];
            }

            //order_number
            if ($param['start_time'] != '' && $param['end_time'] != '') {
                $start = strtotime($param['start_time']);
                $end   = strtotime($param['end_time']);

                $where[] =
                    ['create_time',
                    'between',
                    [$start, $end],

                ];

            }
            $list = $Model->getTransRecordList($limit, $where);
            Log::record($list);

            if (0 == $list['code']) {

                return json(['code' => 0, 'msg' => 'ok', 'count' => $list['data']->total(), 'data' => $list['data']->all()]);
            }

            return json(['code' => 0, 'msg' => 'ok', 'count' => 0, 'data' => []]);
        }
        $data = $list['data'];

        $data = json_encode($data);
        return view('', ['data' => $data]);

    }

    /**
     * 基本配置
     * @return \think\response\View
     */
    public function base()
    {
        if ($this->request->isGet()) {
            $input = input();
            if (empty($input['bcid'])) {
                $this->error('参数不正确');
            }
            $admin = Session::get('admin_auth');
            if ($admin->id < 1) {
                $this->error('参数不正确');
            }
        }
        if ($this->request->isPost() || $param = $this->request->isAjax()) {

            $param = $this->request->param();
            if ($param['bcid']) {
                unset($param['bcid']);
            }

            $TransferConfig = new TransferConfig();

            $res = $TransferConfig->editConfig($param);
            $this->success('设置成功');
        }
        $TransferConfig = new TransferConfig();
        $Config         = $TransferConfig->getConfig();
        return view('', ['data' => $Config['data']]);
    }

    /**
     * 写入配置文件
     * @param $param
     * @param string $filename
     */
    protected function _set($param, $filename = "base")
    {
        if (is_array($param) && !empty($param)) {
            $file = config_path() . $this->folder . "/" . $filename . '.php';

            $str = "<?php\r\nreturn [\r\n";
            foreach ($param as $key => $val) {
                $str .= "\t'$key' => '$val',";
                $str .= "\r\n";
            }
            $str .= '];';
            file_put_contents($file, $str);
        }
    }

    /**
     * 加载配置文件
     * @param $filename
     * @return array
     */
    protected function _load($filename)
    {
        if ($filename == 'base') {
            $SystemConfig = new SystemConfig();
            $data         = $SystemConfig->getConfig($param);

            return $data['data'];
        } else {
            $data = \think\facade\Config::load($this->folder . "/" . $filename, $filename);
            return $data;
        }

    }
    //充提日志
    public function qtlog()
    {
        if ($this->request->isAjax() || input('end_time')) {
            $limit = input('param.limit');

            $param = $this->request->param();

            $where = [];

            $Model = new RechargeRecord();
            if ($param['address'] && $param['address'] != '') {
                $where[] = ['form_address|form_address', '=', $param['address']];
            }
            if (isset($param['transfer_type']) && $param['transfer_type'] != '') {
                $where[] = ['transfer_type', '=', $param['transfer_type']];
            }
            if (isset($param['txid']) && $param['txid'] != '') {
                $where[] = ['txid', '=', $param['txid']];
            }

            //order_number
            if ($param['start_time'] != '' && $param['end_time'] != '') {
                $start = strtotime($param['start_time']);
                $end   = strtotime($param['end_time']);

                $where[] =
                    ['create_time',
                    'between',
                    [$start, $end],

                ];

            }
            $list = $Model->getRechargeRecordList($limit, $where);
            Log::record($list);

            if (0 == $list['code']) {

                return json(['code' => 0, 'msg' => 'ok', 'count' => $list['data']->total(), 'data' => $list['data']->all()]);
            }

            return json(['code' => 0, 'msg' => 'ok', 'count' => 0, 'data' => []]);
        }
        $data = $list['data'];

        $data = json_encode($data);
        return view('', ['data' => $data]);
    }

    public function qtlogdel()
    {
        $this->success('删除成功');
    }

    public function agree()
    {
        if ($param = $this->request->param()) {
            if (!is_numeric($param['id'])) {
                $this->error('提交错误');
            }
            $id  = $param['id'];
            $res = Db::name('transfer_record')->where('id', $id)->update(['status' => 1, 'update_time' => time()]);
            if ($res) {
                $this->success('已经同意审请');
            } else {
                $this->error('提交错误');
            }
        }

    }

    public function reject()
    {
        if ($param = $this->request->param()) {
            if (!is_numeric($param['id'])) {
                $this->error('提交错误');
            }
            $id  = $param['id'];
            $res = Db::name('transfer_record')->where('id', $id)->update(['status' => 3, 'update_time' => time()]);
            if ($res) {
                $this->success('已经拒绝审请');
            } else {
                $this->error('提交错误');
            }
        }

    }
}
