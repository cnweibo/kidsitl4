$(function(){
	$("li").has(".dropdown-menu").hover(
		function() {
			$(this).find(".dropdown-menu").slideDown();
		},
		function() {
			$(this).find(".dropdown-menu").slideUp();
		}
	);
});
var previousBSKey = 0xff;
var currentBSKey = 0xff;
var regexpress = /[^\u4e00-\u9fa5]/;
String.prototype.trim =function()
{
	return this.replace(/(^\s*)|(\s*$)/g, "");
}
console.log(regexpress);
$('#bishunsearchform #inputBishunsearch').bind('keyup',function(e){
	var formdata = $('#bishunsearchform').serialize();
	var bishunsearchdata = $('#bishunsearchform #inputBishunsearch').val();
	console.log(e.keyCode);
	console.log(bishunsearchdata.trim());
	if ((e.keyCode == 17) || (e.keyCode == 16))
	{ //如果是CTRL,SPACE,SHIFT则返回
		return ;
	}
	if ((e.keyCode == 32) ||(e.keyCode == 8))
	{//如果是Backspace,space或者delete键，则判断是否当前输入框已为空，
	 //如空则ajax请求数据
	 	if ((bishunsearchdata)&&(regexpress.test(bishunsearchdata.trim()))){
			console.log('no chinese input');
			return;
		}
		else{
			console.log('backspace and space chinese action');
		$.ajax({
			url: 'bishun',
			type: 'POST',
			data: formdata,
			success: function(results){
				$("#bishuncontainer").html(results
					);
			}
		});
			return;
		}
	}
	{//default action:when user key pressed, ajax sent out
		if ((bishunsearchdata.trim())&&(regexpress.test(bishunsearchdata.trim()))){
			console.log('default no chinese action');
		}else{
			console.log('default chinese action');
		$.ajax({
			url: 'bishun',
			type: 'POST',
			data: formdata,
			success: function(results){
				$("#bishuncontainer").html(results
					);
			}
		});
	}
		return;	
	}
});
