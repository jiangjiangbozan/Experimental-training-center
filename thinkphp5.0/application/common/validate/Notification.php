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
        'title.require' => '标题必须',
        'title.max'     => '标题最多不能超过25个字符',  
        'content.require' => '内容必须',
        'author.require' => '作者必须',
    ];
}