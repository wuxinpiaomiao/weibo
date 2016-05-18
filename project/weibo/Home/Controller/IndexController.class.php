<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
        $uid = $_SESSION['uid'];
    	$wb = M('weibo');
    	$res = $wb->select();
    	// var_dump($res);
        $userinfo = M('userinfo');
        $info = $userinfo->where('uid="'.$uid.'"')->select();
        $info = $info[0];
        $this->assign('face',$info['face80']);
        $this->assign('username',$info['username']);
        $this->assign('follow',$info['follow']);
        $this->assign('fans',$info['fans']);
        $this->assign('weibo',$info['weibo']);
    	$this->assign('wb',$res);
    	// die;
    	$this->display();
    }
    public function loginOut(){
    	session(null);
    	if(empty($_SESSION)){
	    	$this->success("退出成功",U('Home/Login/index'),3);
    	}
    }
}
?>