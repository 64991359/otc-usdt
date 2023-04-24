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
//use think\captcha\facade\Captcha;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use think\facade\Cache;
use think\facade\Db;
use think\facade\Request;
use think\facade\Session;use think\facade\View;

class Account extends Base
{
    public function index()
    {

        return view('', init_view());
    }
    public function notifications()
    {
        $is_login = '';
        $res      = Session::get('user_auth');

        $msg      = Session::get('msg');
        $where    = ['uid' => $res['uid']];
        $user_msg = Db::name('user_msg')->where($where)->cache(true, 60)->order('id desc')->limit(10)->select();
        if ($res) {
            $is_login = 1;

            View::assign('user', $res);
            View::assign('nosender', $res['nosender']);

            View::assign('user_msg_nums', Session::get('user_msg_nums'));

            View::assign('notice_nums', Session::get('notice_nums'));

            View::assign('msg', $msg['user_msg']);
            View::assign('notice', $msg['sys_notice'][0]);
        }
        View::assign('is_login', $is_login);
        View::assign('user_msg', $user_msg);
        return view();
    }
    public function history()
    {
        $is_login = '';
        $res      = Session::get('user_auth');

        $msg   = Session::get('msg');
        $where = ['uid' => $res['uid']];

        if ($res) {
            $is_login = 1;

            View::assign('user', $res);

            View::assign('user_msg_nums', Session::get('user_msg_nums'));

            View::assign('notice_nums', Session::get('notice_nums'));

            View::assign('msg', $msg['user_msg']);
            View::assign('notice', $msg['sys_notice'][0]);
        }
        View::assign('is_login', $is_login);

        return view();
    }

    public function dashboard()
    {

        $is_login = '';
        $res      = Session::get('user_auth');

        $msg = Session::get('msg');

        $domain = input('server.REQUEST_SCHEME') . '://' . input('server.SERVER_NAME');
        if ($res) {
            $is_login = 1;
            $log      = Db::name('user_operation_log')->where('uid', $res['uid'])->order('id desc')->limit(5)->select();
            View::assign('user', $res);

            View::assign('user_msg_nums', Session::get('user_msg_nums'));

            View::assign('notice_nums', Session::get('notice_nums'));
            View::assign('login_log', $log);
            View::assign('msg', $msg['user_msg']);
            View::assign('notice', $msg['sys_notice']);
        }
        View::assign('is_login', $is_login);
        View::assign('domain', $domain);
        View::assign('resault_usdt', 5000);
        return view();

    }

    public function contacts()
    {
        //init_view();//初始用户变量

        return view('', init_view());
    }
    /*可信用户*/
    public function trusted()
    {
        //init_view();//初始用户变量

        return view('', init_view());
    }

    /*不可信用户*/
    public function blocked()
    {
        //init_view();//初始用户变量

        return view('', init_view());
    }

    /*收藏用户*/
    public function favorite_offers()
    {
        //init_view();//初始用户变量

        return view('', init_view());
    }

