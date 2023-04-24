<?php
// +----------------------------------------------------------------------
// | 小牛Admin
// +----------------------------------------------------------------------
// | Website: www.xnadmin.cn
// +----------------------------------------------------------------------
// | Author: dav <85168163@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\model\UserErc20 as Erc20;
use app\admin\model\UserTrc20Address as Trc20Model;
use app\admin\model\UserTrx as Trx;
use app\common\controller\AdminBase;
use app\common\model\AuthRule;
use think\facade\Cache;
use think\facade\Db;
use think\facade\Session;

class Index extends AdminBase
{
    protected $noAuth = ['index', 'home'];
    public function index()
    {
        // 分配菜单数据
        $auth      = new AuthRule();
        $menu_data = $auth->getMenu();
        foreach ($menu_data as $k => $v) {
            if ($this->checkMenuAuth($v['name'])) {
                foreach ($v['_data'] as $m => $n) {
                    if ($this->checkMenuAuth($n['name']) !== true) {
                        unset($menu_data[$k]['_data'][$m]);
                    }
                }
            } else {
                // 删除无权限的菜单
                unset($menu_data[$k]);
            }
        }

        if (config('app.upload_config') === false) {
            unset($menu_data[15]['_data'][21]['_data'][17]);
        }
//关掉上传配置

        return view('', ['menu' => $menu_data, 'admin_data' => Session::get('admin_auth')]);
    }

    public function home()
    {

        $data = array();
        $data = Cache::store('redis')->get('admin_data');

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
            $totalOrder  = Db::name('order')->where($where)->where('status', 2)->count();
            $totalUsdt   = Db::name('order')->where('status', 2)->where($where)->count();
            $waitorder   = Db::name('order')->where('status', '<', 2)->where($where)->count();
            $totaluser   = Db::name('user')->count();
            $big         = Db::name('order')->where($where)->count();
            $big         = $big ? $big : 100;

            $min = Db::name('order')->where('status', 2)->where($where)->count();
            $min = $min ? $min : 60;

            $res = $min / $big * 100;

            $success              = round($res, 2);
            $data['total_amount'] = $totalAmount;
            $data['total_usdt']   = $totalUsdt;
            $data['bilv']         = $success;
            $data['notices']      = $notice;
            $data['banner']       = $banner;
            $data['config']       = $config;
            $data['total_order']  = $totalOrder;
            $data['total_user']   = $totaluser;
            $data['wait_order']   = $waitorder;
            Cache::store('redis')->set('admin_data', $data, 600);
        }

        $server_info = array();
        $server_info = Cache::store('redis')->get('server_info');
        if (empty($server_info)) {

            $info                          = Db::name('config')->where('id', 1)->find();
            $trc20                         = new Trc20Model;
            $trx                           = new Trx;
            $erc20                         = new Erc20;
            $info['erc20_collection_usdt'] = $erc20->getUsdtBalance($info['erc20_collection_address']); //以太坊
            $info['erc20_pay_usdt']        = $erc20->getUsdtBalance($info['erc20_pay_address']); //以太坊

            $info['trc20_collection_usdt']      = $trc20->trc20_balance($info['trc20_collection_address']);
            $info['trc20_pay_usdt']             = $trc20->trc20_balance($info['trc20_pay_address']);
            $info['trx_collection']             = $trx->trxBalance($info['trc20_collection_address']);
            $info['trx_pay']                    = $trx->trxBalance($info['trc20_pay_address']);
            $server_info['TRC收款地址']     = $info['trc20_collection_address'];
            $server_info['usdt收款:']         = $info['trc20_collection_usdt'] ?? '0.00';
            $server_info['trx.gas收款:']      = $info['trx_collection'] ?? '0.00';
            $server_info['ETH收款地址']     = $info['erc20_collection_address'];
            $server_info['usdt收款余额']    = $info['erc20_collection_usdt'] ?? '0.00';
            $server_info['eth.gas收款余额'] = $info['eth_collection'] ?? '0.00';

            $server_info['TRC付款地址']     = $info['trc20_pay_address'];
            $server_info['usdt付款数量']    = $info['trc20_pay_usdt'] ?? '0.00';
            $server_info['trx.gas付款数量'] = $info['trx_pay'] ?? '0.00';
            $server_info['ETH付款地址']     = $info['erc20_pay_address'];
            $server_info['usdt付款余额']    = $info['erc20_pay_usdt'] ?? '0.00';
            $server_info['eth.gas付款余额'] = $info['eth_pay'] ?? '0.00';

            Cache::store('redis')->set('server_info', $server_info, 120);
        }

        return view('', ['server_info' => $server_info, 'data' => $data]);
    }

    public function about()
    {
        return view();
    }

}
