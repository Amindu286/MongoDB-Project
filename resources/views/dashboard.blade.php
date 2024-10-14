<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TOYOTA WMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-5 col-lg-3 p-3 bg-danger text-white" style="height: 100vh;">
                <img src="{{ asset('assets/logo.png') }}" alt="logo" width="50%">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-4">TOYOTA LANKA</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link text-white" aria-current="page">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('stocks.available') }}" class="nav-link text-white">
                            Available Stocks
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('stocks.supply') }}" class="nav-link text-white">
                            Suppliers
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('stocks.return') }}" class="nav-link text-white">
                            Returns
                        </a>
                    </li>
                </ul>
                <hr>
                <!-- User dropdown -->
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <strong>{{ Auth::user()->name }}</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="{{ route('profile.show') }}">{{ __('Profile') }}</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">Sign out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-7 col-lg-9 p-4">
                <!-- Display the content from child templates -->
                @yield('content')

                <!-- Low Stock Items Section -->

                <div class="row">
                    <div class="col-md-6">
                        @isset($lowStockItems)
                        @if($lowStockItems->isEmpty())
                        <div class="card">
                            <div class="card-header">
                                <h3>Stock Update</h3>
                            </div>
                            <div class="card-body" style="height: 200px; overflow-y: auto">
                                <h4 class="text-success">All stock levels are sufficient.</h4>
                            </div>
                            <div class="card-footer d-flex">
                                <a href="{{ route('stocks.available') }}" class="btn btn-success">View All</a>
                                <a href="{{ route('stocks.supply') }}" class="btn btn-success ms-auto">Contact Suppliers</a>
                            </div>
                        </div>
                        @else
                        <div class="card">
                            <div class="card-header">
                                <h3>Low Stock Warning</h3>
                            </div>
                            <div class="card-body" style="height: 200px; overflow-y: auto">
                                <div class="table">
                                    <table>
                                        <thead class="table-warning">
                                            <tr>
                                                <th>Part Name</th>
                                                <th>Quantity in Stock</th>
                                                <th>Warehouse Location</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($lowStockItems as $stock)
                                            <tr>
                                                <td>{{ $stock->part_name }}</td>
                                                <td>{{ $stock->quantity_in_stock }}</td>
                                                <td>{{ $stock->warehouse_location }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer d-flex">
                                <a href="{{ route('stocks.available') }}" class="btn btn-warning">View All</a>
                                <a href="{{ route('stocks.supply') }}" class="btn btn-warning ms-auto">Contact Suppliers</a>
                            </div>
                        </div>
                        @endisset
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3>Major Suppliers</h3>
                            </div>
                            <div class="card-body" style="height: 200px; overflow-y: auto">
                                <div class="table">
                                    <table>
                                        <thead class="table-success">
                                            <tr>
                                                <th>Supplier Name</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($suppliers as $supplier)
                                            <tr>
                                                <td>{{ $supplier->supplier_name }}</td>
                                                <td><a href="{{ $supplier->email }}">{{ $supplier->email }}</a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('stocks.supply') }}" class="btn btn-success">Contact More Suppliers</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-3">
                        <canvas id="stockChart" width="200" height="200"></canvas>

                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Prepare the data for the pie chart
                                const stockData = @json($stockData);
                                const labels = Object.keys(stockData);
                                const data = Object.values(stockData);

                                // Create the pie chart
                                const ctx = document.getElementById('stockChart').getContext('2d');
                                const stockChart = new Chart(ctx, {
                                    type: 'pie',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Stock Availability',
                                            data: data,
                                            backgroundColor: [
                                                'rgba(255, 99, 132, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(255, 206, 86, 0.2)',
                                                'rgba(75, 192, 192, 0.2)',
                                                'rgba(153, 102, 255, 0.2)',
                                                'rgba(255, 159, 64, 0.2)'
                                            ],
                                            borderColor: [
                                                'rgba(255, 99, 132, 1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255, 206, 86, 1)',
                                                'rgba(75, 192, 192, 1)',
                                                'rgba(153, 102, 255, 1)',
                                                'rgba(255, 159, 64, 1)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false, // Prevent maintaining aspect ratio
                                        plugins: {
                                            legend: {
                                                position: 'left',
                                            },
                                            tooltip: {
                                                callbacks: {
                                                    label: function(tooltipItem) {
                                                        return tooltipItem.label + ': ' + tooltipItem.raw; // Customize tooltip label
                                                    }
                                                }
                                            }
                                        }
                                    }
                                });
                            });
                        </script>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="card">
                            <div class="card-header">
                                <h3>Active Users</h3>
                            </div>
                            <div class="card-body" style="height: 200px; overflow-y: auto">
                                <div class="table">
                                    <table>
                                        <thead class="table-success">
                                            <tr>
                                                <th>Employee Name</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td><a href="{{ $user->email }}">{{ $user->email }}</a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Part Name</th>
                            <th>Part Number</th>
                            <th>Manufacturer</th>
                            <th>Quantity in Stock</th>
                            <th>Reorder Level</th>
                            <th>Warehouse Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lowStockItems as $stock)
                        <tr>
                            <td>{{ $stock->part_name }}</td>
                            <td>{{ $stock->part_number }}</td>
                            <td>{{ $stock->manufacturer }}</td>
                            <td>{{ $stock->quantity_in_stock }}</td>
                            <td>{{ $stock->reorder_level }}</td>
                            <td>{{ $stock->warehouse_location }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>