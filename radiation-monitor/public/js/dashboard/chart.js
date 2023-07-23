function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

function createDoseRateChart(data) {
    var outdoorData = data.dose_rate_outdoor;
    var indoorData = data.dose_rate_indoor;

    var doseRateOutdoor = [];
    var doseRateIndoor = [];
    var doseRateLabels = [];

    outdoorData.forEach(function(item) {
        doseRateOutdoor.push(item.dose_rate);
        doseRateLabels.push(item.time);
    });

    indoorData.forEach(function(item) {
      doseRateIndoor.push(item.dose_rate);
    });
  
    if (window.doseRateChart) {
      window.doseRateChart.destroy();
    }
  
    // Area Chart Example
    var ctx = document.getElementById("dose-rate-chart");
    window.doseRateChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: doseRateLabels,
        datasets: [
            {
                label: "Monitor Utama",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: doseRateOutdoor,
            },
            {
                label: "Monitor Dalam",
                lineTension: 0.3,
                backgroundColor: "rgba(248, 196, 60, 0.05)",
                borderColor: "rgba(248, 196, 60, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(248, 196, 60, 1)",
                pointBorderColor: "rgba(248, 196, 60, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(248, 196, 60, 1)",
                pointHoverBorderColor: "rgba(248, 196, 60, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: doseRateIndoor,
            }
        ],
      },
      options: {
        animation : {
          duration : 0
        },
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
          }
        },
        scales: {
          xAxes: [{
            time: {
              unit: 'date'
            },
            gridLines: {
              display: false,
              drawBorder: false
            },
            ticks: {
              maxTicksLimit: 7
            }
          }],
          yAxes: [{
            ticks: {
              maxTicksLimit: 5,
              padding: 10
            },
            gridLines: {
              color: "rgb(234, 236, 244)",
              zeroLineColor: "rgb(234, 236, 244)",
              drawBorder: false,
              borderDash: [2],
              zeroLineBorderDash: [2]
            }
          }],
        },
        legend: {
          display: true
        },
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          intersect: false,
          mode: 'index',
          caretPadding: 10
        }
      }
    });
  }