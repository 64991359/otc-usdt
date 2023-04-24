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

class RechargeRecord extends TimeModel{
   
   
     protected $dateFormat = 'Y-m-d H:i:s';
    protected $name = 'recharge_record';
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
    public function getRechargeRecordList($limit=1, $where = [])
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
 
 
 
 public function getTransferTypeAttr($value)
{ 
	$status =[0=>'<font color="green">转出</font>',1=>'<font color="blue">转入</font>'];
	return $status[$value];
}
 public function getUsdtNumsAttr($value)
{ 

	return $value / 1000000;
}

}

