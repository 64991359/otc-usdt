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
use think\facade\Db;
use think\facade\Session;
use think\facade\View;

class Guide extends Base
{
    public function index()
    {
        $res      = Session::get('user_auth');
        $user_msg = Db::name('user_msg')->where('uid', $res['uid'])->save();

        $data                 = init_view();
        $data['user']['city'] = Session::get('city');
        return view('', $data);
    }

}
