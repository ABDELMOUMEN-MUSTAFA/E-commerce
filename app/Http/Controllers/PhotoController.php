<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Product;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function create(Product $product)
    {
        return view('app.admin.products.photos.create', compact('product'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'bail|required|numeric|exists:products,id',
            'photos' => 'required|image|between:2,10000'
        ]);

        if($request->hasFile('photos')){
            $source = 'storage/'.$request->photos->store('images/products/photos/'.$validated['product_id'], 'public');
            $photo = new Photo;
            $photo->product_id = $validated['product_id'];
            $photo->source = $source;
            $photo->is_primary = false;
            $photo->save();

            return response()->json([
                "message" => "The Photo ".$request->photos->getClientOriginalName()." uploaded successfully."
            ]);
        }else{
            abort(400);
        }
    }
    
    public function destroy(Photo $photo)
    {
        $photo->delete();
        return redirect()->back()->with('message', 'The Photo deleted successfully.');
    }

    public function uploadPhotos(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'bail|required|numeric|exists:products,id',
            'photos' => 'image|between:2,10000'
        ]);

        if($request->hasFile('photos')){
            $source = 'storage/'.$request->photos->store('images/products/'.$validated['product_id'], 'public');
            $photo = new Photo;
            $photo->product_id = $validated['product_id'];
            $photo->source = $source;
            $photo->is_primary = false;
            $photo->save();

            return response()->json([
                "message" => "The Photo ".$request->photos->getClientOriginalName()." uploaded successfully."
            ]);
        }else{
            abort(400);
        }
    }

    public function makePhotoPrimary(Product $product, Photo $photo)
    {
        if($product->photos->where('id', $photo->id)->count()){
            Photo::where('product_id', $product->id)->where('is_primary', true)->update(['is_primary' => false]);
            $photo->is_primary = true;
            $photo->save();
            return redirect()->back()->with('message', 'The Photo you choose is primary now.');
        }
    }
}
