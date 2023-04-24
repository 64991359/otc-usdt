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

class Upload extends Base
{

    public function upload()
    {

        if ($param = $this->request->param()) {
            if ($param['uType'] == 'user_ident') {
//身分证上传参数
                check_login();
                $step = $param["step"]; //用户名
                Session::set('step', $step);
                $_imgUrl = $_FILES["uImg"];

                Session::set('tempimg', $_imgUrl["tmp_name"]);
                $extName     = explode(".", $_imgUrl["name"]); //??????
                $fileExtName = $extName[count($extName) - 1]; //获取扩展名
                $day         = date("Ymd", time());
                $this->mkdirs("imgs/" . $day . '/');
                $fileName = "imgs/" . $day . '/sfz' . time() . "." . $fileExtName; //重命名  15756987.jpg  //图片存储位置
                if ($param['sfz_type']) {
                    $res                     = session('user_auth');
                    $res[$param['sfz_type']] = $fileName;
                    $res['true_name']        = Session::get('truename');
                    Session::set('user_auth', $res);
                    $res = session('user_auth');
                    if ($param['sfz_type'] == 'back' && isset($res['back'])) {
                        $data = ['identification' => 2, 'sfz_front' => $res['front'], 'sfz_back' => $res['back']];
                        Db::name('user')->where('username', $res['username'])->save($data);
                        $truename = Session::get('truename');
                        Db::name('user_info')->where('uid', $res['uid'])->save(['true_name' => $truename]);

                    }
                }
                move_uploaded_file($_imgUrl["tmp_name"], $fileName);
                $param['uName'] = $fileName;

                $this->success('上传成功', url('user/Verification/upload'), $param);
            }

        }

    }

    public function mkdirs($dir, $mode = 0777)
    {
        if (is_dir($dir) || @mkdir($dir, $mode)) {
            return true;
        }

        if (!mkdirs(dirname($dir), $mode)) {
            return false;
        }

        return @mkdir($dir, $mode);

    }

}
