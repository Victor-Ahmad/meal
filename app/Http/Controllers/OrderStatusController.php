<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = OrderStatus::orderBy('id', 'DESC')->paginate(5);
        return view('admin.statuses.orderStatus.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.statuses.orderStatus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        OrderStatus::create([
            'name' => $request->name,

        ]);
        return redirect()->route('admin.orderStatus.index')->with('success', 'OrderStatus created successfully.');
    }

    public function edit($orderStatus)
    {
        $data = OrderStatus::where('id', decrypt($orderStatus))->first();
        return view('admin.statuses.orderStatus.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);


        OrderStatus::where('id', $request->id)->update([
            'name' => $request->name,

        ]);
        return redirect()->route('admin.orderStatus.index')->with('info', 'OrderStatus updated successfully.');
    }

    public function destroy($id)
    {
        OrderStatus::where('id', decrypt($id))->delete();
        return redirect()->route('admin.orderStatus.index')->with('error', 'OrderStatus deleted successfully.');
    }
}
