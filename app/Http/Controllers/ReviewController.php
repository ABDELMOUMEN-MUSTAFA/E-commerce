<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReviewRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'comment' => 'required|string|min:3|max:200',
            'number_stars' => 'required|integer|min:1|max:5'
        ]);

        if(auth()->user()->reviews->where('product_id', session('product_id'))->count() > 0){
            return back()->with('message', "You can't add more than 1 review per product.");
        }

        $validated['user_id'] = auth()->user()->id;
        $validated['product_id'] = session('product_id');
        Review::create($validated);
        return back()->with('message', 'Review created successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReviewRequest  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
