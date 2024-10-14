@extends('dashboard')

@section('content')
<style>
    /* Dropdown container styling */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    /* Dropdown content */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    /* Show dropdown content on hover */
    .dropdown:hover .dropdown-content {
        display: block;
    }

    /* Checkbox list */
    .dropdown-content label {
        display: block;
        padding: 10px;
        cursor: pointer;
    }

    .dropdown-content input[type="checkbox"] {
        margin-right: 10px;
    }
</style>
<div class="stocks d-block">
    <h2>Add Stocks</h2>
    <button type="button" class="btn btn-success display-inline" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add New Stocks
    </button>
</div>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('stockForm').reset(); // Reset the form
    });

    setTimeout(function() {
        $('.alert-success').fadeOut('slow');
    }, 3000);
</script>
@endif
<div class="modal fade modal-xl" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add a New Stock</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('stocks.store') }}" id="stockForm" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="part_name">Part Name</label>
                        <input type="text" class="form-control" id="part_name" name="part_name" required>
                    </div>

                    <div class="form-group">
                        <label for="part_number">Part Number</label>
                        <input type="text" class="form-control" id="part_number" name="part_number" required>
                    </div>

                    <div class="form-group">
                        <label for="manufacturer">Manufacturer</label>
                        <input type="text" class="form-control" id="manufacturer" name="manufacturer" required>
                    </div>

                    <div class="form-group">
                        <label for="compatibility">Compatibility</label>
                        <div class="dropdown d-flex">
                            <button class="btn btn-secondary dropdown-toggle" type="button">
                                Select Toyota Vehicle Types
                            </button>
                            <div class="dropdown-content">
                                <label><input type="checkbox" name="compatibility[]" value="Toyota Corolla" onchange="updateSelected()"> Toyota Corolla</label>
                                <label><input type="checkbox" name="compatibility[]" value="Toyota Camry" onchange="updateSelected()"> Toyota Camry</label>
                                <label><input type="checkbox" name="compatibility[]" value="Toyota Prius" onchange="updateSelected()"> Toyota Prius</label>
                                <label><input type="checkbox" name="compatibility[]" value="Toyota RAV4" onchange="updateSelected()"> Toyota RAV4</label>
                                <label><input type="checkbox" name="compatibility[]" value="Toyota Highlander" onchange="updateSelected()"> Toyota Highlander</label>
                                <label><input type="checkbox" name="compatibility[]" value="Toyota Tacoma" onchange="updateSelected()"> Toyota Tacoma</label>
                                <label><input type="checkbox" name="compatibility[]" value="Toyota Land Cruiser" onchange="updateSelected()"> Toyota Land Cruiser</label>
                                <label><input type="checkbox" name="compatibility[]" value="Toyota Yaris" onchange="updateSelected()"> Toyota Yaris</label>
                                <label><input type="checkbox" name="compatibility[]" value="Toyota Hilux" onchange="updateSelected()"> Toyota Hilux</label>
                                <label><input type="checkbox" name="compatibility[]" value="Toyota C-HR" onchange="updateSelected()"> Toyota C-HR</label>
                                <label><input type="checkbox" name="compatibility[]" value="Toyota Avalon" onchange="updateSelected()"> Toyota Avalon</label>
                                <label><input type="checkbox" name="compatibility[]" value="Toyota Sienna" onchange="updateSelected()"> Toyota Sienna</label>
                                <label><input type="checkbox" name="compatibility[]" value="Toyota Supra" onchange="updateSelected()"> Toyota Supra</label>
                                <label><input type="checkbox" name="compatibility[]" value="Toyota Tundra" onchange="updateSelected()"> Toyota Tundra</label>
                                <label><input type="checkbox" name="compatibility[]" value="Toyota 4Runner" onchange="updateSelected()"> Toyota 4Runner</label>
                                <label><input type="checkbox" name="compatibility[]" value="Toyota Vitz" onchange="updateSelected()"> Toyota Vitz</label>
                                <label><input type="checkbox" name="compatibility[]" value="Toyota Tercel" onchange="updateSelected()"> Toyota Tercel</label>
                                <label><input type="checkbox" name="compatibility[]" value="Toyota GR-auto" onchange="updateSelected()"> Toyota GR-auto</label>
                                <label><input type="checkbox" name="compatibility[]" value="Toyota Century" onchange="updateSelected()"> Toyota Century</label>
                                <label><input type="checkbox" name="compatibility[]" value="Toyota Alphard" onchange="updateSelected()"> Toyota Alphard</label>
                            </div>
                        </div>
                        <span class="selected-values">Selected: None</span> <!-- Display selected values here -->
                    </div>


                    <div class="form-group">
                        <label for="quantity_in_stock">Quantity in Stock</label>
                        <input type="number" class="form-control" id="quantity_in_stock" name="quantity_in_stock" required>
                    </div>

                    <div class="form-group">
                        <label for="reorder_level">Reorder Level</label>
                        <input type="number" class="form-control" id="reorder_level" name="reorder_level" required>
                    </div>

                    <div class="form-group">
                        <label for="warehouse_location">Warehouse Location</label>
                        <select class="form-control" id="warehouse_location" name="warehouse_location" required>
                            <option value="" disabled selected>Select warehouse location</option>
                            <option value="Toyota Lanka - Wattala">Toyota Lanka - Wattala</option>
                            <option value="Toyota Lanka - Ratmalana">Toyota Lanka - Ratmalana</option>
                            <option value="Toyota Lanka - Kandy">Toyota Lanka - Kandy</option>
                            <option value="Toyota Lanka - Kurunegala">Toyota Lanka - Kurunegala</option>
                            <option value="Toyota Lanka - Matara">Toyota Lanka - Matara</option>
                            <option value="Toyota Lanka - Jaffna">Toyota Lanka - Jaffna</option>
                            <option value="Toyota Lanka - Anuradhapura">Toyota Lanka - Anuradhapura</option>
                            <option value="Toyota Lanka - Galle">Toyota Lanka - Galle</option>
                            <option value="Toyota Lanka - Negombo">Toyota Lanka - Negombo</option>
                            <option value="Toyota Lanka - Batticaloa">Toyota Lanka - Batticaloa</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="price_per_unit">Price per Unit</label>
                        <input type="number" step="0.01" class="form-control" id="price_per_unit" name="price_per_unit" required>
                    </div>

                    <div class="form-group">
                        <label for="last_ordered_date">Last Ordered Date</label>
                        <input type="date" class="form-control" id="last_ordered_date" name="last_ordered_date">
                    </div>

                    <button type="submit" class="btn btn-primary mt-5">Add Stock</button>
                </form>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
    </div>
