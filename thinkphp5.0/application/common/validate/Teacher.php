<?php
namespace app\common\validate;
use think\Validate;

class Teacher extends Validate
{
    protected $rule =   [   
        'name'  => 'require|max:25',
    ];
    protected $message  =   [
        'name.require' => '标题必须',
        'name.max'     => '标题最多不能超过25个字符', 
    ];
}