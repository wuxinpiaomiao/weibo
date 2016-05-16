<?php 
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller{
	//功能类似构造方法,率先执行的方法
	public function _initialize(){
		//用户的登录检测
		$id = session('uid');
		//检测
		if (empty($id)) {
			//没有登录
			$this->error('你还没有登录',U('Home/Login/index'),3)
		}
	}
}

 ?>