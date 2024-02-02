<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::with('subCategories', 'products')->orderBy('id', 'DESC')->paginate(5);
        return view('admin.category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $baseSlug = Str::slug($request->name);
        $uniqueSlug = $baseSlug;
        $counter = 1;
        while (Category::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $baseSlug . '-' . $counter;
            $counter++;
        }
        Category::create([
            'name' => $request->name,
            'slug' => $uniqueSlug,
        ]);
        return redirect()->route('admin.category.index')->with('success', 'Category created successfully.');
    }

    public function edit($category)
    {
        $data = Category::where('id', decrypt($category))->first();
        return view('admin.category.edit', compact('data'));
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

        while (Category::where('slug', $uniqueSlug)->where('id', '!=', $request->id)->exists()) {
            $uniqueSlug = $baseSlug . '-' . $counter;
            $counter++;
        }
        $category = Category::find($request->id);
        if ($real_image = $request->file('image')) {
            // Old Image remove
            $category = Category::where('id', $request->id)->first();
            $image_path = public_path('category-image/' . $category->image);

            if ($category->image && file_exists($image_path)) {
                unlink($image_path);
            }
            // Added new image
            $categoryRealImage = 'category-image/';
            $realImage = $uniqueSlug . "." . $real_image->getClientOriginalExtension();
            $real_image->move($categoryRealImage, $realImage);
            $category->image = 'category-image/' . $realImage;
        }
        $category->name = $request->name;
        $category->slug = $uniqueSlug;
        $category->save();
        return redirect()->route('admin.category.index')->with('info', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        Category::where('id', decrypt($id))->delete();
        return redirect()->route('admin.category.index')->with('error', 'Category deleted successfully.');
    }
}
