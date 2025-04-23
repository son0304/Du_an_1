<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Thống kê Doanh thu</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Thẻ thống kê */
    .stat-card {
      border-radius: 1rem;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease-in-out;
    }

    .stat-card:hover {
      transform: translateY(-6px);
    }

    /* Biểu đồ */
    .chart-container {
      margin-top: 20px;
      background-color: #fff;
      padding: 20px;
      border-radius: 1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .chart-tab {
      border-radius: 0.5rem;
    }
  </style>
</head>

<body>

  <?php
  function getRevenueFromStat($statArray)
  {
    return !empty($statArray) ? (float)($statArray[0]['total_price'] ?? 0) : 0;
  }

  $todayRevenue = getRevenueFromStat($statByDay);
  $yesterdayRevenue = getRevenueFromStat($statByDayPrevious);

  $weekRevenue = getRevenueFromStat($statByWeek);
  $lastWeekRevenue = getRevenueFromStat($statByWeekPrevious);

  $monthRevenue = getRevenueFromStat($statByMonth);
  $lastMonthRevenue = getRevenueFromStat($statByMonthPrevious);

  $yearRevenue = getRevenueFromStat($statByYear);
  $lastYearRevenue = getRevenueFromStat($statByYearPrevious);
  ?>

  <div class="container py-5">
    <h2 class="text-center mb-4">📊 Thống kê Doanh thu</h2>
    <div class="container mb-4">
      <form action="" method="post" class="row g-3 align-items-center justify-content-center">
        <div class="col-md-4">
          <input type="date" name="date" id="start-date" class="form-control" required>
        </div>
        <div class="col-auto">
          <button type="submit" class="btn btn-success btn-lg px-4 py-2">Lọc</button>
        </div>
      </form>
    </div>

    <!-- Thẻ thống kê -->
    <div class="row g-4 mb-5">
      <div class="col-md-3">
        <div class="card stat-card text-white bg-primary text-center">
          <div class="card-body">
            <h5 class="card-title">Ngày <?= date("d/m/Y", strtotime($date)) ?></h5>
            <p class="fs-5 mb-1"><?= number_format($todayRevenue) ?> ₫</p>
            <small class="text-light">Hôm qua: <?= date("d/m/Y", strtotime($previousDay)) ?> – <?= number_format($yesterdayRevenue) ?> ₫</small>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card stat-card text-white bg-success text-center">
          <div class="card-body">
            <h5 class="card-title">Tuần <?= date("W", strtotime($date)) ?> (<?= date("d/m", strtotime('monday this week', strtotime($date))) ?> - <?= date("d/m", strtotime('sunday this week', strtotime($date))) ?>)</h5>
            <p class="fs-5 mb-1"><?= number_format($weekRevenue) ?> ₫</p>
            <small class="text-light">Tuần trước: <?= number_format($lastWeekRevenue) ?> ₫</small>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card stat-card text-white bg-warning text-center">
          <div class="card-body">
            <h5 class="card-title">Tháng <?= date("m/Y", strtotime($date)) ?></h5>
            <p class="fs-5 mb-1"><?= number_format($monthRevenue) ?> ₫</p>
            <small class="text-light">Tháng trước: <?= number_format($lastMonthRevenue) ?> ₫</small>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card stat-card text-white bg-danger text-center">
          <div class="card-body">
            <h5 class="card-title">Năm <?= date("Y", strtotime($date)) ?></h5>
            <p class="fs-5 mb-1"><?= number_format($yearRevenue) ?> ₫</p>
            <small class="text-light">Năm trước: <?= number_format($lastYearRevenue) ?> ₫</small>
          </div>
        </div>
      </div>
    </div>

    <!-- Biểu đồ so sánh -->
    <h5 class="mb-3">📈 Biểu đồ so sánh:</h5>
    <ul class="nav nav-tabs" id="chartTab" role="tablist">
      <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#chart-day">Ngày</button></li>
      <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#chart-week">Tuần</button></li>
      <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#chart-month">Tháng</button></li>
      <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#chart-year">Năm</button></li>
    </ul>

    <div class="tab-content chart-container">
      <div class="tab-pane fade show active" id="chart-day">
        <canvas id="chartDay"></canvas>
      </div>
      <div class="tab-pane fade" id="chart-week">
        <canvas id="chartWeek"></canvas>
      </div>
      <div class="tab-pane fade" id="chart-month">
        <canvas id="chartMonth"></canvas>
      </div>
      <div class="tab-pane fade" id="chart-year">
        <canvas id="chartYear"></canvas>
      </div>
    </div>
  </div>

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    const chartConfigs = [{
        id: 'chartDay',
        title: 'So sánh doanh thu hôm nay (<?= date("d/m/Y") ?>) và hôm qua (<?= date("d/m/Y", strtotime("-1 day")) ?>)',
        labels: ['<?= date("d/m", strtotime("-1 day")) ?>', '<?= date("d/m") ?>'],
        data: [<?= $yesterdayRevenue ?>, <?= $todayRevenue ?>],
        bgColor: ['#cbd5e1', '#3b82f6'],
        yMax: 5000000
      },
      {
        id: 'chartWeek',
        title: 'So sánh doanh thu tuần này (<?= date("W") ?>) và tuần trước (<?= date("W", strtotime("-1 week")) ?>)',
        labels: ['Tuần <?= date("W", strtotime("-1 week")) ?>', 'Tuần <?= date("W") ?>'],
        data: [<?= $lastWeekRevenue ?>, <?= $weekRevenue ?>],
        bgColor: ['#d1fae5', '#10b981'],
        yMax: 20000000
      },
      {
        id: 'chartMonth',
        title: 'So sánh doanh thu tháng <?= date("m") ?> và tháng <?= date("m", strtotime("-1 month")) ?>',
        labels: ['Tháng <?= date("m", strtotime("-1 month")) ?>', 'Tháng <?= date("m") ?>'],
        data: [<?= $lastMonthRevenue ?>, <?= $weekRevenue ?>],
        bgColor: ['#fde68a', '#f59e0b'],
        yMax: 100000000
      },
      {
        id: 'chartYear',
        title: 'So sánh doanh thu năm <?= date("Y") ?> và năm <?= date("Y", strtotime("-1 year")) ?>',
        labels: ['<?= date("Y", strtotime("-1 year")) ?>', '<?= date("Y") ?>'],
        data: [<?= $lastYearRevenue ?>, <?= $yearRevenue ?>],
        bgColor: ['#fecaca', '#dc2626'],
        yMax: 2000000000
      }
    ];

    chartConfigs.forEach(({
      id,
      title,
      labels,
      data,
      bgColor,
      yMax
    }) => {
      const ctx = document.getElementById(id).getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels,
          datasets: [{
            label: 'Doanh thu (₫)',
            data,
            backgroundColor: bgColor,
            borderRadius: 10,
            barThickness: 40
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              display: false
            },
            title: {
              display: true,
              text: title,
              font: {
                size: 16
              },
              color: '#111'
            },
            tooltip: {
              callbacks: {
                label: function(context) {
                  return new Intl.NumberFormat('vi-VN').format(context.raw) + ' ₫';
                }
              }
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              max: yMax,
              ticks: {
                callback: function(value) {
                  return new Intl.NumberFormat('vi-VN').format(value) + ' ₫';
                }
              }
            }
          }
        }
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>