    /*支付方式*/
    public function payment()
    {

        //init_view();//初始用户变量

        $row = Session::get('user_auth');
        //dump($row);
        $where         = array();
        $where['uid']  = $row['uid'];
        $where['type'] = 'bank';
        $res           = Db::name('payment')->where($where)->find();

        $data             = init_view();
        $data['payments'] = Db::name('payment')->where($where)->limit(3)->select();
        $where['type']    = 'wallet';
        $data['wallet']   = Db::name('payment')->where($where)->limit(3)->find(); //网络钱包
        // $data['wallet']=1;
        if ($data['wallet']) {
            $data['wallets'] = Db::name('payment')->where($where)->limit(3)->select(); //网络钱包
        }
        // dump($data['wallet']);
        $data['bank'] = $res ? $res : 0;
        if ($param = $this->request->param()) {
            // unset($param['type']);
            if ($param['type'] == 'del_bank') {
                $del = Db::name('payment')->where('id', $param['id'])->delete();
                if ($del) {
                    $this->success('删除成功');exit;
                } else {
                    $this->error('删除失败');exit;
                }

            }
            if ($param['type'] == 'wallet') {
                if ($param['subtype'] == 0) {
                    $data               = array();
                    $data['wx_account'] = $param['account'];
                    $data['wx_qrcode']  = $param['qrcode'];
                    $data['type']       = $param['type'];
                    $data['subtype']    = $param['subtype'];
                    $data['title']      = $param['title'];
                    $data['uid']        = $row['uid'];
                    $data['qr_image']   = $this->getQRcode($param['qrcode']);

                    $wx = Db::name('payment')->where('wx_account', $param['account'])->find();
                    if ($wx) {
                        $this->error('该帐号已经存在');

                    }
                } elseif ($param['subtype'] == 1) {
                    $data                = array();
                    $data['zfb_account'] = $param['account'];
                    $data['zfb_qrcode']  = $param['qrcode'];
                    $data['type']        = $param['type'];
                    $data['subtype']     = $param['subtype'];
                    $data['title']       = $param['title'];
                    $data['uid']         = $row['uid'];
                    $data['qr_image']    = $this->getQRcode($param['qrcode']);
                    $zfb                 = Db::name('payment')->where('zfb_account', $param['account'])->find();
                    if ($zfb) {
                        $this->error('该帐号已经存在');

                    }
                } else {
                    $data                 = array();
                    $data['decp_account'] = $param['account'];
                    $data['decp_qrcode']  = $param['qrcode'];
                    $data['type']         = $param['type'];
                    $data['subtype']      = $param['subtype'];
                    $data['title']        = $param['title'];
                    $data['uid']          = $row['uid'];
                    $data['qr_image']     = $this->getQRcode($param['qrcode']);
                    $decp                 = Db::name('payment')->where('decp_account', $param['account'])->find();
                    if ($decp) {
                        $this->error('该帐号已经存在');

                    }
                }

                $res = Db::name('payment')->save($data);
                if ($res) {
                    $this->success($param['title'] . '添加成功');
                } else {
                    $this->success($param['title'] . '添加失败');
                }
            }
            if ($param['id'] > 0) {
                $where        = array();
                $where['uid'] = $row['uid'];
                $where['id']  = $param['id'];
            } else {
                unset($param['id']);
                //$where['uid']=$row['uid'];
            }
            $has = Db::name('payment')->where('bank_number', $param['bank_number'])->find();
            if ($has) {
                $this->error('该卡号已经存在');

            }
            if (empty($param['id'])) {
                $param['uid'] = $row['uid'];
                Db::name('payment')->save($param);
                $tip = '银行卡添加成功';
            } else {
                $tip = '银行卡保存成功';
                Db::name('payment')->where($where)->save($param);
            }

            $this->success($tip);
        }

        return view('', $data);
    }
    /*安全问题*/
    public function security()
    {
        //init_view();//初始用户变量
        $browser                    = Session::get('browser');
        $login_time                 = Session::get('login_time');
        $city                       = Session::get('city');
        $ip                         = Session::get('ip');
        $row                        = Session::get('user_auth');
        $qrCodeUrl                  = '';
        $data                       = init_view();
        $data['user']['login_time'] = $login_time;
        $data['user']['city']       = $city;
        $data['user']['browser']    = $browser;
        $data['user']['ip']         = $ip;
        // dump($row);
        if ($row['a1'] && $row['a2'] && $row['a3']) {
            $data['as'] = 1;
        } else {
            $data['as'] = 0;
        }

        empty($row['uid']) && $this->error('用户信息不存在');
        if (empty($row['google_key']) || empty($row['qr_code_url'])) {
            $google = new GoogleAuthenticator();
            //生成验证秘钥
            $secret = $google->createSecret();
            //生成验证二维码 $username 需要绑定的用户名

            $username  = Request::domain(1);
            $qrCodeUrl = $google->getQRCodeGoogleUrl($username, $secret);

            if (empty($row['google_key'])) {
                $row['google_key']  = $secret;
                $row['qr_code_url'] = $qrCodeUrl;
                Session::set('user_auth', $row);
            }
            $data['user']['qr_code_url'] = $row['qr_code_url'];
            $data['user']['google_key']  = $row['google_key'];
            Session::set('user_auth', $row);
            Db::name('user')->where('id', $row['uid'])->save(['qr_code_url' => $qrCodeUrl, 'google_key' => $secret]);
        }
        //以下是sns
        $data['user']['msg_login_status'] = $row['msg_login_status'];

        $data['user']['msg_send_status'] = $row['msg_send_status'];
        $data['user']['msg_get_status']  = $row['msg_get_status'];

        if ($row['msg_login_status'] == '0' && $row['msg_send_status'] == '0' && $row['msg_get_status'] == '0') {
            //dump($data);
            $data['user']['active_sns_open'] = 0;
            Db::name('user')->where('id', $row['uid'])->save(['active_sns_open' => '0']);
        } else {
            $data['user']['active_sns_open'] = $row['active_sns_open'];
        }

        $operation         = Db::name('user_operation_log')->where('uid', $row['uid'])->order('id desc')->limit(10)->select();
        $data['operation'] = $operation;
        return view('', $data);
    }

    /*修改密码*/
    public function modifypwd()
    {
        $res = Session::get('user_auth');
        if ($param = $this->request->param()) {
            $password1         = $param['p1'];
            $password2         = $param['p2'];
            $password3         = $param['p3'];
            $where['id']       = $res['uid'];
            $where['password'] = xn_encrypt($password1);
            $userinfo          = Db::name('user')->where($where)->find();
            if (!$userinfo) {
                $this->error('原密码错误');
            }
            if ($password2 !== $password3) {
                $this->error('两次密码不一致');
            }

            $data['password'] = xn_encrypt($password3);
            Db::name('user')->where('id', $res['uid'])->save($data);
            $time        = time();
            $information = Session::get('browser');
            $city        = Session::get('city');
            $ip          = Session::get('ip');

            $contents = '修改密码';
            $data     = ['uid' => $res['uid'], 'ip' => $ip, 'contents' => $contents, 'create_time' => $time, 'city' => $city, 'information' => $information];

            Db::name('user_operation_log')->save($data);
            $res[$type] = $status;
            Session::set('user_auth', $res);
            $this->success('密码修改成功', '', $data);
        }
    }
    //sns 短信开关api

