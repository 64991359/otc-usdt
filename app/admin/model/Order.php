<?php
/**
 * Created by PhpStorm.
 * Date: 2019/3/1
 * Time: 14:22
 */
namespace app\admin\model;

use think\Model;


class Order extends Model
{
     protected $dateFormat = 'Y-m-d H:i:s';
    protected $name = 'order';
    protected $autoWriteTimestamp = true;
    
    protected $type = [
        'create_time' => 'timestamp',
         'update_time' => 'timestamp',
  ];


    /*
     * 获取佣金列表
     * @param $limit
     * @param $where
     * @return array
     */
    public function getOrderList($limit=1, $where = [])
    {
        try {
        
            $res = $this->where($where)
                ->order('id', 'desc')
                ->paginate($limit);
        }catch (\Exception $e) {
            echo $e->getMessage();die;
            return ['code' => -1, 'data' => '', 'msg' => $e->getMessage()];
        }
        //$res['_status'] = $res['status'];
        return ['code' => 0, 'data' => $res, 'msg' => 'ok'];
    }

  
    /**
     * 编辑订单
     * @param $param
     * @return array
     */
    public function editOrder($param)
    {
        try {
    

            $this->where('id', $param['id'])->update($param);
        }catch (\Exception $e) {

            return ['code' => -1, 'data' => '', 'msg' => $e->getMessage()];
        }

        return ['code' => 0, 'data' => '', 'msg' => '编辑成功'];
    }

    /**
     * 删除订单
     * @param $id
     * @return array
     */
    public function delOrder($id)
    {
        try {
         
            $this->where('id', $id)->delete();
        }catch (\Exception $e) {

            return ['code' => -1, 'data' => '', 'msg' => $e->getMessage()];
        }

        return ['code' => 0, 'data' => '', 'msg' => '删除成功'];
    }

 
    /**
     * 获取订单详情
     * @param $id
     * @return array
     */
    public function getOrderById($id)
    {
        try {
         
            $has = $this->where('id', $id)->findOrEmpty();
               
        }catch (\Exception $e) {

            return ['code' => -1, 'data' => 0, 'msg' => $e->getMessage()];
        }

        return ['code' => 0, 'data' => $has, 'msg' => 'success'];
    }

  
  

public function getStatusAttr($value)
{ 
	$status =[0=>'<font color="blue">匹配成功</font>',1=>'买钱付款',2=>'<font color="green">订单完成</font>',3=>'<font color="red">取消订单</font>',4=>'订单过期'];
	return $status[$value];
}


public function getPayCodeAttr($value)
{ 
	$status =[1=>'银行',2=>'微信',3=>'支付宝'];
	return $status[$value];
}
}