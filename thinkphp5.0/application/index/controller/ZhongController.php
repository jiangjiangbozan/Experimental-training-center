<?php
namespace app\index\controller;
use think\Controller;   // 用于与V层进行数据传递
use app\common\model\zhong\Zhong;  
use think\Session;      

class ZhongController extends Controller
{
    public function index()
    {
    	$power = Session::get('power');
    	$this->assign('power',$power);
        $htmls = $this->fetch(); // 取回打包后的数据

        return $htmls; // 将数据返回给用户
        
    }
    public function add(){
    	$htmls = $this->fetch(); // 取回打包后的数据

        return $htmls;

    }
    public function save(){
    	$save = new ImageController();
    	$save->save();
	}
}