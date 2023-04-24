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
//
class OrderConfig extends TimeModel
{
 protected $name = "order_config";

   function getConfig(){
       
        try {

            $res = $this->where('id',1)->find()->toArray();
        }catch (\Exception $e) {

            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
      
      return ['code' => 1, 'data' => $res, 'msg' => 'ok'];
   }
   
   
   
    /**
     * 编辑商户
     * @param $seller
     * @return array
     */
    public function editConfig($config)
    {
        try {

           
            $this->where('id',1)->save($config);
        }catch (\Exception $e) {

            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }

        return ['code' => 1, 'data' => '', 'msg' => '编辑成功'];
    }
}