<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageStoreRequest;
use App\Models\Service;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class InventoryController extends Controller
{
    public function __construct() {
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');
        $inventories = Inventory::all();
        return view('inventory.index', compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');
        $inventories = Inventory::all();
        return view('inventory.create', compact('inventories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');
        $inventory = Inventory::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'price' => $request->price
        ]);

        if ($request->has('inventory')) {
            $inventory->inventories()->attach($request->inventories);
        }

        return redirect()->route('inventory.index')->with('success', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');
        return view('inventory.edit', compact('inventory'));
    }
    
    public function update(Request $request, Inventory $inventory)
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');
        $request->validate([
            'name' => 'required|string',
            'quantity' => 'required|integer',
            'status' => 'required|string|in:Available,Unavailable',
            'price' => 'required|numeric|min:0.00|max:10000.00',
        ]);
    
        $inventory->update([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'price' => $request->price,
        ]);
    
        return redirect()->route('inventory.index')->with('success', 'Item updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (auth()->user()->role == 'customer')
        abort(403, 'This route is only meant for restaurant staffs.');
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();
        return redirect()->route('inventory.index')->with('danger', 'Item deleted successfully.');
    }
}
