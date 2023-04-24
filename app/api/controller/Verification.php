<?php
// +----------------------------------------------------------------------
// | 小牛Admin
// +----------------------------------------------------------------------
// | Website: www.xnadmin.cn
// +----------------------------------------------------------------------
// | Author: dav <85168163@qq.com>
// +----------------------------------------------------------------------

namespace app\api\controller;

use app\common\controller\Base;
use think\facade\Cache;
use think\facade\Config;
use think\facade\Db;
use think\facade\Request;
use think\facade\Session;

class Verification extends Base
{
    public function index()
    {

    }

    public function phone()
    {

        if ($this->request->param()) {
            $param = $this->request->param();

            if (!is_numeric($param['phone'])) {

                $result = ['status' => 0, 'message' => '手机号格式出错', 'result' => []];
                return json($result);
            }

            $where['phone'] = $param['phone'];
            $has            = Db::name('user')->where($where)->find();
            if ($param['type'] == 'add' && $has) {
                $result = ['status' => 0, 'message' => '该手机号已存在', 'result' => []];
                return json($result);
            }

            $u     = Config::get('app.sms_user');
            $p     = Config::get('app.sms_pwd');
            $title = Config::get('app.sms_title');
            $res   = session('user_auth');
            if (!empty($has['citycode']) && $has['citycode'] !== '+86') {
                $touser = $has['citycode'] . $param['phone'];
            } else {
                $touser = $param['phone'];
            }

            $rand          = generate_code(6);
            $data['phone'] = $param['phone'];
            $data['code']  = $rand;
            Cache::store('redis')->set('sms' . $param['phone'], $data, 600);

            $resault = sms_mobile($u, $p, $touser, $rand, $title);

            if ($resault == '0') {
                $result = ['status' => 1, 'message' => '发送成功', 'result' => []];

            } else {

                $result = ['status' => 0, 'message' => '请稍后再试', 'result' => []];
            }
            return json($result);
        }

    }

    public function email()
    {
        if ($this->request->param()) {
            $param = $this->request->param();
            if (!filter_var($param['email'], FILTER_VALIDATE_EMAIL)) {
                $result = ['status' => 0, 'message' => '错误的邮箱地址', 'result' => []];
                return json($result);

            }

            if (isset($param['type']) && $param['type'] == 'add') {
                $resault = Db::name('user')->where('email', $param['email'])->find();
                if ($resault) {
                    $result = ['status' => 0, 'message' => '该邮箱已经存在', 'result' => []];
                    return json($result);
                }
                $sms = Cache::store('redis')->get('mail' . $param['email']);
                if (isset($sms['code']) && $sms['code'] != $param['code']) {
                    $result = ['status' => 0, 'message' => '验证码错误', 'result' => []];
                    return json($result);
                }
                $res = Db::name('user')->where('username', $param['username'])->save(['email' => $param['email']]);
                if ($res) {
                    $result = ['status' => 1, 'message' => '添加成功', 'result' => $data];
                    return json($result);
                } else {
                    $result = ['status' => 0, 'message' => '添加失败', 'result' => $data];
                    return json($result);
                }

            }

            $where['email'] = $param['email'];
            $res            = Db::name('user')->where($where)->find();
            if (!$res) {

                $result = ['status' => 0, 'message' => '参数出错', 'result' => []];
                return json($result);
            }

            $title = Config::get('app.sms_title');

            $touser = $param['email'];
            $rand   = generate_code(6);

            $data['code'] = $rand;
            $data['mail'] = $param['email'];

            unset($data['type']);
            Cache::store('redis')->set('mail' . $param['email'], $data, 600);
            $res['username'] = $param['username'] ? $param['username'] : $res['username'];
            $contents        = '【' . $title . '】您的验证码' . $rand . '：（10分钟内有效，如非本人操作，请忽略）';
            $mailModel       = new Email;
            $resault         = $mailModel->sendMail($touser, $res['username'], $title, $contents);
            if ($resault === true) {
                $result = ['status' => 1, 'message' => '发送成功', 'result' => []];

            } else {
                $result = ['status' => 0, 'message' => '请稍后再试', 'result' => []];
            }
            return json($result);
        }

    }

