<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    // Display the list of suppliers
    public function index()
    {
        $suppliers = Supplier::paginate(4); // Use paginate() directly on the query
        return view('Supply.supply', compact('suppliers'));
    }


    // Store a new supplier
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:suppliers',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'parts_supplied' => 'required|string|max:255',
            'lead_time' => 'required|integer',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        Supplier::create($validatedData);
        return redirect()->route('suppliers.index')->with('success', 'Supplier added successfully.');
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validatedData = $request->validate([
            'supplier_name' => 'sometimes|string|max:255',
            'contact_person' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255|unique:suppliers,email,' . $supplier->id,
            'phone_number' => 'sometimes|string|max:15',
            'address' => 'sometimes|string|max:255',
            'parts_supplied' => 'sometimes|string|max:255',
            'lead_time' => 'sometimes|integer',
            'rating' => 'sometimes|integer|min:1|max:5',
        ]);

        $supplier->update($validatedData);

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    // Delete a supplier
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}
