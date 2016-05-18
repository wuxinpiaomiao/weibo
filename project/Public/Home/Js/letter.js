$(function () {
   //发送私信框
   $('.l-reply,.send').click(function () {
      //弹出私信框
      var left = ($(window).width()-400)/2+'px';
      var top = ($(window).height()-300)/2+'px';
      var obj = $('#letter').show().css({
         'left' : left,
         'top' : top
      });
      var btn = $(this);
      //回复那个人的昵称
      var username = btn.parents('dd').prev().find('a').html();
      //那个人的id
      var form = btn.attr('form');
      $('input[name=name]').val(username);
      //发送
      $('.send-lt-sub').click(function(){
         var content = $('#letter').find('textarea').val();
         $.post('addletter',{uid:form,content:content},function(data){
            if(data == 1){
               alert('发送成功');
            }else{
               alert('发送失败');
            }
         })
      })
   });
   //关闭弹窗
   $('.letter-cencle').click(function(){
      $('#letter').hide();
   })
});






	//发送私信框
//    $('.l-reply,.send').click(function () {
//       var username = '';

//       if ($(this).attr('class') == 'l-reply') {
//          username = $(this).parents('dd').prev().find('a').html();
//       }

//    	var letterLeft = ($(window).width() - $('#letter').width()) / 2;
// 	 	var letterTop = $(document).scrollTop() + ($(window).height() - $('#letter').height()) / 2;
// 		var obj = $('#letter').show().css({
// 	 		'left' : letterLeft,
// 	 		'top' : letterTop
// 	 	});

//       obj.find('input[name=name]').val(username);
//       obj.find('textarea').focus();
// 		createBg('letter-bg');
// 		drag(obj, obj.find('.letter_head'));
//    });
//    //关闭
//    $('.letter-cencle').click(function () {
//    		$('#letter').hide();
//    		$('#letter-bg').remove();
//    });

//    /**
//     * 删除私信
//     */
//    $('.del-letter').click(function () {
//       var isDel = confirm('确定删除该私信？');
//       var lid = $(this).attr('lid');
//       var obj = $(this).parents('dl');

//       if (isDel) {
//          $.post(delLetter, {lid : lid}, function (data) {
//             if (data) {
//                obj.slideUp('slow', function () {
//                   obj.remove();
//                });
//             } else {
//                alert('删除失败重请试...');
//             }
//          }, 'json');
//       }
//    })
// })