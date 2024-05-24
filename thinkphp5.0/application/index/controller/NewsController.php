<?php
namespace app\index\controller;
use think\Controller;   // 用于与V层进行数据传递
use app\common\model\News; 
use think\Session;       
use think\Request; 
use think\Db;
class NewsController extends Controller
{
    public function index()
    {
        $News = new News; 
        $new = News::paginate(10);
    	$power = Session::get('power');
    	$this->assign('power',$power);
        $this->assign('new', $new);
        $htmls = $this->fetch(); // 取回打包后的数据
        return $htmls; // 将数据返回给用户
        
    }
    public function newsDetail($id)
    {
        // 根据$id查询新闻详情
        $news = Db::name('news')->where('id', $id)->find();
        if (!$news) {
            // 如果找不到新闻，可以抛出404错误或重定向到其他页面
            $this->error('新闻不存在');
        }
        // 将新闻详情分配到视图
        $this->assign('news', $news);
        return $this->fetch();
    }
     public function manage()
    {
        try {
            $title = Request::instance()->get('title');
            $pagesize = 5;
           $News = new News; 

            if (!empty($title)) {
                $News->where('title', 'like', '%' . $title . '%');
            }
            // $News->where('is', 'like', '%' . $is . '%');
            $new = $News->paginate($pagesize, false, [
                'query'=>[
                    'title' => $title,
                    ],
                ]);
            // 向V层传数据
            $this->assign('new', $new);
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
        $News = new News();
        $file = request()->file('image');
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'index' . DS . 'image');
            if($info){
                // 成功上传后 获取上传信息
                // 输出 jpg
                // echo $info->getExtension();
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                // echo $info->getSaveName();
                // 输出 42a79759f284b767dfcb2a0197904287.jpg
                // echo $info->getFilename();
                // 实例化班级并赋值
                $News->path = $info->getSaveName();
                return $this->success('操作成功', url('manage'));
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
        // 实例化班级并赋值
        $News->author = Request::instance()->post('author');
        $News->source = Request::instance()->post('source');
        $News->title = Request::instance()->post('title');
        $News->content = Request::instance()->post('content');
        $News->save();
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
            if (null === $News = News::get($id))
            {
                // 由于在$this->error抛出了异常，所以也可以省略return(不推荐)
                $this->error('系统未找到ID为' . $id . '的记录');
            } 
            // 将数据传给V层
            $this->assign('News', $News);
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
        $News = News::get($id);
        $News->author = Request::instance()->post('author');
        $News->source = Request::instance()->post('source');
        $News->title = Request::instance()->post('title');
        $News->content = Request::instance()->post('content');
        $file = request()->file('image');
        if (!is_null($file)) {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'index' . DS . 'image');
            $News->path = $info->getSaveName();
            } 
        if (!is_null($News)) {
            if (!$News->save()) {
                return $this->error('操作失败' . $News->getError());
            }
        } else {
            return $this->error('当前操作的记录不存在');
        }

        // 成功跳转至index触发器
        return $this->success('操作成功', url('index'));
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
            $News = News::get($id);
            // 要删除的对象存在
            if (is_null($News)) {
                throw new \Exception('不存在id为' . $id . '的新闻，删除失败', 1);
            }
            // 删除对象
            if (!$News->delete()) {
                return $this->error('删除失败:' . $News->getError());
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