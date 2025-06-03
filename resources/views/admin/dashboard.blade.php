@extends('layouts.admin')

@section('content')
<main class="app-main">
    <div class="app-content-header bg-light py-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 text-primary">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="#" class="text-dark">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content py-4">
        <div class="container-fluid">
            <div class="row">
                <!-- Total Orders -->
                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="small-box text-bg-primary shadow-sm rounded-3 box-resize">
                        <div class="inner">
                            <h3 class="fw-bold">{{ $newOrders }}</h3>
                            <p class="fs-6 text-uppercase mb-0">Total Orders</p>
                        </div>
                        <div class="icon-box">
                            <i class="bi bi-cart3 display-6 text-white icon-3d"></i>
                        </div>
                        <a href="#" class="small-box-footer text-white">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

                <!-- Delivered Orders -->
                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="small-box text-bg-success shadow-sm rounded-3 box-resize">
                        <div class="inner">
                            <h3 class="fw-bold">{{ $deliveredOrders }}</h3>
                            <p class="fs-6 text-uppercase mb-0">Delivered Orders</p>
                        </div>
                        <div class="icon-box">
                            <i class="bi bi-truck display-6 text-white icon-3d"></i>
                        </div>
                        <a href="#" class="small-box-footer text-white">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

                <!-- Total Users -->
                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="small-box text-bg-warning shadow-sm rounded-3 box-resize">
                        <div class="inner">
                            <h3 class="fw-bold">{{ $userRegistrations }}</h3>
                            <p class="fs-6 text-uppercase mb-0">Total Users</p>
                        </div>
                        <div class="icon-box">
                            <i class="bi bi-people display-6 text-white icon-3d"></i>
                        </div>
                        <a href="#" class="small-box-footer text-dark">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

                <!-- Cancelled Orders -->
                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="small-box text-bg-danger shadow-sm rounded-3 box-resize">
                        <div class="inner">
                            <h3 class="fw-bold">{{ $cancelledOrders }}</h3>
                            <p class="fs-6 text-uppercase mb-0">Cancelled Orders</p>
                        </div>
                        <div class="icon-box">
                            <i class="bi bi-x-circle display-6 text-white icon-3d"></i>
                        </div>
                        <a href="#" class="small-box-footer text-light">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-4">
          <div class="row"> <!-- Added a row to arrange the charts side by side -->
              <!-- First chart: Pie Chart -->
              <div class="col-md-6 mb-4">
                  <div class="card">
                      <div class="card-header">
                          <h5>Order Status Distribution</h5>
                      </div>
                      <div class="card-body">
                          <canvas id="orderStatusPieChart"></canvas>
                      </div>
                  </div>
              </div>
      
              <!-- Second chart: Line Chart -->
              <div class="col-md-6 mb-4">
                  <div class="card">
                      <div class="card-header">
                          <h5>Orders Trend</h5>
                      </div>
                      <div class="card-body">
                          <canvas id="orderStatusLineChart"></canvas>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      
      <script>
          // Pie Chart
          var ctx1 = document.getElementById('orderStatusPieChart').getContext('2d');
          var orderStatusPieChart = new Chart(ctx1, {
              type: 'pie',
              data: {
                  labels: ['Pending', 'Delivered', 'Cancelled'],
                  datasets: [{
                      data: [@json($pendingOrders), @json($deliveredOrders), @json($cancelledOrders)],
                      backgroundColor: ['#ffce56', '#36a2eb', '#ff6384']
                  }]
              },
              options: {
                  responsive: true,
                  plugins: {
                      legend: {
                          position: 'top',
                      }
                  }
              }
          });
      
          // Line Chart
          var ctx2 = document.getElementById('orderStatusLineChart').getContext('2d');
          var orderStatusLineChart = new Chart(ctx2, {
              type: 'line',
              data: {
                  labels: ['Pending', 'Delivered', 'Cancelled'],
                  datasets: [{
                      label: 'Orders Count',
                      data: [@json($pendingOrders), @json($deliveredOrders), @json($cancelledOrders)],
                      borderColor: '#36a2eb',
                      backgroundColor: 'rgba(54, 162, 235, 0.2)',
                      fill: true,
                      tension: 0.4 // For smooth curves
                  }]
              },
              options: {
                  responsive: true,
                  scales: {
                      y: {
                          beginAtZero: true
                      }
                  }
              }
          });
      </script>
      
      <style>
          #orderStatusPieChart {
              width: 100% !important;
              height: 300px !important;  /* Adjusted height */
          }
      
          #orderStatusLineChart {
              width: 100% !important;
              height: 300px !important;  /* Adjusted height */
          }
      </style>
      
    </div>
</main>
@endsection

{{-- Styles --}}
<style>
.box-resize {
    height: 150px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    overflow: hidden;
    background-image: linear-gradient(145deg, rgba(255,255,255,0.05), rgba(0,0,0,0.1));
    border: none;
}

.box-resize:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
}

.icon-box {
    position: absolute;
    top: 15px;
    right: 15px;
}

.icon-3d {
    filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, 0.4));
}

.small-box .inner {
    flex-grow: 1;
}

.small-box .small-box-footer {
    font-size: 0.9rem;
    padding-top: 5px;
}
</style>
