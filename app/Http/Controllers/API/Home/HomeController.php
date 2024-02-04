<?php

namespace App\Http\Controllers\API\Home;

use App\Http\Controllers\API\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\OfferResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Company;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\error;

class HomeController extends ApiBaseController
{
    public function home()
    {
        $homeData = $this->getHomeData();
        return $this->successResponse($homeData);
    }

    protected function getHomeData()
    {
        $addresses = [];

        if (Auth::guard('sanctum')->check()) {
            $userId = Auth::guard('sanctum')->id();
            $addresses = AddressResource::collection(User::find($userId)->addresses);
        }
        // Fetch categories with their subcategories
        $categories = Category::with('subCategories')->get();
        $categoriesData = CategoryResource::collection($categories);

        // Fetch all offers with their associated products
        $offers = Offer::with('product')->get();
        $offersData = OfferResource::collection($offers);

        $companies = Company::get();
        $companiesData = CompanyResource::collection($companies);
        // Combine categories and offers data
        $homeData = [
            'categories' => $categoriesData,
            'offers' => $offersData,
            'companies' => $companiesData,
            'best_sellings' => $this->bestSelling(),
            'addresses' => $addresses,
        ];

        return $homeData;
    }

    protected function bestSelling()
    {
        $topSellingProductsIds = OrderItem::query()
            ->select('product_id', DB::raw('COUNT(*) as total_sales'))
            ->groupBy('product_id')
            ->orderBy('total_sales', 'DESC')
            ->take(5)
            ->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $topSellingProductsIds)->get();
        return ProductResource::collection($products);
    }
}
