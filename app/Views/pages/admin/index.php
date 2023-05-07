<?php $this->extend('template/admin'); ?>

<?php $this->section('content'); ?>
<div class="col-12 col-sm-4">
  <div class="info-box">
    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-box"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">Produk</span>
      <span class="info-box-number">
        <?= $produk ?>
      </span>
    </div>
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</div>
<!-- /.col -->
<div class="col-12 col-sm-4">
  <div class="info-box mb-3">
    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">Konsumen</span>
      <span class="info-box-number"><?= $konsumen ?></span>
    </div>
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</div>
<!-- /.col -->

<!-- fix for small devices only -->
<div class="clearfix hidden-md-up"></div>

<div class="col-12 col-sm-4">
  <div class="info-box mb-3">
    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">Pesanan</span>
      <span class="info-box-number"><?= $pesanan ?></span>
    </div>
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</div>
<!-- /.col -->

<!-- visitor chart -->
<div class="col-lg-8">
  <div class="card">
    <div class="card-header border-0">
      <div class="d-flex justify-content-between">
        <h3 class="card-title">Grafik Penjualan</h3>
        <a href="javascript:void(0);">View Report</a>
      </div>
    </div>
    <div class="card-body">
      <div class="d-flex">
        <p class="d-flex flex-column">
          <span class="text-bold text-lg">820</span>
          <span>Visitors Over Time</span>
        </p>
        <p class="ml-auto d-flex flex-column text-right">
          <span class="text-success">
            <i class="fas fa-arrow-up"></i> 12.5%
          </span>
          <span class="text-muted">Since last week</span>
        </p>
      </div>
      <!-- /.d-flex -->

      <div class="position-relative mb-4">
        <div class="chartjs-size-monitor">
          <div class="chartjs-size-monitor-expand">
            <div class=""></div>
          </div>
          <div class="chartjs-size-monitor-shrink">
            <div class=""></div>
          </div>
        </div>
        <canvas id="visitors-chart" height="200" width="487" style="display: block; width: 487px; height: 200px;" class="chartjs-render-monitor"></canvas>
      </div>

      <div class="d-flex flex-row justify-content-end">
        <span class="mr-2">
          <i class="fas fa-square text-primary"></i> This Week
        </span>

        <span>
          <i class="fas fa-square text-gray"></i> Last Week
        </span>
      </div>
    </div>
  </div>
  <!-- /.card -->
</div>

<div class="col-lg-4">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Pesanan Baru</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <ul class="products-list product-list-in-card pl-2 pr-2">
        <li class="item">
          <div class="product-img">
            <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
          </div>
          <div class="product-info">
            <a href="javascript:void(0)" class="product-title">Samsung TV
              <span class="badge badge-warning float-right">$1800</span></a>
            <span class="product-description">
              Samsung 32" 1080p 60Hz LED Smart HDTV.
            </span>
          </div>
        </li>
        <!-- /.item -->
        <li class="item">
          <div class="product-img">
            <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
          </div>
          <div class="product-info">
            <a href="javascript:void(0)" class="product-title">Bicycle
              <span class="badge badge-info float-right">$700</span></a>
            <span class="product-description">
              26" Mongoose Dolomite Men's 7-speed, Navy Blue.
            </span>
          </div>
        </li>
        <!-- /.item -->
        <li class="item">
          <div class="product-img">
            <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
          </div>
          <div class="product-info">
            <a href="javascript:void(0)" class="product-title">
              Xbox One <span class="badge badge-danger float-right">
                $350
              </span>
            </a>
            <span class="product-description">
              Xbox One Console Bundle with Halo Master Chief Collection.
            </span>
          </div>
        </li>
        <!-- /.item -->
        <li class="item">
          <div class="product-img">
            <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
          </div>
          <div class="product-info">
            <a href="javascript:void(0)" class="product-title">PlayStation 4
              <span class="badge badge-success float-right">$399</span></a>
            <span class="product-description">
              PlayStation 4 500GB Console (PS4)
            </span>
          </div>
        </li>
        <!-- /.item -->
      </ul>
    </div>
    <!-- /.card-body -->
    <div class="card-footer text-center">
      <a href="javascript:void(0)" class="uppercase">Lihat Semua Pesanan</a>
    </div>
    <!-- /.card-footer -->
  </div>
</div>
<?php $this->endSection('content'); ?>

<?php $this->section('script'); ?>
<script src="plugins/chart.js/Chart.min.js"></script>
<script>
  $(function() {
    'use strict'

    var ticksStyle = {
      fontColor: '#495057',
      fontStyle: 'bold'
    }

    var mode = 'index'
    var intersect = true

    var $visitorsChart = $('#visitors-chart')
    // eslint-disable-next-line no-unused-vars
    var visitorsChart = new Chart($visitorsChart, {
      data: {
        labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
        datasets: [{
            type: 'line',
            data: [100, 120, 170, 167, 180, 177, 160],
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            pointBorderColor: '#007bff',
            pointBackgroundColor: '#007bff',
            fill: false
            // pointHoverBackgroundColor: '#007bff',
            // pointHoverBorderColor    : '#007bff'
          },
          {
            type: 'line',
            data: [60, 80, 70, 67, 80, 77, 100],
            backgroundColor: 'tansparent',
            borderColor: '#ced4da',
            pointBorderColor: '#ced4da',
            pointBackgroundColor: '#ced4da',
            fill: false
            // pointHoverBackgroundColor: '#ced4da',
            // pointHoverBorderColor    : '#ced4da'
          }
        ]
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          mode: mode,
          intersect: intersect
        },
        hover: {
          mode: mode,
          intersect: intersect
        },
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            // display: false,
            gridLines: {
              display: true,
              lineWidth: '4px',
              color: 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks: $.extend({
              beginAtZero: true,
              suggestedMax: 200
            }, ticksStyle)
          }],
          xAxes: [{
            display: true,
            gridLines: {
              display: false
            },
            ticks: ticksStyle
          }]
        }
      }
    })
  })
</script>
<?php $this->endSection('script'); ?>