<?php
/**
 * Created by PhpStorm.
 * Date: 2019/3/2
 * Time: 7:28 PM
 */
namespace app\admin\controller;

use app\admin\model\Commission as CommissionMode;
use app\common\controller\AdminBase;
use think\facade\Db;
use think\facade\Session;

class Commission extends AdminBase
{
    /**
     * Class Commission
     * @package app\merchant\controller
     */
    public function index()
    {

        if (request()->isAjax()) {

            $limit = input('param.limit');
            $where = [];

            $Commission = new CommissionMode();
            $list       = $Commission->getCommissionList($limit, $where);

            if (0 == $list['code']) {

                return json(['code' => 0, 'msg' => 'ok', 'count' => $list['data']->total(), 'data' => $list['data']->all()]);
            }

            return json(['code' => 0, 'msg' => 'ok', 'count' => 0, 'data' => []]);
        }
        return view('');

    }

    // 添加佣金
    public function addCommission()
    {
        $admin_auth = Session::get('admin_auth');
        $admin      = $admin_auth->toArray();

        if (request()->isPost()) {

            $param = input('post.');

            if (!isset($param['commission_rate']) || empty($param['commission_rate'])) {
                return json(['code' => -1, 'data' => '', 'msg' => '请输入佣金']);
            }
            $reg_links = request()->domain() . '/user/login/reg/commission_rate/' . $param['commission_rate'] . '/pid/' . $admin_auth->id;

            $self_rate  = Db::name('config')->where('id', 1)->find(); //平台佣金 100
            $commission = Db::name('commission_links')->where('pid', $admin_auth->id)->find();
            if ($param['commission_rate'] == $commission['commission_rate']) {
                return json(['code' => -1, 'data' => '', 'msg' => '该佣金已经存在']);
            }
            if ($param['commission_rate'] > $self_rate['commission_rate']) {
                return json(['code' => -1, 'data' => '', 'msg' => '不能超过自己的佣金' . $self_rate['commission_rate'] . '%']);
            }
            $param['pid'] = $admin_auth->id;

            $param['reg_links'] = $reg_links;
            $commission         = new CommissionMode();
            $res                = $commission->addCommission($param);

            return json($res);
        }

        $assign = [
            'pid' => $admin_auth->id,
        ];

        return view('add', $assign);
    }

    // 编辑佣金
    public function editCommission()
    {
        $commission = new CommissionMode();

        if (request()->isPost()) {

            $param = input('post.');

            if (!isset($param['commission_rate']) || empty($param['commission_rate'])) {
                return json(['code' => -1, 'data' => '', 'msg' => '请输入佣金']);
            }

            $res = $commission->editCommission($param);

            return json($res);
        }

        $this->assign([

            'commission' => $commission->getCommissionInfoById(input('param.id'))['data'],
        ]);

        return view('edit');
    }

    // 删除佣金
    public function delCommission()
    {
        if (request()->isAjax()) {

            $id         = input('param.id');
            $Commission = new CommissionMode();

            $res = $Commission->delCommission($id);

            return json($res);
        }
    }

}
