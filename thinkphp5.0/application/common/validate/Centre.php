<?php
namespace app\common\validate;
use think\Validate;     // 内置验证类

class Centre extends Validate
{
    protected $rule = [
        'content' => 'require'
    ];
}