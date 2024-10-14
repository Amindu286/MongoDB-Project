<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the search term from the request
        $search = $request->input('search');

        // Modify the query to filter based on part name if search is provided
        $stocks = Stock::when($search, function ($query, $search) {
            return $query->where('part_name', 'like', '%' . $search . '%');
        })->paginate(4);

        // Return view with stocks and search term
        return view('stocks.stocks', compact('stocks'));

        $lowStockItems = Stock::whereRaw([
            'quantity_in_stock' => ['$lt' => ['$reorder_level']]
        ])->get();

        return view('dashboard', compact('lowStockItems'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd("Hi");
        $validatedData = $request->validate([
            'part_name' => 'required|string|max:255',
            'part_number' => 'required|string|max:255|unique:available_stocks',
            'manufacturer' => 'required|string|max:255',
            'compatibility' => 'required|array', 
            'quantity_in_stock' => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'warehouse_location' => 'required|string|max:255',
            'price_per_unit' => 'required|numeric|min:0',
            'last_ordered_date' => 'nullable|date',
        ]);

        // dd($validatedData);  
        Stock::create([
            'part_name' => $validatedData['part_name'],
            'part_number' => $validatedData['part_number'],
            'manufacturer' => $validatedData['manufacturer'],
            'compatibility' => implode(',', $validatedData['compatibility']),
            'quantity_in_stock' => $validatedData['quantity_in_stock'],
            'reorder_level' => $validatedData['reorder_level'],
            'warehouse_location' => $validatedData['warehouse_location'],
            'price_per_unit' => $validatedData['price_per_unit'],
            'last_ordered_date' => $validatedData['last_ordered_date'],
        ]);


        return redirect()->back()->with('success', 'Post created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Stock $stocks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stocks)
    {
        // Pass the stock to the edit view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        $validatedData = $request->validate([
            'part_name' => 'required|string|max:255',
            'part_number' => 'required|string|max:255|unique:stocks,part_number,' . $stock->id,
            'manufacturer' => 'required|string|max:255',
            'compatibility' => 'required|array', // Ensure compatibility is an array
            'quantity_in_stock' => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'warehouse_location' => 'required|string|max:255',
            'price_per_unit' => 'required|numeric|min:0',
            'last_ordered_date' => 'nullable|date',
        ]);

        // dd($validatedData);
        $stock->update([
            'part_name' => $validatedData['part_name'],
            'part_number' => $validatedData['part_number'],
            'manufacturer' => $validatedData['manufacturer'],
            'compatibility' => implode(',', $validatedData['compatibility']),
            'quantity_in_stock' => $validatedData['quantity_in_stock'],
            'reorder_level' => $validatedData['reorder_level'],
            'warehouse_location' => $validatedData['warehouse_location'],
            'price_per_unit' => $validatedData['price_per_unit'],
            'last_ordered_date' => $validatedData['last_ordered_date'],
        ]);

        // dd($stock);
        return redirect()->back()->with('success', 'Stock updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect()->back()->with('success', 'Stock deleted successfully.');
    }
}
