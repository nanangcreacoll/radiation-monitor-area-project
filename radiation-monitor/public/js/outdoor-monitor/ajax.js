$(document).ready(function() {
    const apiKey = document.querySelector('meta[name="api-key"]').getAttribute('content');
    
    function latestOutdoorTemperature() {
        $.ajax({
            url: 'latest-outdoor-temperature',
            headers: {
                'Api-Key': apiKey
            },
            method: 'GET',
            success: function(response) {
                $('#outdoor-temperature').html(response.temperature);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
    
    function latestOutdoorHumidity() {
        $.ajax({
            url: 'latest-outdoor-humidity',
            headers: {
                'Api-Key': apiKey
            },
            method: 'GET',
            success: function(response) {
                $('#outdoor-humidity').html(response.humidity);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
    function doseRateChart() {
        $.ajax({
            url: 'outdoor-dose-rate-chart',
            headers: {
                'Api-Key': apiKey
            },
            method: 'GET',
            success: function(response) {
                createOutdoorDoseRateChart(response);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
    function temperatureChart() {
        $.ajax({
            url: 'outdoor-temperature-chart',
            headers: {
                'Api-Key': apiKey
            },
            method: 'GET',
            success: function(response) {
                createOutdoorTemperatureChart(response);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
    function humidityChart() {
        $.ajax({
            url: 'outdoor-humidity-chart',
            headers: {
                'Api-Key': apiKey
            },
            method: 'GET',
            success: function(response) {
                createOutdoorHumidityChart(response);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
    if (window.location.pathname == '/outdoor-monitor') {
        setInterval(function() {
            latestOutdoorHumidity();
            latestOutdoorTemperature();
            humidityChart();
            temperatureChart();
            doseRateChart();
        }, 1000);
        
        latestOutdoorHumidity();
        latestOutdoorTemperature();
        humidityChart();
        temperatureChart();
        doseRateChart();
    }
});