    public function set_switch()
    {
        ini_set('date.timezone', 'Asia/Shanghai');
        $param = $this->request->param();

        if (isset($param['type']) && $param['type'] == 'email') {
            $where['email']   = $param['email'];
            $mail             = Cache::store('redis')->get('mail' . $param['email']);
            $code             = $mail['code'] ?? '';
            $data['email_yz'] = $param['status'] > 0 ? 1 : '0';
        } elseif (isset($param['type']) && $param['type'] == 'phone') {
            $where['phone']   = $param['phone'];
            $sms_code_1       = Cache::store('redis')->get('sms' . $param['phone']);
            $code             = $param['code'] ?? '';
            $data['phone_yz'] = $param['status'] > 0 ? 1 : '0';
        } elseif (isset($param['type']) && $param['type'] == 'google') {
            $code  = $param['code'] ?? '';
            $cansu = '';
            if (isset($param['phone']) && $param['phone'] > 0) {
                $cansu          = $param['phone'];
                $where['phone'] = $param['phone'];
            } elseif (isset($param['email']) && $param['email'] > 0) {
                $cansu          = $param['email'];
                $where['email'] = $param['email'];
            }

            $sign = $this->makeSign($param['uid'], $param['time'], $param['uid']);
            $find = Db::name('user')->where('id', $param['uid'])->find();

            if (isset($param['sign']) && $param['sign'] !== $sign) {
                $result = ['status' => 0, 'message' => '签名验证失败', 'result' => []];
                return json($result);
            }

            $res = $this->create_gas($cansu, $param['uid']);

            $data['verification_status'] = $param['status'] > 0 ? 1 : '0';

            if ($res['one_code'] != $code) {

                $result = ['status' => 0, 'message' => 'google验证码错误', 'result' => $res];
                return json($result);
            }
            $data['google_secret'] = $res['google_secret'];
            $data['qr_code_url']   = $res['qr_code_url'];
            $res                   = Db::name('user')->where('id', $param['uid'])->update($data);
            if (!$res) {
                $result = ['status' => 0, 'message' => '参数错误', 'result' => []];
                return json($result);
            }
            if ($data['verification_status'] > 0) {
                $result = ['status' => 1, 'message' => 'google验证开启成功', 'result' => []];

            } else {
                $result = ['status' => 1, 'message' => 'google验证已经关闭', 'result' => []];
            }
            return json($result);
        }
        if ($param['status'] == '') {
            $result = ['status' => 0, 'message' => '错误的status参数', 'result' => []];
            return json($result);
        }

        if (isset($param['uid'])) {
            if (!is_numeric($param['uid'])) {
                $result = ['status' => 0, 'message' => 'uid只能为数字', 'result' => []];
                return json($result);
            }
            $where['id'] = $param['uid'];
        }

        if ($param['status'] < 1) {
            if ($code != $param['code'] || $param['code'] == '') {

                $result = ['status' => 0, 'message' => '验证码错误', 'result' => []];
                return json($result);
            }
        }

        $res = Db::name('user')->where($where)->update($data);
        $msg = $param['status'] > 0 ? '开启成功' : '已经关闭';
        if ($res) {
            $result = ['status' => 1, 'message' => $msg, 'result' => []];
            return json($result);
        } else {
            $result = ['status' => 0, 'message' => '错误的参数', 'result' => []];
            return json($result);
        }
    }

