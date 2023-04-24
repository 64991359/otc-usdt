<?php
// +----------------------------------------------------------------------
// | 小牛Admin
// +----------------------------------------------------------------------
// | Website: www.xnadmin.cn
// +----------------------------------------------------------------------
// | Author: dav <85168163@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\model\User as UserModel;
use app\common\controller\AdminBase;
use app\common\model\AuthGroup;
use think\facade\Db;
use think\facade\Request;
use think\facade\View;
use think\paginator\driver\Bootstrap;

class User extends AdminBase
{

    public function index()
    {
        $param = $this->request->param();
        $model = new UserModel();
        if ($param['start_date'] != '' && $param['end_date'] != '') {
            $model = $model->whereBetweenTime('register_time', $param['start_date'], $param['end_date']);
        }
        if ($param['phone'] != '') {
            $list = $model->where('phone', $param['phone'])->order('id desc')->paginate(['query' => $param]);
        } else {
            $list = $model->order('id desc')->paginate(['query' => $param]);
        }

        return view('', ['list' => $list]);
    }
    /**
     * 添加用户
     * @return \think\response\View
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $param             = $this->request->param();
            $param['password'] = xn_encrypt($param['password']);
            if (empty($param['password']) || empty($param['username'])) {
                $this->error('操作失败');
            }
            $param['register_time'] = time();
            $has                    = Db::name('user')->where('username', $param['username'])->find();
            if ($has) {
                $this->error('用户已存在');exit;
            }
            $insert_id = Db::name('user')->strict(false)->insertGetId($param);
            Db::name('user_info')->strict(false)->insertGetId(['uid' => $insert_id, 'create_time' => time()]);
            if ($insert_id) {

                xn_add_admin_log('添加用户');
                $this->success('操作成功');
            } else {
                $this->error('操作失败');
            }
        }
        $group_data = AuthGroup::select();
        return view('form', ['group_data' => $group_data]);
    }

    /**
     * 编辑用户
     * @return \think\response\View
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function edit()
    {
        if ($this->request->isPost()) {
            $param     = $this->request->param();
            $id        = $param['id'];
            $group_ids = $param['group_ids'];

            if ($param['username'] == '') {
                unset($param['username']);
            }
            if ($param['phone'] == '') {
                unset($param['phone']);
            }
            if ($param['email'] == '') {
                unset($param['email']);
            }
            if (isset($param['password']) && $param['password'] !== '') {
                $param['password'] = xn_encrypt($param['password']);
            } else {
                unset($param['password']);
            }
            if (isset($param['trans_password']) && $param['trans_password'] != '') {
                $param['trans_password'] = xn_encrypt($param['trans_password']);
            } else {
                unset($param['trans_password']);
            }
            if ($param['status'] != 1) {
                $param['status'] = '0';
            }

            $result = Db::name('user')->where(['id' => $id])->update($param);
            if ($result) {
                xn_add_admin_log('修改用户信息');
                $this->success('操作成功');
            } else {
                $this->error('操作失败');
            }
        }
        $id = $this->request->get('id');

        $user_data = Db::name('user')->where(['id' => $id])->find();
        $assign    = [

            'user_data'      => $user_data,
            'group_data'     => AuthGroup::select(),
            'user_group_ids' => Db::name('auth_group_access')->where("admin_id", $id)->column('group_id'),
        ];
        return view('form', $assign);
    }

    /**
     * 删除用户
     */
    public function delete()
    {
        $id = intval($this->request->get('id'));
        !($id > 1) && $this->error('参数错误');
        Db::name('user_info')->where("uid", $id)->delete();
        Db::name('user_msg')->where("uid", $id)->delete();
        Db::name('check_balance')->where("uid", $id)->delete();
        Db::name('payment')->where("uid", $id)->delete();
        Db::name('user_address')->where("uid", $id)->delete();
        Db::name('wallet_temp')->where("uid", $id)->delete();
        Db::name('identity_auth')->where("uid", $id)->delete(); //identity_auth

        UserModel::destroy($id);
        xn_add_admin_log('删除用户');
        $this->success('删除成功');
    }

    /**
     * 修改资料
     * @return \think\response\View
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function info()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $id    = intval($this->request->get('id'));
            if ($param['password'] != '') {
                $param['password'] = xn_encrypt($param['password']);
            } else {
                unset($param['password']);
            }
            $result = UserModel::where('id', $id)->update($param);
            if ($result) {
                xn_add_admin_log('修改个人资料');
                $this->success('操作成功');
            } else {
                $this->error('操作失败');
            }
        }
        $id        = intval($this->request->get('id'));
        $user_data = UserModel::find($id);
        return view('', ['user_data' => $user_data]);
    }
    //身份认证列表
    public function renzheng()
    {
        $pageNo = Request::param('page');
        //客户端传过来的分页
        $pageNumber = $pageNo ? $pageNo : '0';
        if ($pageNumber > 0) {
            $pageNumber_one = $pageNumber - 1;
        } else {
            $pageNumber_one = 0;
        }
        $limit  = 10; //每页显示条数
        $offset = $pageNumber_one * $limit; //查询偏移值

        $sql  = "SELECT `a`.*,`b`.username FROM `xn_user` `b`,`xn_identity_auth` `a` WHERE  ( b.id=a.uid ) ORDER BY `a`.`renzheng1` asc,`a`.`renzheng2` asc,`a`.`id` DESC LIMIT  $offset,$limit";
        $list = Db::query($sql);

        //查询的总条数

        $sqlTotal = "SELECT count(*) as count_num FROM `xn_user` `b`,`xn_identity_auth` `a` WHERE  ( b.id=a.uid ) ORDER BY `a`.`id` DESC";
        $counts   = Db::query($sqlTotal);

        $count = count($counts); //因为获取的总数为数组类型，因此用count计算出总数
        //组合分页数据格式
        $pagernator = Bootstrap::make($list, $limit, $pageNumber, $count, false, ['path' => Bootstrap::getCurrentPath(), 'query' => request()->param()]);
        $page       = $pagernator->render();

        // 获取分页显示
        View::assign(['list' => $list, 'page' => $page]);
        return View::fetch();
    }
    //认证通过
    public function sfzedit()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();

            $id  = $param['id'];
            $uid = $param['uid'];
            unset($param['id']);
            unset($param['uid']);
            $result  = Db::name('identity_auth')->where("id", $id)->update($param);
            $result2 = Db::name('user')->where("id", $uid)->update($param);
            if ($result && $result2) {
                xn_add_admin_log('修改认证状态');
                $this->success('操作成功');
            } else {
                $this->error('操作失败');
            }
        }
    }

    //删除认证
    public function sfzdelete()
    {
        $id = intval($this->request->get('id'));
        !($id > 0) && $this->error('参数错误');
        Db::name('identity_auth')->where("id", $id)->delete();
        xn_add_admin_log('删除用户认证');
        $this->success('删除成功');
    }

}
