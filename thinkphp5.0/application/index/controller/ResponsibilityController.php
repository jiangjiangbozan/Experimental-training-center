<?php
namespace app\index\controller;
use think\Controller;   // 用于与V层进行数据传递
use app\common\model\Responsibility; 
use think\Request;            // 引用Request
use think\Db;
use think\Session; 

class ResponsibilityController extends Controller
{
    public function index() 
    {
        $name = Request::instance()->get('name');
        $Responsibility = new Responsibility; 
        $responsibilitys = Responsibility::paginate(5);
        $power = Session::get('power');
    	$this->assign('power',$power);

        // 向V层传数据
        $this->assign('responsibilitys', $responsibilitys);

        // 取回打包后的数据
        $htmls = $this->fetch();

        // 将数据返回给用户
        return $htmls;

    }
    public function manage()
    {
        $name = Request::instance()->get('name');
            
        $Responsibility = new Responsibility; 

        if (!empty($name)) {
            $Responsibility->where('name', 'like', '%' . $name . '%');
        }
        // $Responsibility->where('is', 'like', '%' . $is . '%');
        $responsibilitys = Responsibility::paginate(5);
        // 向V层传数据
        $this->assign('responsibilitys', $responsibilitys);

        // 将数据返回给用户
        return $this->fetch();
        

    }
    

    public function insert()
    {
        $message = '';  // 提示信息

        try {
            // 接收传入数据
            $postData = Request::instance()->post();    
            $Responsibility = new Responsibility();
            // 为对象赋值
            $Responsibility->name = $postData['name'];
            $Responsibility->content = $postData['content'];
            $Responsibility->tel = $postData['tel'];
            // 新增对象至数据表
            $result = $Responsibility->validate(true)->save();

            // 反馈结果
            if (false === $result)
            {
                session('Responsibility_add_tel', $Responsibility->tel);
                session('Responsibility_add_name', $Responsibility->name);
                session('Responsibility_add_content', $Responsibility->content);
                // 验证未通过，发生错误
                $message = '新增失败:' . $Responsibility->getError();
            } else {
                session('Responsibility_add_tel', null);
                session('Responsibility_add_name', null);
                session('Responsibility_add_content', null);
                // 提示操作成功
                return $this->success('用户' . $Responsibility->name . '新增成功。', url('manage'));
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
            $name = session('Responsibility_add_name');
            $content = session('Responsibility_add_content');
            $tel = session('Responsibility_add_tel');
            $this->assign('name', $name);
            $this->assign('content', $content);
            $this->assign('tel', $tel);
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
            $Responsibility = Responsibility::get($id);

            // 要删除的对象存在
            if (is_null($Responsibility)) {
                throw new \Exception('不存在id为' . $id . '的信息，删除失败', 1);
            }

            // 删除对象
            if (!$Responsibility->delete()) {
                return $this->error('删除失败:' . $Responsibility->getError());
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

            // 在Responsibility表模型中获取当前记录
            if (null === $Responsibility = Responsibility::get($id))
            {
                // 由于在$this->error抛出了异常，所以也可以省略return(不推荐)
                $this->error('系统未找到ID为' . $id . '的记录');
            } 

            // 将数据传给V层
            $this->assign('Responsibility', $Responsibility);

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
        try {
            // 接收数据，获取要更新的关键字信息
            $id = Request::instance()->post('id/d');

            // 获取当前对象
            $Responsibility = Responsibility::get($id);

            if (!is_null($Responsibility)) {
                // 写入要更新的数据
                $Responsibility->name = input('post.name');
                $Responsibility->content = input('post.content');
                $Responsibility->tel = input('post.tel');

                // 更新
                if (false === $Responsibility->validate(true)->save()) {
                    return $this->error('更新失败' . $Responsibility->getError());
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