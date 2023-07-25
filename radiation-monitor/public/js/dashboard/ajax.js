$(document).ready(function() {
    const apiKey = document.querySelector('meta[name="api-key"]').getAttribute('content');

    function doseRateChart() {
        $.ajax({
            url: 'dose-rate-chart',
            headers: {
                'Api-Key': apiKey
            },
            method: 'GET',
            success: function(response) {
                createDoseRateChart(response);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
    function latestOutdoorDoseRate() {
        $.ajax({
            url: 'latest-dose-rate-outdoor',
            headers: {
                'Api-Key': apiKey
            },
            method: 'GET',
            success: function(response) {
                $('#outdoor-dose-rate').html(response.doseRateOutdoor.dose_rate);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
    function latestIndoorDoseRate() {
        $.ajax({
            url: 'latest-dose-rate-indoor',
            headers: {
                'Api-Key': apiKey
            },
            method: 'GET',
            success: function(response) {
                $('#indoor-dose-rate').html(response.doseRateIndoor.dose_rate);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
    if (window.location.pathname == '/') {
        setInterval(function() {
            latestIndoorDoseRate();
            latestOutdoorDoseRate();
            doseRateChart();
        }, 1000);
        
        latestIndoorDoseRate();
        latestOutdoorDoseRate();
        doseRateChart();
    }
    if (window.location.pathname == '/outdoor-monitor') {
        setInterval(function() {
            latestOutdoorDoseRate();
        }, 1000);
        
        latestOutdoorDoseRate();
    }
    if (window.location.pathname == '/indoor-monitor') {
        setInterval(function() {
            latestIndoorDoseRate();
        }, 1000);
        
        latestIndoorDoseRate();
    } 

});    