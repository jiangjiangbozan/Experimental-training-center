<?php
namespace app\index\controller;
use think\Controller;   // 用于与V层进行数据传递
<<<<<<<< HEAD:thinkphp5.0/application/common/index/controller/XuController.php
use app\common\model\shi\Xu;   
========
use app\common\model\shou\Shou;   
use app\common\model\News; 
use app\common\model\Notification; 
>>>>>>>> 6a2c0461444c407c5ea689e83d3f966feb7c8666:thinkphp5.0/application/index/controller/ShouController.php
use think\Session;     

class XuController extends Controller
{
    public function index()
    {
        $News = new News; 
        $Notification = new Notification; 
        $notifications = Notification::paginate(10);
        $new = News::paginate(10);
    	$power = Session::get('power');
    	$this->assign('power',$power);
        $this->assign('notifications', $notifications);
        $this->assign('new', $new);
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