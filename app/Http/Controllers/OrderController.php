<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Order::with(['user', 'orderStatus', 'driver'])->orderBy('id', 'DESC')->paginate(5);
        return view('admin.orders.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orderStatuses = OrderStatus::all();
        $users = User::where('type', 'customer')->get();
        $drivers = User::where('type', 'driver')->get();
        $products = Product::all();
        return view('admin.orders.create', compact('drivers', 'orderStatuses', 'users', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'driver' => 'required',
            'orderStatus' => 'required',
            'products' => 'required|array',
            'amounts' => 'required|array',
        ]);

        $order = Order::create([
            'user_id' => $request->user,
            'driver_id' => $request->driver,
            'order_status_id' => $request->orderStatus,
        ]);
        foreach ($request->products as $key => $product) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product,
                'amount' => $request->amounts[$key],
            ]);
        }
        return redirect()->route('admin.orders.index')->with('success', 'Order created successfully.');
    }

    public function edit($orders)
    {
        $data = Order::where('id', decrypt($orders))->first();
        return view('admin.orders.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);


        Order::where('id', $request->id)->update([
            'name' => $request->name,

        ]);
        return redirect()->route('admin.orders.index')->with('info', 'Order updated successfully.');
    }

    public function destroy($id)
    {
        Order::where('id', decrypt($id))->delete();
        return redirect()->route('admin.orders.index')->with('error', 'Order deleted successfully.');
    }


    public function show($id)
    {
        $order = Order::with(['orderItems.product.subcategory.category'])->where('id', decrypt($id))->first();
        return view('admin.orders.show', compact('order'));
    }
    public function showMap($id)
    {

        return view('admin.orders.map');
    }
}
