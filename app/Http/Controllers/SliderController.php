<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\OurCollection;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.admin.sliders.index', ['sliders' => Slider::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|between:3,200',
            'title' => 'required|string|between:3,200',
            'description' => 'required|string|between:3,200',
            'photo' => 'required|image'
        ]);
        
        $validated['photo'] = 'storage/'.$request->photo->store('images/sliders', 'public');
        
        Slider::create($validated);
        return redirect()->route('sliders.index')->with('message', 'Slider created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('app.admin.sliders.edit', ['slider' => $slider]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'name' => 'required|string|between:3,200',
            'title' => 'required|string|between:3,200',
            'description' => 'required|string|between:3,200',
            'photo' => 'nullable|image'
        ]);

        if($request->hasFile('photo')){
            $validated['photo'] = 'storage/'.$request->photo->store('images/sliders', 'public');
        }

        Slider::where('id', $slider->id)->update($validated);
        return redirect()->route('sliders.index')->with('message', 'Slider updated successfully.'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect()->route('sliders.index')->with('message', 'Slider deleted successfully.');
    }

    public function ourCollection()
    {
        return view('app.admin.sliders.ourCollections.index', ['ourCollections' => OurCollection::all()]);
    }


    public function createCollection()
    {
        return view('app.admin.sliders.ourCollections.create');
    }

    public function storeCollection(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:big,small',
            'title' => 'required|string|between:3,100',
            'description' => 'required|string|between:3,100',
            'photo' => 'required|image'
        ]);

        $validated['photo'] = 'storage/'.$request->photo->store('images/ourCollections', 'public');

        OurCollection::create($validated);

        return redirect()->route('ourCollection')->with('message', 'Collection created successfully.');
    }

    public function editCollection(OurCollection $ourCollection)
    {
        return view('app.admin.sliders.ourCollections.edit', ['collection' => $ourCollection]);
    }

    public function updateCollection(Request $request, OurCollection $ourCollection)
    {
         $validated = $request->validate([
            'type' => 'required|in:big,small',
            'title' => 'required|string|between:3,100',
            'description' => 'required|string|between:3,100',
            'photo' => 'nullable|image'
        ]);

        if($request->hasFile('photo')){
            $validated['photo'] = 'storage/'.$request->photo->store('images/ourCollections', 'public');
        }

        OurCollection::where('id', $ourCollection->id)->update($validated);

        return redirect()->route('ourCollection')->with('message', 'Collection updated successfully.');
    }

    public function deleteCollection(OurCollection $ourCollection)
    {
        $ourCollection->delete();
        return redirect()->route('ourCollection')->with('message', 'Collection deleted successfully.');
    }
}
