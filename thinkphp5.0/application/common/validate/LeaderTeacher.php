<?php
namespace app\common\validate;
use think\Validate;

class LeaderTeacher extends Validate
{
    protected $rule =   [   
        'name'  => 'require|max:25',
        'file' => 'require'
    ];
    protected $message  =   [
        'name.require' => '标题必须',
        'name.max'     => '标题最多不能超过25个字符', 
        'file.require' => '文件必须'
    ];
    }