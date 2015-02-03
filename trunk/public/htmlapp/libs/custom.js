var simpleFormDataValidate = function (rules,data) {
	if (rules){
        if (rules.minlength){
            if (data.length<rules.minlength){
                return "长度不符合要求，必需大于"+rules.minlength+"个字符！";
            }
        }
        if (rules.maxlength){
            if (data.length>rules.maxlength){
                return "长度不符合要求，必需小于"+rules.maxlength+"个字符！";
            }
        }
        if (rules.isEmail){
            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/ ;
            if(!data.match(mailformat)){
                return "不符合mail格式要求！";
            }
        }
        if (rules.isallnumeric){
            var numbersformat = /^[0-9]+$/;
            if(!data.match(numbersformat)){
                return "要求全部为数字";
            }
        }
        if (rules.isallletter){
			var lettersformat = /^[0-9a-zA-Z]+$/;
			if (!data.match(lettersformat)){
				return "要求全部为字母或数字";
			}
        }
        if (rules.isurl){
			var urlformat = /^(?:http(?:s)?:\/\/)?(?:www\.)?(?:[\w-]*)\.\w{2,}$/;
			if (!data.match(urlformat)){
				return "不符合网址URL的合法格式！请使用http://xx.yy.zz或者https://xx.yy.zz";
			}
        }
        if (rules.canuse){

        }
        return 0;
    }
    return 0;
};
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
