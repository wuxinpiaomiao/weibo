<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends CommonController {
    public function index(){
    	$this->display();
    }
    public function letter(){
    	$letter = M('letter');
    	//userinfo和Letter表联查
    	$letterinfo = $letter->join('wb_userinfo on wb_letter.from=wb_userinfo.uid')->where(array('wb_letter.uid='.session("uid")))->select();
        // echo $letter->_sql();
        // var_dump($letterinfo);
    	$num = $letter->where('uid='.session('uid'))->count();
    	$this->assign('count',$num);
    	$this->assign('letter',$letterinfo);
    	$this->display();
    }
    public function addletter(){
        $time = time();
        $uid = session('uid');
        $_POST['time'] = $time;
        $_POST['from'] = $uid;
        $letter = M('letter');
        $le = $letter->create();
        $le = $letter->add();
        if($le>0){
            echo 1;
        }else{
            echo 0;
        }
    }
}

?>