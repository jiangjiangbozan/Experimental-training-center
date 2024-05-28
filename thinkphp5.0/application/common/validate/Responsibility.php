<?php
namespace app\common\validate;
use think\Validate;

class Responsibility extends Validate
{
    protected $rule =   [   
        'name'  => 'require|max:25',
        'content'   => 'require',
        'tel'  => 'require',
    ];
    protected $message  =   [
        'name.require' => '标题必须',
        'name.max'     => '标题最多不能超过25个字符', 
        'content.require' => '内容必须',
        'tel.require'  => '电话必须'，
    ];
}