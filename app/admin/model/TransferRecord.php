<?php

// +----------------------------------------------------------------------
// | EasyAdmin
// +----------------------------------------------------------------------
// | PHP交流群: 763822524
// +----------------------------------------------------------------------
// | 开源协议  https://mit-license.org 
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zhongshaofa/EasyAdmin
// +----------------------------------------------------------------------


namespace app\admin\model;


use app\common\model\TimeModel;

class TransferRecord extends TimeModel{
   
   
     protected $dateFormat = 'Y-m-d H:i:s';
    protected $name = 'transfer_record';
    protected $autoWriteTimestamp = true;
    
    protected $type = [
        'create_time' => 'timestamp',
         'update_time' => 'timestamp',
  ];
   
      /*
     * 获取转帐列表
     * @param $limit
     * @param $where
     * @return array
     */
    public function getTransRecordList($limit=1, $where = [])
    {
        try {
        
            $res = $this->where($where)
                ->order('id', 'desc')
                ->paginate($limit);
        }catch (\Exception $e) {
            echo $e->getMessage();die;
            return ['code' => -1, 'data' => '', 'msg' => $e->getMessage()];
        }
      
        return ['code' => 0, 'data' => $res, 'msg' => 'ok'];
    }
 
 
 
 public function getStatusAttr($value)
{ 
	$status =[0=>'等待审核',1=>'<font color="blue">开始提现</font>',2=>'<font color="green">提现成功</font>',3=>'<font color="red">取消订单</font>',4=>'<font color="red">订单过期</font>'];
	return $status[$value];
}
}

