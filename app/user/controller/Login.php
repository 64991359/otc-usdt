<?php
// +----------------------------------------------------------------------
// | 小牛Admin
// +----------------------------------------------------------------------
// | Website: www.xnadmin.cn
// +----------------------------------------------------------------------
// | Author: dav <85168163@qq.com>
// +----------------------------------------------------------------------

namespace app\user\controller;

use app\common\controller\Base;
use app\common\model\User;
use Oscar\IpGet\IpGet;
use think\exception\ValidateException;
use think\facade\Db;
use think\facade\Session;
use think\facade\View;
use think\Request;

class Login extends Base
{
    public function index()
    {
        $domain = input('server.REQUEST_SCHEME') . '://' . input('server.SERVER_NAME');

        if ($param = $this->request->param()) {
            if (Session::has('is_login') && Session::get('is_login') == '1') {
                $this->success('登录成功');exit;
            }
            try {
                $this->validate($param, 'login');
            } catch (ValidateException $e) {
                $this->error($e->getError());
                exit;
            }

            $user_data = Db::name('user')->alias('a')->join('user_info b', 'a.id=b.uid')->where([
                'username' => $param['username'],
                'password' => xn_encrypt($param['password']),
            ])->find();

            if (empty($user_data)) {

                $this->error('用户名或密码不正确');exit;
            }
            if ($user_data['status'] != 1) {
                $this->error('您的账户已被禁用');exit;
            }

            $where = ['uid' => $user_data['uid']];

            $user_msg = Db::name('user_msg')->where($where)->limit(10)->select();
            $nosender = 0;
            foreach ($user_msg as $v) {

                $nosender = $nosender + $v['sender'];

            }
            $nosender = $nosender > 0 ? '0' : '1';

            $user_data['nosender'] = $nosender;

            $where = array();

            $sys_notice = Db::name('sys_notice')->where('create_time', '>', $user_data['notice_update_time'])->limit(5)->select();

            $info    = array();
            $no_read = 0;
            for ($i = 0; $i < count($user_msg); $i++) {
                if ($user_msg[$i]['has_readed'] != 1) {
                    $no_read = $no_read + 1;
                }
            }

            Session::set('user_msg_nums', $no_read);

            $info['user_msg'] = $user_msg;

            $no_read = 0;

            foreach ($sys_notice as $v) {
                if ($v['create_time'] > $user_data['notice_update_time']) {
                    $no_read = $no_read + 1;
                }
            }

            $info['sys_notice'] = $sys_notice;
            Session::set('notice_nums', $no_read);
            Session::set('user_auth', $user_data);
            Session::set('msg', $info);
            Session::set('show_balance', '0');
            Session::set('is_login', '1');

            $ip         = get_client_ip();
            $ipLocation = new IpGet('../source/qqwry.dat');

            $list = $ipLocation->getlocation($ip);

            $city = '(' . $list['country'] . ')' . $list['area'];

            $time = time();

            $usernfo     = new Userinfo();
            $information = $usernfo->get_user_info();
            $information = $information ?? 'N/A';
            Session::set('browser', $information);
            Session::set('login_time', $time);
            Session::set('city', $city);
            Session::set('ip', $ip);
            $data = ['uid' => $user_data['uid'], 'ip' => $ip, 'contents' => '用户已登录', 'create_time' => $time, 'city' => $city, 'information' => $information];

            $log        = Db::name('user_operation_log')->save($data);
            $session_id = Session::getId();
            Db::name('user')->where('id', $user_data['uid'])->save(['session_id' => $session_id]);
            Session::set('session_id', $session_id);
            if ($log && is_array($user_data)) {
                $this->success('登录成功');exit;
            }
            $this->error('登录出错');exit;
        }
        View::assign('nosender', $nosender);
        View::assign('domain', $domain);
        return view();
    }

    public function logout()
    {
        $user_data  = Session::get('user_auth');
        $ip         = get_client_ip();
        $time       = time();
        $ipLocation = new IpGet('../source/qqwry.dat');

        $list = $ipLocation->getlocation($ip);

        $city = '(' . $list['country'] . ')' . $list['area'];

        $time = time();

        $usernfo     = new Userinfo();
        $information = $usernfo->get_user_info();
        $information = $information ?? 'N/A';
        $data        = ['uid' => $user_data['uid'], 'ip' => $ip, 'contents' => '用户已退出', 'create_time' => $time, 'city' => $city, 'information' => $information];
        $res         = Db::name('user_operation_log')->save($data);
        Session::delete('user_auth', null);
        Session::delete('is_login', null);
        if ($res) {
            $this->redirect(url('index'));
        }

    }

    /**
     * 生成验证码
     * @return \think\Response
     */
    public function verify()
    {
        return Captcha::create();
    }

    public function password()
    {
        return view();
    }
}
