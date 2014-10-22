kidsitApplication.service('mp3PlayerService',function() {
  return {
    mp3Play: function(mp3File) {
    $('#yinbiaoplayer').attr("src" ,"http://kidsit.cn/getmp3/"+mp3File);
    $("#yinbiaoplayer").trigger('play');
  },
    wordPlay: function(wordtoplay){
      // 1. play the mp3 first
      this.mp3Play(wordtoplay.mp3File);
      // 2. animate the corresponding word block
      var element = angular.element("#"+wordtoplay.wordDom);
      TweenMax.to(element, 0.5, {border: "2px #57AA2C solid",zIndex: "1"});
    }
  }
});
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
kidsitApplication.controller('mp3PlayerCtrl', function($scope,mp3PlayerService) {
  this.mp3Play = mp3PlayerService.mp3Play;
  this.mp3Pause = function() {

  };
}); 

kidsitApplication.controller('WordsPlayListCtrl', function($scope,mp3PlayerService) {
  $scope.mp3PlayList = [];
  this.wordsPlay = function(){
    mp3PlayerService.wordPlay($scope.mp3PlayList[0]);
  }
  this.mp3Add = function(wordinfo) {
    $scope.mp3PlayList.push(wordinfo);
  };
});
kidsitApplication.directive('wordsPlayList',function(mp3PlayerService) {
  return {
    restrict: 'A',
    scope: true,
    controller: 'WordsPlayListCtrl'
  };});
kidsitApplication.directive('singleWord',['$timeout',function(timer) {
  return {
    restrict: 'A',
    require: ['^mp3Player','^wordsPlayList'],
    replace: true,
    templateUrl: "singleword.html",
    scope: { mp3File:'@',wordText:'@',wordYinjieshu:'@',wordFollowUrl:'@',wordYinbiao:'@',wordDom:'@'},
    link: function(scope, element, attrs, ctrls) {
      scope.mp3Play = function(mp3Url) {
        ctrls[0].mp3Play(mp3Url);
      };
      timer(function() { //shedule the linker after DOM rendering finished!!
        ctrls[1].mp3Add({'mp3File': scope.mp3File,'wordDom':scope.wordDom});
      },0);
    }
  };}]);