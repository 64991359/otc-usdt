<?php
namespace app\user\controller;

use app\common\controller\Base;
use think\facade\Db;
use think\facade\Session;
use think\facade\View;

class Index extends Base
{
    public function index()
    {
        $res      = Session::get('user_auth');
        $user_msg = Db::name('user_msg')->where('uid', $res['uid'])->find();

    }

    public function readed()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            if (isset($param['uptime']) && $param['uptime'] > 1) {
                $res    = Session::get('user_auth');
                $notice = Db::name('user_info')->where('uid', $res['uid'])->save(['notice_update_time' => $param['uptime']]);
                if ($notice) {
                    $this->success('更新成功');
                } else {
                    $this->error('更新错误');
                }
            }
            $res = Session::get('user_auth');
            Session::set('user_msg_nums', '0');
            $user_msg = Db::name('user_msg')->where('uid', $res['uid'])->save(['has_readed' => 1]);

            if ($user_msg) {
                $this->success('标记成功');
            } else {
                $this->error('标记错误');
            }
        }

    }

    public function showbalance()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            if (isset($param['show_balance'])) {
                Session::set('show_balance', $param['show_balance']);
                $this->success('show_balance更新成功');
            } else {
                $this->error('show_balance更新失败');
            }

        }
    }
    /*  邀请朋友*/
    public function invite()
    {
        return view('', init_view());
    }
    /* 加入Paxful社群*/
    public function community()
    {
        return view('', init_view());
    }
}
