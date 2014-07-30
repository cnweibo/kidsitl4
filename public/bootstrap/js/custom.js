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
$('#bishunsearchform #inputBishunsearch').bind('keyup',function(e){
	var formdata = $('#bishunsearchform').serialize();
	var bishunsearchdata = $('#bishunsearchform #inputBishunsearch').val();
	console.log(e.keyCode);
	console.log(bishunsearchdata);
	if ((e.keyCode == 17) || (e.keyCode == 16))
	{ //如果是CTRL,SPACE,SHIFT则返回
		return ;
	}
	if ((e.keyCode == 32) ||(e.keyCode == 8))
	{
	 //如果是Backspace,space或者delete键，则判断是否当前输入框已为空，
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
	{
		//default action:when user key pressed, check input content, if chinese 
		//detected, ajax sent out, else return
	    if(bishunsearchdata.trim())
	    {	
			if ((bishunsearchdata.trim())&&(regexpress.test(bishunsearchdata.trim()))){
				console.log('default no chinese action');
			}else{
				console.log('default chinese action');
			$.ajax({
				url: 'bishun',
				type: 'POST',
				data: formdata,
				success: function(results){
					$("#bishuncontainer").html(results);}
					});
				}
		}
		return;	
	}
});
// angular js guest add word controller
function guestaddwordController($scope,$log,$http){
	$scope.wordsadded = [
		{wordtext: 'hello',createdby: 'zhangsan'},
		{wordtext: 'go',createdby: 'lisi'},
	];
	// $http.get('/guestaddedword').success(function(guestaddedwords))
	// {
	// 	$scope.wordsadded = guestaddedwords;
	// };
	$scope.addword = function(){
		$scope.wordsadded.push({
			wordtext: $scope.newwordadded,
			createdby:'wangwu'
		});
		$log.info($scope.wordsadded);
		$scope.newwordadded = '';
	};

}