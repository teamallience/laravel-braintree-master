$(document).ready(function(){
 	
	// Pusher.logToConsole = true;
    // update stats for test (every 5s)
	

	var pusher = new Pusher(app_key, {
		cluster: cluster,
		encrypted: true
	})
	var channel = pusher.subscribe('client-dashboard');
    setInterval(function(){
        $.ajax({
            url: '/stats-update'
        })
        $.ajax({
            url: '/chart-update'
        })
    },15000)
      


	//pusher get channel for real
    channel.bind('get-stats' + id, function(response) {
        // console.log('pusher stats response for user ' + id)
  		changeStats(response)
    });

    channel.bind('autopay2', function(response){
        console.log(response)
    })

    //pusher get channel for real
    channel.bind('get-chart' + id, function(response) {
        $("#dial-history-chart").find('svg').remove()
        $("#dial-history-chart").find('div').remove()
        // console.log('pusher charts response for user ' + id)
  		DrawChart(response)
    });

    var changeStats = function(stats){
        if(Number(stats.balance) < 0 ){
            location.href="/balance";
        }
    	$("#balance").number(stats.balance, 2)
        $("#header-balance").number(stats.balance, 2)
    	$("#spent_today").number(stats.spent_today, 2)
    	$("#asr").number(stats.asr,2)
    	$("#canceled_calls").number(stats.canceled_calls, 2)
    	$("#billed_minutes").number(stats.billed_minutes, 2)
    	$("#total_calls").number(stats.total_calls, 0)
    	$("#connected_calls").number(stats.connected_calls, 0)
    	$("#short_calls").number(stats.short_calls, 2)
    }
    
    function toTimeZone(time, zone) {
        var format = 'YYYY-MM-DD HH:mm:ss';
        return moment(time, format).tz(zone).format(format);
    }
    function toTimeFormat(dateTime){
        var hour = dateTime.getHours();
        var minute = dateTime.getMinutes();
        var amPM = (hour > 11) ? " PM" : " AM";
        if(hour > 12) {
            hour -= 12;
        } else if(hour == 0) {
            hour = "12";
        }
        if(minute < 10) {
            minute = "0" + minute;
        }
        return hour + ":" + minute + amPM;
    }

    var DrawChart = function(chartData){
        if(typeof chartData == 'string'){
            chartData = JSON.parse(chartData)
        }
        var chart_info = chartData.map(function(obj){
            // console.log(obj.created_at + "* " + toTimeZone(obj.created_at, timezone))
            return {
                    time: obj.created_at,
                    Active: obj.active,
                    ASR: obj.asr,
                    CPS : obj.cps,
                    Ports: obj.ports
                }
        })
        Morris.Area({
            element: 'dial-history-chart',
            data: chart_info,
            xkey: 'time',
            ykeys: ['Active', 'ASR', 'CPS', 'Ports'],
            labels: ['Active', 'ASR', 'CPS', 'Ports'],
            pointSize: 0,
            fillOpacity: 0,
            pointStrokeColors: ['#20aee3', '#24d2b5', '#6772e5', '#ff5c6c'],
            behaveLikeLine: true,
            gridLineColor: '#e0e0e0',
            lineWidth: 3,
            hideHover: 'auto',
            lineColors: ['#20aee3', '#24d2b5', '#6772e5', '#ff5c6c'],
            xLabelFormat: function (d) {
                return toTimeFormat(d);
            },
            dateFormat: function(date) {
                var d = new Date(date);
                return (d.getMonth()+1) + "/" + d.getDate()+'/' + d.getFullYear() + " " + toTimeFormat(d); 
            },
            resize: true
        });

    }



    DrawChart(chartData)

})



