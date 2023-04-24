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

class Guiji extends TimeModel{
   
   
     protected $dateFormat = 'Y-m-d H:i:s';
    protected $name = 'guiji';
    protected $autoWriteTimestamp = true;
    
    protected $type = [
        'create_time' => 'timestamp',
         'run_time' => 'timestamp',
  ];
   
      /*
     * 获取转帐列表
     * @param $limit
     * @param $where
     * @return array
     */
    public function getTGuijiList($limit=1, $where = [])
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
	$status =[0=>'等待执行',1=>'<font color="blue">执行中</font>',2=>'<font color="green">执行成功</font>',3=>'<font color="red">执行出错</font>'];
	return $status[$value];
}
}

