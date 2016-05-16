<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>后盾微博-注册</title>
	<link rel="stylesheet" href="/Public/Css/regis.css" />
	<!-- <script type="text/javascript" src="/Public/Js/jquery-validate.js"></script> -->
	<script type='text/javascript'>
		var checkAccount = "<?php echo U('checkAccount');?>";
		var checkUname = "<?php echo U('checkUname');?>";
		var checkVerify = "<?php echo U('checkVerify');?>";
	</script>
	<style type="text/css">
		.cur{ border:solid 1px green; }
		.error{ border:solid 1px red; }
	</style>
</head>
<body>
	<div id='logo'></div>
	<div id='reg-wrap'>
		<form action="<?php echo U('Home/Login/runRegis');?>" method='post' name='register'>
			<fieldset>
				<legend>用户注册</legend>
				<p>
					<label for="account">注册邮箱：</label>
					<input type="text" name='account' id='account' class='input' readmin=" *请输入合法的邮箱作为用户名"/><span></span>
				</p>
				<p>
					<label for="pwd">注册密码：</label>
					<input type="password" name='password' id='pwd' class='input' readmin=" *请输入6-18位密码"/><span></span>
				</p>
				<p>
					<label for="pwded">确认密码：</label>
					<input type="password" name='pwded' class='input' readmin=" *请确认密码"/><span></span><span></span>
				</p>
				<p>
					<label for="verify">验证码：</label>
					<input type="text" name='verify' class='input' id='verify'/>
					<img src="<?php echo U('Home/Login/CreateVcode');?>" onclick="this.src=this.src+'?a'"  width='120' height='35' title="点击切换" style="display:block;float:right;margin-right:300px;margin-top:3px;cursor:pointer" />
				</p>
				<p class='run'>
					<input type="submit" value='马上注册' id='regis'/>
				</p>
			</fieldset>
		</form>
		<script type="text/javascript" src="/Public/Js/jquery-1.8.3.min.js"></script>
		<script type="text/javascript">
			//声明全局变量
			var CUSER = true;
				//绑定表单事件
				$('form').submit(function(){
				CUSER   = true;
				//丧失焦点事件
				$('input').trigger('blur');
				//检测是否正确
				if (!CUSER){
					return false;
				}
				//阻止默认行为
					return true;
				})

				//绑定获取焦点事件,显示提示信息
				$('input').focus(function(){
					// alert('2');
					//获取属性
					var str  = $(this).attr('readmin');
					//设置文本
					$(this).next().html(str).css({color:'#aaa',fontSize:'17px'});
					//设置样式
					$(this).attr('class','input');
				})

				//注册邮箱丧失焦点事件
				$('input[name=account]').blur(function(){
					//检测用户名是否正确
					var reg = /^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
					//获取用户名邮箱
					var account = $(this).val();
					//检测 
					var res = reg.test(account);
					if (!res){
						$(this).next().html('邮箱格式不合法').css('color','red');
						//设置样式
						$(this).addClass('error');;
						CUSER = false;
						return false;
					};	
					var inp = $(this);
					//发送ajax确认用户名是否可用
					$.ajax({
						url:"<?php echo U('Home/Login/checkAccount');?>",
						data:{account:account},
						type:'post',
						async:false,
						success:function(data){
							if (data == 0){
								inp.next().html('√').css('color','green');
								inp.attr('class','input');
							}else{
								inp.next().html('注册邮箱已经存在').css('color','red');
								inp.addClass('error');
								CUSER = false;
							}
						}

					})

				})

				//密码格式丧失焦点事件
				$('input[name=password]').blur(function(){
					// alert('2');
					var pass = $(this).val();
					var reg = /^\w{6,18}$/;
					if (!reg.test(pass)) {
						$(this).next().html('密码格式不正确').css('color','red');
						//设置样式
						$(this).addClass('error');
						CUSER = false;
						return false;
					}else{
						$(this).next().html('√').css('color','green');
						//设置样式
						$(this).attr('class','input');
					}
				})

				//确认密码丧失焦点事件
				$('input[name=pwded]').blur(function(){
					var pass = $(this).val();
					var password = $('input[name=password]').val();

					if(pass == password){
						$(this).next().html('√').css('color','green');
						//设置样式
						$(this).attr('class','input');
					}else{
						$(this).next().html('两次密码不一致').css('color','red');
						//设置样式
						$(this).addClass('error');
						CUSER = false;
					}
				})

		</script>
	</div>
</body>
</html>