    public function snsapi()
    {
        $res = Session::get('user_auth');
        if ($param = $this->request->param()) {
            $type        = $param['type'];
            $status      = $param['status'];
            $data        = array();
            $data[$type] = $status;
            if ($status > 0) {
                $data['active_sns_open'] = 1;
                $res['active_sns_open']  = 1;
            }
            Db::name('user')->where('id', $res['uid'])->save($data);
            $res[$type] = $status;
            Session::set('user_auth', $res);
            $this->success('保存成功', '', $data);
        }
    }
    /*设置安全问题*/
    public function questions()
    {
        //init_view();//初始用户变量
        $res = Session::get('user_auth');
        //dump($res);
        if ($param = $this->request->param()) {
            check_login();
            $res['q1'] = $param['q1'];
            $res['q2'] = $param['q2'];
            $res['q3'] = $param['q3'];
            $res['a1'] = $param['a1'];
            $res['a2'] = $param['a2'];
            $res['a3'] = $param['a3'];
            Session::set('user_auth', $res);
            Db::name('user_info')->where('uid', $res['uid'])->save($param);
            $time        = time();
            $information = Session::get('browser');
            $city        = Session::get('city');
            $ip          = Session::get('ip');

            $contents = '设置安全问题';
            $data     = ['uid' => $res['uid'], 'ip' => $ip, 'contents' => $contents, 'create_time' => $time, 'city' => $city, 'information' => $information];

            Db::name('user_operation_log')->save($data);
            $this->success('保存成功', '', $param);

        }
        // $data['user']=init_view();
        return view('', init_view());
    }

    /* google验证*/
    public function google_check_code()
    {

        if ($this->request->param()) {
            $param     = $this->request->param();
            $user_data = Session::get('user_auth');

            $code   = $param['code_1'] . $param['code_2'] . $param['code_3'] . $param['code_4'] . $param['code_5'] . $param['code_6'];
            $status = $param['status'];
            // $google_secret 服务端的 "安全密匙SecretKey"
            // $code 手机上看到的 "一次性验证码"
            // 最后一个参数 为容差时间,这里是2 那么就是 2* 30 sec 一分钟.
            $google_secret = $user_data['google_key'];

            $qr_code_url = $user_data['qr_code_url'];
            $google      = new GoogleAuthenticator();
            $checkResult = $google->verifyCode($google_secret, $code, 2);

            $user_data['google_key_status'] = $status;

            $title = $status == 1 ? '已开启google验证，谢谢!' : '已关闭google验证，谢谢!';
            if ($checkResult) {
                $time        = time();
                $information = Session::get('browser');
                $city        = Session::get('city');
                $ip          = Session::get('ip');

                $contents = $status == 1 ? '已开启google验证' : '已关闭google验证';
                $data     = ['uid' => $user_data['uid'], 'ip' => $ip, 'contents' => $contents, 'create_time' => $time, 'city' => $city, 'information' => $information];

                Db::name('user_operation_log')->save($data);
                $user_data = Session::get('user_auth');
                Db::name('user')->where('username', $user_data['username'])->save(['google_key_status' => $status, 'google_key' => $google_secret, 'qr_code_url' => $qr_code_url]);
                Db::name('user_msg')->save(['create_time' => $time, 'sender' => '0', 'uid' => $user_data['uid'], 'title' => $title, 'contents' => '<p><span style="color: rgb(32, 33, 36); font-family: consolas, &quot;lucida console&quot;, &quot;courier new&quot;, monospace; font-size: 12px; white-space: pre-wrap; background-color: rgb(255, 255, 255);">' . $title . '！</span></p>']);
                $user_data['google_key_status'] = $status;
                Session::set('user_auth', $user_data);
                $msg = $status ? '开启成功' : '关闭成功';
                $this->success($msg);
            } else {
                $this->error('谷歌验证码错误');
            }
        }

    }

    private function getQRcode($url)
    {
        $options = new QROptions([
            'version'    => 5, //二维码版本
            'outputType' => QRCode::OUTPUT_IMAGE_JPG, //生成图片
            'eccLevel'   => QRCode::ECC_L, //错误级别
            'scale'      => 10, //二维码大小
        ]);
        $qrcode = new QRCode($options);
        //第一种方式  将二维码保存到服务器中
        $time      = time();
        $user_data = Session::get('user_auth');
        $path      = "./qrcode/" . $user_data['uid'] . $time . ".jpg";
        $qrcode->render($url, $path);

        //第二种方式，将二维码直接生成base64格式的图片
        // $qrcode->render('htttp://www.baidu.com');

        return substr($path, 1);
    }

}
