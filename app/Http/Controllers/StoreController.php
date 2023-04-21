<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class StoreController extends Controller
{
    public function index()
    {
    	$products = Product::all();
    	return view('public.index', compact('products'));
    }

    public function addToShoppingCart(Request $request)
    {
    	$validated = $request->validate([
    		'product_id' => 'required|integer|exists:products,id',
    		'quantity' => 'required|integer|min:1|max:99999'
    	]);

    	$user = auth()->user();
    	// Check if the product already in a shopping cart, just need to update quantity
    	if($user->products->where('id', $validated['product_id'])->exists()){
    		return response()->json(['message' => 'Product already in your shopping cart'], 400); 
    	}

    	$user->products()->attach($validated['product_id'], ['quantity' => $validated['quantity']]);
    	return response()->json(['message' => 'Product Added Successfully to your shopping cart']);
    }

    public function updateShoppingCart(Request $request)
    {
    	$validated = $request->validate([
    		"product_id" => "required|integer|exists:product_user,product_id",
    		"quantity" => "required|integer|min:1|max:99999"
    	]);

    	auth()->user()->products()->updateExistingPivot($validated['product_id'], ['quantity' => $validated['quantity']], false);
    	return response()->json(['message' => "Updated Successfully."]);
    }

    public function removeProductFromShoppingCart(Product $product)
    {
    	auth()->user()->products()->detach($product->id);
    	return response()->json(['message' => 'Product Removed from shopping cart Successfully.']); 
    }

    public function clearAllShoppingCart()
    {
    	auth()->user()->products()->sync([]);
    	return response()->json(['message' => 'Shopping cart cleared.']); 
    }
}
