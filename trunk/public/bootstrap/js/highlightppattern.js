// highlighting the matched code pattern
// Original JavaScript code by Chirp Internet: www.chirp.com.au
// Please acknowledge use of this code by including this header.
// porting the highlight library into angular directive
kidsitApplication.directive('highlightChars',['$timeout',function(timer){
  var linker = function(scope, element, attrs){
      function Hilitor(id, tag){
        var targetNode = document.getElementById(id);
        var hiliteTag = tag || "EM";
        var skipTags = new RegExp("^(?:" + hiliteTag + "|EM|SCRIPT|FORM)$");
        var colors = ["#EF0606"];
        var wordColor = [];
        var colorIdx = 0;
        var matchRegex = "";
        var openLeft = false;
        var openRight = false;
        // console.log('targetNode:',targetNode);
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
            for(var i=0; i < node.childNodes.length; i++){
              this.hiliteWords(node.childNodes[i]);}
          }
          if(node.nodeType == 3) { // NODE_TEXT
            
            if((nv = node.nodeValue) && (regs = matchRegex.exec(nv))) {
              if(!wordColor[regs[0].toLowerCase()]) {
                wordColor[regs[0].toLowerCase()] = colors[colorIdx % colors.length];
              }

              var match = document.createElement(hiliteTag);
              match.appendChild(document.createTextNode(regs[0]));
              match.style.color = wordColor[regs[0].toLowerCase()];
              match.style.fontStyle = "inherit";
              match.style.fontWeight = "bolder";
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
          this.setRegex(input);
          this.hiliteWords(targetNode);
        };
      }; //Hilitor
      // console.log("highlighting directive linker...");
      timer(function() { //shedule the linker after DOM rendering finished!!
        // console.log("highlighting triggered after dom rendered");
        (new Hilitor(scope.domId)).apply((scope.pt));
      },0);
  }; //linker
  return {
    restrict: 'AE',
    scope: {domId: "@",pt: "@"},
    link: linker,
    transclude:true,
    template: '<div><div ng-transclude></div></div>',
    replace: true
  };
}]);
