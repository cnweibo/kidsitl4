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
console.log(regexpress);
$('#bishunsearchform #inputBishunsearch').bind('keyup',function(e){
	var formdata = $('#bishunsearchform').serialize();
	var bishunsearchdata = $('#bishunsearchform #inputBishunsearch').val();
	if (regexpress.test(bishunsearchdata.trim())){
		console.log('no chinese input');
	}
	else{
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
});
