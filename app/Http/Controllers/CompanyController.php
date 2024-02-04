<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Company::with('products')->orderBy('id', 'DESC')->paginate(5);
        return view('admin.company.index', compact('data'));
    }

    public function create()
    {
        return view('admin.company.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $baseSlug = Str::slug($request->name);
        $uniqueSlug = $baseSlug;
        $counter = 1;
        while (Company::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $baseSlug . '-' . $counter;
            $counter++;
        }
        Company::create([
            'name' => $request->name,
            'slug' => $uniqueSlug,
        ]);
        return redirect()->route('admin.company.index')->with('success', 'Company created successfully.');
    }
    public function edit($company)
    {
        $data = Company::where('id', decrypt($company))->first();
        return view('admin.company.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $baseSlug = Str::slug($request->name);
        $uniqueSlug = $baseSlug;
        $counter = 1;

        while (Company::where('slug', $uniqueSlug)->where('id', '!=', $request->id)->exists()) {
            $uniqueSlug = $baseSlug . '-' . $counter;
            $counter++;
        }
        $category = Company::find($request->id);
        $category->name = $request->name;
        $category->slug = $uniqueSlug;
        $category->save();
        return redirect()->route('admin.company.index')->with('info', 'Company updated successfully.');
    }
    public function destroy($id)
    {
        Company::where('id', decrypt($id))->delete();
        return redirect()->route('admin.company.index')->with('error', 'Company deleted successfully.');
    }
}
