<?php
// +----------------------------------------------------------------------
// | 小牛Admin
// +----------------------------------------------------------------------
// | Website: www.xnadmin.cn
// +----------------------------------------------------------------------
// | Author: dav <85168163@qq.com>
// +----------------------------------------------------------------------

namespace app\user\validate;

use think\Validate;

class Register extends Validate
{
    protected $rule = [
        'username' => 'require|number|max:11|min:11',
        'password' => 'require|min:5',
         'pid' => 'number',
    ];

    protected $message = [
        'username.require' => '账号不能为空！',
        'password.require' => '密码不能为空！',
        'username.max'     => '手机号不能超过11个字符',
        'username.min'     => '手机号不能少于11个字符',
        'password.min'     => '密码不能少于5个字符',
        'username.number'   => '账号必须是数字',
        'pid.number'   => '邀请码必须是数字',
    ];
}
