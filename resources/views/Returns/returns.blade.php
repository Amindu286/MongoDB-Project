@extends('dashboard')

@section('content')
<h2>Return Stocks</h2>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<!-- Button to trigger Create Modal -->
<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createReturnModal">
    Add New Return
</button>

<div class="table-responsive">
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Quantity Returned</th>
                <th>Return Date</th>
                <th>Reason</th>
                <th>Condition</th>
                <th>Returned By</th>
                <th>Supplier</th>
                <th>Action Taken</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($returns as $return)
            <tr>
                <td>{{ $return->id }}</td>
                <td>{{ $return->quantity_returned }}</td>
                <td>{{ $return->return_date }}</td>
                <td>{{ $return->reason_for_return }}</td>
                <td>{{ $return->condition }}</td>
                <td>{{ $return->returned_by }}</td>
                <td>{{ $return->supplier->supplier_name }} by {{ $return->supplier->contact_person }}</td> <!-- No need to loop suppliers -->
                <td>{{ $return->action_taken }}</td>
                <td>
                    <!-- Edit Button -->
                    <button class="btn btn-warning btn-sm" onclick="openEditModal({{ json_encode($return) }})" data-bs-toggle="modal" data-bs-target="#editReturnModal">Edit</button>

                    <!-- Delete Form -->
                    <form action="{{ route('returns.destroy', $return->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this return?');">
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
        {{ $returns->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>


<!-- Create Return Modal -->
<div class="modal fade" id="createReturnModal" tabindex="-1" aria-labelledby="createReturnModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createReturnModalLabel">Add New Return</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('returns.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="quantity_returned" class="form-label">Quantity Returned</label>
                        <input type="number" class="form-control" id="quantity_returned" name="quantity_returned" required>
                    </div>
                    <div class="mb-3">
                        <label for="return_date" class="form-label">Return Date</label>
                        <input type="date" class="form-control" id="return_date" name="return_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="reason_for_return" class="form-label">Reason for Return</label>
                        <select class="form-control" id="reason_for_return" name="reason_for_return" required>
                            <option value="">Select reason</option>
                            <option value="Damaged">Damaged</option>
                            <option value="Expired">Expired</option>
                            <option value="Defective">Defective</option>
                            <option value="Wrong Item">Wrong Item</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="condition" class="form-label">Condition</label>
                        <select class="form-control" id="condition" name="condition" required>
                            <option value="">Select condition</option>
                            <option value="New">New</option>
                            <option value="Used">Used</option>
                            <option value="Sealed">Sealed</option>
                            <option value="Opened">Opened</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="returned_by" class="form-label">Returned By</label>
                        <select class="form-control" id="returned_by" name="returned_by" required>
                            <option value="">Select person</option>
                            <option value="Saman Indika">Saman Indika</option>
                            <option value="Nimal Perera">Nimal Perera</option>
                            <option value="John Silva">John Silva</option>
                            <option value="Malani Fernando">Malani Fernando</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="supplier_id" class="form-label">Supplier</label>
                        <select class="form-control" id="supplier_id" name="supplier_id" required>
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }} by {{ $supplier->contact_person }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="action_taken" class="form-label">Action Taken</label>
                        <select class="form-control" id="action_taken" name="action_taken" required>
                            <option value="">Select an action</option>
                            <option value="Discarded">Discarded</option>
                            <option value="Restocked">Restocked</option>
                            <option value="Repaired">Repaired</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Return</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Return Modal -->
<div class="modal fade" id="editReturnModal" tabindex="-1" aria-labelledby="editReturnModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editReturnModalLabel">Edit Return</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editReturnForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="edit_return_id" name="return_id">
                    <div class="mb-3 d-none">
                        <label for="edit_part_id" class="form-label">Part ID</label>
                        <input type="text" class="form-control" id="edit_part_id" name="part_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_quantity_returned" class="form-label">Quantity Returned</label>
                        <input type="number" class="form-control" id="edit_quantity_returned" name="quantity_returned" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_return_date" class="form-label">Return Date</label>
                        <input type="date" class="form-control" id="edit_return_date" name="return_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_reason_for_return" class="form-label">Reason for Return</label>
                        <input type="text" class="form-control" id="edit_reason_for_return" name="reason_for_return" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_condition" class="form-label">Condition</label>
                        <input type="text" class="form-control" id="edit_condition" name="condition" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_returned_by" class="form-label">Returned By</label>
                        <input type="text" class="form-control" id="edit_returned_by" name="returned_by" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_action_taken" class="form-label">Action Taken</label>
                        <input type="text" class="form-control" id="edit_action_taken" name="action_taken" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Update Return</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openEditModal(returnData) {
        // Populate the edit form with existing data
        document.getElementById('edit_return_id').value = returnData.id;
        document.getElementById('edit_part_id').value = returnData.part_id;
        document.getElementById('edit_quantity_returned').value = returnData.quantity_returned;
        document.getElementById('edit_return_date').value = returnData.return_date;
        document.getElementById('edit_reason_for_return').value = returnData.reason_for_return;
        document.getElementById('edit_condition').value = returnData.condition;
        document.getElementById('edit_returned_by').value = returnData.returned_by;
        document.getElementById('edit_action_taken').value = returnData.action_taken;

        // Set the form action to the update route
        document.getElementById('editReturnForm').action = '/returns/' + returnData.id;
    }
</script>
@endsection