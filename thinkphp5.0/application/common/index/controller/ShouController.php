<?php
namespace app\index\controller;
use think\Controller;   // 用于与V层进行数据传递
use app\common\model\shou\Shou;   
use app\common\model\News; 
use app\common\model\Notification; 
use think\Session;     

class ShouController extends Controller
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