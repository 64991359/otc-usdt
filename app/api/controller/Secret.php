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
use think\facade\Db;
use think\facade\Log;use think\Request;

class Secret extends Base
{

    public function index()
    {
        if ($param = $this->request->param()) {
            if ($param['phone'] != '' && !is_numeric($param['phone'])) {
                $result = ['status' => 0, 'message' => '参数出错', 'result' => []];
                return json($result);
            }

            if ($param['phone']) {

                $where['username'] = $param['phone'];
            } else {

                $where['email'] = $param['email'];
            }

            $data = Db::name('user')->where($where)->find();

            if ($data) {
                unset($data['password']);
                unset($data['trans_password']);
                $result = ['status' => 1, 'message' => '取得谷歌验证', 'result' => []];
                return json($result);
            }
            $result = ['status' => 0, 'message' => '取得谷歌验证失败', 'result' => []];
            return json($result);
        }
    }

    //修改验证
    public function api()
    {

        if ($param = $this->request->param()) {
            // Log::record($param);
            if ($param['phone'] != '' && !is_numeric($param['phone'])) {
                $result = ['status' => 0, 'message' => '修改谷歌验证失败', 'result' => []];
                return json($result);
            }
            if ($param['email'] != '' && !filter_var($param['email'], FILTER_VALIDATE_EMAIL)) {
                $result = ['status' => 0, 'message' => '修改谷歌验证失败', 'result' => []];
                return json($result);
            }
            $status = $param['status'] ?? 0;
            $phone  = $param['phone'];
            $data   = '';
            if ($phone) {
                $where['username'] = $phone;
            }
            if ($param['email']) {
                $where['email'] = $param['email'];
            }
            $data = Db::name('user')->where($where)->find();

            $data['verification_status'] = $status;
            if (!empty($data['google_secret'])) {

                Db::name('user')->where($where)->save(['verification_status' => $status]);
                $result = ['status' => 1, 'message' => '修改谷歌验证成功', 'result' => $data];
                return json($result);

            } else {
                $domain = input('server.REQUEST_SCHEME') . '://' . input('server.SERVER_NAME');

                $usercode = $phone ? $phone : $param['email'];
                $res_temp = $this->create_ga($usercode);

                $res_temp = json_decode($res_temp, 1);

                if ($res_temp['status'] == 1) {

                    if (isset($res_temp['one_code'])) {
                        unset($res_temp['one_code']);
                    }
                    $res_temp['verification_status'] = $status;

                    Db::name('user')->where($where)->save($res_temp['result']);

                } else {
                    $result = ['status' => 0, 'message' => '修改谷歌验证失败', 'result' => []];
                }

            }

            $data = Db::name('user')->where($where)->find();

            $result = ['status' => 1, 'message' => '修改谷歌验证成功', 'result' => $data];

        } else {
            $result = ['status' => 0, 'message' => '修改谷歌验证失败', 'result' => []];

        }
        return json($result);
    }

    private function create_ga($phone)
    {
        if (is_numeric($phone)) {
            $where['username'] = $phone;
        } else {
            $where['email'] = $phone;
        }
        $find = Db::name('user')->where($where)->find();

        $google = new GoogleAuthenticator();
        //生成验证秘钥

        if ($find['google_secret'] > 0) {

            $secret = $find['google_secret'];
        } else {

            $secret = $google->createSecret();
        }

        //生成验证二维码 $username 需要绑定的用户名
        // $username=Request::domain(1);
        $username  = $phone;
        $qrCodeUrl = $google->getQRCodeGoogleUrl($username, $secret);

        //getCode('生成的密钥')
        $oneCode = $google->getCode($secret);

        //verifyCode('生成密钥','一次性验证码',2)  //2:  2*30=60秒误差
        $checkResult           = $google->verifyCode($secret, $oneCode, 2);
        $data['google_secret'] = $secret;
        $data['qr_code_url']   = $qrCodeUrl;

        $data['one_code'] = $oneCode;

        if ($checkResult && $data) {

            $result = ['status' => 1, 'message' => '生成谷歌验证成功', 'result' => $data];
            return json($result);
        }

        $result = ['status' => 0, 'message' => '生成谷歌验证失败', 'result' => []];
        return json($result);
    }

    public function yanzhenga()
    {
        if ($param = $this->request->param()) {
            // Log::record($param);
            $phone = $param['phone'];
            $email = $param['email'];
            if ($phone && is_numeric($phone)) {
                $where['phone'] = $phone;
                $find           = Db::name('user')->where('phone', $phone)->find();
                $code           = Cache::store('redis')->get('sms' . $param['phone']);
                $msg            = '短信验证码不正确';
                $code2          = $param['code2'];
                if ($param['type'] == 'get' && $code['code'] !== $code2) {

                    $result = ['status' => 0, 'message' => $msg, 'result' => []];
                    return json($result);
                }
            }
            if ($email) {
                $where['email'] = $email;
                $find           = Db::name('user')->where('email', $email)->find();
                $code           = Cache::store('redis')->get('mail' . $param['email']);
                $msg            = '邮箱验证码不正确';
                $code2          = $param['code2'];
                if ($param['type'] == 'get' && $code['code'] !== $code2) {

                    $result = ['status' => 0, 'message' => $msg, 'result' => []];
                    return json($result);
                }
            }

            if ($find) {
                $google = new GoogleAuthenticator();

                $oneCode = $google->getCode($find['google_secret']);
                if (isset($param['type']) && $param['type'] == 'get' && $oneCode == $param['code']) {
                    $result = ['status' => 1, 'message' => '谷歌验证成功', 'result' => ['one_code' => $oneCode]];
                    return json($result);
                }
                if (isset($param['type']) && $param['type'] == 'add' && $oneCode == $param['code']) {
                    $msg                         = $param['open'] == 1 ? '谷歌验证已打开' : '谷歌验证已关闭';
                    $data['verification_status'] = $param['open'];
                    $res                         = Db::name('user')->where($where)->save($data);

                    $result = ['status' => 1, 'message' => $msg, 'result' => $data];
                    return json($result);
                }
                if ($oneCode != $param['code']) {
                    $result = ['status' => 0, 'message' => '谷歌验证失败', 'result' => ['one_code' => $oneCode]];
                    return json($result);
                }

            }

        }
        $result = ['status' => 0, 'message' => '谷歌验证码失败', 'result' => []];
        return json($result);

    }

    public function anqu()
    {

    }

}
