<?php

namespace App\Http\Controllers;

use App\Models\Returns;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ReturnsController extends Controller
{
    // Display all the returns
    public function index()
    {
        $returns = Returns::with('supplier')->paginate(4); // Use paginate() directly on the query
        $suppliers = Supplier::paginate(4); // Use paginate() directly on the query
        return view('returns.returns', compact('returns', 'suppliers'));
    }


    // Store a new return entry
    public function store(Request $request)
    {
        $request->validate([
            'quantity_returned' => 'required|integer',
            'return_date' => 'required|date',
            'reason_for_return' => 'required|string|max:255',
            'condition' => 'required|string|max:255',
            'returned_by' => 'required|string|max:255',
            'action_taken' => 'required|string|max:255',
            'supplier_id' => 'required|exists:suppliers,id', // Validate supplier_id exists in suppliers table
        ]);

        // Create the return entry
        Returns::create([
            'quantity_returned' => $request->input('quantity_returned'),
            'return_date' => $request->input('return_date'),
            'reason_for_return' => $request->input('reason_for_return'),
            'condition' => $request->input('condition'),
            'returned_by' => $request->input('returned_by'),
            'action_taken' => $request->input('action_taken'),
            'supplier_id' => $request->input('supplier_id'), // Add supplier_id to return entry
        ]);

        return redirect()->route('returns.index')->with('success', 'Return recorded successfully.');
    }

    // Update a return entry
    public function update(Request $request, Returns $return)
    {
        $request->validate([
            'quantity_returned' => 'required|integer',
            'return_date' => 'required|date',
            'reason_for_return' => 'required|string|max:255',
            'condition' => 'required|string|max:255',
            'returned_by' => 'required|string|max:255',
            'action_taken' => 'required|string|max:255',
            'supplier_id' => 'required|exists:suppliers,id', 
        ]);

        // Update the return entry
        $return->update([
            'quantity_returned' => $request->input('quantity_returned'),
            'return_date' => $request->input('return_date'),
            'reason_for_return' => $request->input('reason_for_return'),
            'condition' => $request->input('condition'),
            'returned_by' => $request->input('returned_by'),
            'action_taken' => $request->input('action_taken'),
            'supplier_id' => $request->input('supplier_id'), // Update supplier_id
        ]);

        return redirect()->route('returns.index')->with('success', 'Return updated successfully.');
    }

    // Delete a return entry
    public function destroy(Returns $return)
    {
        $return->delete();
        return redirect()->route('returns.index')->with('success', 'Return deleted successfully.');
    }
}
