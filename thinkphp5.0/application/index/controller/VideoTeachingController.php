<?php
namespace app\index\controller;
use think\Controller;   // 用于与V层进行数据传递
use app\common\model\VideoTeaching;      
use think\Session;  
use think\Request; 
use think\Db;
class VideoTeachingController extends Controller
{
    public function index()
    {
        $VideoTeaching = new VideoTeaching; 
        $videoTeachings = VideoTeaching::paginate(5);
    	$power = Session::get('power');
    	$this->assign('power',$power);
        $this->assign('videoTeachings', $videoTeachings);
        $htmls = $this->fetch(); // 取回打包后的数据
        return $htmls; // 将数据返回给用户
    }
    public function video_teachingDetail($id)
    {
        // 使用模型获取指定ID的视频信息
        $videoInfo = Db::name('video_teaching')->where('id',$id)->find();
        if (!$videoInfo) {
            $this->error('视频信息不存在！');
        }
        // 将视频信息分配给视图
        $this->assign('videoInfo', $videoInfo);
        // 渲染视图
        return $this->fetch('video_detail');
    }

     public function manage()
    {

        try {
            $title = Request::instance()->get('title');
            $pagesize = 5;
           $VideoTeaching = new VideoTeaching; 

            if (!empty($title)) {
                $VideoTeaching->where('title', 'like', '%' . $title . '%');
            }
            // $VideoTeaching->where('is', 'like', '%' . $is . '%');
            $videoTeachings = $VideoTeaching->paginate($pagesize, false, [
                'query'=>[
                    'title' => $title,
                    ],
                ]);
            // 向V层传数据
            $this->assign('videoTeachings', $videoTeachings);

            // 取回打包后的数据
            $htmls = $this->fetch();

            // 将数据返回给用户
            return $htmls;
        } catch (\Exception $e) {
            // 由于对异常进行了处理，如果发生了错误，我们仍然需要查看具体的异常位置及信息，那么需要将以下代码的注释去掉。
            // throw $e;
            return '系统错误' . $e->getMessage();
        }

    }
    public function add(){
    	$htmls = $this->fetch(); // 取回打包后的数据

        return $htmls;

    }
    public function save(){
        $VideoTeaching = new VideoTeaching();
        // 实例化班级并赋值
        $VideoTeaching->author = Request::instance()->post('author');
        $VideoTeaching->source = Request::instance()->post('source');
        $VideoTeaching->title = Request::instance()->post('title');
        $VideoTeaching->content = Request::instance()->post('content');
        $VideoTeaching->save();
        return $this->success('操作成功', url('manage'));
	}
    public function edit(){
        try {
            // 获取传入ID
            $id = Request::instance()->param('id/d');

            // 判断是否成功接收
            if (is_null($id) || 0 === $id) {
                throw new \Exception('未获取到ID信息', 1);
            }

            // 在Xinwen表模型中获取当前记录
            if (null === $VideoTeaching = VideoTeaching::get($id))
            {
                // 由于在$this->error抛出了异常，所以也可以省略return(不推荐)
                $this->error('系统未找到ID为' . $id . '的记录');
            } 

            // 将数据传给V层
            $this->assign('VideoTeaching', $VideoTeaching);

            // 获取封装好的V层内容
            $htmls = $this->fetch();

            // 将封装好的V层内容返回给用户
            return $htmls;

        // 获取到ThinkPHP的内置异常时，直接向上抛出，交给ThinkPHP处理
        } catch (\think\Exception\HttpResponseException $e) {
            throw $e;

        // 获取到正常的异常时，输出异常
        } catch (\Exception $e) {
            return $e->getMessage();
        } 
    }
    public function update() //接收数据
    {
        // 接收数据，取要更新的关键字信息
        $id = Request::instance()->post('id/d');

        // 获取当前对象
        $VideoTeaching = VideoTeaching::get($id);

        if (!is_null($VideoTeaching)) {
            if (!$this->saveVideoTeaching($VideoTeaching, true)) {
                return $this->error('操作失败' . $Xinwen->getError());
            }
        } else {
            return $this->error('当前操作的记录不存在');
        }

        // 成功跳转至index触发器
        return $this->success('操作成功', url('index'));
    }
    private function saveVideoTeaching(VideoTeaching &$VideoTeaching) 
    {
        // 写入要更新的数据
        $VideoTeaching->name = Request::instance()->post('name');
        $VideoTeaching->path = Request::instance()->post('path');

        // 更新或保存
        return $VideoTeaching->validate(true)->save();
    }
    public function delete()
    {
        try {
            // 实例化请求类
            $Request = Request::instance();

            // 获取get数据
            $id = Request::instance()->param('id/d');

            // 判断是否成功接收
            if (0 === $id) {
                throw new \Exception('未获取到ID信息', 1);
            }

            // 获取要删除的对象
            $VideoTeaching = VideoTeaching::get($id);

            // 要删除的对象存在
            if (is_null($VideoTeaching)) {
                throw new \Exception('不存在id为' . $id . '的新闻，删除失败', 1);
            }

            // 删除对象
            if (!$VideoTeaching->delete()) {
                return $this->error('删除失败:' . $VideoTeaching->getError());
            }

        // 获取到ThinkPHP的内置异常时，直接向上抛出，交给ThinkPHP处理
        } catch (\think\Exception\HttpResponseException $e) {
            throw $e;

        // 获取到正常的异常时，输出异常
        } catch (\Exception $e) {
            return $e->getMessage();
        } 

        // 进行跳转 
        return $this->success('删除成功', $Request->header('referer')); 
    }
}