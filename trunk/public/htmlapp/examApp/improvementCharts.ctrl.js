// improvementCharts.ctrl.js created by zhenghua@kidsit.cn on 27/12/2014 
(function () {
    'use strict';
    angular
        .module('improvementCharts',['highcharts-ng'])
        .controller('improvementChartsCtrl',improvementChartsCtrl);

    improvementChartsCtrl.$inject = ['$scope'];

    function improvementChartsCtrl($scope) {
        /*jshint validthis: true */
        var vm = this;
		$scope.addPoints = function () {
		        var seriesArray = $scope.chartConfig.series
		        var rndIdx = Math.floor(Math.random() * seriesArray.length);
		        seriesArray[rndIdx].data = seriesArray[rndIdx].data.concat([1, 10, 20])
		    };

		    $scope.addSeries = function () {
		        var rnd = []
		        for (var i = 0; i < 10; i++) {
		            rnd.push(Math.floor(Math.random() * 20) + 1)
		        }
		        $scope.chartConfig.series.push({
		            data: rnd
		        })
		    }

		    $scope.removeRandomSeries = function () {
		        var seriesArray = $scope.chartConfig.series
		        var rndIdx = Math.floor(Math.random() * seriesArray.length);
		        seriesArray.splice(rndIdx, 1)
		    }

		    $scope.swapChartType = function () {
		        if (this.chartConfig.options.chart.type === 'line') {
		            this.chartConfig.options.chart.type = 'bar'
		        } else {
		            this.chartConfig.options.chart.type = 'line'
		            this.chartConfig.options.chart.zoomType = 'x'
		        }
		    }

		    $scope.toggleLoading = function () {
		        this.chartConfig.loading = !this.chartConfig.loading
		    }

		    $scope.chartSeries = [
		        {"name": "贾宝宝", "data": [10, 11, 9, 8, 12,12,13,11]},
		        {"name": "徐成婷", "data": [12, 13, 8, 10, 11,12,12,10]},

		        {"name": "贾宝宝", "data": [9, 8, 7, 13, 13,10,11,13]},
		        {"name": "张子墨", "data": [13, 12, 7, 6, 10,10,12,13]}
		      ];

		    $scope.chartConfig = {
		        options: {
		            chart: {
		                type: 'line'
		            },
		            xAxis: {
                        categories: ['12月20日', '12月21日', '12月22日', '12月23日', '12月24日', '12月27日',
                            '12月28日', '12月30日']
                    },
		            tooltip: {
	                    valueSuffix: '分钟'
	                },        
		        },
		        credits: {
					enabled: false
				},
		        series: $scope.chartSeries,
		        title: {
		            text: '数学计算用时'
		        },

		        loading: false
		    }	
    }
})();