@extends('dashboard')

@section('content')
<div class="stocks d-block">
    <h2>Add a new Supplier</h2>
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createSupplierModal">
        Add New Supplier
    </button>
</div>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<!-- Create Supplier Modal -->
<div class="modal fade" id="createSupplierModal" tabindex="-1" aria-labelledby="createSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createSupplierModalLabel">Add New Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('suppliers.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="supplier_name">Warehouse Location</label>
                        <select class="form-control" id="supplier_name" name="supplier_name" required>
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
                    <div class="mb-3">
                        <label for="contact_person" class="form-label">Contact Person</label>
                        <input type="text" class="form-control" id="contact_person" name="contact_person" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="parts_supplied" class="form-label">Parts Supplied</label>
                        <input type="text" class="form-control" id="parts_supplied" name="parts_supplied" required>
                    </div>
                    <div class="mb-3">
                        <label for="lead_time" class="form-label">Lead Time</label>
                        <input type="number" class="form-control" id="lead_time" name="lead_time" required>
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating (Optional)</label>
                        <input type="number" class="form-control" id="rating" name="rating" min="1" max="5">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Supplier</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Supplier Modal -->
<div class="modal fade modal" id="editSupplierModal" tabindex="-1" aria-labelledby="editSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editSupplierForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Form Fields as Provided -->
                    <div class="form-group">
                        <label for="edit_supplier_name">Warehouse Location</label>
                        <select class="form-control" id="edit_supplier_name" name="supplier_name" required>
                            <option value="" disabled>Select warehouse location</option>
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
                    <div class="mb-3">
                        <label for="edit_contact_person" class="form-label">Contact Person</label>
                        <input type="text" class="form-control" id="edit_contact_person" name="contact_person">
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="edit_phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="edit_phone_number" name="phone_number">
                    </div>
                    <div class="mb-3">
                        <label for="edit_address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="edit_address" name="address">
                    </div>
                    <div class="mb-3">
                        <label for="edit_parts_supplied" class="form-label">Parts Supplied</label>
                        <input type="text" class="form-control" id="edit_parts_supplied" name="parts_supplied">
                    </div>
                    <div class="mb-3">
                        <label for="edit_lead_time" class="form-label">Lead Time</label>
                        <input type="number" class="form-control" id="edit_lead_time" name="lead_time">
                    </div>
                    <div class="mb-3">
                        <label for="edit_rating" class="form-label">Rating (Optional)</label>
                        <input type="number" class="form-control" id="edit_rating" name="rating" min="1" max="5">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Supplier</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="table-responsive mt-5">
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Supplier Name</th>
                <th>Contact Person</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Parts Supplied</th>
                <th>Amount Sent</th>
                <th>Rating</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $supplier)
            <tr>
                <td>{{ $supplier->id }}</td>
                <td>{{ $supplier->supplier_name }}</td>
                <td>{{ $supplier->contact_person }}</td>
                <td><a href="{{ $supplier->email }}">{{ $supplier->email }}</a></td>
                <td>{{ $supplier->phone_number }}</td>
                <td>{{ $supplier->address }}</td>
                <td>{{ $supplier->parts_supplied }}</td>
                <td>{{ $supplier->lead_time }}</td>
                <td>{{ $supplier->rating }}</td>
                <td>
                    <!-- Edit Button -->
                    <button
                        class="btn btn-warning btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#editSupplierModal"
                        data-id="{{ $supplier->id }}"
                        data-supplier_name="{{ $supplier->supplier_name }}"
                        data-contact_person="{{ $supplier->contact_person }}"
                        data-email="{{ $supplier->email }}"
                        data-phone_number="{{ $supplier->phone_number }}"
                        data-address="{{ $supplier->address }}"
                        data-parts_supplied="{{ $supplier->parts_supplied }}"
                        data-lead_time="{{ $supplier->lead_time }}"
                        data-rating="{{ $supplier->rating }}">
                        Edit
                    </button>


                    <!-- Delete Button -->
                    <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this supplier?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $suppliers->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>
<script
    src="https://code.jquery.com/jquery-3.7.1.js"
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the modal and the form inside it
        var editSupplierModal = document.getElementById('editSupplierModal');
        var editSupplierForm = document.getElementById('editSupplierForm');
        
        // Listen for the modal show event
        editSupplierModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            var button = event.relatedTarget;

            // Extract info from data-* attributes
            var supplierId = button.getAttribute('data-id');
            var supplierName = button.getAttribute('data-supplier_name');
            var contactPerson = button.getAttribute('data-contact_person');
            var email = button.getAttribute('data-email');
            var phoneNumber = button.getAttribute('data-phone_number');
            var address = button.getAttribute('data-address');
            var partsSupplied = button.getAttribute('data-parts_supplied');
            var leadTime = button.getAttribute('data-lead_time');
            var rating = button.getAttribute('data-rating');

            // Populate the form fields with the supplier data
            document.getElementById('edit_supplier_name').value = supplierName;
            document.getElementById('edit_contact_person').value = contactPerson;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_phone_number').value = phoneNumber;
            document.getElementById('edit_address').value = address;
            document.getElementById('edit_parts_supplied').value = partsSupplied;
            document.getElementById('edit_lead_time').value = leadTime;
            document.getElementById('edit_rating').value = rating;

            // Set the form action to the correct route for updating the supplier
            editSupplierForm.action = '/suppliers/' + supplierId; // Adjust this route if needed
        });
    });
</script>


@endsection