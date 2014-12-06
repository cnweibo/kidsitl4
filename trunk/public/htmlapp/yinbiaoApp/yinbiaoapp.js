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
  };
});
kidsitApplication.directive('mp3Player',function($rootScope){
  var linker = function(scope, element, attrs){
    $rootScope.isLoading = false;
    $("#yinbiaoplayer").on( "ended", function() {
      $rootScope.$broadcast('wordPlayFinished');
    });
    $("#yinbiaoplayer").on( "loadstart", function() {
      $rootScope.isLoading = true;
    });
    $("#yinbiaoplayer").on( "loadedmetadata", function() {
      $rootScope.isLoading = false;
    });
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
  var thisctrl = this;
  $scope.mp3PlayList = [];
  var currentWordIndex = 0;
  this.wordsPlay = function(){
    // start the playlist playing 
    mp3PlayerService.wordPlay($scope.mp3PlayList[currentWordIndex]);
  };
  this.mp3Add = function(wordinfo) {
    $scope.mp3PlayList.push(wordinfo);
  };

});
kidsitApplication.directive('wordsPlayList',function(mp3PlayerService,$rootScope) {
  return {
    restrict: 'A',
    scope: {id:'='},
    link: function(scope,element,attrs){
      scope.$on('startToPlayList',function(e,listID){
        // only triggered for the specified list
        if (listID == scope.id){
          currentWordIndex = 0;
          // firstly reset the border color to white
          for (var i = scope.mp3PlayList.length - 1; i >= 0; i--) {
            angular.element("#"+scope.mp3PlayList[i].wordDom).css("border-color","#FFF");
          }
          mp3PlayerService.wordPlay(scope.mp3PlayList[currentWordIndex]);
      }
      });
      scope.$on('wordPlayFinished',function(){
        if ($rootScope.currentListID == scope.id){
        if (currentWordIndex == scope.mp3PlayList.length-1){
          currentWordIndex = 0;
          // change the words list word boarder to white indicating finished
          for (var i = scope.mp3PlayList.length - 1; i >= 0; i--) {
            angular.element("#"+scope.mp3PlayList[i].wordDom).css("border-color","#FFF");
          }
      }else{
        currentWordIndex++;
        mp3PlayerService.wordPlay(scope.mp3PlayList[currentWordIndex]);
      }
    }
      });
    },
    controller: 'WordsPlayListCtrl'
  };});
kidsitApplication.directive('singleWord',['$timeout','$rootScope',function(timer,$rootScope) {
  return {
    restrict: 'A',
    require: ['^mp3Player','^wordsPlayList'],
    replace: true,
    templateUrl: "singleword.html",
    scope: { mp3File:'@',wordText:'@',wordYinjieshu:'@',wordFollowUrl:'@',wordYinbiao:'@',wordDom:'@'},
    link: function(scope, element, attrs, ctrls) {
      scope.mp3Play = function(mp3Url) {
        $rootScope.currentListID = 0xffff;
        ctrls[0].mp3Play(mp3Url);
      };
      timer(function() { //shedule the linker after DOM rendering finished!!
        ctrls[1].mp3Add({'mp3File': scope.mp3File,'wordDom':scope.wordDom});
      },0);
    }
  };}]);
kidsitApplication.controller('playListsCtrl',function($rootScope){
  this.wordsPlay = function(listID){
    // start the playlist playing 
    $rootScope.currentListID = listID;
    $rootScope.$broadcast('startToPlayList',listID);
  };
});