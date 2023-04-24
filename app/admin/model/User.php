<?php
/**
 * Created by PhpStorm.
 * Date: 2019/3/1
 * Time: 14:22
 */
namespace app\admin\model;

use think\Model;
use think\facade\Session;
use think\facade\Db;

class User extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $name = 'user';
    protected $autoWriteTimestamp = true;
        protected $type = [
        'register_time' => 'timestamp',
         'update_time' => 'timestamp',
  ];


    /*
     * 获取用户列表
     * @param $limit
     * @param $where
     * @return array
     */
    public function getuserList($param, $where = [])
    {
        try {

      $res =  $this->table('xn_user')
->where($where)

->paginate(['query' => $param]);

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
    public function adduser($param)
    {
        try {
            $admin_auth =  Session::get('admin_auth');
            $has = $this->where('username', $param['username'])
                
             
                ->findOrEmpty()->toArray();
            if(!empty($has)) {
                return ['code' => -2, 'data' => '', 'msg' => '该用户已经存在'];
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
    public function edituser($param)
    {
        try {
            $admin_auth =  Session::get('admin_auth');
            $has = $this->where('user_rate', $param['user_rate'])
                
            
                ->where('id', '<>', $param['id'])
                ->findOrEmpty()->toArray();
            if(!empty($has)) {
                return ['code' => -2, 'data' => '', 'msg' => '用户已经存在'];
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
    public function deluser($id)
    {
        try {
            $admin_auth =  Session::get('admin_auth');
            $this->where('id', $id)->delete();
        }catch (\Exception $e) {

            return ['code' => -1, 'data' => '', 'msg' => $e->getMessage()];
        }

        return ['code' => 0, 'data' => '', 'msg' => '删除成功'];
    }

  

    /**
     * 获取用户详情
     * @param $wordId
     * @return array
     */
    public function getuserInfoById($id)
    {
        try {
            $admin_auth =  Session::get('admin_auth');
            $has = $this->where('id', $id)
                ->findOrEmpty();
        }catch (\Exception $e) {

            return ['code' => -1, 'data' => 0, 'msg' => $e->getMessage()];
        }

        return ['code' => 0, 'data' => $has, 'msg' => 'success'];
    }

  
}