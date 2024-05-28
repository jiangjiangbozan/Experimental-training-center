<?php
namespace app\index\controller;
use think\Controller;
use app\common\model\Show;
use think\Request; 
use think\Db;
use think\Session; 
class ShowController extends Controller{

	public function index()
    {
        $Show = new Show; 
        $shows = Show::paginate(5);
    	$power = Session::get('power');
    	$this->assign('power',$power);
        $this->assign('shows', $shows);
        $htmls = $this->fetch(); // 取回打包后的数据

        return $htmls; // 将数据返回给用户
        
    }
     public function manage()
    {

        try {
            $name = Request::instance()->get('name');
            $pagesize = 5;
           $Show = new Show; 

            if (!empty($name)) {
                $Show->where('name', 'like', '%' . $name . '%');
            }
            // $Show->where('is', 'like', '%' . $is . '%');
            $shows = $Show->paginate($pagesize, false, [
                'query'=>[
                    'name' => $name,
                    ],
                ]);
            // 向V层传数据
            $this->assign('shows', $shows);

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
    public function add()
    {
        
        $Show = new Show;
        $Show->id = 0;
        $Show->name = '';
        $Show->create_time = '';

        $this->assign('Show', $Show);
        
    	$htmls = $this->fetch(); // 取回打包后的数据

        return $htmls;

    }
    public function save()
    {
          // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('show');
        
        // 移动到框架应用根目录/public/uploads/ 目录下
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
                $base =  $info->getSaveName();
                $this->assign('base', $base); 
                $Shows = new Show();
                // 实例化班级并赋值
                $Shows->path = $info->getSaveName();
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
        $Shows->name = Request::instance()->post('name');
        $Shows->create_time = Request::instance()->post('create_time');
        $Shows->save();
        return $this->success('操作成功', url('manage'));
	}
    public function edit()
    {
        try {
            // 获取传入ID
            $id = Request::instance()->param('id/d');

            // 判断是否成功接收
            if (is_null($id) || 0 === $id) {
                throw new \Exception('未获取到ID信息', 1);
            }

            // 在Show表模型中获取当前记录
            if (null === $Show = Show::get($id))
            {
                // 由于在$this->error抛出了异常，所以也可以省略return(不推荐)
                $this->error('系统未找到ID为' . $id . '的记录');
            } 

            // 将数据传给V层
            $this->assign('Show', $Show);

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
        $Show = Show::get($id);

        if (!is_null($Show)) {
            if (!$this->saveShow($Show, true)) {
                return $this->error('操作失败' . $Xinwen->getError());
            }
        } else {
            return $this->error('当前操作的记录不存在');
        }

        // 成功跳转至index触发器
        return $this->success('操作成功', url('index'));
    }
    private function saveShow(Show &$Show) 
    {
        // 写入要更新的数据
        $Show->name = Request::instance()->post('name');
        $Show->path = Request::instance()->post('path');

        // 更新或保存
        return $Show->validate(true)->save();
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
            $Show = Show::get($id);

            // 要删除的对象存在
            if (is_null($Show)) {
                throw new \Exception('不存在id为' . $id . '的新闻，删除失败', 1);
            }

            // 删除对象
            if (!$Show->delete()) {
                return $this->error('删除失败:' . $Show->getError());
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