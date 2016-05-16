<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
	//注册登录类

	//登陆页面
    public function index(){
    	$this->display();
    }

    //用户进行登录
    public function login(){
        $user = M('user');
        // var_dump($user);
        //接受数据
        $account = I('post.account');
        $password = I('post.password');

        //查询
        $info = $user->where('account = "'.$account.'" and password = "'.$password.'"')->find();
        // echo $user->_sql();
        // var_dump($info);
        if (!empty($info)) {
            session_start();
            $_SESSION['uid'] = $info['id'];
            session('account',$info['account']);
            $this->success('登录成功',U('Home/Index/index'),3);
        }else{
            $this->error('请输入正确的登录邮箱','',3);
        }
    }

    //注册页面;
    public function register(){

    	$this->display();
    }

    //生成验证码
    public function CreateVcode(){
    	$Verify = new \Think\Verify();
		$Verify->entry();
    }

    //用户进行注册
    public function runRegis(){
        // var_dump($_POST);
        $register = D('user');
        // var_dump($register);
        // $res = $register->create();
        // var_dump($res);die;

        //创建表数据
        $time = time();
        if (!$register->create()) {
            //获取错误
            $info = $register->getError();
            $this->error($info);
        }
        // var_dump($register);die;
        // $register['datetime'] = $time;die;
         //执行添加
        if($register->add()){
              //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
             $this->success('注册成功', U('Home/Login/index'),3);
        }else{
             //错误页面的默认跳转页面是返回前一页，通常不需要设置
             $this->error('注册失败');
        }

    }

    //Ajax验证用户名邮箱是否已经被使用
    public function checkAccount(){
        $user = M('user');
        $account = $_POST['account'];

        $res = $user->where('account = "'.$account.'"')->select();
        if (empty($res)){
            //如果为空,证明可用
            echo 0;
        }else{
            echo 1;
        }
    }
    


}