<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Height Chart Embed</title>
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
  <canvas id="heightChart"></canvas>
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
          data: [104,106,108,110,112,114,116,117,118,119,120,121,122,123,124,124.5,125,125.2,125.5]
        },
        {
          label: '+2 SD',
          borderColor: '#ff0000',
          data: [99,101,103,105,107,109,111,112,113,114,115,116,117,118,119,119.5,120,120.2,120.5]
        },
        {
          label: 'Median (0 SD)',
          borderColor: '#00aa00',
          data: [92,94,96,98,100,102,104,105,106,107,108,109,110,111,112,112.5,113,113.2,113.5]
        },
        {
          label: '-2 SD',
          borderColor: '#ff0000',
          borderDash: [4,4],
          data: [86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,100.5,101,101.2,101.5]
        },
        {
          label: '-3 SD',
          borderColor: '#000000',
          borderDash: [4,4],
          data: [80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,94.5,95,95.2,95.5]
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
          title: { display: true, text: 'Height (cm)' },
          min: 75,
          max: 130,
          ticks: { stepSize: 5 }
        },
        x: {
          title: { display: true, text: 'Age (months)' }
        }
      }
    };

    new Chart(document.getElementById('heightChart'), {
      type: 'line',
      data: chartData,
      options: chartOptions
    });
  </script>
</body>
</html>
