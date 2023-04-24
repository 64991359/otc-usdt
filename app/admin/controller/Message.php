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
use app\common\model\AuthGroup;
use think\facade\Db;

class Message extends AdminBase
{
    public function index()
    {
        return view();
    }

    public function add()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $id    = $param['id'];
            if (isset($param['username'])) {
                $u = Db::name('user')->where('username', $param['username'])->find();
                if (empty($u)) {
                    $this->error('该用户不存在');exit;
                }
                $param['uid']        = $u['id'];
                $param['has_readed'] = 0;
                $param['sender']     = 1;
                unset($param['username']);
                $param['create_time'] = time();
                xn_add_admin_log('添加用户信息：' . $param['username']);
                $result = Db::name('user_msg')->save($param);
                if ($result) {
                    $this->success('添加成功');

                } else {
                    $this->error('添加失败');
                }
            }

        }
        return view();
    }
    /*添加公告信息*/
    public function addnotice()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();

            if ($param) {

                $param['create_time'] = time();
                xn_add_admin_log('添加公告信息');
                $result = Db::name('sys_notice')->save($param);
                if ($result) {
                    $this->success('添加成功');

                } else {
                    $this->error('添加失败');
                }
            }

        }
        return view();
    }

    public function deletemsg()
    {
        $id = intval($this->request->get('id'));
        !($id > 1) && $this->error('参数错误');
        Db::name('user_msg')->where("id", $id)->delete();

        xn_add_admin_log('删除用户信息');
        $this->success('删除成功');
    }
    public function deletenotice()
    {

        $id = intval($this->request->get('id'));
        !($id > 1) && $this->error('参数错误');
        Db::name('sys_notice')->where("id", $id)->delete();

        xn_add_admin_log('删除公告');
        $this->success('删除成功');

    }

    public function msg()
    {

        $list = Db::name('user_msg')->order('id desc')->paginate(12);

        return view('', ['list' => $list]);

    }
    /* 平台公告*/
    public function notice()
    {
        $list = Db::name('sys_notice')->order('id desc')->paginate(12);

        return view('', ['list' => $list]);
    }

    /**
     * 编辑用户信息
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

            if (isset($param['id'])) {
                $param2                = array();
                $param2['id']          = $param['id'];
                $param2['uid']         = $param['uid'];
                $param2['title']       = $param['title'];
                $param2['contents']    = $param['contents'];
                $param2['has_readed']  = $param['has_readed'] ? $param['has_readed'] : 0;
                $id                    = intval($param['id']);
                $param2['create_time'] = time();
                $result                = Db::name('user_msg')->where("id", $id)->update($param2);

            }

            if ($result) {
                xn_add_admin_log('修改用户信息');
                $this->success('操作成功');
            } else {
                $this->error('操作失败');
            }
        }
        $id        = $this->request->get('id');
        $user_data = Db::name('user_msg')->where(['id' => $id])->find();
        $assign    = [

            'user_data'      => $user_data,
            'group_data'     => AuthGroup::select(),
            'user_group_ids' => Db::name('auth_group_access')->where("admin_id", $id)->column('group_id'),
        ];
        return view('form', $assign);
    }

    /**
     * 编辑公告信息
     * @return \think\response\View
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function info()
    {
        if ($this->request->isPost()) {
            $param     = $this->request->param();
            $id        = $param['id'];
            $group_ids = $param['group_ids'];

            if (isset($param['id'])) {
                $param2       = array();
                $param2['id'] = $param['id'];

                $param2['title']    = $param['title'];
                $param2['contents'] = $param['contents'];

                $id                    = intval($param['id']);
                $param2['create_time'] = time();
                $result                = Db::name('sys_notice')->where("id", $id)->update($param2);

            }

            if ($result) {
                xn_add_admin_log('修改用户信息');
                $this->success('操作成功');
            } else {
                $this->error('操作失败');
            }
        }
        $id        = $this->request->get('id');
        $user_data = Db::name('sys_notice')->where(['id' => $id])->find();
        $assign    = [

            'user_data'      => $user_data,
            'group_data'     => AuthGroup::select(),
            'user_group_ids' => Db::name('auth_group_access')->where("admin_id", $id)->column('group_id'),
        ];
        return view('', $assign);
    }
}
