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


  function getRevenueFromStaty($statArray)
  {
    return !empty($statArray) && isset($statArray['revenue']) && $statArray['revenue'] > 0 ? (float)$statArray['revenue'] : 0;
  }



  $yearRevenue = getRevenueFromStaty($statByYear);
  $lastYearRevenue = getRevenueFromStaty($statByYearPrevious);

  function getRevenueFromStat($statArray)
  {
    return !empty($statArray) && isset($statArray['revenue']) && $statArray['revenue'] > 0 ? (float)$statArray['revenue'] : 0;
  }

  $todayRevenue = getRevenueFromStat($statByDay[6] ?? []);
  $yesterdayRevenue = getRevenueFromStat($statByDay[5] ?? []);

  $weekRevenue = getRevenueFromStat($statByWeek[3] ?? []);
  $lastWeekRevenue = getRevenueFromStat($statByWeek[2] ?? []);

  $monthRevenue = getRevenueFromStat($statByMonth[5] ?? []);
  $lastMonthRevenue = getRevenueFromStat($statByMonth[4] ?? []);

  // Xử lý dữ liệu năm
  $yearRevenue = 0;
  $lastYearRevenue = 0;
  if (!empty($statByYear)) {
    foreach ($statByYear as $index => $yearStat) {
      if ($index === 0) {
        $yearRevenue = getRevenueFromStaty($yearStat);
      } else if ($index === 1) {
        $lastYearRevenue = getRevenueFromStaty($yearStat);
      }
    }
  }
  ?>

  <div class="container py-5">
    <h2 class="text-center mb-4">📊 Thống kê Doanh thu</h2>
    <div class="container mb-4">
      <form action="" method="post" class="row g-3 align-items-center justify-content-center">
        <div class="col-md-4">
          <input type="date" name="date" id="start-date" class="form-control" value="<?= isset($_POST['date']) ? $_POST['date'] : date('Y-m-d') ?>" required>
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
            <small class="text-light">Hôm qua: <?= number_format($yesterdayRevenue) ?> ₫</small>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card stat-card text-white bg-success text-center">
          <div class="card-body">
            <h5 class="card-title">Tuần <?= date("W", strtotime($date)) ?></h5>
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
      <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#chart-day"> Ngày</button></li>
      <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#chart-week"> Tuần</button></li>
      <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#chart-month"> Tháng</button></li>
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
    const selectedDate = new Date('<?= $date ?>');

    function getLastNDays(n) {
      const days = [];
      for (let i = n - 1; i >= 0; i--) {
        const date = new Date(selectedDate);
        date.setDate(date.getDate() - i);
        days.push(date.toLocaleDateString('vi-VN', {
          day: '2-digit',
          month: '2-digit'
        }));
      }
      return days;
    }

    function getLastNWeeks(n) {
      const weeks = [];
      for (let i = n - 1; i >= 0; i--) {
        const date = new Date(selectedDate);
        date.setDate(date.getDate() - (i * 7));
        const weekNumber = getWeekNumber(date);
        weeks.push(`Tuần ${weekNumber}`);
      }
      return weeks;
    }

    function getLastNMonths(n) {
      const months = [];
      for (let i = n - 1; i >= 0; i--) {
        const date = new Date(selectedDate);
        date.setMonth(date.getMonth() - i);
        months.push(`Tháng ${date.toLocaleDateString('vi-VN', { month: '2-digit' })}`);
      }
      return months;
    }

    function getLastNYears(n) {
      const years = [];
      const yearData = <?= json_encode($statByYear) ?>;

      // Lấy danh sách các năm có dữ liệu
      const yearsWithData = yearData.filter(stat => stat && stat.revenue > 0);

      // Nếu không có năm nào có dữ liệu, trả về mảng rỗng
      if (yearsWithData.length === 0) {
        return [];
      }

      // Thêm các năm có dữ liệu vào labels
      yearsWithData.forEach(stat => {
        years.push(`Năm ${stat.year}`);
      });

      return years;
    }

    function getWeekNumber(date) {
      const firstDayOfYear = new Date(date.getFullYear(), 0, 1);
      const pastDaysOfYear = (date - firstDayOfYear) / 86400000;
      return Math.ceil((pastDaysOfYear + firstDayOfYear.getDay() + 1) / 7);
    }

    const chartConfigs = [{
        id: 'chartDay',
        title: ' Doanh thu 7 ngày gần nhất',
        labels: getLastNDays(7),
        data: [
          <?php foreach ($statByDay as $stat): ?>
            <?= $stat['revenue'] ?? 0 ?>,
          <?php endforeach; ?>
        ],
        bgColor: ['#cbd5e1', '#cbd5e1', '#cbd5e1', '#cbd5e1', '#cbd5e1', '#cbd5e1', '#3b82f6'],
        yMax: 5000000
      },
      {
        id: 'chartWeek',
        title: ' Doanh thu 4 tuần gần nhất',
        labels: getLastNWeeks(4),
        data: [
          <?php foreach ($statByWeek as $stat): ?>
            <?= $stat['revenue'] ?? 0 ?>,
          <?php endforeach; ?>
        ],
        bgColor: ['#d1fae5', '#d1fae5', '#d1fae5', '#10b981'],
        yMax: 20000000
      },
      {
        id: 'chartMonth',
        title: ' Doanh thu 6 tháng gần nhất',
        labels: getLastNMonths(6),
        data: [
          <?php foreach ($statByMonth as $stat): ?>
            <?= $stat['revenue'] ?? 0 ?>,
          <?php endforeach; ?>
        ],
        bgColor: ['#fde68a', '#fde68a', '#fde68a', '#fde68a', '#fde68a', '#f59e0b'],
        yMax: 100000000
      },
      {
        id: 'chartYear',
        title: 'So sánh doanh thu năm <?= date("Y") ?> và năm <?= date("Y", strtotime("-1 year")) ?>',
        labels: ['Năm <?= date("Y", strtotime("-1 year")) ?>', 'Năm <?= date("Y") ?>'],
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