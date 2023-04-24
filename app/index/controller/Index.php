<?php
namespace app\index\controller;

use app\common\controller\Base;
use think\facade\Session;
use think\facade\View; 
class Index extends Base
{
    public function index()
    {
        
     
        /*View::assign('is_login',$is_login);*/
  
    if(is_mobile()===true){
         return view(); 
    }else{
         return view('pc'); 
    }
     
    }
}