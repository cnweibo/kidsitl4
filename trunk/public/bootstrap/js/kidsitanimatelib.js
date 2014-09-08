angular.module('kidsitAnimate', ["ngAnimate"])
.directive("fadeMe", function($animate) {
    var linker = function(scope, element, attrs) {

        scope.$watch('animateStyle',function(){
            console.log(scope.animateStyle);
            switch (scope.animateStyle)
            {
                case 'fadeMeIn':
                    $animate.addClass(element, "fadeMe");
                    break;
                case 'fadeMeOut':
                    $animate.removeClass(element, "fadeMe");
                    break;
            }
        },true);
    };
    return {
        restrict: 'EA',
        scope: {},
        link: linker,
        controller: function($scope){
            // data which used to trigger animate
            $scope.animateStyle=null;
            // lib api
            this.setAnimateStyle = function(style){
                $scope.animateStyle = style;
            };
        }
    };
})
.directive("fadeMeHover", function($animate) {
    return {
        restrict: 'EA',
        // scope: {},
        require: "fadeMe",
        link: function(scope, element, attrs, fademeCtrl) {

            element.bind('mouseenter',function(event) {
                fademeCtrl.setAnimateStyle('fadeMeIn');
                scope.$apply();
            });
            element.bind('mouseleave',function(event) {
                fademeCtrl.setAnimateStyle('fadeMeOut');
                scope.$apply();
            });
        }
};})
.directive("fadeMeClick", function($animate) {
    return {
        restrict: 'EA',
        // scope: {},
        require: "fadeMe",
        link: function(scope, element, attrs, fademeCtrl) {
            var clicktoggle = 0;
            element.bind('click', function(event) {
                clicktoggle++;
                if (clicktoggle%2)
                    fademeCtrl.setAnimateStyle('fadeMeIn');
                else
                    fademeCtrl.setAnimateStyle('fadeMeOut');
                // due to this function runs outside angular,
                // so we should inform angular for the change
                // and trigger the watchers
                scope.$apply();
            });
        }
    };
})
.directive("fadeGlobal", function($animate) {
    var linker = function(scope, element, attrs) {

        scope.$watch('trigger',function(){
            console.log(scope.trigger);
            switch (scope.trigger)
            {
                case 'fadeMeIn':
                    $animate.addClass(element, "fadeMe");
                    break;
                case 'fadeMeOut':
                    $animate.removeClass(element, "fadeMe");
                    break;
            }
        },true);
    };
    return {
        restrict: 'EA',
        scope: {trigger: '='},
        link: linker,
        controller: function($scope){
            // data which used to trigger animate
            // $scope.animateStyle=null;
            // // lib api
            // this.setAnimateStyle = function(style){
            //     $scope.animateStyle = style;
            // };
        }
    };
})
.animation(".fadeMe", function() {
    return {
        addClass: function(element, className) {
                   // TweenMax.to(element, 0.2, {'fontSize': 50,'marginBottom':10,'width':200,'borderLeft':'20px solid #89cd25'});
                   TweenMax.to(element, 0.5, {opacity:1});
               
               },
        removeClass: function(element, className) {
           // TweenMax.to(element, 0.2, {'fontSize': 10,'marginBottom':2,'width':100,'borderLeft':'10px solid #333'});
            TweenMax.to(element, 0.5, {opacity:0});
        }
    };
});
