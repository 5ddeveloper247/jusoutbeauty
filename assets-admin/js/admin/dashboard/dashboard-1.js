(function($) {
    /* "use strict" */


 var dzChartlist = function(){
	let draw = Chart.controllers.line.__super__.draw; //draw shadow
	var screenWidth = $(window).width();
	var donutChart = function(){
		$("span.donut").peity("donut", {
			width: "65",
			height: "65"
		});
	}
	var lineChart = function(){
		 
		var options = {
          series: [{
          name: 'previous6month',
          data: linechartorders
        }],
          chart: {
          height: 300,
		  toolbar:{
			show:false
		  },
          type: 'area'
        },
		colors:['#2BC155','#3F9AE0'],
		legend:{
			show:false
		},
        dataLabels: {
          enabled: false
        },
        stroke: {
			width:4,
          curve: 'smooth'
        },
		xaxis: {
			categories: [...linechartmonths],
		  },
		fill:{
			opacity:0.05,
			type:'solid'
		},
        tooltip: {
          x: {
            format: 'dd/MM/yy HH:mm'
          },
        },
        };

        var chart = new ApexCharts(document.querySelector("#lineChart"), options);
        chart.render();
	}
	/* Function ============ */
		return {
			init:function(){
			},
			
			
			load:function(){
				donutChart();
				lineChart();
			},
			
			resize:function(){
				
			}
		}
	
	}();

	jQuery(document).ready(function(){
	});
		
	jQuery(window).on('load',function(){
		setTimeout(function(){
			dzChartlist.load();
		}, 1000); 
		
	});

	jQuery(window).on('resize',function(){
		
		
	});     

})(jQuery);