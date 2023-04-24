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
use think\facade\Config;
use think\facade\Db;
use think\facade\Request;
use think\facade\Session;
use think\facade\View;

class Verification extends Base
{
    public function index()
    {

        return view('', init_view());
    }

    //身证验证post

    public function identification()
    {
        if ($this->request->param()) {
            $param = $this->request->param();
            if (!$param['lastName'] || !$param['firstName']) {

                $this->error('姓名不能为空');
            }
            if (!empty($param['middleName'])) {
                $truename = $param['lastName'] . '(' . $param['middleName'] . ')' . $param['firstName'];
            } else {
                $truename = $param['lastName'] . $param['firstName'];
            }

            Session::set('truename', $truename);

            $this->success('姓名提交成功', url('user/Verification/upload'));
        }

    }
    /*/后来这个没有用上/*/
    public function reupload()
    {

        if ($param = $this->request->param()) {
            if ($param['reupload'] == 1) {
                Session::delete('tempimg');
                Session::delete('step');

            }
            $this->success('清理成功', url('user/Verification/upload'));
        }

    }
    /*  上传身份证界面*/
    public function upload()
    {

        $step = Session::get('step');

        if ($step != null && $step < 3) {
            $step = $step + 1;

        } elseif ($step != null && $step > 3) {
            Session::delete('step');
            $step = 1;
        } else {
            $step = 1;
        }

        //exit;
        if ($step == 3) {
            $res                   = session('user_auth');
            $res['identification'] = 2;
            session::set('user_auth', $res);

        }
        $tips = [1 => '上传身份证正面', 2 => '上传身份证背面', 3 => '身份证上传成功', 4 => '请重新上传身份证'];
        $data = init_view();

        $data['tips'] = $tips[$step];
        $data['step'] = $step;

        return view('', $data);
    }
    public function phone()
    {

        if ($this->request->param()) {
            $param = $this->request->param();
            if (!is_numeric($param['tel']) || strlen($param['tel']) != 11) {
                $this->error('手机号格式不对');
            }
            $u      = Config::get('app.sms_user');
            $p      = Config::get('app.sms_pwd');
            $title  = Config::get('app.sms_title');
            $res    = session('user_auth');
            $touser = $param['tel'];
            $rand   = generate_code(6);
            Session::set('sms_code', $rand);
            Session::set('sms_tel', $param['tel']);
            $resault = sms_mobile($u, $p, $touser, $rand, $title);
            if ($resault == '0') {
                $this->success('发送成功');
            } else {
                $this->error('请稍后再试');
            }
        }

        return view('', init_view());
    }

    public function email()
    {
        if ($this->request->param()) {
            $param = $this->request->param();
            if (!filter_var($param['email'], FILTER_VALIDATE_EMAIL)) {

                $this->error('错误的邮箱' . $param['email']);
            }

            $title  = Config::get('app.sms_title');
            $res    = session('user_auth');
            $touser = $param['email'];
            $rand   = generate_code(6);
            Session::set('mail_code', $rand);
            Session::set('mail_address', $param['email']);

            $contents  = '【' . $title . '】您的验证码' . $rand . '：（3分钟内有效，如非本人操作，请忽略）';
            $mailModel = new Email;
            $resault   = $mailModel->sendMail($touser, $res['username'], $title, $contents);
            if ($resault === true) {
                $this->success('发送成功');
            } else {
                $this->error($resault);
            }
        }

        return view('', init_view());
    }
    /* 短信验证*/
    public function check()
    {

        if ($this->request->param()) {
            $param      = $this->request->param();
            $sms_code_1 = Session::get('sms_code');
            $sms_code_2 = $param['code_1'] . $param['code_2'] . $param['code_3'] . $param['code_4'] . $param['code_5'] . $param['code_6'];
            if ($sms_code_1 == $sms_code_2) {
                $time      = time();
                $phone     = Session::get('sms_tel');
                $user_data = Session::get('user_auth');
                Db::name('user')->where('username', $user_data['username'])->save(['has_readed' => '0', 'phone' => $phone, 'quota' => 1000]);
                Db::name('user_msg')->save(['sender' => '0', 'uid' => $user_data['uid'], 'title' => '已确认手机，谢谢!', 'contents' => '<p><span style="color: rgb(32, 33, 36); font-family: consolas, &quot;lucida console&quot;, &quot;courier new&quot;, monospace; font-size: 12px; white-space: pre-wrap; background-color: rgb(255, 255, 255);">已确认手机，谢谢！</span></p>', 'create_time' => $time]);

                $information = Session::get('browser');
                $city        = Session::get('city');
                $ip          = Session::get('ip');

                $data = ['uid' => $user_data['uid'], 'ip' => $ip, 'contents' => '确认验证手机信息', 'create_time' => $time, 'city' => $city, 'information' => $information];

                Db::name('user_operation_log')->save($data);
                $user_data['phone'] = $phone;
                Session::set('user_auth', $user_data);
                $this->success('验证成功');
            } else {
                $this->error('验证码错误');
            }
        }

    }

    /* 邮箱验证*/
    public function checkmail()
    {

        if ($this->request->param()) {
            $param      = $this->request->param();
            $sms_code_1 = Session::get('mail_code');
            $sms_code_2 = $param['code_1'] . $param['code_2'] . $param['code_3'] . $param['code_4'] . $param['code_5'] . $param['code_6'];
            if ($sms_code_1 == $sms_code_2) {
                $time      = time();
                $mail      = Session::get('mail_address');
                $user_data = Session::get('user_auth');
                Db::name('user')->where('username', $user_data['username'])->save(['has_readed' => '0', 'email' => $mail, 'quota' => 1000]);
                Db::name('user_msg')->save(['sender' => '0', 'uid' => $user_data['uid'], 'title' => '已确认邮箱，谢谢!', 'contents' => '<p><span style="color: rgb(32, 33, 36); font-family: consolas, &quot;lucida console&quot;, &quot;courier new&quot;, monospace; font-size: 12px; white-space: pre-wrap; background-color: rgb(255, 255, 255);">已确认邮箱，谢谢！</span></p>', 'create_time' => $time]);
                $user_data['email'] = $mail;
                Session::set('user_auth', $user_data);
                $information = Session::get('browser');
                $city        = Session::get('city');
                $ip          = Session::get('ip');

                $data = ['uid' => $user_data['uid'], 'ip' => $ip, 'contents' => '确认验证邮箱信息', 'create_time' => $time, 'city' => $city, 'information' => $information];

                Db::name('user_operation_log')->save($data);
                $this->success('验证成功');
            } else {
                $this->error('验证码错误');
            }
        }

    }
}
