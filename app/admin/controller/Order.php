<?php
// +----------------------------------------------------------------------
// | 小牛Admin
// +----------------------------------------------------------------------
// | Website: www.xnadmin.cn
// +----------------------------------------------------------------------
// | Author: dav <85168163@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\model\Order as OrderModel;
use app\admin\model\OrderBuy;
use app\admin\model\OrderConfig;
use app\admin\model\OrderSell;
use app\common\controller\AdminBase;
use app\common\model\AuthGroup;
use think\facade\Cache;
//use think\facade\Log;
use think\facade\Db;
use think\facade\Session;

class Order extends AdminBase
{

    public function index()
    {

        if ($this->request->isGet()) {
            $input = input();
            if (empty($input['bcid'])) {
                $this->error('参数不正确');
            }
            $admin = Session::get('admin_auth');
            if ($admin->id < 1) {
                $this->error('参数不正确');
            }
        }

        if ($this->request->isPost()) {

            $param = $this->request->post();

            $OrderConfig = new OrderConfig();

            $res = $OrderConfig->editConfig($param);

            Cache::store('redis')->set('orderconfig', $param, 600);
            $this->success('设置成功');
        }
        $OrderConfig = new OrderConfig();
        $Config      = $OrderConfig->getConfig();

        return view('', ['data' => $Config['data']]);

    }
    //匹配订单
    public function order()
    {

        if ($this->request->isAjax() || input('end_time')) {
            $limit = input('param.limit');

            $param = $this->request->param();

            $where = [];

            $Order = new OrderModel();
            if ($param['phone'] && $param['phone'] != '') {
                $where[] = ['b_phone|s_phone', '=', $param['phone']];
            }
            if (isset($param['status']) && $param['status'] != '') {
                $where[] = ['status', '=', $param['status']];
            }
            if (isset($param['order_sn']) && $param['order_sn'] != '') {
                $where[] = ['order_sn', '=', $param['order_sn']];
            }

            //order_number
            if ($param['start_time'] != '' && $param['end_time'] != '') {
                $start = strtotime($param['start_time']);
                $end   = strtotime($param['end_time']);

                $where[] =
                    ['create_time',
                    'between',
                    [$start, $end],

                ];

            }
            $list = $Order->getOrderList($limit, $where);

            if (0 == $list['code']) {

                return json(['code' => 0, 'msg' => 'ok', 'count' => $list['data']->total(), 'data' => $list['data']->all()]);
            }

            return json(['code' => 0, 'msg' => 'ok', 'count' => 0, 'data' => []]);
        }
        $data = $list['data'];
        $data = json_encode($data);
        return view('', ['data' => $data]);

    }

    public function sell()
    {
        if ($this->request->isAjax() || input('end_time')) {
            $limit = input('param.limit');

            $param = $this->request->param();

            $where = [];

            $OrderSell = new OrderSell();
            if ($param['phone'] && $param['phone'] != '') {
                $where[] = ['phone', '=', $param['phone']];
            }
            if (isset($param['status']) && $param['status'] != '') {
                $where[] = ['status', '=', $param['status']];
            }
            if (isset($param['order_number']) && $param['order_number'] != '') {
                $where[] = ['order_number', '=', $param['order_number']];
            }

            //order_number
            if ($param['start_time'] != '' && $param['end_time'] != '') {
                $start = strtotime($param['start_time']);
                $end   = strtotime($param['end_time']);

                $where[] =
                    ['create_time',
                    'between',
                    [$start, $end],

                ];

            }
            $list = $OrderSell->getSellList($limit, $where);

            if (0 == $list['code']) {

                return json(['code' => 0, 'msg' => 'ok', 'count' => $list['data']->total(), 'data' => $list['data']->all()]);
            }

            return json(['code' => 0, 'msg' => 'ok', 'count' => 0, 'data' => []]);
        }
        $data = $list['data'];
        $data = json_encode($data);
        return view('', ['data' => $data]);

    }
    public function buy()
    {

        if ($this->request->isAjax() || input('end_time')) {
            $limit = input('param.limit');

            $param = $this->request->param();

            $where = [];

            $OrderSell = new OrderBuy();
            if ($param['phone'] && $param['phone'] != '') {
                $where[] = ['phone', '=', $param['phone']];
            }
            if (isset($param['status']) && $param['status'] != '') {
                $where[] = ['status', '=', $param['status']];
            }
            if (isset($param['order_number']) && $param['order_number'] != '') {
                $where[] = ['order_number', '=', $param['order_number']];
            }

            if ($param['start_time'] != '' && $param['end_time'] != '') {
                $start = strtotime($param['start_time']);
                $end   = strtotime($param['end_time']);

                $where[] =
                    ['create_time',
                    'between',
                    [$start, $end],

                ];

            }
            $list = $OrderSell->getBuyList($limit, $where);

            if (0 == $list['code']) {

                return json(['code' => 0, 'msg' => 'ok', 'count' => $list['data']->total(), 'data' => $list['data']->all()]);
            }

            return json(['code' => 0, 'msg' => 'ok', 'count' => 0, 'data' => []]);
        }
        $data = $list['data'];

        $data = json_encode($data);
        return view('', ['data' => $data]);

    }

