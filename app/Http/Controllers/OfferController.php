<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\OfferImage;
use App\Models\Product;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Offer::with(['product', 'images'])->orderBy('id', 'DESC')->paginate(5);
        return view('admin.offer.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.offer.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $request->validate([
                'name' => 'required',
                'product' => 'required',
                'offer_price' => 'required',
                'amount' => 'required',
            ]);

            $offer = Offer::create([
                'name' => $request->name,
                'product_id' => $request->product,
                'offer_price' => $request->offer_price,
                'amount' => $request->amount,

            ]);

            if ($request->hasFile('offer_images')) {
                foreach ($request->file('offer_images') as $image) {
                    $realImage = $request->name . "-" . rand(1, 9999) . "-" . date('d-m-Y-h-s') . "." . $image->getClientOriginalExtension();
                    $path = $image->move('offer-slider-images', $realImage);
                    OfferImage::create([
                        'offer_id' => $offer->id,
                        'image' => 'offer-slider-images/'.$realImage,
                    ]);
                }
            }
            return redirect()->route('admin.offer.index')->with('success', 'Offer created successfully.');
        } catch (\Exception $e) {
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            error_log('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            return redirect()->route('admin.offer.index')->with('error', 'Offer couldnt be created.');
        }
    }

    public function edit($offers)
    {
        $data = Offer::where('id', decrypt($offers))->first();
        return view('admin.offer.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'product' => 'required',
            'offer_price' => 'required',
            'amount' => 'required',
        ]);


        Offer::where('id', $request->id)->update([
            'name' => $request->name,
            'product_id' => $request->product,
            'offer_price' => $request->offer_price,
            'amount' => $request->amount,

        ]);
        return redirect()->route('admin.offer.index')->with('info', 'Offer updated successfully.');
    }

    public function destroy($id)
    {
        Offer::where('id', decrypt($id))->delete();
        return redirect()->route('admin.offer.index')->with('error', 'Offer deleted successfully.');
    }


    public function show($id)
    {
        $order = Offer::where('id', decrypt($id))->first();
        return view('admin.offer.show', compact('order'));
    }
}
