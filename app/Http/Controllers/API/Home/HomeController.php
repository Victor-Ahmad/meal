<?php

namespace App\Http\Controllers\API\Home;

use App\Http\Controllers\API\Auth\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
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
        $categories = Category::with('subCategories')->get();
        $homeData = CategoryResource::collection($categories);


        return $homeData;
    }

    protected function getUserSpecificData($userId)
    {

        $userSpecificData = '';

        return $userSpecificData;
    }
}
