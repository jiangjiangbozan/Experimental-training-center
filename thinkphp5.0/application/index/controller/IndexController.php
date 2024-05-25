<?php
namespace app\index\controller;
use think\Controller;   // 用于与V层进行数据传递
use app\common\model\News; 
use app\common\model\Notification; 
use app\common\model\CarouselImage;
use app\common\model\Laboratory;
use app\common\model\Slide;
use app\common\model\VrImage;
use app\common\model\NewsImage;
use app\common\model\Zi;
use think\db;
use think\Session;     

class IndexController extends Controller
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

        // 查询轮播图数据
        $carouselImages = CarouselImage::all();
        
        // 分配数据到视图
        $this->assign('carouselImages',$carouselImages);

         // 查询实验室信息
        $laboratory = Laboratory::find(1); // 假设您要查询的是 ID 为 1 的实验室
        
        // 分配数据到视图
        $this->assign('laboratory',$laboratory);

        // 查询幻灯片信息
        $slides = Slide::all();
        
        // 分配数据到视图
        $this->assign('slides',$slides);

        // 查询轮播图信息
        $vrImages = VrImage::all();
        
        // 分配数据到视图
        $this->assign('vrImages',$vrImages);

        // 查询新闻轮播图信息
        $newsImages = NewsImage::all();
        
        // 分配数据到视图
        $this->assign('newsImages',$newsImages);

        // 查询新闻轮播图信息
        $zis = Zi::all();
        
        // 分配数据到视图
        $this->assign('zis',$zis);

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