<?php
// +----------------------------------------------------------------------
// | 小牛Admin
// +----------------------------------------------------------------------
// | Website: www.xnadmin.cn
// +----------------------------------------------------------------------
// | Author: dav <85168163@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\common\controller\Base;
use app\common\model\Admin;
use think\captcha\facade\Captcha;
use think\exception\ValidateException;
use think\facade\Cookie;
use think\facade\Session;

class Login extends Base
{
    public function index()
    {
        $google_key_status = Cookie::get('google_key_status');

        if ($google_key_status == 1) {

            $captcha = 0;
        } else {
            $captcha = xn_cfg('base.login_vercode');
        }

        if ($this->request->isPost()) {
            $param = $this->request->param();
            try {
                $this->validate($param, 'login');
            } catch (ValidateException $e) {
                $this->error($e->getError());
            }

            $admin_data = Admin::where([
                'username' => $param['username'],
                'password' => xn_encrypt($param['password']),
            ])->find();

            if (empty($admin_data)) {
                $this->error('用户名或密码不正确');
            }
            if ($admin_data['status'] != 1) {
                $this->error('您的账户已被禁用');
            }

            //是否开启验证码
            if ($captcha == 1) {
                if (!captcha_check($param['vercode'])) {
                    $this->error('验证码错误');
                }
            }
            if ($admin_data['google_key_status'] == 1) {
                Cookie::set('google_key_status', '1');
            } else {

                Cookie::delete('google_key_status');

            }

            if ($admin_data['google_key_status'] == 1 && empty($param['google_code'])) {

                $this->error('请刷新页面后，输入谷歌验证码');
                exit;
            }

            //$google_secret 存入的谷歌秘钥  ，$code 谷歌动态验证码
            if ($google_key_status == 1) {
                $google_secret = $admin_data['google_key'];
                $code          = $param['google_code'];
                if (empty($code)) {
                    $this->error('请刷新页面后，输入谷歌验证码');
                }
                $google      = new GoogleAuthenticator();
                $checkResult = $google->verifyCode($google_secret, $code, 4);

                if (!$checkResult) {

                    $this->error('谷歌验证码错误');exit;

                }

            }

            //$google_secret  end
            Session::set('admin_auth', $admin_data);
            xn_add_admin_log('后台登录');
            $this->success('登录成功', $admin_data, url('admin/index'), );

        }
        return view('', ['captcha' => $captcha]);
    }

    public function logout()
    {
        Cookie::delete('admin_auth');
        //Session::set('admin_auth',null);
        $this->redirect(url('index'));
    }

    /**
     * 生成验证码
     * @return \think\Response
     */
    public function verify()
    {
        return Captcha::create();
    }
}
