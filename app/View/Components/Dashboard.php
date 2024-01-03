<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Dashboard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $users = User::count();
        view()->share('users', $users);

        // $category = Category::count();
        // view()->share('category', $category);

        // $product = Product::count();
        // view()->share('product', $product);

        $orders = Order::count();
        view()->share('orders', $orders);

        $today = Carbon::now('Asia/Riyadh')->toDateString();
        $newOrders = Order::whereDate('created_at', $today)->count();
        view()->share('newOrders', $newOrders);

        $canceledOrders = Order::where('order_status_id', 5)->count();
        view()->share('canceledOrders', $canceledOrders);

        // $collection = Collection::count();
        // view()->share('collection',$collection);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard');
    }
}
