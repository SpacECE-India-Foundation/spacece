<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Weight Chart Embed</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      margin: 0;
      background: #fff;
    }
html, body {
  margin: 0;
  padding: 0;
  height: 100%;
  overflow: hidden;
}

canvas {
  display: block;
  width: 100% !important;
  height: 100% !important;
}

  </style>
</head>
<body>
  <canvas id="weightChart"></canvas>
  <script>
    const ageLabels = [
      '2y', '2y2m', '2y4m', '2y6m', '2y8m', '2y10m',
      '3y', '3y2m', '3y4m', '3y6m', '3y8m', '3y10m',
      '4y', '4y2m', '4y4m', '4y6m', '4y8m', '4y10m',
      '5y'
    ];

    const chartData = {
      labels: ageLabels,
      datasets: [
        {
          label: '+3 SD',
          borderColor: '#000000',
          data: [18.5, 19, 19.6, 20.2, 20.8, 21.5, 22.1, 22.6, 23.1, 23.6, 24.2, 24.7, 25.2, 25.7, 26.2, 26.6, 27, 27.4, 28]
        },
        {
          label: '+2 SD',
          borderColor: '#ff0000',
          data: [16.2, 16.7, 17.2, 17.6, 18.1, 18.6, 19, 19.5, 20, 20.4, 20.9, 21.3, 21.8, 22.2, 22.6, 23, 23.4, 23.8, 24.2]
        },
        {
          label: 'Median (0 SD)',
          borderColor: '#00aa00',
          data: [12.6, 13, 13.4, 13.8, 14.2, 14.6, 15, 15.4, 15.8, 16.2, 16.6, 17, 17.4, 17.8, 18.2, 18.6, 19, 19.4, 19.8]
        },
        {
          label: '-2 SD',
          borderColor: '#ff0000',
          borderDash: [4, 4],
          data: [10.2, 10.5, 10.8, 11.1, 11.4, 11.7, 12, 12.3, 12.6, 12.9, 13.2, 13.5, 13.8, 14.1, 14.4, 14.7, 15, 15.3, 15.6]
        },
        {
          label: '-3 SD',
          borderColor: '#000000',
          borderDash: [4, 4],
          data: [9, 9.2, 9.4, 9.6, 9.8, 10, 10.2, 10.4, 10.6, 10.8, 11, 11.2, 11.4, 11.6, 11.8, 12, 12.2, 12.4, 12.6]
        }
      ]
    };

    const chartOptions = {
      responsive: true,
      plugins: {
        legend: {
          display: true,
          position: 'right'
        }
      },
      scales: {
        y: {
          title: { display: true, text: 'Weight (kg)' },
          min: 8,
          max: 30,
          ticks: { stepSize: 2 }
        },
        x: {
          title: { display: true, text: 'Age (months)' }
        }
      }
    };

    new Chart(document.getElementById('weightChart'), {
      type: 'line',
      data: chartData,
      options: chartOptions
    });
  </script>
</body>
</html>
