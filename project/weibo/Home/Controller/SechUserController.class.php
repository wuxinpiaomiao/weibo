<?php
namespace Home\Controller;
use Think\Controller;
class SechUserController extends CommonController {
    //搜索主页
    public function index(){
    	

    	$this->display();
    }
    //搜索用户 听过昵称
    Public function sechuser(){
    	$keyword = $_GET['keyword'];
    	$info = M('userinfo');
    	$follow = M('follow');

    	$where = "wb_userinfo.username like '%".$keyword."%'";
    	$userlist = $info->where($where)->select();

    	//判断与每个搜索用户关系
    	foreach($userlist as $k=>$v){
    		//我关注了她
    		if($follow->where('follow='.$v['uid'].' && fans='.session('uid'))->select()){
    			//她也关注了我
    			if($follow->where('fans='.$v['uid'].' && follow='.session('uid'))->select()){
    				//互相关注 mutual
    				$userlist[$k]['mutual'] = 1;
    			}else{
    				//已关注 followed
    				$userlist[$k]['followed'] = 1;
    			}
    		}
    		//否则互不关注
    			    		
    	}
    
    	$this->assign('result',$userlist);
    	$this->display('index');
    }
    //添加关注
    Public function follow(){
    	//增加wb_follow数据库和wb_group数据库
	    $_POST['fans'] = session('uid');
	    //链接数据库
	    $follow = M('follow');
	    $group = M('group');
	    $info = M('userinfo');


	    //向follow里插入数据
	    $_POST['follow'] = $_POST['uid'];
	    $res = $follow->create();
	    $res = $follow->add();
	    //向userinfo里插入数据
	    //粉丝加1
	    $fansnum = $info->where('uid = '.$_POST['uid'])->select();
	    $fansnum = $fansnum[0]['fans'];
	    $adata['fans'] = $fansnum+1;
	    $infore = $info->where('uid = '.$_POST["uid"])->save($adata);
	    //关注+1
	    $follownum = $info->where('uid = '.session("uid"))->select();
	    $follownum = $follownum[0]['follow'];
	    $fdata['follow'] = $follownum+1;
	    $infores = $info->where('uid = '.session("uid"))->save($fdata);
	    //判断我和关注的关注关系 如果关注的人也关注了我将显示互相关注 如果没有将显示已关注

	    	//如果她关注了我
	    	if($follow->where('fans='.$v['uid'].' && follow='.session('uid'))->select()){
	    		if($infores>0 && $res>0 && $infore>0){
	    			//局部刷新为互相关注
	    			echo 2;
	    		}else{
	    			echo 0;
	    		}
	    	}else{
	    		//局部刷新为已关注
	    		if($infores>0 && $res>0 && $infore>0){
	    			echo 1;
	    		}else{
	    			echo 0;
	    		}
	    	}

    }
    //增加分组
    Public function groupadd(){
        //分组增加uid字段
        $_POST['uid'] = session('uid');
        $group = M('group');
        $gu = $group->create();
        if($group->add()){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function followdel(){
    	//关注的userinfo的uid和我的uid
    	$fol = $_POST['uid'];
    	$fans = session('uid');

    	//删除follow数据库里的记录
    	$follow = M('follow');
    	$info = M('userinfo');
    	$fres = $follow->where('follow='.$fol.' && fans='.$fans)->delete();
    	//更改userinfo里的fans和follow数据
    	$fansnum = $info->where('uid = '.$_POST['uid'])->select();
    	$fansnum = $fansnum[0]['fans'];
    	$adata['fans'] = $fansnum-1;
    	$infore = $info->where('uid = '.$_POST["uid"])->save($adata);
    	//关注-1
    	$follownum = $info->where('uid = '.session("uid"))->select();
    	$follownum = $follownum[0]['follow'];
    	$fdata['follow'] = $follownum-1;
    	$infores = $info->where('uid = '.session("uid"))->save($fdata);
    	if($infores>0 && $fres>0 && $infore>0){
	    	echo 1;
	    }else{
	    	echo 0;
	    }
    }
}