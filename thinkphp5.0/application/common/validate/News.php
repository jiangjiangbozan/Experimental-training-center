<?php
namespace app\common\validate;
use think\Validate;

class News extends Validate
{
    protected $rule =   [
        'author' => 'require',   
        'title'  => 'require|max:25',
        'content'   => 'require',
    ];
    protected $message  =   [
        'author.require' => '作者必须',
        'title.require' => '标题必须',
        'title.max'     => '标题最多不能超过25个字符', 
        'content.require' => '内容必须',
    ];
}