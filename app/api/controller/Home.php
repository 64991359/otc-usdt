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
use think\facade\Session;
use think\Request;

class Home extends Base
{

    //取一些公共数据
    public function commondata()
    {

        if ($param = $this->request->param()) {

            $uid   = $param['uid'];
            $token = Cache::store('redis')->get('token' . $uid);

            if (empty($token)) {
                $token = Session::get('session_id' . $uid);
                $time  = 14515200;
                Cache::store('redis')->set('token' . $uid, $token, $time);
            }

            if ($token != $param['token']) {
                $result = ['status' => 0, 'message' => '验证失败', 'result' => []];
                return json($result);
            }
            $data = array();
            $data = Cache::store('redis')->get('commondata');

            if (empty($data)) {
                $notice                   = Db::name('sys_notice')->order('id DESC')->limit(5)->select();
                $banner                   = Db::name('banner')->order('id DESC')->limit(5)->select();
                $config                   = Db::name('config')->where('id', 1)->find();
                $buy_mark_up              = Db::name('order_config')->where('id', 1)->value('buy_mark_up');
                $config['usdt_price']     = $config['usdt_price'] + $config['usdt_modify']; //卖家价格修正
                $config['usdt_buy_price'] = $buy_mark_up + $config['usdt_price']; //买家家价格修正
                $t1                       = date('Y-m-d', time());
                $t1                       = strtotime($t1);
                $where[]                  = ['create_time', '>=', $t1];

                $totalAmount = Db::name('order')->where('status', 2)->where($where)->sum('usdt_nums');
                $totalUsdt   = Db::name('order')->where('status', 2)->where($where)->count();
                $big         = Db::name('order')->where($where)->count();
                $big         = $big ? $big : 100;

                $min = Db::name('order')->where('status', 2)->where($where)->count();
                $min = $min ? $min : 60;

                $res = $min / $big * 100;

                $success = round($res, 2);
                unset($config['trc20_collection_key']);
                unset($config['trc20_pay_key']);
                unset($config['erc20_collection_key']);
                unset($config['erc20_pay_key']);
                $totalAmount = $totalAmount + 835000;

                $totalUsdt            = $totalUsdt + 2639;
                $data['total_amount'] = round($totalAmount, 2);
                $data['total_usdt']   = $totalUsdt;
                $data['bilv']         = $success;
                $data['notices']      = $notice;
                $data['banner']       = $banner;
                $data['config']       = $config;

                $data['site_help'] = config('app.site_help');
                Cache::store('redis')->set('commondata', $data, 60);
            }

            $result = ['status' => 1, 'message' => 'ok', 'result' => $data];

            return json($result);

        } else {
            $result = ['status' => 0, 'message' => 'commondata error', 'result' => []];
            return json($result);
        }
    }

    public function get_app_url()
    {
        if ($param = $this->request->param()) {

            $config = Cache::store('redis')->get('app_down_url');
            if (empty($config)) {
                $config = Db::name('config')->where('id', 1)->value('app_down_url');
                Cache::store('redis')->set('app_down_url', $config, 600);
            }

            $data   = ['app_down_url' => $config];
            $result = ['status' => 1, 'message' => 'ok', 'result' => $data];
            return json($result);
        }

    }

    public function get_user_address()
    {
        $param = $this->request->param();
        $uid   = $param['uid'];
        if ($uid < 1) {
            $result = ['status' => 0, 'message' => '参数出错', 'result' => ''];
            return json($result);
        }
        $address = Db::name('user_address')->where(['uid' => $uid])->find();
        if ($address) {

            unset($address['trc20_key']);
            unset($address['erc20_key']);
            $result = ['status' => 1, 'message' => 'ok', 'result' => $address];
            return json($result);

        }
    }
}
