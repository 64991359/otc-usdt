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
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use sfz\IdentityCard;
use think\facade\Cache;use think\facade\Db;
use think\facade\Log;
use think\Request;

class Order extends Base
{
    //银行卡列表
    public function banklist()
    {
        if ($param = $this->request->param()) {
            $uid      = $param['uid'];
            $bankinfo = Db::name('payment')->where(['uid' => $uid, 'is_delete' => 0])->select();
            $bankinfo = _unsetNull($bankinfo);
            if (!$bankinfo) {
                $result = ['status' => 0, 'message' => '客户未设置银行卡', 'result' => []];
            } else {
                $result = ['status' => 1, 'message' => '获取成功', 'result' => $bankinfo];
            }
            return json($result);
        }
    }
    //添加银行卡
    public function bankadd()
    {
        if ($param = $this->request->param()) {
            $uid  = $param['uid'];
            $type = $param['type'];
            if ($type == 'bank') {
                if (!isset($param['bank_number']) || !isset($param['bank_kaihu']) || !isset($param['holder_name']) || !isset($param['bank_name'])) {
                    $result = ['status' => 0, 'message' => '参数不完整', 'result' => []];
                } else {
                    $bankinfo = Db::name('payment')->where(['uid' => $uid, 'bank_number' => $param['bank_number']])->find();
                    if ($bankinfo) {
                        $result = ['status' => 0, 'message' => '该银行卡号已存在', 'result' => []];
                    } else {
                        if ($param['bank_name'] == '数字人民币') {

                            $param['decp_qrcode'] = $this->getQRcode($param['bank_number'], $uid);
                        }
                        $data = ['decp_qrcode' => $param['decp_qrcode'], 'uid' => $uid, 'bank_number' => $param['bank_number'], 'bank_kaihu' => $param['bank_kaihu'], 'holder_name' => $param['holder_name'], 'bank_name' => $param['bank_name'], 'type' => $type];
                        Db::name('payment')->save($data);
                        $result = ['status' => 1, 'message' => '该银行卡添加成功', 'result' => []];
                    }
                }
            } elseif ($type == 'wx') {
                if (!isset($param['wx_account']) || !isset($param['holder_name']) || !isset($param['wx_qrcode'])) {
                    $result = ['status' => 0, 'message' => '参数不完整', 'result' => []];
                } else {
                    $wxinfo = Db::name('payment')->where(['uid' => $uid, 'wx_account' => $param['wx_account']])->find();
                    if ($wxinfo) {
                        $result = ['status' => 0, 'message' => '该微信号已存在', 'result' => []];
                    } else {
                        $data = ['uid' => $uid, 'wx_account' => $param['wx_account'], 'holder_name' => $param['holder_name'], 'wx_qrcode' => $param['wx_qrcode'], 'type' => $type];
                        Db::name('payment')->save($data);
                        $result = ['status' => 1, 'message' => '该微信号添加成功', 'result' => []];
                    }
                }
            } elseif ($type == 'zfb') {
                if (!isset($param['zfb_account']) || !isset($param['holder_name']) || !isset($param['zfb_qrcode'])) {
                    $result = ['status' => 0, 'message' => '参数不完整', 'result' => []];
                } else {
                    $zfbinfo = Db::name('payment')->where(['uid' => $uid, 'zfb_account' => $param['zfb_account']])->find();
                    if ($zfbinfo) {
                        $result = ['status' => 0, 'message' => '该支付宝已存在', 'result' => []];
                    } else {
                        $data = ['uid' => $uid, 'zfb_account' => $param['zfb_account'], 'holder_name' => $param['holder_name'], 'zfb_qrcode' => $param['zfb_qrcode'], 'type' => $type];
                        Db::name('payment')->save($data);
                        $result = ['status' => 1, 'message' => '该支付宝添加成功', 'result' => []];
                    }
                }
            } else {
                $result = ['status' => 0, 'message' => '收款类型错误', 'result' => []];
            }
            //var_dump($result);
            return json($result);
        }
    }
    //编辑银行卡
    public function bankedit()
    {
        if ($param = $this->request->param()) {
            $id   = $param['id'];
            $uid  = $param['uid'];
            $type = $param['type'];
            if ($type == 'bank') {
                if (!isset($param['bank_number']) || !isset($param['bank_kaihu']) || !isset($param['holder_name']) || !isset($param['bank_name'])) {
                    $result = ['status' => 0, 'message' => '参数不完整', 'result' => []];
                } else {
                    $bankinfo = Db::name('payment')->where(['uid' => $uid, 'bank_number' => $param['bank_number']])->find();
                    if ($bankinfo && $bankinfo['id'] != $id) {
                        $result = ['status' => 0, 'message' => '该银行卡号已存在', 'result' => []];
                    } else {
                        if ($param['bank_name'] == '数字人民币') {

                            $param['decp_qrcode'] = $this->getQRcode($param['bank_number'], $id);
                        }
                        $data = ['decp_qrcode' => $param['decp_qrcode'], 'bank_number' => $param['bank_number'], 'bank_kaihu' => $param['bank_kaihu'], 'holder_name' => $param['holder_name'], 'bank_name' => $param['bank_name'], 'type' => $type];
                        Db::name('payment')->where(['id' => $id, 'uid' => $uid])->save($data);
                        $result = ['status' => 1, 'message' => '该银行卡编辑成功', 'result' => []];
                    }
                }
            } elseif ($type == 'wx') {
                if (!isset($param['wx_account']) || !isset($param['holder_name']) || !isset($param['wx_qrcode'])) {
                    $result = ['status' => 0, 'message' => '参数不完整', 'result' => []];
                } else {
                    $wxinfo = Db::name('payment')->where(['uid' => $uid, 'wx_account' => $param['wx_account']])->find();
                    if ($wxinfo && $wxinfo['id'] != $id) {
                        $result = ['status' => 0, 'message' => '该微信号已存在', 'result' => []];
                    } else {
                        $data = ['wx_account' => $param['wx_account'], 'holder_name' => $param['holder_name'], 'wx_qrcode' => $param['wx_qrcode'], 'type' => $type];
                        Db::name('payment')->where(['id' => $id, 'uid' => $uid])->save($data);
                        $result = ['status' => 1, 'message' => '该微信号编辑成功', 'result' => []];
                    }
                }
            } elseif ($type == 'zfb') {
                if (!isset($param['zfb_account']) || !isset($param['holder_name']) || !isset($param['zfb_qrcode'])) {
                    $result = ['status' => 0, 'message' => '参数不完整', 'result' => []];
                } else {
                    $zfbinfo = Db::name('payment')->where(['uid' => $uid, 'zfb_account' => $param['zfb_account']])->find();
                    if ($zfbinfo && $zfbinfo['id'] != $id) {
                        $result = ['status' => 0, 'message' => '该支付宝已存在', 'result' => []];
                    } else {
                        $data = ['zfb_account' => $param['zfb_account'], 'holder_name' => $param['holder_name'], 'zfb_qrcode' => $param['zfb_qrcode'], 'type' => $type];
                        Db::name('payment')->where(['id' => $id, 'uid' => $uid])->save($data);
                        $result = ['status' => 1, 'message' => '该支付宝编辑成功', 'result' => []];
                    }
                }
            } else {
                $result = ['status' => 0, 'message' => '收款类型错误', 'result' => []];
            }
            //var_dump($result);
            return json($result);
        }
    }
    //删除银行卡
    public function bankdel()
    {
        if ($param = $this->request->param()) {
            $id  = $param['id'];
            $uid = $param['uid'];
            $res = Db::name('payment')->where(['id' => $id, 'uid' => $uid])->save(['is_delete' => 1]);
            if ($res) {
                $result = ['status' => 1, 'message' => '删除成功', 'result' => []];
            } else {
                $result = ['status' => 0, 'message' => '删除失败', 'result' => []];
            }
            return json($result);
        }

    }
    //银行卡设为默认
    public function bankmoren()
    {
        if ($param = $this->request->param()) {
            $id   = $param['id'];
            $uid  = $param['uid'];
            $res1 = Db::name('payment')->where(['uid' => $uid])->save(['is_moren' => 0]);
            $res2 = Db::name('payment')->where(['id' => $id, 'uid' => $uid])->save(['is_moren' => 1]);
            if ($res1 && $res2) {
                $result = ['status' => 1, 'message' => '设置默认成功', 'result' => []];
            } else {
                $result = ['status' => 0, 'message' => '设置默认失败', 'result' => []];
            }
            return json($result);
        }

    }
    //地址薄列表
    public function booklist()
    {
        if ($param = $this->request->param()) {
            $uid      = $param['uid'];
            $bookinfo = Db::name('address_book')->where(['uid' => $uid, 'is_delete' => 0])->select();
            $bankinfo = _unsetNull($bookinfo);
            if (!$bookinfo) {
                $result = ['status' => 0, 'message' => '客户未设置地址薄', 'result' => []];
            } else {
                $result = ['status' => 1, 'message' => '获取成功', 'result' => $bookinfo];
            }
            return json($result);
        }
    }
    //添加地址薄
    public function bookadd()
    {
        if ($param = $this->request->param()) {
            $uid      = $param['uid'];
            $currency = $param['currency'];
            $address  = $param['address'];
            $beizhu   = $param['beizhu'];
            if ($currency == 1) {
                if (substr($address, 0, 1) != 'T') {
                    $result = ['status' => 0, 'message' => '添加失败,地址格式开头为T', 'result' => []];
                    return json($result);exit;
                }
            }
            if ($currency == 2) {
                if (substr($address, 0, 2) != '0x') {
                    $result = ['status' => 0, 'message' => '添加失败,地址格式开头为0x', 'result' => []];
                    return json($result);exit;
                }
            }
            $bookinfo = Db::name('address_book')->where(['uid' => $uid, 'address' => $param['address']])->find();
            if ($bookinfo) {
                $result = ['status' => 0, 'message' => '添加失败,该地址已存在', 'result' => []];
                return json($result);exit;
            }
            if (!isset($uid) || !isset($currency) || !isset($address) || !isset($beizhu)) {
                $result = ['status' => 0, 'message' => '参数不完整', 'result' => []];
            } else {
                $data = ['uid' => $uid, 'currency' => $currency, 'beizhu' => $param['beizhu'], 'address' => $param['address']];
                $res  = Db::name('address_book')->save($data);
                if ($res) {
                    $result = ['status' => 1, 'message' => '添加成功', 'result' => []];
                } else {
                    $result = ['status' => 0, 'message' => '添加失败', 'result' => []];
                }
            }
            //var_dump($result);
            return json($result);
        }
    }
    //修改地址薄
    public function bookedit()
    {
        if ($param = $this->request->param()) {
            $id       = $param['id'];
            $uid      = $param['uid'];
            $currency = $param['currency'];
            $address  = $param['address'];
            $beizhu   = $param['beizhu'];
            if ($currency == 1) {
                if (substr($address, 0, 1) != 'T') {
                    $result = ['status' => 0, 'message' => '添加失败,USDT-TRC20地址格式开头为T', 'result' => []];
                    return json($result);exit;
                }
            }
            if ($currency == 2) {
                if (substr($address, 0, 2) != '0x') {
                    $result = ['status' => 0, 'message' => '添加失败,USDT-ERC20地址格式开头为0x', 'result' => []];
                    return json($result);exit;
                }
            }
            $bookinfo = Db::name('address_book')->where(['uid' => $uid, 'address' => $param['address']])->find();
            if ($bookinfo && $bookinfo['id'] != $id) {
                $result = ['status' => 0, 'message' => '编辑失败,该地址已存在', 'result' => []];
                return json($result);exit;
            }
            if (!isset($id) || !isset($uid) || !isset($currency) || !isset($address) || !isset($beizhu)) {
                $result = ['status' => 0, 'message' => '参数不完整', 'result' => []];
            } else {
                $data = ['uid' => $uid, 'currency' => $currency, 'beizhu' => $param['beizhu'], 'address' => $param['address']];
                $res  = Db::name('address_book')->where(['id' => $id, 'uid' => $uid])->save($data);
                if ($res) {
                    $result = ['status' => 1, 'message' => '编辑成功', 'result' => []];
                } else {
                    $result = ['status' => 0, 'message' => '编辑失败', 'result' => []];
                }
            }
            //var_dump($result);
            return json($result);
        }
    }
    //删除地址薄
    public function bookdel()
    {
        if ($param = $this->request->param()) {
            $id  = $param['id'];
            $uid = $param['uid'];
            $res = Db::name('address_book')->where(['id' => $id, 'uid' => $uid])->save(['is_delete' => 1]);
            if ($res) {
                $result = ['status' => 1, 'message' => '删除成功', 'result' => []];
            } else {
                $result = ['status' => 0, 'message' => '删除失败', 'result' => []];
            }
            return json($result);
        }
    }
    //地址薄设为默认
    public function bookmoren()
    {
        if ($param = $this->request->param()) {
            $id   = $param['id'];
            $uid  = $param['uid'];
            $res1 = Db::name('address_book')->where(['uid' => $uid])->save(['is_moren' => 0]);
            $res2 = Db::name('address_book')->where(['id' => $id, 'uid' => $uid])->save(['is_moren' => 1]);
            if ($res1 && $res2) {
                $result = ['status' => 1, 'message' => '设置默认成功', 'result' => []];
            } else {
                $result = ['status' => 0, 'message' => '设置默认失败', 'result' => []];
            }
            return json($result);
        }
    }
    //初级认证
    public function renzheng1()
    {
        if ($param = $this->request->param()) {
            $uid       = $param['uid'];
            $country   = $param['guojia'];
            $true_name = $param['name'];
            $id_no     = $param['haoma'];

            $sfzgs = new IdentityCard();
            if (!$sfzgs->isValid($id_no)) {
                $result = ['status' => 0, 'message' => '身份证格式错误', 'result' => []];
                return json($result);exit;
            }
            if (!isset($uid) || !isset($country) || !isset($true_name) || !isset($id_no)) {
                $result = ['status' => 0, 'message' => '参数不完整', 'result' => []];
                return json($result);exit;
            }
            $rzinfo = Db::name('identity_auth')->where(['uid' => $uid])->find();
            if ($rzinfo) {
                $result = ['status' => 0, 'message' => '添加失败,会员已存在认证记录', 'result' => []];
            } else {
                $data = ['uid' => $uid, 'country' => $country, 'true_name' => $true_name, 'id_no' => $id_no, 'renzheng1' => 2];
                Db::name('identity_auth')->save($data);
                Db::name('user')->where("id", $uid)->update(['renzheng1' => 2]);
                $result = ['status' => 1, 'message' => '添加成功', 'result' => ['renzheng1' => 2]];
            }
            return json($result);
        }
    }
    //高级认证2
    public function renzheng2()
    {
        if ($param = $this->request->param()) {
            $id        = $param['id'];
            $uid       = $param['uid'];
            $img_first = $param['zhengmian'];
            $img_back  = $param['fanmian'];
            if (!isset($uid) || !isset($id) || !isset($img_first) || !isset($img_back)) {
                $result = ['status' => 0, 'message' => '参数不完整', 'result' => []];
                return json($result);exit;
            }
            $rzinfo = Db::name('identity_auth')->where(['id' => $id, 'uid' => $uid])->find();
            if (!$rzinfo) {
                $result = ['status' => 0, 'message' => '添加失败,请先完成初级认证', 'result' => []];
            } else {
                $data = ['img_first' => $img_first, 'img_back' => $img_back, 'renzheng2' => 2];
                Db::name('identity_auth')->where(['id' => $id, 'uid' => $uid])->save($data);
                Db::name('user')->where("id", $uid)->update(['renzheng2' => 2]);
                $result = ['status' => 1, 'message' => '添加成功', 'result' => ['renzheng2' => 2]];
            }
            return json($result);
        }
    }
    //初级认证修改
    public function renzheng3()
    {
        if ($param = $this->request->param()) {
            $id        = $param['id'];
            $uid       = $param['uid'];
            $country   = $param['guojia'];
            $true_name = $param['name'];
            $id_no     = $param['haoma'];
            if (!isset($uid) || !isset($id) || !isset($country) || !isset($true_name) || !isset($id_no)) {
                $result = ['status' => 0, 'message' => '参数不完整', 'result' => []];
                return json($result);exit;
            }
            $rzinfo = Db::name('identity_auth')->where(['id' => $id, 'uid' => $uid])->find();
            if (!$rzinfo) {
                $result = ['status' => 0, 'message' => '添加失败,查无该用户认证记录', 'result' => []];
            } else {
                $data = ['country' => $country, 'true_name' => $true_name, 'id_no' => $id_no, 'renzheng1' => 2, 'renzheng2' => 2];
                Db::name('identity_auth')->where(['id' => $id, 'uid' => $uid])->save($data);
                $result = ['status' => 1, 'message' => '添加成功', 'result' => ['renzheng1' => 2, 'renzheng2' => 2]];
            }
            return json($result);
        }
    }
    //身份认证信息
    public function idrzinfo()
    {
        if ($param = $this->request->param()) {
            $uid    = $param['uid'];
            $idinfo = Db::name('identity_auth')->where(['uid' => $uid])->find();
            $idinfo = _unsetNull($idinfo);
            if (!$idinfo) {
                $result = ['status' => 0, 'message' => '客户未认证', 'result' => []];
            } else {
                $result = ['status' => 1, 'message' => '获取成功', 'result' => $idinfo];
            }
            return json($result);
        }
    }

