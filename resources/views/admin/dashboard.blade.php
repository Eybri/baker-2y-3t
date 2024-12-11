@extends('layouts.master')

@section('content')
<h1>CHARTS</h1>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            width: 60%;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="chart-container">
    <div class="container-fluid header-container">
        <div class="card header-card">
            <h1 class="card-title text-center">˚ · .✧ Categories products chart ✧ ˚ · .</h1>
        </div>
    </div>
        <canvas id="productsPerCategoryChart"></canvas>
    </div>

    <div class="container mt-5">
    <div class="container-fluid header-container">
        <div class="card header-card">
            <h1 class="card-title text-center">˚ · .✧ Dashboard ✧ ˚ · .</h1>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">
            <canvas id="positionsChart"></canvas>
        </div>

    <div class="chart-container">
    <div class="container-fluid header-container">
        <div class="card header-card">
            <h1 class="card-title text-center">˚ · .✧ Stocks chart ✧ ˚ · .</h1>
        </div>
    </div>
        <canvas id="stockChart"></canvas>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('/admin/products-per-category')
                .then(response => response.json())
                .then(data => {
                    const labels = data.map(category => category.name);
                    const productCounts = data.map(category => category.products_count);

                    const ctx = document.getElementById('productsPerCategoryChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Number of Products',
                                data: productCounts,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });

                fetch('/admin/employee/positions')
            .then(response => response.json())
            .then(data => {
                const positions = data.data;
                const labels = positions.map(p => p.position.name); // Assuming the Position model has a name attribute
                const counts = positions.map(p => p.total);

                // Create chart
                const ctx = document.getElementById('positionsChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Number of Employees',
                            data: counts,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                beginAtZero: true
                            },
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching position data:', error));
    });

            fetch('/inventory/stock-data')
                .then(response => response.json())
                .then(data => {
                    const items = data.map(item => item.item);
                    const stockCounts = data.map(item => item.total_stock);

                    const ctx = document.getElementById('stockChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: items,
                            datasets: [{
                                label: 'Stock Count',
                                data: stockCounts,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 205, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(201, 203, 207, 0.2)'
                                ],
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
    </script>
</body>
</html>
@endsection
