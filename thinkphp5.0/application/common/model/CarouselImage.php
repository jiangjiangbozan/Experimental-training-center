<?php
namespace app\common\model;

use think\Model;

class CarouselImage extends Model
{
    // 如果图片路径存储的是相对路径，确保这里的数据库配置正确
    protected $resultSetType = 'collection';
}