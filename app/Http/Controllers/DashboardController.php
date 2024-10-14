<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\User;

class DashboardController extends Controller
{

    public function showAvailableStocks()
    {
        return view('stocks.stocks'); // Adjust the path to your stocks.blade.php
    }

    public function showExtraStocks()
    {
        return view('extras.extras'); // Adjust the path to your stocks.blade.php
    }

    public function showReturnStocks()
    {
        return view('returns.returns'); // Adjust the path to your stocks.blade.php
    }

    public function showSupplyyStocks()
    {
        return view('supply.supply'); // Adjust the path to your stocks.blade.php
    }

    public function index()
    {
        // Query for low stock items
        $lowStockItems = Stock::whereRaw([
            '$expr' => [
                '$lt' => [
                    ['$toInt' => '$quantity_in_stock'],
                    ['$toInt' => '$reorder_level']
                ]
            ]
        ])->get();

        // Fetch supplier names and emails
        $suppliers = Supplier::select('supplier_name', 'email')->get();
        $users = User::select('name', 'email')->get();

        // Aggregate stock quantities by part name
        $stockData = Stock::select('part_name', 'quantity_in_stock')
            ->get()
            ->groupBy('part_name')
            ->map(function ($items) {
                return $items->sum('quantity_in_stock');
            })
            ->toArray();

        // Pass both $lowStockItems, $suppliers, and $stockData to the view
        return view('dashboard', compact('lowStockItems', 'suppliers', 'stockData','users'));
    }
}
