$(document).ready(function() {
    const apiKey = document.querySelector('meta[name="api-key"]').getAttribute('content');

    function doseRateChart() {
        $.ajax({
            url: 'api/dose-rate-chart',
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

    if (window.location.pathname == '/') {
        setInterval(function() {
            doseRateChart();
        }, 1000);
        
        doseRateChart();
    }
});    