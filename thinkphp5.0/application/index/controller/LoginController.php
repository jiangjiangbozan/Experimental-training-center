<?php
namespace app\index\controller;
use think\Controller;
use think\Request; // 请求
use app\common\model\User;
use think\Session;


class LoginController extends Controller
{
  // 用户登录表单
  public function index()
  {
    // 显示登录表单
    return $this->fetch();
  }

  // 处理用户提交数据
  public function login()
  {
    // 接收post信息
    $postData = Request::instance()->post();

    // 验证用户名是否存在
    $map = array('name' => $postData['name']); 
    $User = User::get($map);

    // $User要么是一个对象，要么是null。
    if (!is_null($User) && $User->getData('passwords') === $postData['passwords']) {
      // 用户名密码正确，将UserId存session，并跳转至教师管理界面
      session('userId', $User->getData('id'));
      session('power', $User->getData('power'));
      return $this->success('login success', url('Index/index'));
    } else {
      // 用户名不存在，跳转到登录界面。
      return $this->error('name or passwords incorrect', url('index'));
    }
  }
}
