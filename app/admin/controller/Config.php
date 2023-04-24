<?php
// +----------------------------------------------------------------------
// | 小牛Admin
// +----------------------------------------------------------------------
// | Website: www.xnadmin.cn
// +----------------------------------------------------------------------
// | Author: dav <85168163@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\model\SystemConfig;
use app\admin\model\UserTrc20Address;
use app\common\controller\AdminBase;
use think\facade\Session;

class Config extends AdminBase
{
    //配置文件目录
    protected $folder = 'cfg';

    /**
     * 基本配置
     * @return \think\response\View
     *
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

        if ($this->request->isPost()) {
            $param = $this->request->post();
            config('app.is_demo') && $this->error('演示模式不可修改');

            if ($param['authsys'] != 159753) {
                $this->error('参数不正确');
            }

            unset($param['authsys']);
            $SystemConfig = new SystemConfig();
            $data2        = $SystemConfig->getConfig();
            $result       = $data2['data'];
            $model        = new UserTrc20Address;
            if (isset($param['trc20_collection_key']) && @$param['trc20_collection_key'] != '') {
                if (md5($result['trc20_collection_key']) == $param['trc20_collection_key']) {
                    unset($param['trc20_collection_key']);
                } else {
                    $privateKeyHex = $param['trc20_collection_key'];
                    try {

                        $trc20_collection_address = $model->trc20_private_key_to_address($privateKeyHex);
                    } catch (Exception $e) {
                        $msg = $e->getMessage();
                        $this->success($msg);

                    }
                }

            }
            if (isset($param['trc20_pay_key']) && @$param['trc20_pay_key'] != '') {
                if (md5($result['trc20_pay_key']) == $param['trc20_pay_key']) {
                    unset($param['trc20_pay_key']);
                } else {
                    $trc20_pay_key = $param['trc20_pay_key'];
                    try {

                        $trc20_pay_address = $model->trc20_private_key_to_address($trc20_pay_key);
                    } catch (Exception $e) {
                        $msg = $e->getMessage();
                        $this->success($msg);

                    }
                }

            }

            if (isset($param['trc20_collection_key']) && @$param['trc20_collection_key'] != '' && $trc20_collection_address != $param['trc20_collection_address']) {
                $this->error('trx.usdt收款私钥不正确');
            }

            if (isset($param['trc20_pay_key']) && @$param['trc20_pay_key'] != '' && $trc20_pay_address != $param['trc20_pay_address']) {
                $this->error('trx.usdt付款私钥不正确');
            }

            $SystemConfig = new SystemConfig();
            $res          = $SystemConfig->editConfig($param);
            $this->success('设置成功');
        }
        $SystemConfig                = new SystemConfig();
        $data                        = $SystemConfig->getConfig();
        $res                         = $data['data'];
        $res['trc20_collection_key'] = md5($res['trc20_collection_key']);
        $res['trc20_pay_key']        = md5($res['trc20_pay_key']);
        return view('', ['data' => $res]);
    }

    /**
     * 上传配置
     * @return \think\response\View
     */
    public function upload()
    {
        $file = $this->request->action();
        if ($this->request->isPost()) {
            config('app.is_demo') && $this->error('演示模式不可修改');
            $param = $this->request->post();
            $this->_set($param, $file);

            $this->success('设置成功');
        }
        return view($file, ['data' => $this->_load($file)]);
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
            //$data['data']['usdt_price']=sprintf("%.2f", $data['data']['usdt_price']);
            return $data['data'];
        } else {
            $data = \think\facade\Config::load($this->folder . "/" . $filename, $filename);
            return $data;
        }

    }

    //更新usdt价格

    public function updateusdt()
    {
        // $id = session('admin.id');

        $save         = '';
        $SystemConfig = new SystemConfig();
        $data         = $SystemConfig->getConfig($param);
        $usdtArray    = auto_usdt2cny();
        try {

            if ($usdtArray['usdt']['price'] && $data['data']['auto_update'] > 0) {
                $data['data']['usdt_price'] = $usdtArray['usdt']['price'] + $data['data']['usdt_modify'];

                unset($data['data']['id']);
                $save = $SystemConfig->editConfig($data['data']);

            }

        } catch (\Exception $e) {
            $this->error('更新失败');
        }

        $save ? $this->success('更新成功') : $this->error('更新失败');

    }
}