    //用户消息列表
    public function usermsg()
    {
        if ($param = $this->request->param()) {
            $uid     = $param['uid'];
            $msglist = Db::name('user_msg')->where(['uid' => $uid])->select();
            $msglist = _unsetNull($msglist);
            if (!$msglist) {
                $result = ['status' => 0, 'message' => '该用户无消息', 'result' => []];
            } else {
                $result = ['status' => 1, 'message' => '获取成功', 'result' => $msglist];
            }
            return json($result);
        }
    }

    //用户消息已读
    public function readmsg()
    {
        if ($param = $this->request->param()) {
            $id  = $param['id'];
            $uid = $param['uid'];
            if (!isset($uid) || !isset($id)) {
                $result = ['status' => 0, 'message' => '参数不完整', 'result' => []];
                return json($result);exit;
            }
            $msginfo = Db::name('user_msg')->where(['id' => $id, 'uid' => $uid])->find();
            if (!$msginfo) {
                $result = ['status' => 0, 'message' => '操作失败,查无该条用户信息', 'result' => []];
            } else {
                $data = ['has_readed' => 1];
                Db::name('user_msg')->where(['id' => $id, 'uid' => $uid])->save($data);
                $result = ['status' => 1, 'message' => '操作成功', 'result' => []];
            }
            return json($result);
        }
    }

