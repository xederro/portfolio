var ctx = document.getElementsByTagName('canvas');
var tempChart;
var presChart;
var humChart;
var lightChart;

var site = "/?page=weather&data=";

var sortBy = "Hour";

function change(text){
  if (text !== sortBy){
    document.getElementById("sort").innerHTML = text;
    sortBy = text;

    $.getJSON(site + sortBy.toLowerCase(), function (data) {

      var timestamps = Array.from(data, x => x['time'])

      tempChart.data.labels = timestamps;
      tempChart.data.datasets[0].data = Array.from(data, x => x['temperature']);

      presChart.data.labels = timestamps;
      presChart.data.datasets[0].data = Array.from(data, x => x['pressure']);

      humChart.data.labels = timestamps;
      humChart.data.datasets[0].data = Array.from(data, x => x['humidity']);

      lightChart.data.labels = timestamps;
      lightChart.data.datasets[0].data = Array.from(data, x => x['light']);

      tempChart.update();
      presChart.update();
      humChart.update();
      lightChart.update();
    })
  }
}


function graphInit() {

  setInterval(function() {
    dataUpdate(true)
  }, 60000);

  $.getJSON(site + sortBy.toLowerCase(), function (data) {

    var timestamps = Array.from(data, x => x['time'])

    tempChart = new Chart(ctx[0], {
      type: 'line',
      data: {
        labels: timestamps,
        datasets: [{
          data: Array.from(data, x => x['temperature']),
          lineTension: 0,
          backgroundColor: 'transparent',
          borderColor: '#007bff',
          borderWidth: 1,
          pointBackgroundColor: '#007bff'
        }]
      },
      options: {
        responsive: true,
        interaction: {
          intersect: false,
          mode: 'nearest',
        },
        scales: {
          y: {
            ticks: {
              beginAtZero: false
            },
            title: {
              display: true,
              text: '[°C]'
            }
          },
          x: {
            title: {
              display: true,
              text: 'Date/Hour'
            }
          }
        },
        plugins: {
          legend: {
            display: false
          }
        }
      }
    })

    presChart = new Chart(ctx[1], {
      type: 'line',
      data: {
        labels: timestamps,
        datasets: [{
          data: Array.from(data, x => x['pressure']),
          lineTension: 0,
          backgroundColor: 'transparent',
          borderColor: '#37FF0D',
          borderWidth: 1,
          pointBackgroundColor: '#37FF0D'
        }]
      },
      options: {
        responsive: true,
        interaction: {
          intersect: false,
          mode: 'nearest',
        },
        scales: {
          y: {
            ticks: {
              beginAtZero: false
            },
            title: {
              display: true,
              text: '[hPa]'
            }
          },
          x: {
            title: {
              display: true,
              text: 'Date/Hour'
            }
          }
        },
        plugins: {
          legend: {
            display: false
          }
        }
      }
    })

    humChart = new Chart(ctx[2], {
      type: 'line',
      data: {
        labels: timestamps,
        datasets: [{
          data: Array.from(data, x => x['humidity']),
          lineTension: 0,
          backgroundColor: 'transparent',
          borderColor: '#FF19C6',
          borderWidth: 1,
          pointBackgroundColor: '#FF19C6'
        }]
      },
      options: {
        responsive: true,
        interaction: {
          intersect: false,
          mode: 'nearest',
        },
        scales: {
          y: {
            ticks: {
              beginAtZero: false
            },
            title: {
              display: true,
              text: '[%]'
            }
          },
          x: {
            title: {
              display: true,
              text: 'Date/Hour'
            }
          }
        },
        plugins: {
          legend: {
            display: false
          }
        }
      }
    })

    lightChart = new Chart(ctx[3], {
      type: 'line',
      data: {
        labels: timestamps,
        datasets: [{
          data: Array.from(data, x => x['light']),
          lineTension: 0,
          backgroundColor: 'transparent',
          borderColor: '#FFAB19',
          borderWidth: 1,
          pointBackgroundColor: '#FFAB19'
        }]
      },
      options: {
        responsive: true,
        interaction: {
          intersect: false,
          mode: 'nearest',
        },
        scales: {
          y: {
            ticks: {
              beginAtZero: false
            },
            title: {
              display: true,
              text: '[lux]'
            }
          },
          x: {
            title: {
              display: true,
              text: 'Date/Hour'
            }
          }
        },
        plugins: {
          legend: {
            display: false
          }
        }
      }
    })
  })
}

function dataUpdate(updateChart){
  $.getJSON(site + 'data', function (data) {

    document.getElementById('time').innerHTML = data[0]['time']
    document.getElementById('temperature').innerHTML = data[0]['temperature']
    document.getElementById('pressure').innerHTML = data[0]['pressure']
    document.getElementById('humidity').innerHTML = data[0]['humidity']
    document.getElementById('light').innerHTML = data[0]['light']
    if (sortBy==="Hour" && updateChart){
      addData(data)
    }
  })
}

function addData(data){
  var timestamp = data[0]['time']
  tempChart.data.labels.push(timestamp)
  tempChart.data.labels.shift()

  tempChart.data.datasets[0].data.push(data[0]['temperature'])
  tempChart.data.datasets[0].data.shift()

  presChart.data.datasets[0].data.push(data[0]['pressure'])
  presChart.data.datasets[0].data.shift()

  humChart.data.datasets[0].data.push(data[0]['humidity'])
  humChart.data.datasets[0].data.shift()

  lightChart.data.datasets[0].data.push(data[0]['light'])
  lightChart.data.datasets[0].data.shift()

  tempChart.update()
  presChart.update()
  humChart.update()
  lightChart.update()
}