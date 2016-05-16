<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$weibo = M('weibo');
    	$res = $weibo->select();
    	// var_dump($res);
    	$this->assign('weibo',$res);
    	// die;
    	$this->display();
    }

}
?>