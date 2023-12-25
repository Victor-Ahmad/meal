<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $data = User::where('type','driver')->orderBy('id','DESC')->paginate(5);
        return view('admin.driver.index', compact('data'));
    }
}
