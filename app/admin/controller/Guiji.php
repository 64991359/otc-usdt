<?php
// +----------------------------------------------------------------------
// | 小牛Admin
// +----------------------------------------------------------------------
// | Website: www.xnadmin.cn
// +----------------------------------------------------------------------
// | Author: dav <85168163@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\model\Guiji as Gj;
use app\common\controller\AdminBase;
use think\facade\Db;

class Guiji extends AdminBase
{
    /*status 0开始1失败3成功*/
    public function index()
    {

        $param = $this->request->param();
        $model = new Gj();
        if ($param['start_date'] != '' && $param['end_date'] != '') {
            $model = $model->whereBetweenTime('run_time', $param['start_date'], $param['end_date']);
        }
        if ($param['status'] != '') {
            $list = $model->where('status', $param['status'])->order('id desc')->paginate(['query' => $param]);
        } else {
            $list = $model->order('id desc')->paginate(['query' => $param]);
        }

        return view('', ['list' => $list]);

    }
    public function delete()
    {

        $id  = input('id/d');
        $res = '';
        ($id < 1) && $this->error('参数错误' . $id);
        $res = Db::name('guiji')->where("id", $id)->where('status', '<>', 1)->delete();
        if (!$res) {
            $this->error('暂时不能删除');
        }
        xn_add_admin_log('归集任务删除' . $id);
        $this->success('归集任务删除成功');
    }

    public function config()
    {
        if ($param = $this->request->post()) {
            //Log::record($param);
            if (isset($param['sg']) && $param['sg'] == 1) {
                $data['run_time']    = time() + 60;
                $data['create_time'] = time();
                $data['status']      = 0;
                $data['contents']    = '归集任务等待执行！';
                $find                = Db::name('guiji')->where('status', '<', 2)->find();
                if ($find) {
                    $this->error('还有一个任务未完成');exit;
                }
                $res = Db::name('guiji')->strict(false)->insert($data);
                if ($res) {
                    $this->success('任务提交成功');
                } else {
                    $this->error('提交失败');
                }
            }
            if (!is_numeric($param['id'])) {
                $this->error('提交错误');
            }

            $param['open_time']   = strtotime($param['open_time']);
            $param['update_time'] = time();
            $id                   = $param['id'];
            $res                  = Db::name('guiji_config')->where('id', $id)->update($param);
            if ($res) {
                $this->success('任务保存成功');
            } else {
                $this->error('保存失败');
            }

        }
        $data                = Db::name('guiji_config')->where('id', 1)->find();
        $data2               = Db::name('config')->where('id', 1)->find();
        $data['trx_address'] = $data2['trc20_collection_address'];
        $data['eth_address'] = $data2['erc20_collection_address'];
        $data['open_time']   = date('H:m:i', $data['open_time']);
        return view('', ['data' => $data]);
    }

}
