<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>微博登陆页</title>
	<link rel="stylesheet" href="/Public/Home/Css/login.css" />
	<style type="text/css">
		.cur{ border:solid 1px green; }
		.error{ border:solid 1px red; }
	</style>
</head>
<body>
	<div id='top-bg'></div>
	<div id='login-form'>
		<div id='login-wrap'>
			<p>还没有微博帐号？<a href="<?php echo U('Home/Login/register');?>">立即注册</a></p>
			<form action="<?php echo U('Home/Login/login');?>" method='post' name='login'>
				<fieldset>
					<legend>用户登录</legend>
					<p>
						<label for="account">登录邮箱：</label>
						<input type="text" name='account' class='input' placeholder="请输入您的邮箱" /><span></span>
					</p>
					<p>
						<label for="pwd">密码：</label> 
						<input type="password" name='password' class='input' placeholder="请输入您的密码"/><span></span>
					</p>
					<p>
						<input type="checkbox" name='auto' checked='1' class='auto' id='auto'/><span></span>
						<label for="auto">下次自动登录</label>
					</p>
					<p>
						<input type="submit" value='马上登录' id='login'/>
					</p>
						<a href="<?php echo U('Home/Login/forgetPwd');?>" style="margin-left:120px;">忘记密码</a>
				</fieldset>
			</form>
		</div>
	</div>

</body>
</html>