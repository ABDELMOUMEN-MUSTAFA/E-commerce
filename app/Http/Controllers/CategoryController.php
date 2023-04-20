<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.admin.categories.index', ['categories' => Category::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();
        if($request->hasFile('photo')){
            $validated['photo'] = 'storage/'.$request->photo->store('images/categories', 'public');
        }
    
        Category::create($validated);
        return redirect()->route('categories.index')->with('message', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('app.admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();
        if($request->hasFile('photo')){
            $category->photo = 'storage/'.$request->photo->store('images/categories', 'public');
        }

        $category->name = $validated['name'];
        $category->description = $validated['description'];
        $category->save();
        return redirect()->route('categories.index')->with('message', 'Category updated successfully.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('message', 'Category deleted successfully.');
    }


    public function toggleStatus(Category $category)
    {
        $category->status = !$category->status;
        $category->save();
        return redirect()->route('categories.index')->with('message', 'Category <strong>'.$category->name.'</strong> status changed successfully.');
    }
}
