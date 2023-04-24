<?php
// +----------------------------------------------------------------------
// | 小牛Admin
// +----------------------------------------------------------------------
// | Website: www.xnadmin.cn
// +----------------------------------------------------------------------
// | Author: dav <85168163@qq.com>
// +----------------------------------------------------------------------

namespace app\common\model;

use think\Model;

class User extends Model
{
     protected $autoWriteTimestamp = true;
     
       /**
     * 添加时间
     * @var string
     */
    protected $createTime = 'register_time';

  
}