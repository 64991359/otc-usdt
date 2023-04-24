<?php
// +----------------------------------------------------------------------
// | 应用设置
// +----------------------------------------------------------------------

return [
    // 应用地址
    'app_host'         => env('app.host', ''),
    'domain'            => env('app.domain', ''),
    // 应用的命名空间
    'app_namespace'    => '',
    // 是否启用路由
    'with_route'       => true,
    // 是否启用事件
    'with_event'       => true,
    // 默认应用
    'default_app'      => 'index',
    // 默认时区
    'default_timezone' => 'Asia/Shanghai',
    'default_filter'      => 'trim,removeXSS',

    // 应用映射（自动多应用模式有效）
    'app_map'          => [],
    // 域名绑定（自动多应用模式有效）
    'domain_bind'      => [],
    // 禁止URL访问的应用列表（自动多应用模式有效）
    'deny_app_list'    => [],

    // 异常页面的模板文件
    'exception_tmpl'   => app()->getThinkPath() . 'tpl/think_exception.tpl',

    'dispatch_success_tmpl' => app()->getRootPath() . 'view/tpl/dispatch_jump.tpl',

    // 错误显示信息,非调试模式有效
    'error_message'    => '页面错误！请稍后再试～',
    // 显示错误信息
    'show_error_msg'   => false,
    'show_app_trace'   => false,
    //短信宝
    'sms_user'  => '',
    'sms_pwd'  => '',
    'sms_title'  => 'U汇',
    //发送邮件帐号
    'from_user_mail'=>'XX@qq.com',
   'from_user_password'=>'',
   'trans_timeout'=>1800,//转帐超时
   
  'remainTrx'=>4,//保留波场用户地址gas费
 'remainEth'=>0.0001,//保留以太坊用户地址gas费
  'infuraId'=>'',//以太节点 id
  'appPrivateKey'=>'erweAq2222xsaaaaaaaZ',//app 通信私钥
   'is_demo'=>env('demo.is_demo', false),
   'site_name'=>'U汇',
   'site_help'=>'https://help.yoursite.com',//帮助网站
   'upload_config'=>false,//是否显示上传配置
];
