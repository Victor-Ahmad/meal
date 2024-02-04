<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Address::with('user')->orderBy('id', 'DESC')->paginate(5);
        return view('admin.address.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('type', 'customer')->get();
        return view('admin.address.create', compact('users'));
    }

    public function showMap($id)
    {
        $address = Address::with('user')->find(decrypt($id));
        return view('admin.address.map', compact('address'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:255',
                'user' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
            ]);
            $baseSlug = Str::slug($request->name);
            $uniqueSlug = $baseSlug;
            $counter = 1;
            while (Address::where('slug', $uniqueSlug)->exists()) {
                $uniqueSlug = $baseSlug . '-' . $counter;
                $counter++;
            }
            Address::create([
                'user_id' => $request->user,
                'name' => $request->name,
                'slug' => $uniqueSlug,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,

            ]);
            return redirect()->route('admin.address.index')->with('success', 'Address created successfully.');
        } catch (\Exception $e) {
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
        }
    }

    public function edit($address)
    {
        $data = Address::with('user')->where('id', decrypt($address))->first();
        $users = User::where('type', 'customer')->get();
        return view('admin.address.edit', compact('data', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'user' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
        $baseSlug = Str::slug($request->name);
        $uniqueSlug = $baseSlug;
        $counter = 1;

        while (Address::where('slug', $uniqueSlug)->where('id', '!=', $request->id)->exists()) {
            $uniqueSlug = $baseSlug . '-' . $counter;
            $counter++;
        }

        Address::where('id', $request->id)->update([
            'user_id' => $request->user,
            'name' => $request->name,
            'slug' => $uniqueSlug,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
        return redirect()->route('admin.address.index')->with('info', 'Address updated successfully.');
    }

    public function destroy($id)
    {
        Address::where('id', decrypt($id))->delete();
        return redirect()->route('admin.address.index')->with('error', 'Address deleted successfully.');
    }
}