</div>

<div class="modal fade" id="editStockModal" tabindex="-1" aria-labelledby="editStockModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editStockModalLabel">Edit Stock</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editStockForm" method="POST" action="">
                    @csrf
                    @method('PUT') <!-- This is important for PUT requests -->

                    <div class="form-group">
                        <label for="edit_part_name">Part Name</label>
                        <input type="text" class="form-control" id="edit_part_name" name="part_name" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_part_number">Part Number</label>
                        <input type="text" class="form-control" id="edit_part_number" name="part_number" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_manufacturer">Manufacturer</label>
                        <input type="text" class="form-control" id="edit_manufacturer" name="manufacturer" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_quantity_in_stock">Quantity in Stock</label>
                        <input type="number" class="form-control" id="edit_quantity_in_stock" name="quantity_in_stock" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_reorder_level">Reorder Level</label>
                        <input type="number" class="form-control" id="edit_reorder_level" name="reorder_level" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_warehouse_location">Warehouse Location</label>
                        <input type="text" class="form-control" id="edit_warehouse_location" name="warehouse_location" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_price_per_unit">Price per Unit</label>
                        <input type="number" class="form-control" id="edit_price_per_unit" name="price_per_unit" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_last_ordered_date">Last Ordered Date</label>
                        <input type="date" class="form-control" id="edit_last_ordered_date" name="last_ordered_date">
                    </div>

                    <div class="form-group">
                        <label for="edit_compatibility">Compatibility</label>
                        <div class="dropdown d-flex">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Select Compatibility
                            </button>
                            <div class="dropdown-menu">
                                <label><input type="checkbox" name="compatibility[]" value="Toyota Corolla"> Toyota Corolla</label>
                                <label><input type="checkbox" name="compatibility[]" value="Toyota Camry"> Toyota Camry</label>
                                <label><input type="checkbox" name="compatibility[]" value="Toyota Prius"> Toyota Prius</label>
                                <!-- Add more options as needed -->
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Stock</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- <h3>Stock List</h3> -->
<div class="table-responsive">
    <h2 class="mt-5">Available Stocks</h2>

    <!-- Filter form -->
    <form action="{{ route('stocks.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by Part Name" value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Part Name</th>
                <th>Part Number</th>
                <th>Manufacturer</th>
                <th>Compatibility</th>
                <th>Quantity in Stock</th>
                <th>Reorder Level</th>
                <th>Warehouse Location</th>
                <th>Price per Unit</th>
                <th>Last Ordered Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($stocks->isEmpty())
            <tr>
                <td colspan="10" class="text-center">No stocks available.</td>
            </tr>
            @else
            @foreach($stocks as $stock)
            <tr>
                <td>{{ $stock->id }}</td>
                <td>{{ $stock->part_name }}</td>
                <td>{{ $stock->part_number }}</td>
                <td>{{ $stock->manufacturer }}</td>
                <td>{{ $stock->compatibility }}</td>
                <td>{{ $stock->quantity_in_stock }}</td>
                <td>{{ $stock->reorder_level }}</td>
                <td>{{ $stock->warehouse_location }}</td>
                <td>LKR.{{ $stock->price_per_unit }}</td>
                <td>{{ $stock->last_ordered_date ? $stock->last_ordered_date->format('Y-m-d') : 'N/A' }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" onclick="openEditModal({{ json_encode($stock) }})">Edit</button>
                    <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this stock?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

    <!-- Pagination links -->
    <div class="d-flex justify-content-center">
        {{ $stocks->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>



<script>
    function openEditModal(stock) {
        // Populate the form fields in the modal with the stock data
        document.getElementById('edit_part_name').value = stock.part_name;
        document.getElementById('edit_part_number').value = stock.part_number;
        document.getElementById('edit_manufacturer').value = stock.manufacturer;
        document.getElementById('edit_quantity_in_stock').value = stock.quantity_in_stock;
        document.getElementById('edit_reorder_level').value = stock.reorder_level;
        document.getElementById('edit_warehouse_location').value = stock.warehouse_location;
        document.getElementById('edit_price_per_unit').value = stock.price_per_unit;
        document.getElementById('edit_last_ordered_date').value = stock.last_ordered_date ? stock.last_ordered_date.split(' ')[0] : '';

        // Handle the compatibility (assuming it's a comma-separated string)
        const compatibilityArray = stock.compatibility.split(',');
        document.querySelectorAll('input[name="compatibility[]"]').forEach((checkbox) => {
            checkbox.checked = compatibilityArray.includes(checkbox.value);
        });

        // Set the form action URL to the correct route for updating the stock
        document.getElementById('editStockForm').action = `/stocks/${stock.id}`; // Adjust the URL as necessary

        // Show the modal
        const modal = new bootstrap.Modal(document.getElementById('editStockModal'));
        modal.show();
    }
</script>


<script>
    function updateSelected() {
        // Get all checked checkboxes
        const selectedOptions = Array.from(document.querySelectorAll('input[name="compatibility[]"]:checked')).map(el => el.value);

        // Get the span to update
        const selectedValuesSpan = document.querySelector('.selected-values');

        // Update the displayed selected values
        selectedValuesSpan.textContent = selectedOptions.length > 0 ?
            'Selected: ' + selectedOptions.join(', ') :
            'Selected: None';
    }
</script>

@endsection