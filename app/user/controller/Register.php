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
use think\exception\ValidateException;
use think\facade\Db;
use think\facade\Session;

class Register extends Base
{
    public function index()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            try {
                $this->validate($param, 'register');
            } catch (ValidateException $e) {
                $this->error($e->getError());
            }

            $admin_data = User::where([
                'username' => $param['username'],

            ])->find();
            if (!empty($admin_data)) {
                $this->error('用户已存在');
            }
            if ($param['pid'] == '' || $param['pid'] === null) {
                $param['pid'] = 0;
            } elseif ($param['pid'] > 10000) {
                $param['pid'] = $param['pid'] - 10000;
            }
            $admin_data = '';
            $admin_data = User::where([
                'id' => $param['pid'],

            ])->find();

            if (empty($admin_data)) {
                $this->error('邀请码无效');
            }
            $param['password'] = xn_encrypt($param['password']);
            $param['phone']    = $param['username'];
            $param['quota']    = 10;

            $user = new User;
            $user->allowField(['username', 'password', 'pid', 'phone', 'quota'])->save($param);

            $user_data = User::where([
                'username' => $param['username'],

            ])->find();
            $user_data = $user_data->toArray();
            if ($user_data['id'] > 0) {
                $has = Db::name('user_info')->where(['uid' => $user_data['id']]);
                if (empty($has)) {
                    Db::name('user_info')->save(['uid' => $user_data['id']]);
                }

            }

            Session::set('user_auth', $user_data);

            $this->success('注册成功');

        }
        return view();
    }
}
