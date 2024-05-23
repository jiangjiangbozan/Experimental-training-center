<?php
namespace app\index\controller;
use think\Controller;   // 用于与V层进行数据传递
use app\common\model\Xinwen;     
use think\Request; 
use think\Db;


class XinwenController extends Controller
{
    public function index()
    {
        $Xinwen = new Xinwen; 
        $xinwens = Xinwen::paginate(5);
        $this->assign('xinwens', $xinwens); // 向V层传数据
        $htmls = $this->fetch(); // 取回打包后的数据
        return $htmls; // 将数据返回给用户
        
    }

    public function manage()
    {

            $name = Request::instance()->get('name');
            
            $Xinwen = new Xinwen; 

            if (!empty($name)) {
                $Xinwen->where('name', 'like', '%' . $name . '%');
            }
            // $Xinwen->where('is', 'like', '%' . $is . '%');
            $xinwens = Xinwen::paginate(5);
            // 向V层传数据
            $this->assign('xinwens', $xinwens);

            // 将数据返回给用户
            return $this->fetch();
        

    }

    public function insert()
    {
        $message = '';  // 提示信息

        try {
            // 接收传入数据
            $postData = Request::instance()->post();    
            $Xinwen = new Xinwen();
            // 为对象赋值
            $Xinwen->name = $postData['name'];
            $Xinwen->content = $postData['content'];
            $Xinwen->create_time = $postData['create_time'];
            // 新增对象至数据表
            $result = $Xinwen->validate(true)->save();

            // 反馈结果
            if (false === $result)
            {
                // 验证未通过，发生错误
                $message = '新增失败:' . $Xinwen->getError();
            } else {
                // 提示操作成功
                return $this->success('用户' . $Xinwen->name . '新增成功。', url('manage'));
            }

        // 获取到ThinkPHP的内置异常时，直接向上抛出，交给ThinkPHP处理
        } catch (\think\Exception\HttpResponseException $e) {
            throw $e;

        // 获取到正常的异常时，输出异常
        } catch (\Exception $e) {
            return $e->getMessage();
        } 

        return $this->error($message);
        
    }

    public function add()
    {
        try {
            $Xinwen = new Xinwen; 
            $Xinwen->id = 0;
            $Xinwen->name = '';
            $Xinwen->content = '';
            $Xinwen->create_time = '';
            $this->assign('Xinwen', $Xinwen);
            $htmls = $this->fetch();
            return $htmls;
        } catch (\Exception $e) {
            return '系统错误' . $e->getMessage();
        }
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
            $Xinwen = Xinwen::get($id);

            // 要删除的对象存在
            if (is_null($Xinwen)) {
                throw new \Exception('不存在id为' . $id . '的教师，删除失败', 1);
            }

            // 删除对象
            if (!$Xinwen->delete()) {
                return $this->error('删除失败:' . $Xinwen->getError());
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

    public function edit()
    {
        try {
            // 获取传入ID
            $id = Request::instance()->param('id/d');

            // 判断是否成功接收
            if (is_null($id) || 0 === $id) {
                throw new \Exception('未获取到ID信息', 1);
            }

            // 在Xinwen表模型中获取当前记录
            if (null === $Xinwen = Xinwen::get($id))
            {
                // 由于在$this->error抛出了异常，所以也可以省略return(不推荐)
                $this->error('系统未找到ID为' . $id . '的记录');
            } 

            // 将数据传给V层
            $this->assign('Xinwen', $Xinwen);

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

    public function update()
    {
        try {
            // 接收数据，获取要更新的关键字信息
            $id = Request::instance()->post('id/d');

            // 获取当前对象
            $Xinwen = Xinwen::get($id);

            if (!is_null($Xinwen)) {
                // 写入要更新的数据
                $Xinwen->name = input('post.name');
                $Xinwen->content = input('post.content');
                $Xinwen->create_time = input('post.create_time');

                // 更新
                if (false === $Xinwen->validate(true)->save()) {
                    return $this->error('更新失败' . $Xinwen->getError());
                }
            } else {
                throw new \Exception("所更新的记录不存在", 1);   // 调用PHP内置类时，需要在前面加上 \ 
            }

        // 获取到ThinkPHP的内置异常时，直接向上抛出，交给ThinkPHP处理
        } catch (\think\Exception\HttpResponseException $e) {
            throw $e;

        // 获取到正常的异常时，输出异常
        } catch (\Exception $e) {
            return $e->getMessage();
        } 

        // 成功跳转至manage触发器
        return $this->success('操作成功', url('manage'));
    
    }
    
}