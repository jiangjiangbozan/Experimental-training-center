<?php
namespace app\common\validate;
use think\Validate;

class Layout extends Validate
{
    protected $rule =   [   
        'content'   => 'require',
    ];
    protected $message  =   [
        'content.require' => '内容必须',
    ];
}