    public function ordercfg()
    {
        if ($param = $this->request->param()) {
            $uid      = $param['uid'];
            $bankinfo = array();
            $bankinfo = Cache::store('redis')->get('orderconfig' . $uid);
            if (empty($bankinfo)) {

                $config = Db::name('config')->where('id', 1)->find();
                unset($config['trc20_collection_key']);
                unset($config['trc20_pay_key']);
                unset($config['erc20_collection_key']);
                unset($config['erc20_pay_key']);
                $buy_mark_up              = Db::name('order_config')->where('id', 1)->value('buy_mark_up');
                $config['usdt_price']     = $config['usdt_price'] + $config['usdt_modify']; //卖家价格修正
                $config['usdt_buy_price'] = $buy_mark_up + $config['usdt_price']; //买家家价格修正
                $orderinfo                = Db::name('order_config')->where('id', 1)->find();
                $bankinfo                 = Db::name('payment')->where(['uid' => $uid, 'is_delete' => 0])->select();
                $bankinfo                 = _unsetNull($bankinfo);
                $config                   = array_merge($config, $orderinfo);
                $bankinfo['config']       = $config;
                Cache::store('redis')->set('orderconfig' . $uid, $bankinfo, 30);
            }

            if (!$bankinfo) {
                $result = ['status' => 0, 'message' => '客户未设置银行卡', 'result' => []];
            } else {
                $result = ['status' => 1, 'message' => '获取成功', 'result' => $bankinfo];
            }
            return json($result);

        }
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

    public function add()
    {
        if ($param = $this->request->param()) {

            $sign = $this->makeSign($param['uid'], $param['time'], $param['uid']);

            if (isset($param['sign']) && $param['sign'] !== $sign) {
                $result = ['status' => 0, 'message' => '验名验证失败', 'result' => []];
                return json($result);
            }
            $config = Cache::store('redis')->get('sys_price');
            if (empty($config)) {
                $config                   = Db::name('config')->where('id', 1)->find();
                $buy_mark_up              = Db::name('order_config')->where('id', 1)->value('buy_mark_up');
                $config['usdt_price']     = $config['usdt_price'] + $config['usdt_modify']; //卖家价格修正
                $config['usdt_buy_price'] = $buy_mark_up + $config['usdt_price']; //买家家价格修正
                Cache::store('redis')->set('sys_price', $config, 600);
            }
            // 启动事务
            Db::startTrans();
            try {

                $uid = $param['uid'];
                // Log::rcord($param);
                $user = Db::name('user')->where('id', $uid)->find();
                $data = array();
                if ($param['order_type'] < 1) {
//购买
                    $table = 'order_buy';
                    $sn    = 'B';
                } else {
                    $sn    = 'S';
                    $table = 'order_sell';
                    if ($user['usdt_nums'] < $param['usdt_nums']) {
                        // 回滚事务
                        Db::rollback();
                        $result = ['status' => 0, 'message' => '您的USDT不足', 'result' => ''];
                        return json($result);
                    }
                }
                $orders = Db::name($table)->where('uid', $uid)->where('status', '<', 2)->find();
                if (is_array($orders)) {
                    // 回滚事务
                    Db::rollback();
                    $result = ['status' => 0, 'message' => '您还有一个订单未完成', 'result' => $orders];
                    return json($result);
                }
                /* if($param['pay_code']>1){
                $data['qr_code_url']=$param['qr_code_url'] ?? '';
                }*/
                $data['qr_code_url']  = $param['qr_code_url'] ?? '';
                $data['email']        = $user['email'];
                $data['phone']        = $user['phone'];
                $data['uid']          = $uid;
                $data['pay_code']     = $param['pay_code'];
                $data['pay_account']  = $param['pay_account'];
                $data['usdt_nums']    = $param['usdt_nums'];
                $data['beizhu']       = $param['beizhu'];
                $data['create_time']  = time();
                $data['status']       = 0;
                $data['amount']       = $param['amount'];
                $data['order_number'] = $sn . create_osn() . $uid;
                if ($param['order_type'] == 1) {
                    $data['price'] = $config['usdt_price'];
                } else {
                    $data['price'] = $config['usdt_buy_price'];
                }

                $data['remain_usdts'] = $param['usdt_nums'];
                $res                  = Db::name($table)->save($data);
                if ($param['order_type'] == 1) {
                    $save['usdt_nums'] = $user['usdt_nums'] - $param['usdt_nums'];
                    Db::name('user')->where('id', $uid)->save($save);
                }

                // 提交事务
                Db::commit();
                $result = ['status' => 1, 'message' => '获取成功', 'result' => []];
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                $result = ['status' => 0, 'message' => '添加订单出错', 'result' => []];
            }

            return json($result);

        }
    }
    //取订单记录
    public function orderlist()
    {
        if ($param = $this->request->param()) {
            if (!is_numeric($param['uid'])) {
                $result = ['status' => 0, 'message' => '查询订单出错', 'result' => []];
                return json($result);
            }

            $data = array();
            $uid  = $param['uid'];

            $where[] = ['status', '<', 2];

            $sell = Db::name('order_sell')->where('uid', $uid)->limit(10)->order('create_time', 'desc')->select();

            $buy          = Db::name('order_buy')->where('uid', $uid)->limit(10)->order('create_time', 'desc')->select();
            $data['sell'] = $sell->toArray();

            $data['buy']       = $buy->toArray();
            $sellorder         = Db::name('order')->where('s_uid', $uid)->limit(10)->order('create_time', 'desc')->select();
            $data['sellorder'] = $sellorder->toArray();

            $buyorder         = Db::name('order')->where('b_uid', $uid)->limit(10)->order('create_time', 'desc')->select();
            $data['buyorder'] = $buyorder->toArray();
            $result           = !empty($data) ? ['status' => 1, 'message' => '获取成功', 'result' => $data] : ['status' => 0, 'message' => '查询订单出错', 'result' => []];

            return json($result);
        }

    }

    //取订单
    public function getordersn()
    {
        if ($param = $this->request->param()) {
            if (empty($param['sn'])) {
                $result = ['status' => 0, 'message' => '查询订单出错', 'result' => []];
                return json($result);
            }

            $data = array();
            $sn   = $param['sn'];

            $data = Db::name('order')->where('order_sn', $sn)->find();

            $result = !empty($data) ? ['status' => 1, 'message' => '获取订单详情成功', 'result' => $data] : ['status' => 2, 'message' => '订单查询中', 'result' => []];

            return json($result);
        }

    }
    //取订单
    public function editorder()
    {
        if ($param = $this->request->param()) {
            Log::record('editorder');
            Log::record($param);
            if (!is_numeric($param['id'])) {
                $result = ['status' => 0, 'message' => '查询订单出错', 'result' => []];
                return json($result);
            }

            if (!is_numeric($param['status'])) {
                $result = ['status' => 0, 'message' => '查询订单出错', 'result' => []];
                return json($result);
            }

            $data = array();
            $id   = $param['id'];

            $save['status']      = $param['status'];
            $save['update_time'] = time();

            $sign = $this->makeSign($param['uid'], $param['time'], $param['status']);
            $find = Db::name('user')->where('id', $param['uid'])->find();
            if (isset($param['sign']) && $param['sign'] !== $sign) {
                $result = ['status' => 0, 'message' => '签名验证失败', 'result' => []];
                return json($result);
            }

            if ($param['status'] == 1 || $param['status'] == 2) {
//交易密码
                $tradepwd = xn_encrypt($param['verificationCode']);

                if ($find['trans_password'] !== $tradepwd) {
                    $result = ['status' => 0, 'message' => '交易密码错误', 'result' => []];
                    return json($result);
                }
            }

            //googleCode
            if (isset($param['googleCode'])) {

                $google = new GoogleAuthenticator();

                $oneCode = $google->getCode($find['google_secret']);
                if ($oneCode !== $param['googleCode']) {
                    $result = ['status' => 0, 'message' => '谷歌验证码错误', 'result' => []];
                    return json($result);
                }
            }
            //邮箱
            if (isset($param['emailCode'])) {
                $code = Cache::store('redis')->get('mail' . $find['email']);
                if ($code != $param['emailCode']) {
                    $result = ['status' => 0, 'message' => '邮箱验证码不正确', 'result' => []];
                    return json($result);
                }
            }

            //邮箱
            if (isset($param['phoneCode'])) {
                $code = Cache::store('redis')->get('sms' . $find['phone']);
                if ($code != $param['phoneCode']) {
                    $result = ['status' => 0, 'message' => '短信验证码不正确', 'result' => []];
                    return json($result);
                }
            }
            // 启动事务
            Db::startTrans();
            try {
                if ($param['status'] == 1) {
                    $data = Db::name('order')->where('id', $id)->update($save);
                }

                if ($param['status'] == 2) {
                    $find = array();
                    $find = Db::name('order')->where('id', $id)->find();
                    Db::name('order_sell')->where('order_number', $find['sell_order_number'])->save(['status' => 0, 'locked' => 0]);

                    Db::name('order_buy')->where('uid', $find['b_uid'])->where('locked', '1')->save(['status' => 0, 'locked' => 0]);

                    $userid = $find['b_uid'];
                    Db::name('user')->where('id', $userid)->inc('usdt_nums', $find['b_usdt_nums'])->update(); //买家到帐

                    $data = Db::name('order')->where('id', $id)->update($save);
                }

                if ($param['status'] > 2) {
                    $find = array();
                    $find = Db::name('order')->where('id', $id)->find();

                    Db::name('order_sell')->where('order_number', $find['sell_order_number'])->where('locked', '1')->inc('remain_usdts', $find['usdt_nums'])->update();
                    Db::name('order_sell')->where('order_number', $find['sell_order_number'])->where('locked', '1')->save(['status' => $param['status'], 'locked' => 0]);

                    Db::name('order_buy')->where('uid', $find['b_uid'])->where('locked', '1')->inc('remain_usdts', $find['usdt_nums'])->update();
                    Db::name('order_buy')->where('uid', $find['b_uid'])->where('locked', '1')->save(['status' => $param['status'], 'locked' => 0]);

                    $data = Db::name('order')->where('id', $id)->update($save);
                }

                // 提交事务
                Db::commit();

            } catch (\Exception $e) {
                // 回滚事务
                $data = '';
                Db::rollback();

            }
            $result = $data != '' ? ['status' => 1, 'message' => '订单修改成功', 'result' => $param] : ['status' => 0, 'message' => '修改订单出错', 'result' => []];
            // dump($data['buy']);exit;
            return json($result);
        }

    }

//改挂单
    public function editbuysell()
    {
        if ($param = $this->request->param()) {
            if (!is_numeric($param['id'])) {
                $result = ['status' => 0, 'message' => '订单参数出错', 'result' => $param];
                return json($result);
            }
            if (!is_numeric($param['status'])) {
                $result = ['status' => 0, 'message' => '订单参数出错', 'result' => $param];
                return json($result);
            }
            if ($param['type'] == 'sell') {
                $table = 'order_sell';
            } else {
                $table = 'order_buy';
            }
            $data = array();
            $id   = $param['id'];

            $save['status']      = $param['status'];
            $save['update_time'] = time();
            $save['locked']      = '0';
            Db::startTrans();
            try {
                if ($param['type'] == 'sell') {
                    if ($param['status'] > 2) {

                        $find = Db::name($table)->where('id', $id)->find();
                        Db::name('user')->where('id', $find['uid'])->inc('usdt_nums', $find['remain_usdts'])->update();
                        Db::name($table)->where('id', $id)->save($save);

                    }

                } else {
                    Db::name($table)->where('id', $id)->save($save);
                }

                // 提交事务
                $ok = 1;
                Db::commit();

            } catch (\Exception $e) {
                // 回滚事务
                $ok = '';
                Db::rollback();

            }

            $msg    = $param['type'] == 'sell' ? '卖家订单修改成功' : '买家订单修改成';
            $result = !empty($ok) ? ['status' => 1, 'message' => $msg, 'result' => $data] : ['status' => 0, 'message' => '修改订单出错', 'result' => []];

            return json($result);
        }

    }

    private function getQRcode($url, $id = '')
    {
        $options = new QROptions([
            'version'    => 5, //二维码版本
            'outputType' => QRCode::OUTPUT_IMAGE_JPG, //生成图片
            'eccLevel'   => QRCode::ECC_L, //错误级别
            'scale'      => 10, //二维码大小
        ]);
        $qrcode = new QRCode($options);
        //第一种方式  将二维码保存到服务器中
        $time = time();

        $path = "./qrcode/" . $id . $time . ".jpg";
        $qrcode->render($url, $path);

        //第二种方式，将二维码直接生成base64格式的图片
        // $qrcode->render('htttp://www.baidu.com');

        return substr($path, 1);
    }
}
