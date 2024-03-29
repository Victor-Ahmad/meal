<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Company;
use App\Models\Offer;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $userCount = User::count();
        view()->share('userCount', $userCount);

        $driversCount = User::where('type', 'driver')->count();
        view()->share('driversCount', $driversCount);

        $RoleCount = Role::count();
        view()->share('RoleCount', $RoleCount);

        $PermissionCount = Permission::count();
        view()->share('PermissionCount', $PermissionCount);

        $CompanyCount = Company::count();
        view()->share('CompanyCount', $CompanyCount);

        $CategoryCount = Category::count();
        view()->share('CategoryCount', $CategoryCount);

        $SubCategoryCount = SubCategory::count();
        view()->share('SubCategoryCount', $SubCategoryCount);

        // $CollectionCount = Collection::count();
        // view()->share('CollectionCount',$CollectionCount);

        $ProductCount = Product::count();
        view()->share('ProductCount', $ProductCount);

        $OffersCount = Offer::count();
        view()->share('OffersCount', $OffersCount);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }
}
