<?php
namespace app\index\controller;

use app\common\controller\Base;
use think\facade\View; 
use think\facade\Session;

class Trade extends Base
{
    public function index()
    {
       return view();
    }

    
    
    
    public function buy()
    {
        
          $is_login='';
        $res =   Session::get('user_auth');
       
            $msg =   Session::get('msg');
        
         
        if($res){
         $is_login=1;  
       
         View::assign('user',$res);
         
          View::assign('user_msg_nums',Session::get('user_msg_nums'));
        
          View::assign('notice_nums',Session::get('notice_nums'));
       
          View::assign('msg',$msg['user_msg']);
          View::assign('notice',$msg['sys_notice'][0]);
         
        }
        View::assign('is_login',$is_login);
      
       return view();
    }
 
    
    
    
    public function sell()
    {
        
          $is_login='';
        $res =   Session::get('user_auth');
       
            $msg =   Session::get('msg');
        
         
        if($res){
         $is_login=1;  
       
         View::assign('user',$res);
         
          View::assign('user_msg_nums',Session::get('user_msg_nums'));
        
          View::assign('notice_nums',Session::get('notice_nums'));
       
          View::assign('msg',$msg['user_msg']);
          View::assign('notice',$msg['sys_notice'][0]);
         
        }
        View::assign('is_login',$is_login);
      
       return view();
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}