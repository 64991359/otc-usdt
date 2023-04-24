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
use app\common\lib\Oss;
use app\common\lib\Qiniu;
use OSS\Core\OssException;
use think\facade\Db;

class Upload extends Base
{

    /**
     * 文件上传
     * @return \think\response\Json
     * @throws OssException
     */
    public function upload()
    {
        //file_put_contents('55555.txt', print_r($_FILES, true));exit;
        $ok  = $okk  = 0;
        $str = explode('.', $_FILES['file']['name']);
        //文件后缀名
        $ext = $str[count($str) - 1];
        switch ($_FILES['file']['type']) {
            case 'image/pjpeg':$ok = 1;
                break;
            case 'image/jpeg':$ok = 1;
                break;
            case 'image/gif':$ok = 1;
                break;
            case 'image/png':$ok = 1;
                break;
            case 'image/x-png':$ok = 1;
                break;

        }
        $upload_max = 4 * 1024 * 1024;
        if ($_FILES['file']['size'] < $upload_max) {
            $okk = 1;
        }
        if (!$ok) {
            $result = ['status' => 0, 'msg' => '上传失败,图片格式错误'];
            return json($result);
            exit;
        }
        if (!$okk) {
            $result = ['status' => 0, 'msg' => '上传失败,图片文件过大'];
            return json($result);
            exit;
        }
        //上传到七牛云
        $qiniu     = new Qiniu();
        $savename  = date('Ymd') . '/' . time() . rand(10000, 99999) . '.' . $ext;
        $file_path = $qiniu->putFile($savename, $_FILES['file']['tmp_name']);
        if (!$file_path) {
            $result = ['status' => 0, 'msg' => '上传失败,未上传至七牛云'];
            return json($result);
            exit;
        }
        //记录入文件表
        $insert_data = [
            'url'         => $file_path,
            'storage'     => 2,
            'app'         => 1,
            'user_id'     => 1,
            'file_name'   => $_FILES['file']['name'],
            'file_size'   => $_FILES['file']['size'],
            //'file_type' => 'image',
            'extension'   => $ext,
            'create_time' => time(),
        ];
        $upflie = Db::name('upload_files')->save($insert_data);
        //self::create($insert_data);
        if ($upflie) {
            $result = ['status' => 1, 'msg' => '上传成功', 'file' => $file_path];
        } else {
            $result = ['status' => 0, 'msg' => '上传失败,未写入数据库'];
        }

        return json($result);

    }
}
