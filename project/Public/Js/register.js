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
		alert('2');
		//获取属性
		var str  = $(this).attr('readmin');
		//设置文本
		$(this).next().html(str).css('color','green');
		//设置样式
		$(this).sttr('class','cur');
	})