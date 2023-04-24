<?php
/**
 * Created by PhpStorm.
 * Date: 2019/3/1
 * Time: 14:22
 */
namespace app\admin\model;

use think\Model;
use think\facade\Session;

class Commission extends Model
{
    protected $name = 'commission_links';
    protected $autoWriteTimestamp = true;

    /*
     * 获取佣金列表
     * @param $limit
     * @param $where
     * @return array
     */
    public function getCommissionList($limit=1, $where = [])
    {
        try {
           $admin_auth =  Session::get('admin_auth');
            $res = $this->field('xn_commission_links.*')
                
                ->where('xn_commission_links.pid', $admin_auth->id)
                ->where($where)
                ->order('id', 'desc')
                ->paginate($limit);
        }catch (\Exception $e) {
            echo $e->getMessage();die;
            return ['code' => -1, 'data' => '', 'msg' => $e->getMessage()];
        }

        return ['code' => 0, 'data' => $res, 'msg' => 'ok'];
    }

    /**
     * 增加佣金
     * @param $param
     * @return array
     */
    public function addCommission($param)
    {
        try {
            $admin_auth =  Session::get('admin_auth');
            $has = $this->where('commission_rate', $param['commission_rate'])
                
                ->where('pid', $admin_auth->id)
                ->findOrEmpty()->toArray();
            if(!empty($has)) {
                return ['code' => -2, 'data' => '', 'msg' => '该佣金已经存在'];
            }

            $this->save($param);
        }catch (\Exception $e) {

            return ['code' => -1, 'data' => '', 'msg' => $e->getMessage()];
        }

        return ['code' => 0, 'data' => '', 'msg' => '添加成功'];
    }

    /**
     * 编辑佣金
     * @param $param
     * @return array
     */
    public function editCommission($param)
    {
        try {
            $admin_auth =  Session::get('admin_auth');
            $has = $this->where('commission_rate', $param['commission_rate'])
                
                ->where('pid', $admin_auth->id)
                ->where('id', '<>', $param['id'])
                ->findOrEmpty()->toArray();
            if(!empty($has)) {
                return ['code' => -2, 'data' => '', 'msg' => '佣金已经存在'];
            }

            $this->where('id', $param['id'])->update($param);
        }catch (\Exception $e) {

            return ['code' => -1, 'data' => '', 'msg' => $e->getMessage()];
        }

        return ['code' => 0, 'data' => '', 'msg' => '编辑成功'];
    }

    /**
     * 删除佣金
     * @param $wordId
     * @return array
     */
    public function delCommission($id)
    {
        try {
            $admin_auth =  Session::get('admin_auth');
            $this->where('id', $id)->where('pid', $admin_auth->id)->delete();
        }catch (\Exception $e) {

            return ['code' => -1, 'data' => '', 'msg' => $e->getMessage()];
        }

        return ['code' => 0, 'data' => '', 'msg' => '删除成功'];
    }

    /**
     * 检测商户某个分类下是否有佣金
     * @param $cateId
     * @return array
     */
    public function checkHasCommissionById($id)
    {
        try {
            $admin_auth =  Session::get('admin_auth');
            $has = $this->where('pid', $admin_auth->id)
                ->count();
        }catch (\Exception $e) {

            return ['code' => -1, 'data' => 0, 'msg' => $e->getMessage()];
        }

        return ['code' => 0, 'data' => $has, 'msg' => 'success'];
    }

    /**
     * 获取佣金详情
     * @param $wordId
     * @return array
     */
    public function getCommissionInfoById($id)
    {
        try {
            $admin_auth =  Session::get('admin_auth');
            $has = $this->where('id', $id)->where('pid', $admin_auth->id)
                ->findOrEmpty();
        }catch (\Exception $e) {

            return ['code' => -1, 'data' => 0, 'msg' => $e->getMessage()];
        }

        return ['code' => 0, 'data' => $has, 'msg' => 'success'];
    }

  
}