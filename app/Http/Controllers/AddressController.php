<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|between:3,250',
            'city' => 'required|string|between:3,100',
            'postal_code' => 'required|integer|regex:/^[0-9]{3,6}$/'
        ]);

        $validated['user_id'] = auth()->user()->id;

        Address::create($validated);
        return back()->with('message', 'Address added successfuly.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        $validated = $request->validate([
            'address' => 'required|string|between:3,250',
            'city' => 'required|string|between:3,100',
            'postal_code' => 'required|integer|regex:/^[0-9]{3,6}$/'
        ]);

        $address->address = $validated['address'];
        $address->city = $validated['city'];
        $address->postal_code = $validated['postal_code'];
        $address->user_id = auth()->user()->id;

        return back()->with('message', 'Address updated successfuly.');
    }
}
