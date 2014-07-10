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
// highlighting the matched code pattern
// Original JavaScript code by Chirp Internet: www.chirp.com.au
// Please acknowledge use of this code by including this header.

function Hilitor(id, tag)
{

  var targetNode = document.getElementById(id) || document.body;
  var hiliteTag = tag || "EM";
  var skipTags = new RegExp("^(?:" + hiliteTag + "|SCRIPT|FORM|SPAN)$");
  var colors = ["#EF0606"];
  var wordColor = [];
  var colorIdx = 0;
  var matchRegex = "";
  var openLeft = false;
  var openRight = false;
  console.log('targetNode:',targetNode);
  this.setMatchType = function(type)
  {
    switch(type)
    {
      case "left":
        this.openLeft = false;
        this.openRight = true;
        break;
      case "right":
        this.openLeft = true;
        this.openRight = false;
        break;
      case "open":
        this.openLeft = this.openRight = true;
        break;
      default:
        this.openLeft = this.openRight = false;
    }
  };

  this.setRegex = function(input)
  {
    // input = input.replace(/^[^\w]+|[^\w]+/g, "");//.replace(/[^\w'-]+/g, "|");
    var re = "(" + input + ")";
    // if(!this.openLeft) re = "\\b" + re;
    // if(!this.openRight) re = re + "\\b";
    matchRegex = new RegExp(re, "i");
    console.log('setRegex:matchRex',matchRegex);
  };

  this.getRegex = function()
  {
    var retval = matchRegex.toString();
    retval = retval.replace(/(^\/(\\b)?|\(|\)|(\\b)?\/i$)/g, "");
    retval = retval.replace(/\|/g, " ");
    return retval;
  };

  // recursively apply word highlighting
  this.hiliteWords = function(node)
  {
    if(node == undefined || !node) return;
    if(!matchRegex) return;
    if(skipTags.test(node.nodeName)) return;

    if(node.hasChildNodes()) {
      for(var i=0; i < node.childNodes.length; i++)
        this.hiliteWords(node.childNodes[i]);
    }
    if(node.nodeType == 3) { // NODE_TEXT
      console.log('node:',node);
      if((nv = node.nodeValue) && (regs = matchRegex.exec(nv))) {
        console.log('regs:',regs);
        if(!wordColor[regs[0].toLowerCase()]) {
          wordColor[regs[0].toLowerCase()] = colors[colorIdx % colors.length];
        }

        var match = document.createElement(hiliteTag);
        match.appendChild(document.createTextNode(regs[0]));
        match.style.color = wordColor[regs[0].toLowerCase()];
        match.style.fontStyle = "inherit";
        // match.style.color = "#000";

        var after = node.splitText(regs.index);
        after.nodeValue = after.nodeValue.substring(regs[0].length);
        node.parentNode.insertBefore(match, after);
      }
    };
  };

  // remove highlighting
  this.remove = function()
  {
    var arr = document.getElementsByTagName(hiliteTag);
    while(arr.length && (el = arr[0])) {
      var parent = el.parentNode;
      parent.replaceChild(el.firstChild, el);
      parent.normalize();
    }
  };

  // start highlighting at target node
  this.apply = function(input)
  {
    if(input == undefined || !input) return;
    this.remove();
    this.setRegex(input);
    this.hiliteWords(targetNode);
  };
}
// main entry fo the matched pronounce pattern letters highlighting
var myhigh = new Hilitor("relatedwordid_x");
	$(function(){
		myHilitor = new Hilitor("relatedwordid_x");
		myHilitor.apply("[^\\saeiouAEIOU]+e(?:\\b)");
});