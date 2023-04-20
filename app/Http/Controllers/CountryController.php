<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.admin.users.countries.index', ['countries' => Country::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.admin.users.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCountryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
            'name' => 'required|between:3,70|regex:/^[a-zA-Z\s]+$/',
        ], ['name.regex' => 'Please entre a valid country name.']);

        Country::create($request->all());
        return redirect()->route('countries.index')->with('message', 'The country <strong>'.$request->name.'</strong> added successfully.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCountryRequest  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name' => 'required|between:3,70|regex:/^[a-zA-Z\s]+$/',
        ], ['name.regex' => 'Please entre a valid country name.']);

        $country->name = $request->name;
        $country->save();
        return response()->json(['message' => 'The country renamed to <strong>'.$country->name.'</strong> successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('countries.index')->with('message', 'The country <strong>'.$country->name.'</strong> deleted successfully.');
    }
}