    /**
     * 编辑订单
     * @return \think\response\View
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function editsell()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $id    = $param['id'];

            $group_ids = $param['group_ids'];

            $param['update_time'] = time();
            unset($param['create_time']);

            if (isset($param['status']) && $param['status'] > 2) {
                if ($param['locked'] == 1) {
                    $remain_usdts = Db::name('order_sell')->where(['id' => $id])->find();
                    if ($remain_usdts['remain_usdts'] > 0) {

                        Db::name('user')->where('id', $param['uid'])->inc('usdt_nums', $remain_usdts['remain_usdts'])->update();
                    }
                    $where['sell_order_number'] = $remain_usdts['order_number'];
                    //$where[]=['status','<',2];
                    Db::name('user')->where($where)->where(['status', '<', 2])->update(['status' => 3]);
                    $param['locked'] = 0;
                }

            }
            $result = Db::name('order_sell')->where(['id' => $id])->update($param);
            if ($result) {
                xn_add_admin_log('修改订单信息');
                $this->success('操作成功');
            } else {
                $this->error('操作失败');
            }
        }
        $id = input('id/d');

        // $order_data= Db::name('order_sell')->where(['id'=>$id])->find();
        //$model = new orderSell;
        // $order_data = $model->getOrderSellById($id);
        $order_data = Db::name('order_sell')->where('id', $id)->find();
        $assign     = [

            'order_data'     => $order_data,
            'group_data'     => AuthGroup::select(),
            'user_group_ids' => Db::name('auth_group_access')->where("admin_id", $id)->column('group_id'),
        ];
        return view('', $assign);
    }
    public function editorder()
    {
        if ($this->request->isPost()) {
            $param     = $this->request->param();
            $id        = $param['id'];
            $group_ids = $param['group_ids'];

            $param['update_time'] = time();
            unset($param['create_time']);
            if (isset($param['status']) && $param['status'] > 2) {
                $order_number = $param['sell_order_number'];
                Db::name('order_sell')->where('order_number', $order_number)->where('status', 1)->inc('remain_usdts', $param['usdt_nums'])->update();
                Db::name('order_sell')->where('order_number', $order_number)->where('status', 1)->update(['locked' => 0]);
            }
            $result = Db::name('order')->where(['id' => $id])->update($param);

            if ($result) {
                xn_add_admin_log('修改订单信息');
                $this->success('操作成功');
            } else {
                $this->error('操作失败');
            }
        }
        $id = input('id/d');

        $order_data                = Db::name('order')->where('id', $id)->find();
        $status                    = [0 => '匹配成功', 1 => '买钱付款', 2 => '订单完成', 3 => '取消订单', 4 => '订单过期'];
        $order_data['status']      = $status[$order_data['status']];
        $order_data['create_time'] = date('Y-m-d H:i:s', $order_data['create_time']);
        $assign                    = [

            'order_data'     => $order_data,
            'group_data'     => AuthGroup::select(),
            'user_group_ids' => Db::name('auth_group_access')->where("admin_id", $id)->column('group_id'),
        ];
        return view('', $assign);
    }
    /**
     * 编辑订单
     * @return \think\response\View
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function editbuy()
    {
        if ($this->request->isPost()) {
            $param     = $this->request->param();
            $id        = $param['id'];
            $group_ids = $param['group_ids'];

            $param['update_time'] = time();
            unset($param['create_time']);

            $result = Db::name('order_buy')->where(['id' => $id])->update($param);

            $find = Db::name('order_buy')->where(['id' => $id])->find();
            Db::name('order')->where('status', '<', 2)->where('b_uid', $find['uid'])->update(['status' => 3]);
            if ($result) {
                xn_add_admin_log('修改订单信息');
                $this->success('操作成功');
            } else {
                $this->error('操作失败');
            }
        }
        $id = input('id/d');
        //$model = new OrderBuy;
        // $order_data= $model->getOrderBuyById($id);
        $order_data = Db::name('order_buy')->where(['id' => $id])->find();
        $assign     = [

            'order_data'     => $order_data,
            'group_data'     => AuthGroup::select(),
            'user_group_ids' => Db::name('auth_group_access')->where("admin_id", $id)->column('group_id'),
        ];
        return view('editbuy', $assign);
    }

    /**
     * 删除订单
     */
    public function delsell()
    {

        $id = input('id/d');

        ($id < 1) && $this->error('参数错误' . $id);
        $res = Db::name('order_sell')->where("id", $id)->where('status', 0)->delete();
        if (!$res) {
            $this->success('暂时不能删除');
        }
        xn_add_admin_log('删除订单');
        $this->success('删除成功');
    }

    public function delorder()
    {
        $id = input('id/d');

        ($id < 1) && $this->error('参数错误' . $id);
        $res = Db::name('order')->where("id", $id)->where('status', 0)->delete();
        if (!$res) {
            $this->success('暂时不能删除');
        }
        xn_add_admin_log('删除订单');
        $this->success('删除成功');
    }

    /**
     * 删除订单
     */
    public function delbuy()
    {

        $id = input('id/d');

        ($id < 1) && $this->error('参数错误' . $id);
        $res = Db::name('order_buy')->where("id", $id)->where('status', 0)->delete();
        if (!$res) {
            $this->success('暂时不能删除');
        }
        xn_add_admin_log('删除订单');
        $this->success('删除成功');
    }
}
