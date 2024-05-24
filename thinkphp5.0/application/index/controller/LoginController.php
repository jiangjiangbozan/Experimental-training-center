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
    $name = session('name');
    $passwords = session('passwords');
    $this->assign('name',$name);
    $this->assign('passwords',$passwords);
    // 显示登录表单
    return $this->fetch();
  }

  // 处理用户提交数据
  public function login()
  {
      // 接收post信息
      $postData = Request::instance()->post();
      if (isset($postData['remember_me'])) {
        $remember_me = input($postData['remember_me'], 1);
      // 验证用户登录信息
        if ($remember_me) {
          session('name', $postData['name']);
          session('passwords', $postData['passwords']);
            // 使用cookie记住密码，这里的30天代表cookie保留的时间
            // cookie('name', input($postData['name']), 30 * 86400);
            // cookie('passwords', input($postData['passwords']), 30 * 86400);
        } 
      }else {
        // 清除cookie
        session('name', null);
        session('passwords', null);
      }
    // 验证用户名是否存在
    $map = array('name' => $postData['name']); 
    $User = User::get($map);
    // $User要么是一个对象，要么是null。
    if (!is_null($User) && $User->getData('passwords') === $postData['passwords']) {
      // 用户名密码正确，将UserId存session，并跳转至教师管理界面
      session('power', $User->getData('power'));
      return $this->success('登陆成功', url('Index/index'));
    } else {
      // 用户名不存在，跳转到登录界面。
      return $this->error('用户名或密码不正确', url('index'));
    }
  }
  public function loginout(){
    session('power', null);
    session('name', null);
    session('passwords', null);
    return $this->success('注销成功', url('Index/index'));
  }
}
