kidsitApplication.directive('mp3Player',function(){
  var linker = function(scope, element, attrs){
  }; //linker
  return {
    restrict: 'AE',
    link: linker,
    controller: 'mp3PlayerCtrl',
    transclude: true,
    template: '<div><audio id="yinbiaoplayer"></audio><div ng-transclude></div></div>'
  };
});
kidsitApplication.controller('mp3PlayerCtrl', function($scope) {
  this.mp3Play = function(mp3File) {
    $('#yinbiaoplayer').attr("src" ,"http://kidsit.cn/getmp3/"+mp3File);
    $("#yinbiaoplayer").trigger('play');
  };
  this.mp3Pause = function() {

  };
});
kidsitApplication.directive('singleWord',function() {
  return {
    restrict: 'A',
    require: '^mp3Player',
    replace: true,
    templateUrl: "singleword.html",
    scope: { mp3File:'@',wordText:'@',wordYinjieshu:'@',wordFollowUrl:'@',wordYinbiao:'@',wordDom:'@'},
    link: function(scope, element, attrs, mp3PlayerCtrl) {
      scope.mp3Play = function(mp3Url) {
        mp3PlayerCtrl.mp3Play(mp3Url);
      };
    }
  };});