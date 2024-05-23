<?php
namespace app\index\controller;
use think\Controller;   // 用于与V层进行数据传递
use app\common\model\fan\Fan;      

class FanController extends Controller
{
    public function index()
    {
         //$Fan = new Fan; 
        // $fans = $Fan->select();

        // $this->assign('fans', $fans); // 向V层传数据

        $htmls = $this->fetch(); // 取回打包后的数据

        return $htmls; // 将数据返回给用户
        
    }
}