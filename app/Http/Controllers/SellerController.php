<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index()
    {
        $data = User::where('type', 'seller')->orderBy('id', 'DESC')->paginate(5);
        return view('admin.seller.index', compact('data'));
    }
}