    /* 交易密码修改*/
    public function changetradepwd()
    {

        if ($this->request->param()) {
            $param = $this->request->param();
            if (isset($param['uid'])) {
                if (!is_numeric($param['uid'])) {
                    $result = ['status' => 0, 'message' => 'uid只能为数字', 'result' => []];
                    return json($result);
                }

                if (isset($param['email']) && $param['email'] != '') {
                    $mail = Cache::store('redis')->get('mail' . $param['email']);
                    if ($mail['code'] != $param['emailCode']) {
                        $result = ['status' => 0, 'message' => '邮箱验证码错误', 'result' => []];
                        return json($result);
                    }

                }

                if (isset($param['phone']) && $param['phone'] != '') {
                    $mail = Cache::store('redis')->get('sms' . $param['phone']);
                    if ($mail['code'] != $param['phoneCode']) {
                        $result = ['status' => 0, 'message' => '短信验证码错误', 'result' => []];
                        return json($result);
                    }

                }
                if (isset($param['google']) && $param['google'] == 1) {
                    $google  = new GoogleAuthenticator();
                    $find    = Db::name('user')->where('id', $param['uid'])->find();
                    $oneCode = $google->getCode($find['google_secret']);
                    if ($oneCode != $param['googleCode']) {
                        $result = ['status' => 1, 'message' => '谷歌验证码错误', 'result' => []];
                        return json($result);
                    }

                }
                $sign = $this->makeSign($param['uid'], $param['time'], $param['uid']);
                if (@$param['sign'] !== $sign) {
                    $result = ['status' => 0, 'message' => '验名验证失败', 'result' => []];
                    return json($result);
                }

                if (isset($param['tradepassword'])) {
                    $data['trans_password'] = xn_encrypt($param['tradepassword']);
                    $data['update_time']    = time();
                    $res                    = Db::name('user')->where('id', $param['uid'])->save($data);
                    if ($res) {

                        return json(['status' => 1, 'message' => '交易密码修改成功', 'result' => []]);
                    } else {

                        return json(['status' => 0, 'message' => '交易密码修改失败', 'result' => []]);
                    }

                }

            }

        }
    }
    //更新邮箱
    public function changeemail()
    {
        if ($param = $this->request->param()) {
            if (!filter_var($param['old_email'], FILTER_VALIDATE_EMAIL)) {
                $result = ['status' => 0, 'message' => '错误的旧邮箱地址', 'result' => []];
                return json($result);

            }
            if (!filter_var($param['new_email'], FILTER_VALIDATE_EMAIL)) {
                $result = ['status' => 0, 'message' => '错误的新邮箱地址', 'result' => []];
                return json($result);

            }
            $mail = Cache::store('redis')->get('mail' . $param['old_email']);
            if ($mail['code'] != $param['code']) {
                $result = ['status' => 0, 'message' => '旧邮箱验证码错误', 'result' => []];
                return json($result);
            }
            $where['email'] = $param['old_email'];
            if (isset($param['uid'])) {
                if (!is_numeric($param['uid'])) {
                    $result = ['status' => 0, 'message' => 'uid只能为数字', 'result' => []];
                    return json($result);
                }
                $where['id'] = $param['uid'];
            }
            $has = Db::name('user')->where('email', $param['new_email'])->find();
            if ($has) {
                $result = ['status' => 0, 'message' => '新邮箱已存在', 'result' => []];
                return json($result);
            }
            $res = Db::name('user')->where($where)->update(['email' => $param['new_email']]);
            if ($res) {
                $result = ['status' => 1, 'message' => '邮箱地址更换成功', 'result' => []];
                return json($result);

            }
        }
        $result = ['status' => 0, 'message' => '错误的邮箱参数', 'result' => []];
        return json($result);
    }
    //更新手机
    public function changephone()
    {

        if ($param = $this->request->param()) {
            if (!is_numeric($param['old_phone']) || strlen($param['old_phone']) != 11) {

                $result = ['status' => 0, 'message' => '旧手机号格式出错', 'result' => []];
                return json($result);
            }
            if (!is_numeric($param['new_phone'])) {
                $result = ['status' => 0, 'message' => '新手机号格式出错', 'result' => []];
                return json($result);

            }
            $has = Db::name('user')->where('phone', $param['new_phone'])->find();
            if ($has) {
                $result = ['status' => 0, 'message' => '新手机号已经存在', 'result' => []];
                return json($result);
            }
            $where['phone'] = $param['old_phone'];
            if (isset($param['uid'])) {
                if (!is_numeric($param['uid'])) {
                    $result = ['status' => 0, 'message' => 'uid只能为数字', 'result' => []];
                    return json($result);
                }
                $where['id'] = $param['uid'];
            }

            $sms_code_1 = Cache::store('redis')->get('sms' . $param['old_phone']);

            if ($sms_code_1['code'] != $param['code']) {
                $result = ['status' => 0, 'message' => '旧手机验证码错误', 'result' => []];
                return json($result);
            }
            if (isset($param['citycode'])) {

                $res = Db::name('user')->where($where)->update(['phone' => $param['new_phone'], 'username' => $param['new_phone'], 'citycode' => $param['citycode']]);
            } else {
                $res = Db::name('user')->where($where)->update(['phone' => $param['new_phone'], 'username' => $param['new_phone']]);
            }

            if ($res) {
                $result = ['status' => 1, 'message' => '手机号更换成功', 'result' => []];
                return json($result);

            }
        }
        $result = ['status' => 0, 'message' => '错误的手机参数', 'result' => []];
        return json($result);

    }
    /* 短信验证*/
    public function checksms()
    {

        if ($this->request->param()) {

            $param = $this->request->param();

            $sms_code_1 = Cache::store('redis')->get('sms' . $param['phone']);
            $code       = $param['code'];
            if ($param['type'] == 'get' && isset($param['sign'])) {
                $info = Db::name('user')->where('phone', $param['phone'])->find();
                $sign = $this->makeSign($info['id'], $param['time'], $param['code']);
                if ($sign !== $param['sign']) {
                    $result = ['status' => 0, 'message' => '签名验证失败', 'result' => []];
                    return json($result);
                }

            }
            if ($sms_code_1['code'] == $param['code']) {
                if (isset($param['type']) && $param['type'] == 'get') {

                    return json(['status' => 1, 'message' => '短信验证成功', 'result' => []]);
                }

                if (isset($param['type']) && $param['type'] == 'changepwd') {

                    if (isset($param['tradepassword'])) {
                        $data['trans_password'] = xn_encrypt($param['phone']);
                        Db::name('user')->where('phone', $param['phone'])->save($data);

                        return json(['status' => 1, 'message' => '交易密码修改成功', 'result' => []]);
                    }

                } elseif (isset($param['type']) && $param['type'] == 'add') {
                    $data['phone']    = $param['phone'];
                    $data['username'] = $param['phone'];
                    $has              = Db::name('user')->where('phone', $param['phone'])->find();
                    if ($has) {
                        $result = ['status' => 0, 'message' => '该手机号已存在', 'result' => []];
                        return json($result);
                    }
                    $getres = Db::name('user')->where('email', $param['email'])->update($data);
                    if ($getres) {

                        return json(['status' => 1, 'message' => '手机号添加成功', 'result' => []]);
                    } else {

                        return json(['status' => 0, 'message' => '手机号添加失败', 'result' => []]);
                    }
                }

            } else {

                $result = ['status' => 0, 'message' => '验证错误，请再试', 'result' => []];
                return json($result);
            }
            $result = ['status' => 0, 'message' => '参数不足', 'result' => []];
            return json($result);
        }

    }

