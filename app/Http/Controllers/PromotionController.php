<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\Product;
use App\Http\Requests\StorePromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;

class PromotionController extends Controller
{

    public function create(Product $product)
    {
        return view('app.products.promotions.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePromotionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePromotionRequest $request, Product $product)
    {
        $validated = $request->validated();
                
        $validated['product_id'] = $product->id;
        Promotion::create($validated);
        return redirect()->route('products.show', $product->id)->with('message', 'The promotion created successfuly.');
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        return view('app.products.promotions.edit', compact('promotion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePromotionRequest  $request
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePromotionRequest $request, Promotion $promotion)
    {
        $validated = $request->validated();
        $promotion->start_date = $validated['start_date'];
        $promotion->end_date = $validated['end_date'];
        $promotion->discount = $validated['discount'];
        $promotion->save();

        return redirect()->route('products.show', $promotion->product->id)->with('message', 'The promotion updated successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return redirect()->route('products.show', $promotion->product->id)->with('message', 'The promotion deleted successfuly.');
    }

    public function clearExpired(Product $product)
    {
       $product->promotions->where('end_date', '<', now())->each->delete();
       return redirect()->route('products.show', $product->id)->with('message', 'The expired promotions are cleared successfuly.');
    }
}
