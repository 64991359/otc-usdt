<?php
// +----------------------------------------------------------------------
// | 小牛Admin
// +----------------------------------------------------------------------
// | Website: www.xnadmin.cn
// +----------------------------------------------------------------------
// | Author: dav <85168163@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\common\controller\AdminBase;
use app\common\model\Admin as AdminModel;
use app\common\model\AuthGroup;
use app\common\model\AuthGroupAccess;
use think\facade\Cookie;
use think\facade\Db;
use think\facade\Request;
use think\facade\Session;

class Admin extends AdminBase
{
    public function index()
    {
        $list = AdminModel::with(['auth_group_access'])->select();
        return view('', ['list' => $list]);
    }

    /**
     * 添加管理员
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
            $insert_id         = Db::name('admin')->strict(false)->insertGetId($param);
            if ($insert_id) {
                if (!empty($param['group_ids'])) {
                    foreach ($param['group_ids'] as $group_id) {
                        AuthGroupAccess::create(['admin_id' => $insert_id, 'group_id' => $group_id]);
                    }
                }
                xn_add_admin_log('添加管理员');
                $this->success('操作成功');
            } else {
                $this->error('操作失败');
            }
        }
        $group_data = AuthGroup::select();
        return view('form', ['group_data' => $group_data]);
    }

    /**
     * 编辑
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

            //更新权限
            if (!empty($group_ids)) {
                Db::name('auth_group_access')->where("admin_id", $id)->delete();

                foreach ($group_ids as $group_id) {
                    AuthGroupAccess::create(['admin_id' => $id, 'group_id' => $group_id]);
                }
            }

            if ($param['password'] != '') {
                $param['password'] = xn_encrypt($param['password']);
            } else {
                unset($param['password']);
            }

            $result = AdminModel::update($param);
            if ($result) {
                xn_add_admin_log('修改管理员信息');
                $this->success('操作成功');
            } else {
                $this->error('操作失败');
            }
        }
        $id     = $this->request->get('id');
        $assign = [
            'user_data'      => AdminModel::find($id),
            'group_data'     => AuthGroup::select(),
            'user_group_ids' => Db::name('auth_group_access')->where("admin_id", $id)->column('group_id'),
        ];
        return view('form', $assign);
    }

    /**
     * 删除节点
     */
    public function delete()
    {
        $id = intval($this->request->get('id'));
        !($id > 1) && $this->error('参数错误');
        AuthGroupAccess::where('admin_id', $id)->delete();
        AdminModel::destroy($id);
        xn_add_admin_log('删除管理员');
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

            config('app.is_demo') && $this->error('演示模式不可修改');
            $param = $this->request->param();
            $id    = $this->getAdminId();
            if ($param['password'] != '') {
                $param['password'] = xn_encrypt($param['password']);
            } else {
                unset($param['password']);
            }
            $result = AdminModel::where('id', $id)->update($param);
            if ($result) {
                xn_add_admin_log('修改个人资料');
                $this->success('操作成功');
            } else {
                $this->error('操作失败');
            }
        }
        $id        = $this->getAdminId();
        $user_data = AdminModel::find($id);
        return view('', ['user_data' => $user_data]);
    }

    //开关谷歌验证器
    public function google()
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

        $qrCodeUrl = '';
        $id        = $this->getAdminId();
        $row       = AdminModel::find($id);

        empty($row) && $this->error('管理员信息不存在');
        if ($this->request->isAjax()) {

            if (empty($row['google_key'])) {
                $google = new GoogleAuthenticator();
                //生成验证秘钥
                $secret = $google->createSecret();
                //生成验证二维码 $username 需要绑定的用户名
                $username  = Request::domain(1);
                $qrCodeUrl = $google->getQRCodeGoogleUrl($username, $secret);
            }

            $post = $this->request->post();
            $post['google_key_status'] ? Cookie::set('google_key_status', '1') : Cookie::delete('google_key_status');
            if (empty($row['qrCodeUrl'])) {
                $post['qrCodeUrl']  = $qrCodeUrl;
                $post['google_key'] = $secret;
            }

            $this->isDemo && $this->error('演示环境下不允许修改');
            $rule = [];
            $this->validate($post, $rule);
            try {

                $save = AdminModel::update($post);
            } catch (\Exception $e) {
                $this->error('开启失败');
            }
            if ($post['google_key_status'] == 1) {
                $save ? $this->success('开启成功') : $this->error('开启失败');
            } else {
                $save ? $this->success('关闭成功') : $this->error('关闭失败');
            }

        }
        $qrCodeUrl = $row['qrCodeUrl'] ? $row['qrCodeUrl'] : $qrCodeUrl;

        return view('google', ['row' => $row]);
    }
}
