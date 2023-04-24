<?php
namespace app\ybf\controller;

use app\common\controller\Base;
use think\facade\Session;
use think\facade\View; 
class Index extends Base
{
    public function index()
    {
        
     
       
  
    if(is_mobile()===true){
         return view(); 
    }else{
         return view('pc'); 
    }
     
    }
}