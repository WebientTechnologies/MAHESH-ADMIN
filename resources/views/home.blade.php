@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Dashboard') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-4">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Families</h5>
                            <p class="card-text">{{ $totalFamilies }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Families in the Last 7 Days</h5>
                            <p class="card-text">{{ $familiesIn7Days }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <h5 class="card-title">Families in the Last 30 Days</h5>
                            <p class="card-text">{{ $familiesIn30Days }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card" style="height: 360px;">
                        <div class="card-body">
                            <h5 class="card-title">Pie Chart</h5>
                            <canvas id="pieChart" style="height: 200px; width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Line Chart</h5>
                            <canvas id="lineChart" style="height: 300px; width: 100%;"></canvas>
                        </div>
                    </div>
                </div>


            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Get the canvas elements
    var pieChartCanvas = document.getElementById('pieChart').getContext('2d');
    var lineChartCanvas = document.getElementById('lineChart').getContext('2d');

    // Pie chart data
    var pieChartData = {
        labels: ['Label 1', 'Label 2', 'Label 3'],
        datasets: [{
            data: [30, 40, 30], // Replace with your data
            backgroundColor: ['red', 'green', 'blue'] // Customize colors as needed
        }]
    };

    // Line chart data
    var lineChartData = {
        labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5'], // Replace with your labels
        datasets: [{
            label: 'Data Set 1',
            data: [10, 20, 30, 40, 50], // Replace with your data
            borderColor: 'red', // Customize line color as needed
            fill: false
        }]
    };

    // Create the pie chart
    var pieChart = new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieChartData
    });

    // Create the line chart
    var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: lineChartData
    });
</script>

    
@endsection
