$(document).ready(function() {
    const apiKey = document.querySelector('meta[name="api-key"]').getAttribute('content');
    
    function latestIndoorTemperature() {
        $.ajax({
            url: 'latest-indoor-temperature',
            headers: {
                'Api-Key': apiKey
            },
            method: 'GET',
            success: function(response) {
                $('#indoor-temperature').html(response.temperature);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
    
    function latestIndoorHumidity() {
        $.ajax({
            url: 'latest-indoor-humidity',
            headers: {
                'Api-Key': apiKey
            },
            method: 'GET',
            success: function(response) {
                $('#indoor-humidity').html(response.humidity);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
    function doseRateChart() {
        $.ajax({
            url: 'indoor-dose-rate-chart',
            headers: {
                'Api-Key': apiKey
            },
            method: 'GET',
            success: function(response) {
                createIndoorDoseRateChart(response);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
    function temperatureChart() {
        $.ajax({
            url: 'indoor-temperature-chart',
            headers: {
                'Api-Key': apiKey
            },
            method: 'GET',
            success: function(response) {
                createIndoorTemperatureChart(response);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
    function humidityChart() {
        $.ajax({
            url: 'indoor-humidity-chart',
            headers: {
                'Api-Key': apiKey
            },
            method: 'GET',
            success: function(response) {
                createIndoorHumidityChart(response);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
    if (window.location.pathname == '/indoor-monitor') {
        setInterval(function() {
            latestIndoorHumidity();
            latestIndoorTemperature();
            humidityChart();
            temperatureChart();
            doseRateChart();
        }, 1000);
        
        latestIndoorHumidity();
        latestIndoorTemperature();
        humidityChart();
        temperatureChart();
        doseRateChart();
    }
});