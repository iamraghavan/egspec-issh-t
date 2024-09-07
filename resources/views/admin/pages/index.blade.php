@extends('admin.layouts.admin')

@section('admin_content')




<div class="content-wrapper">
    <div class="page-header">
       <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white mr-2">
          <i class="mdi mdi-home"></i>
          </span> Dashboard
       </h3>
       <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
             <li class="breadcrumb-item active" aria-current="page">
                <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
             </li>
          </ul>
       </nav>
    </div>
    <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="https://demo.bootstrapdash.com/purple-admin-free/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">Total Amount Collected </h4>
                    <h2 class="mb-5">₹ {{ $weeklySales }}</h2>

                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="https://demo.bootstrapdash.com/purple-admin-free/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">Weekly Registration </h4>
                    <h2 class="mb-5">{{ $weeklyOrders }}</h2>

                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="https://demo.bootstrapdash.com/purple-admin-free/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">Total Registration </h4>
                    <h2 class="mb-5">{{ $totalVisitors }}</h2>

                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <!-- Chart 1: Total Amount -->
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

    <div id="dailyRegistrationChart" style="width: 600px; height: 400px;"></div>
                </div>
            </div>
        </div>

        <!-- Chart 2: Weekly Sales -->
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

    <div id="revenueChart" style="width: 600px; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <!-- Chart 1: Total Amount -->
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

    <div id="trendChart" style="width: 600px; height: 400px;"></div>
                </div>
            </div>
        </div>

        <!-- Chart 2: Weekly Sales -->
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

    <div id="geoChart" style="width: 600px; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>






 </div>
 <script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>

 <script>
    // Utility function to handle fetch errors
    function handleFetchError(error) {
        console.error('Fetch Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Data Fetch Error',
            text: 'There was an error fetching the data. Please try again later.',
            confirmButtonText: 'OK'
        });
    }

    // Initialize a chart with given options
    function initializeChart(elementId, titleText, xAxisData, seriesData, chartType, color) {
        const chart = echarts.init(document.getElementById(elementId));
        chart.setOption({
            title: { text: titleText },
            xAxis: { type: 'category', data: xAxisData },
            yAxis: { type: 'value' },
            series: [{
                data: seriesData,
                type: chartType,
                itemStyle: { color: color }
            }],
            tooltip: {
                trigger: 'axis',
                formatter: params => `<div>${params[0].name}</div><div>Value: ${params[0].value}</div>`
            }
        });
    }

    // Fetch and initialize chart data
    async function fetchAndInitializeChart(url, elementId, titleText, chartType, color) {
        try {
            const response = await fetch(url);
            if (!response.ok) throw new Error('Network response was not ok.');
            const data = await response.json();
            initializeChart(elementId, titleText, data.xAxis, data.series, chartType, color);
        } catch (error) {
            handleFetchError(error);
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        fetchAndInitializeChart('/api/daily-registrations', 'dailyRegistrationChart', 'Daily User Registrations', 'bar', '#4BC0C0');
        fetchAndInitializeChart('/api/revenue-by-event', 'revenueChart', 'Revenue by Event', 'bar', '#FF6384');
        fetchAndInitializeChart('/api/registration-trends', 'trendChart', 'Registration Trends', 'line', '#4BC0C0');
        fetchAndInitializeChart('/api/geographical-distribution', 'geoChart', 'Geographical Distribution', 'pie', '#FF6384');
    });
</script>

@endsection
