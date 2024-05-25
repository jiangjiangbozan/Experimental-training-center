<?php
namespace app\common\validate;
use think\Validate;

class Notification extends Validate
{
    protected $rule =   [
        'title'  => 'require|max:25',
        'content'   => 'require',
        'author' => 'require',   
    ];
    protected $message  =   [
        'name.require' => '名称必须',
        'name.max'     => '名称最多不能超过25个字符',  
        'content.require' => '内容必须',
        'author.require' => '作者必须',
    ];
}