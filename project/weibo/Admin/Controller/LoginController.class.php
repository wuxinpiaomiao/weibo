<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {

	public function index(){

		//解析模板
		$this->display();
	}

	public function login(){
		// var_dump($_POST);

		$user = M('adminuser');

		//接受数据
		$username = I('post.username');
		$password = I('post.password');

		//查询
		$info = $user->where('username = "'.$username.'" and password = "'.$password.'"')->find();
		// echo $user->_sql();
		// var_dump($info);
		//检测用户是否存在
		if(!empty($info)){
			session_start();
			$_SESSION['uid'] = $info['id'];
			session('username',$info['username']);
			$this->success('登录成功',U('Admin/Index/index'),3);
		}else{
			$this->error('登录失败','',3);
		}
	}

}