    /* 邮箱验证*/
    public function checkmail()
    {

        if ($param = $this->request->param()) {

            $mail = Cache::store('redis')->get('mail' . $param['email']);
            if ($mail['code'] == $param['code'] && $mail['code'] != '') {

                if (isset($param['type']) && $param['type'] == 'add') {
                    $data['email'] = $param['email'];

                    $where['username'] = $param['username'];
                    $tt                = Db::name('user')->where($where)->save($data);

                    $result = ['status' => 1, 'message' => '邮箱添加成功', 'result' => $data];
                    return json($result);
                } elseif (isset($param['type']) && $param['type'] == 'get') {
                    $result = ['status' => 1, 'message' => '邮箱验证成功', 'result' => $data];
                    return json($result);
                }

            } else {

                $result = ['status' => 0, 'message' => '验证错误，请再试', 'result' => []];
            }
            return json($result);
        }
    }

    private function create_gas($phone, $uid = '')
    {
        if (is_numeric($phone)) {
            $where['username'] = $phone;
        } else {
            $where['email'] = $phone;
        }
        $find = Db::name('user')->where($where)->find();
        if ($uid > 0) {
            $find = Db::name('user')->where('id', $uid)->find();
        }

        $google = new GoogleAuthenticator();
        //生成验证秘钥
        if ($find['google_secret']) {
            $secret           = $find['google_secret'];
            $data             = $find;
            $data['one_code'] = $google->getCode($secret);
            $username         = $phone;
            $qrCodeUrl        = $google->getQRCodeGoogleUrl($username, $secret);
            unset($find['password']);
            unset($find['trans_password']);
            $data['qr_code_url']   = $qrCodeUrl;
            $data['google_secret'] = $secret;
            $checkResult           = $google->verifyCode($secret, $oneCode, 2);
        } else {
            $secret = $google->createSecret();

            $data = Db::name('user')->where($where)->find();
            unset($data['password']);
            unset($data['trans_password']);
            //生成验证二维码 $username 需要绑定的用户名

            $username  = $phone;
            $qrCodeUrl = $google->getQRCodeGoogleUrl($username, $secret);

            //getCode('生成的密钥')
            $oneCode = $google->getCode($secret);
            if ($uid > 0) {
                Db::name('user')->where('id', $uid)->update(['google_secret' => $secret, 'qr_code_url' => $qrCodeUrl]);
            } else {
                Db::name('user')->where($where)->update(['google_secret' => $secret, 'qr_code_url' => $qrCodeUrl]);
            }

            $checkResult           = $google->verifyCode($secret, $oneCode, 2);
            $data['google_secret'] = $secret;
            $data['qr_code_url']   = $qrCodeUrl;

            $data['one_code'] = $oneCode;
        }

        if ($checkResult && $data) {

            return $data;
        }

        return $data;
    }
    private function makeSign($uid, $time, $_str = '')
    {
        $key = Cache::store('redis')->get('appPrivateKey');
        if (empty($key)) {
            $key = config('app.appPrivateKey');
            Cache::store('redis')->set('appPrivateKey', $key, 600);

        }
        $token = Cache::store('redis')->get('token' . $uid);
        $str   = $key . $token . $time . $_str;
        return md5($str);

    }
}
