<?php
namespace app\common\validate;
use think\Validate;     // 内置验证类

class Manage extends Validate
{
    protected $rule =   [   
        'name'  => 'require|max:25',
        'content'   => 'require',
    ];
    protected $message  =   [
        'name.require' => '标题必须',
        'name.max'     => '标题最多不能超过25个字符', 
        'content.require' => '内容必须',
    ];
}