<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>找回密码页</title>
	<link rel="stylesheet" href="/Public/Home/Css/login.css" />
</head>
<body>
	<div id='top-bg'></div>
	<div id='login-form'>
		<div id='login-wrap'>
			<p>想到密码啦？<a href="<?php echo U('Home/Login/index');?>">立即前去登录</a></p>
			<form action="<?php echo U('Home/Login/findPwd');?>" method='post' name='login'>
				<fieldset>
					<legend>用户找回密码!!!</legend>
					<p>
						<label for="account">注册的邮箱：</label>
						<input type="text" name='account' class='input' placeholder="请输入您注册的邮箱" /><span></span>
					</p>
					<p>
					<label for="verify">验证码：</label>
					<input type="text" name='verify' class='input' id='verify' placeholder="请输入下方的验证码"/>
					<img src="<?php echo U('Home/Login/CreateVcode');?>" onclick="this.src=this.src+'?a'"  width='120' height='35' title="点击切换" style="display:block;float:right;margin-right:100px;margin-top:3px;cursor:pointer" />
				</p>
					<p>
						<input type="submit" value='邮箱验证' id='login'/>
					</p>
				</fieldset>
			</form>
		</div>
	</div>

</body>
</html>