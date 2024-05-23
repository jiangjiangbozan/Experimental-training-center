<?php
namespace app\index\controller;
use think\Controller;   // 用于与V层进行数据传递
use app\common\model\index\Index;      

class IndexController extends Controller
{
    public function index()
    {
         //$Index = new Index; 
        // $indexs = $Index->select();

        // $this->assign('indexs', $indexs); // 向V层传数据

        $htmls = $this->fetch(); // 取回打包后的数据

        return $htmls; // 将数据返回给用户
        
    }
}