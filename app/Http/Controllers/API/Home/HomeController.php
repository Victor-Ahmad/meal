<?php

namespace App\Http\Controllers\API\Home;

use App\Http\Controllers\API\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\OfferResource;
use App\Models\Category;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends ApiBaseController
{
    public function home()
    {
        $homeData = $this->getHomeData();
        if (Auth::check()) {
            $userId = Auth::id();
            $userSpecificData = $this->getUserSpecificData($userId);
            $homeData = array_merge($homeData, $userSpecificData);
        }

        return $this->successResponse($homeData);
    }

    protected function getHomeData()
    {

        // Fetch categories with their subcategories
        $categories = Category::with('subCategories')->get();
        $categoriesData = CategoryResource::collection($categories);

        // Fetch all offers with their associated products
        $offers = Offer::with('product')->get();
        $offersData = OfferResource::collection($offers);

        // Combine categories and offers data
        $homeData = [
            'categories' => $categoriesData,
            'offers' => $offersData
        ];

        return $homeData;
    }

    protected function getUserSpecificData($userId)
    {

        $userSpecificData = '';

        return $userSpecificData;
    }
}
