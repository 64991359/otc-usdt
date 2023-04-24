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
use app\common\lib\Oss;
use app\common\model\UploadFiles as UploadFilesModel;
use OSS\Core\OssException;
use think\facade\Db;

class Banner extends AdminBase
{
    protected $noAuth = ['upload', 'select'];
    public function index()
    {
        if ($this->request->isPost()) {
            $post = $this->request->param();

            if (isset($post['title1'])) {
                if (strpos($post['links1'], "http") === false) {
                    $this->error('链接地址1 出错');
                }
                if (strpos($post['links2'], "http") === false) {
                    $this->error('链接地址2 出错');
                }
                if (strpos($post['links3'], "http") === false) {
                    $this->error('链接地址3 出错');
                }
                $post['banner1'] = $post['banner1'] ? $post['banner1'] : $post['img_url1'];
                $post['banner2'] = $post['banner2'] ? $post['banner2'] : $post['img_url2'];
                $post['banner3'] = $post['banner3'] ? $post['banner3'] : $post['img_url3'];
                $delete          = Db::table('xn_banner')->where('id', '>', 0)->delete();
                $data            = [];
                $data[]          = ['title' => $post['title1'], 'url' => $post['links1'], 'img_url' => $post['banner1']];
                $data[]          = ['title' => $post['title2'], 'url' => $post['links2'], 'img_url' => $post['banner2']];
                $data[]          = ['title' => $post['title3'], 'url' => $post['links3'], 'img_url' => $post['banner3']];
                $ok              = Db::table('xn_banner')->insertAll($data);
                $this->success('添加成功');
            } else {
                $folder_name = $this->request->param('folder_name/s', 'file');
                $result      = UploadFilesModel::upload($folder_name);
                return json($result);
            }

        }
        $list = Db::table('xn_banner')->where('id', '>', 0)->select();
        return view('index', ['list' => $list]);
    }

    public function add()
    {
        if ($this->request->isPost()) {
            $this->success('添加成功');
        }
        return view();
    }

    public function delete()
    {
        $this->success('删除成功');
    }

    /**
     * 文件上传
     * @return \think\response\Json
     * @throws OssException
     */
    public function upload()
    {
        $folder_name = $this->request->param('folder_name/s', 'file');
        $result      = UploadFilesModel::upload($folder_name);
        return json($result);
    }
}
