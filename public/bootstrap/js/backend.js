$(function(){
	$("li").has(".dropdown-menu").hover(
		function() {
			$(this).find(".dropdown-menu").slideDown();
		},
		function() {
			$(this).find(".dropdown-menu").slideUp();
		}
	);
	// yinbiao player trigger event:click of the volumn icon
	$("#yinbiao_1").click(function(){
		$("#yinbiaoplayer").attr("src" ,"http://kidsit.cn/getmp3/"+mp3);
		$("#yinbiaoplayer").trigger('play');
	});
});
var previousBSKey = 0xff;
var currentBSKey = 0xff;
var regexpress = /[^\u4e00-\u9fa5]/;
String.prototype.trim =function()
{
	return this.replace(/(^\s*)|(\s*$)/g, "");
};
console.log(regexpress);
$('#guizesearch').bind('keyup',function(e){
	var formdata = $('#guizesearch').serialize();
	var bishunsearchdata = $('#guizesearch').val();
		$.ajax({
			url: 'http://kidsit.cn/admin/yinbiaorelatedwords/guizesearch',
			type: 'GET',
			data: formdata,
			success: function(results){
				$("#fayinguize_id").empty();
				for (var i = 0; i < results.length; i++) {
					var html = "<option value="+results[i].id+">"+results[i].title+"</option>";
					$("#fayinguize_id").append(html);
				}
			}
		});
		
	});
