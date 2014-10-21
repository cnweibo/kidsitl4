kidsitApplication.directive('mp3Player',function(){
  var linker = function(scope, element, attrs){
    // console.log("linker for mp3Player...");
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
kidsitApplication.directive('wordsPlayList',function() {

  return {
    restrict: 'A',
    scope: true,
    controller: function($scope) {
      $scope.mp3PlayList = [];
      this.mp3Add = function(wordinfo) {
        $scope.mp3PlayList.push(wordinfo);
      };
    }
  };});
kidsitApplication.directive('singleWord',['$timeout',function(timer) {
  return {
    restrict: 'A',
    require: ['^mp3Player','^wordsPlayList'],
    replace: true,
    templateUrl: "singleword.html",
    scope: { mp3File:'@',wordText:'@',wordYinjieshu:'@',wordFollowUrl:'@',wordYinbiao:'@',wordDom:'@'},
    link: function(scope, element, attrs, ctrls) {
      // console.log("linker for "+scope.wordText);
      scope.mp3Play = function(mp3Url) {
        ctrls[0].mp3Play(mp3Url);
      };
      // console.log("populating the single word data into playerlist...");
      timer(function() { //shedule the linker after DOM rendering finished!!
        console.log("mp3Add for playlist word"+scope.wordText+" Dom:"+ scope.wordDom);
        ctrls[1].mp3Add({'mp3File': scope.mp3File,'wordDom':scope.wordDom});
      },0);
    }
  };}]);