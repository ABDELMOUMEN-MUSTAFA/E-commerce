<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.admin.products.coupons.index', ['coupons' => Coupon::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.admin.products.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCouponRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCouponRequest $request)
    {
        $validated = $request->validated();
        if($validated['code'] === null){
            $validated['code'] = $this->generateCouponCode();
        }
        Coupon::create($validated);
        return redirect()->route('coupons.index')->with('message', 'The coupon <strong>'.$validated['code'].'</strong> created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return view('app.admin.products.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCouponRequest  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        $validated = $request->validated();
        $coupon->usage_limit = $validated['usage_limit'];
        $coupon->expiration_date = $validated['expiration_date'];
        $coupon->discount = $validated['discount'];
        $coupon->save();
        return redirect()->route('coupons.index')->with('message', 'The coupon '.$coupon->code.' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('coupons.index')->with('message', 'The coupon '.$coupon->code.' deleted successfully.');
    }

    private function generateCouponCode()
    {
        do {
            $generatedCoupon = Str::random(6);
        } while(Coupon::where('code', $generatedCoupon)->exists());
        return $generatedCoupon;
    }

    public function toggleStatus(Coupon $coupon)
    {
        $coupon->is_active = !$coupon->is_active;
        $coupon->save();
        return redirect()->route('coupons.index')->with('message', 'The coupon <strong>'.$coupon->code.'</strong> status changed successfully.');
    }

    public function checkCoupon(Coupon $coupon){
        if($coupon->is_active === false || $coupon->usage_limit === 0 || $coupon->expiration_date < now()){
            abort(404);
        }

        return response()->json(['message' => 'coupon successfully applied, place now your order.']);
    }
}
