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
use Oscar\IpGet\IpGet;
use think\exception\ValidateException;
use think\facade\Cache;
use think\facade\Config;
use think\facade\Db;
use think\facade\Log;
use think\facade\Session;
use think\Request;

class User extends Base
{
    public function register()
    {
        if ($param = $this->request->param()) {
            Db::startTrans();
            try {

                $where = array();
                if (isset($param['username']) && is_numeric($param['username'])) {
                    $where['username'] = $param['username'];
                    $data['username']  = $param['username'];
                    $data['phone']     = $param['username'];
                    if (isset($param['citycode'])) {
                        $data['citycode'] = $param['citycode'];
                    }
                } else {
                    $where['email'] = $param['username'];
                    $data['email']  = $param['username'];
                }
                $data['niname'] = niname();
                if (!isset($param['pid'])) {
                    $param['pid'] = 0;
                } elseif ($param['pid'] > 10000) {
                    $param['pid'] = $param['pid'] - 10000;
                    $admin_data   = '';
                    $admin_data   = User::where(['id' => $param['pid']])->find();

                    if (empty($admin_data)) {
                        Db::rollback();
                        return json(['status' => 0, 'message' => '无邀请码', 'result' => []]);
                    }
                }

                $user_data = Db::name('user')->where($where)->find();
                if (is_array($user_data)) {
                    Db::rollback();
                    $result = ['status' => 0, 'message' => '该帐号已存在', 'result' => []];
                    return json($result);
                }

                $password               = $param['password'];
                $data['password']       = xn_encrypt($param['password']);
                $data['trans_password'] = xn_encrypt(123456);

                $data['quota']         = 10;
                $data['register_time'] = time();
                $data['status']        = 1;
                $data['pid']           = $param['pid'];
                $id                    = Db::name('user')->insertGetId($data);
                $user_data             = Db::name('user')->where($where)->find();

                if ($id > 0) {
                    $has = Db::name('user_info')->where(['uid' => $id])->find();
                    if (empty($has)) {
                        Db::name('user_info')->save(['uid' => $id]);
                    }

                } else {
                    Db::rollback();
                    $result = ['status' => 0, 'message' => '注册失败', 'result' => []];
                    return json($result);
                }
                Db::name('wallet_temp')->save(['uid' => $id, 'status' => 1, 'create_time' => time()]); //生成钱包地址

                // 提交事务
                Db::commit();
                $param['password'] = $password;
                $result            = ['status' => 1, 'message' => '注册成功', 'result' => $param];
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                $result = ['status' => 0, 'message' => '注册失败', 'result' => []];
            }
            return json($result);

        }

    }
    public function auth()
    {
        if ($param = $this->request->param()) {
            $time = 7 * 24 * 1440 * 30;

            $uid   = $param['uid'];
            $token = Cache::store('redis')->get('token' . $uid);

            if (empty($token)) {
                $result = ['status' => 0, 'message' => '验证失败', 'result' => []];
                return json($result);

            }

            if ($token !== $param['token']) {
                $result = ['status' => 0, 'message' => '验证失败', 'result' => []];
                return json($result);
            }

            $header = Cache::store('redis')->get('header' . $uid);
            $result = ['status' => 1, 'message' => 'ok', 'result' => $header];

            return json($result);

        }
        return json(['status' => 0, 'message' => '验证失败', 'result' => []]);
    }
    public function login()
    {
        $domain = input('server.REQUEST_SCHEME') . '://' . input('server.SERVER_NAME');

        if ($param = $this->request->param()) {

            try {
                $this->validate($param, 'login');
            } catch (ValidateException $e) {
                $this->error($e->getError());
                exit;
            }

            if (is_numeric($param['username'])) {
                $where['username'] = $param['username'];
                $where['password'] = xn_encrypt($param['password']);
                if (isset($param['citycode']) && $param['citycode'] != '+86') {
                    $where['citycode'] = $param['citycode'];
                }
            } else {
                $where['email']    = $param['username'];
                $where['password'] = xn_encrypt($param['password']);
            }

            $user_data = Db::name('user')->where($where)->find();
            if (empty($user_data)) {
                return json(['status' => 0, 'message' => '帐号或密码错误', 'result' => []]);
            } elseif ($user_data['status'] == 0) {
                return json(['status' => 0, 'message' => '该帐号已禁用', 'result' => []]);
            }
            $user_data['uid'] = $user_data['id'];
            $uid              = $user_data['id'];
            $register_time    = $user_data['register_time'];
            $just_reg         = time() - $register_time;
            if ($just_reg < 300) {
                $has_temp = Db::name('wallet_temp')->where('uid', $uid)->find();
                if (empty($has_temp)) {
                    Db::name('wallet_temp')->save(['uid' => $uid, 'status' => 1, 'create_time' => time()]); //生成钱包地址
                }

            }

            $address = Db::name('user_address')->where(['uid' => $uid])->find();
            if ($address) {
                $user_data = array_merge($user_data, $address);
                unset($user_data['trc20_key']);
                unset($user_data['erc20_key']);
                unset($user_data['trans_password']);
                unset($user_data['password']);

            }

            $where = array();
            if (empty($user_data)) {
                return json(['status' => 0, 'message' => '用户名或密码不正确', 'result' => []]);

            }

            $where = ['uid' => $uid];

            $user_msg = Db::name('user_msg')->where($where)->limit(10)->select();
            $nosender = 0;
            foreach ($user_msg as $v) {

                $nosender = $nosender + $v['sender'];

            }
            $nosender = $nosender > 0 ? '0' : '1';

            $user_data['nosender'] = $nosender;

            $where = array();

            $sys_notice = Db::name('sys_notice')->where('create_time', '>', $user_data['notice_update_time'])->limit(5)->select();
            $sys_notice = $sys_notice->toArray();
            $info       = array();
            $no_read    = 0;
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
            $information = $information ?? 'na';
            Session::set('browser', $information);
            Session::set('login_time', $time);
            Session::set('city', $city);
            Session::set('ip', $ip);
            $data = ['uid' => $uid, 'ip' => $ip, 'contents' => '用户已登录', 'create_time' => $time, 'city' => $city, 'information' => $information];

            $log        = Db::name('user_operation_log')->save($data);
            $session_id = Session::getId();
            Session::set('session_id' . $uid, $session_id);

            Db::name('user')->where('id', $uid)->save(['session_id' => $session_id, 'last_login_time' => time()]);
      
            if ($log && is_array($user_data)) {
                $header               = $user_data;
                $header['token']      = $session_id;
                $header['session_id'] = $session_id;
                $header['uid']        = $uid;
                $help_url             = Cache::store('redis')->get('site_help');
                if ($help_url == '') {
                    $help_url = config('app.site_help');
                    Cache::store('redis')->set('site_help', $help_url, 3600);
                }
                $header['help_url'] = $help_url;
                unset($header['password']);
                $result = ['status' => 1, 'message' => '登陆成功', 'result' => $header]; //登陆成功
                //$time= 7 * 24 * 1440 * 60;
                $time = 14515200;
                Cache::store('redis')->set('token' . $uid, $session_id, $time);
                Cache::store('redis')->set('header' . $uid, $header, $time);
                return json($result); //登陆成功

            }
            return json(['status' => 0, 'message' => '登录出错', 'result' => []]);
     
        }
        return json(['status' => 0, 'message' => '登录出错', 'result' => []]);
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
        $information = $information ?? 'na';
        $data        = ['uid' => $user_data['uid'], 'ip' => $ip, 'contents' => '用户已退出', 'create_time' => $time, 'city' => $city, 'information' => $information];
        $res         = Db::name('user_operation_log')->save($data);
        Session::delete('user_auth');
        Session::delete('is_login');
        Session::delete('session_id');
        if ($res) {
     
        return json(['status' => 0, 'message' => '用户已退出', 'result' => []]);
          );
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

    public function changepassword()
    {
        if ($param = $this->request->param()) {
            $uid  = input('uid/d');
            $find = Db::name('user')->where(['id' => $uid])->find();
            $p1   = xn_encrypt($param['password']);
            if ($find['password'] !== $p1) {
                $result = ['status' => 0, 'message' => '原始密码错误', 'result' => []];

                return json($result);
            }
            $p2   = xn_encrypt($param['password2']);
            $save = Db::name('user')->where(['id' => $uid])->save(['password' => $p2]);
            if ($save) {
                return json(['status' => 1, 'message' => '密码修改成功', 'result' => ['password' => $param['password2']]]);
            }
            $result = ['status' => 0, 'message' => '密码修改错误', 'result' => []];
            return json($result);
        }
    }

    //服务端同步区块链余额
    public function checkbalance()
    {
        if ($param = $this->request->param()) {

            if ($param['uid']) {
                $id = $param['uid'];
                if ($id == '') {
                    $result = ['status' => 0, 'message' => 'error', 'result' => []];
                    return json($result);
                }
                $has_res = '';
                $data    = Cache::store('redis')->get('check_balance' . $id);
                if (is_array($data)) {
                    $result = ['status' => 1, 'message' => 'ok', 'result' => $data];

                    return json($result);
                }
                $has_res = Db::name('check_balance')->where(['uid' => $id])->find();
                $data    = ['uid' => $id, 'status' => 1, 'update_time' => time()];
                Cache::store('redis')->set('check_balance' . $id, $data, 60);
                if (empty($has_res)) {

                    Db::name('check_balance')->save($data);
                } else {
                    Db::name('check_balance')->where(['uid' => $id])->save($data);
                }

                $result = ['status' => 1, 'message' => 'ok', 'result' => $data];

                return json($result);
            }
        }
    }
    //用户取余额
    public function balance()
    {
        if ($param = $this->request->param()) {

            $id = $param['uid'];
            if ($id == '' || $id < 1) {
                $result = ['status' => 0, 'message' => 'error', 'result' => []];
                return json($result);
            }
            $data = Cache::store('redis')->get('balance' . $id);
            if (empty($data)) {
                $data = Db::name('user')->where(['id' => $id])->find();
                unset($data['password']);unset($data['trans_password']);
                Cache::store('redis')->set('balance' . $id, $data, 30);
            }

            $result = ['status' => 1, 'message' => 'ok', 'result' => $data];
            return json($result);
        }
    }

    public function transfer()
    {
        //取手续费跟余额
        if ($param = $this->request->param()) {
            Log::record('transfer----------------------------------');
            Log::record($param);
            $key = Cache::store('redis')->get('appPrivateKey');
            if (empty($key)) {
                $key = config('app.appPrivateKey');
                Cache::store('redis')->set('appPrivateKey', $key, 600);

            }

            if (isset($param['orderNo'])) {
                $order = Db::name('transfer_record')->where('order_no', $param['orderNo'])->find();
                if ($order['status']) {
                    return json(['status' => 1, 'message' => '查询成功', 'result' => ['status' => $order['status']]]);
                } else {
                    return json(['status' => 0, 'message' => '查询中', 'result' => []]);
                }
            }

            if (isset($param['type'])) {
//提交转帐订单 && $param['type']=='trc20'
                $uid   = $param['uid'];
                $token = Cache::store('redis')->get('token' . $uid);
                $str   = $key . $token . $param['time'] . $param['to_address'];
                $sign  = md5($str);

                if (@$param['sign'] !== $sign) {
                    $result = ['status' => 0, 'message' => '签名验证失败', 'result' => []];
                    return json($result);
                }
                if ($param['amount'] < 2) {
                    $result = ['status' => 0, 'message' => '转帐金额不能小于2U', 'result' => []];
                    return json($result);
                }
                Db::startTrans();
                try {
                    $status       = 0;
                    $trans_config = Cache::store('redis')->get('transfer_config');
                    if (empty($trans_config)) {

                        $trans_config = Db::name('transfer_config')->where(['id' => 1])->find();

                        Cache::store('redis')->set('transfer_config', $trans_config, 300);
                    }
                    if ($trans_config['transfer_status'] == 1) {
                        $status = 1;
                    } elseif ($trans_config['transfer_status'] == 2 && $param['amount'] <= $trans_config['amount']) {
//多少钱以下自动
                        $status = 1;
                    } elseif ($trans_config['transfer_status'] == 3 && $param['amount'] >= $trans_config['amount']) {
//多少钱以上自动
                        $status = 1;
                    }
                    $uid      = $param['uid'];
                    $userinfo = Db::name('user')->where(['id' => $uid])->find();
                    if ($param['amount'] > $userinfo['usdt_nums']) {
                        Db::rollback();
                        $result = ['status' => 0, 'message' => '金额不足', 'result' => []];
                        return json($result);
                    }
                    $form_address = Db::name('user_address')->where('uid', $uid)->find();
                    if ($form_address['trc_address'] == $param['to_address'] || $form_address['erc_address'] == $param['to_address']) {
                        Db::rollback();
                        return json(['status' => 0, 'message' => '不能给自己转帐', 'result' => []]);
                    }
                    if ($userinfo['frozen_usdt'] > 0) {
                        Db::rollback();
                        return json(['status' => 0, 'message' => '你还有一个转帐订单未完成', 'result' => []]);
                    } else {
                        $touser = Db::name('user_address')->where('trc_address', $param['to_address'])->find();
                        if ($trans_config['platform_free_charge'] == 1 && !empty($touser)) {
                            //内转免费处理
                            //充值数据
                            $recharge                  = array();
                            $recharge['type']          = 'tx';
                            $recharge['network']       = 'TRX';
                            $recharge['block_no']      = 50000;
                            $recharge['height']        = 50000;
                            $recharge['index_no']      = 200;
                            $recharge['create_time']   = time();
                            $recharge['txid']          = '内转';
                            $recharge['confirmations'] = 200;
                            $recharge['from_address']  = $param['type'] == 'trc20' ? $form_address['trc_address'] : $form_address['erc_address'];
                            $recharge['to_address']    = $param['type'] == 'trc20' ? $touser['trc_address'] : $touser['erc_address'];
                            $recharge['usdt_nums']     = $param['amount'] * 1000000;
                            $recharge['token']         = $param['type'] == 'trc20' ? 'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t' : '0xdac17f958d2ee523a2206206994597c13d831ec7';
                            $recharge['uid']           = $touser['uid'];
                            $recharge['update_time']   = time();
                            $recharge['finished']      = 1;
                            $recharge['transfer_type'] = 1; //转入
                            Db::name('recharge_record')->save($recharge);
                            $recharge['transfer_type'] = 0; //转出
                            $recharge['uid']           = $param['uid'];
                            Db::name('recharge_record')->save($recharge);
                            $remainusdt = $userinfo['usdt_nums'] - $param['amount'];
                            Db::name('user')->where(['id' => $uid])->save(['usdt_nums' => $remainusdt]);
                            Db::name('user')->where(['id' => $touser['uid']])->inc('usdt_nums', $param['amount'])->update();
                            $status            = 2;
                            $param['userFree'] = 0;
                            $param['arrival']  = $param['amount'];
                        } else {
                            $recharge                  = array();
                            $recharge['type']          = 'tx';
                            $recharge['network']       = 'TRX';
                            $recharge['block_no']      = 60000;
                            $recharge['height']        = 60000;
                            $recharge['index_no']      = 200;
                            $recharge['create_time']   = time();
                            $recharge['txid']          = '外转';
                            $recharge['confirmations'] = 300;
                            $recharge['from_address']  = $param['type'] == 'trc20' ? $form_address['trc_address'] : $form_address['erc_address'];
                            $recharge['to_address']    = $param['to_address'];
                            $recharge['usdt_nums']     = $param['amount'] * 1000000;
                            $recharge['token']         = $param['type'] == 'trc20' ? 'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t' : '0xdac17f958d2ee523a2206206994597c13d831ec7';

                            $recharge['update_time'] = time();
                            $recharge['finished']    = 1;

                            $recharge['transfer_type'] = 0; //转出
                            $recharge['uid']           = $param['uid'];

                            Db::name('recharge_record')->save($recharge);
                            $remainusdt = $userinfo['usdt_nums'] - $param['amount'];
                            Db::name('user')->where(['id' => $uid])->save(['frozen_usdt' => $param['amount'], 'usdt_nums' => $remainusdt]);
                        }

                    }

                    $data                 = array();
                    $data['type']         = $param['type'];
                    $data['status']       = $status;
                    $data['txid']         = '';
                    $data['free']         = $param['userFree'];
                    $data['to_address']   = $param['to_address'];
                    $data['arrival']      = $param['arrival'];
                    $data['create_time']  = time(); //amount
                    $data['amount']       = $param['amount'] ?? 0.00;
                    $data['update_time']  = 0;
                    $data['order_no']     = create_osn() . $uid;
                    $data['uid']          = $param['uid'];
                    $data['form_address'] = $param['type'] == 'trc20' ? $form_address['trc_address'] : $form_address['erc_address'];

                    $res = Db::name('transfer_record')->save($data);
                    // 提交事务
                    Db::commit();
                    $result = ['status' => 1, 'message' => 'ok', 'result' => $data];
                } catch (\Exception $e) {
                    // 回滚事务
                    $result = ['status' => 0, 'message' => 'error', 'result' => []];
                    Db::rollback();
                }

                return json($result);
            }
            $trans_config = Cache::store('redis')->get('transfer_config');
            if (empty($trans_config)) {

                $trans_config = Db::name('transfer_config')->where(['id' => 1])->find();

                Cache::store('redis')->set('transfer_config', $trans_config, 300);
            }
            if (isset($param['getfree']) && $param['getfree'] > 0) {
//取手续费
                $uid  = $param['uid'];
                $user = Db::name('user')->where('id', $uid)->find();
                unset($user['password']);
                unset($user['trans_password']);
                $data   = array_merge($trans_config, $user);
                $result = ['status' => 1, 'message' => 'ok', 'result' => $data];

                return json($result);
            }
        }
    }

    public function transrecord()
    {
        if ($param = $this->request->param()) {
            if (is_numeric($param['uid'])) {
                $uid              = $param['uid'];
                $data['transfer'] = Db::name('transfer_record')->where('uid', $uid)->where('status', 2)->limit(20)->order('id desc')->select();
                $transrecord      = $data['transfer']->toArray(); //转出
                foreach ($transrecord as $k => $v) {
                    if ($v['amount'] > 0) {
                        $transrecord[$k]['usdt_nums'] = $v['amount'];
                        $transrecord[$k]['status']    = 2;
                    }
                }
                $data['transfer'] = $transrecord; //提现
                $data['recharge'] = Db::name('recharge_record')->where('uid', $uid)->where('finished', 1)->limit(20)->order('id desc')->select(); //充值
                $recharge         = $data['recharge']->toArray(); //充提值
                foreach ($recharge as $k => $v) {
                    if ($v['usdt_nums'] > 0) {
                        $recharge[$k]['usdt_nums'] = $v['usdt_nums'] / 1000000;
                        $recharge[$k]['status']    = 2;
                    }
                }
                $data['recharge'] = $recharge;
                $sell             = Db::name('order_sell')->where('uid', $uid)->limit(10)->order('create_time', 'desc')->select();

                $buy          = Db::name('order_buy')->where('uid', $uid)->limit(10)->order('create_time', 'desc')->select();
                $data['sell'] = $sell->toArray();

                $data['buy'] = $buy->toArray();
                if ($data) {
                    $result = ['status' => 1, 'message' => 'ok', 'result' => $data];
                } else {
                    $result = ['status' => 0, 'message' => 'error', 'result' => []];
                }

            } else {
                $result = ['status' => 0, 'message' => 'error', 'result' => []];
            }

            return json($result);
        }
    }
    //重置密码
    public function resetpwd()
    {
        if ($param = $this->request->param()) {
            $title = Config::get('app.sms_title');
            if (isset($param['type']) && $param['type'] == 'phone') {
                $sms = Cache::store('redis')->get('sms' . $param['phone']);
                if ($sms['code'] != $param['code']) {
                    $result = ['status' => 0, 'message' => '验证码出错', 'result' => []];
                    return json($result);
                }
                $rand             = generate_code(6);
                $rand             = 'p' . $rand;
                $data['password'] = xn_encrypt($rand);

                $res = Db::name('user')->where('phone', $param['phone'])->find();
                if (empty($res)) {
                    $result = ['status' => 0, 'message' => '找不到该手机号的用户', 'result' => []];
                    return json($result);
                }
                $u = Config::get('app.sms_user');
                $p = Config::get('app.sms_pwd');
                if (!empty($res['citycode']) && $res['citycode'] !== '+86') {
                    $touser = $res['citycode'] . $param['phone'];
                } else {
                    $touser = $param['phone'];
                }

                $resault1 = sms_mobile_pwd($u, $p, $touser, $rand, $title);
                $result2  = Db::name('user')->where('phone', $param['phone'])->update($data);
                $msg      = '密码已经重置，并已经发到你的手机短信';
                if ($result2) {
                    $result = ['status' => 1, 'message' => '您密码已经重置', 'result' => []];
                } else {
                    $result = ['status' => 0, 'message' => '参数错误，请稍后再试', 'result' => []];
                }
                return json($result);
            } elseif (isset($param['type']) && $param['type'] == 'email') {

                $mail = Cache::store('redis')->get('mail' . $param['email']);
                if ($mail['code'] != $param['code']) {
                    $result = ['status' => 0, 'message' => '验证码出错', 'result' => []];
                    return json($result);
                }

                $res = Db::name('user')->where('email', $param['email'])->find();
                //Log::record($res);
                if (empty($res)) {
                    $result = ['status' => 0, 'message' => '找不到该邮箱地址的用户', 'result' => []];
                    return json($result);
                }
                $rand             = generate_code(6);
                $rand             = 'p' . $rand;
                $data['password'] = xn_encrypt($rand);
                $mailModel        = new Email;
                $touser           = $param['email'];
                $res['username']  = isset($res['username']) ? $res['username'] : $param['email'];
                $contents         = '【' . $title . '】您密码已经重置为:' . $rand . '：（10分钟内有效，如非本人操作，请忽略）';
                $resault1         = $mailModel->sendMail($touser, $res['username'], $title, $contents);
                $result2          = Db::name('user')->where('email', $param['email'])->save($data);
                if ($resault1 && $result2) {
                    $result = ['status' => 1, 'message' => '您密码已经重置', 'result' => []];
                    return json($result);
                } else {
                    $result = ['status' => 0, 'message' => '参数错误，请稍后再试', 'result' => []];
                    return json($result);
                }

            } elseif ($param['type'] == '') {
                $result = ['status' => 0, 'message' => '参数错误', 'result' => []];
                return json($result);
            }
        }

    }
    //是不是站内地址
    public function testadd()
    {
        if ($param = $this->request->param()) {

            $where[] = ['trc_address|erc_address', '=', $param['add']];
            $find    = '';
            $find    = Db::name('user_address')->where($where)->find();

            if (is_array($find)) {
                $result = ['status' => 1, 'message' => '站内地址', 'result' => []];
            } else {
                $result = ['status' => 0, 'message' => '站外地址', 'result' => []];
            }

            return json($result);
        }
    }
}
