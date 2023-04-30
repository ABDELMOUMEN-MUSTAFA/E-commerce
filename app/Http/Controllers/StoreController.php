<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use App\Models\Category;
use App\Models\OurCollection;
use App\Models\Slider;

class StoreController extends Controller
{
    public function index()
    {
    	$bestSellingProducts = DB::table('products')
        ->select(DB::raw('COUNT(products.id) as numberDelivered, products.*, photos.source'))
        ->join('photos', 'products.id', '=', 'photos.product_id')
        ->join('order_product', 'products.id', '=', 'order_product.product_id')
        ->join('orders', 'order_product.order_id', '=', 'orders.id')
        ->where('order_status_id', 4)
        ->groupBy('products.id', 'photos.source')
        ->orderBy('numberDelivered', 'desc')
        ->take(8)
        ->get();

        $newArrivals = Product::orderBy('created_at', 'desc')->take(8)->get();
        $sliders = Slider::all();
        $ourCollections = OurCollection::all();

    	return view('public.index', compact('bestSellingProducts', 'newArrivals', 'sliders', 'ourCollections'));
    }

    public function addToShoppingCart(Request $request)
    {
    	$validated = $request->validate([
    		'product_id' => 'required|integer|exists:products,id',
    		'quantity' => 'required|integer|min:1|max:99999'
    	]);

    	$user = auth()->user();
    	// Check if the product already in a shopping cart, just need to update quantity
    	if($user->products->where('id', $validated['product_id'])->count() > 0){
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

    public function productDetails(Product $product)
    {
        session(['product_id' => $product->id]);
        $bestSellingProducts = DB::table('products')
        ->select(DB::raw('COUNT(products.id) as numberDelivered, products.*, photos.source'))
        ->join('photos', 'products.id', '=', 'photos.product_id')
        ->join('order_product', 'products.id', '=', 'order_product.product_id')
        ->join('orders', 'order_product.order_id', '=', 'orders.id')
        ->where('order_status_id', 4)
        ->groupBy('products.id', 'photos.source')
        ->orderBy('numberDelivered', 'desc')
        ->take(8)
        ->get();

        return view('app.customer.productDetails', compact('product', 'bestSellingProducts'));
    }

    public function filterByCategory($category)
    {
        if($category !== 'All'){
            $category = Category::where('name', $category)->first();
            if($category !== null){
                return Product::where('category_id', $category->id);
            }
        }

        return Product::where('category_id', '>', 0);
    }

    public function orderBy($criteria, $products)
    {
        if($criteria === 'name'){
            return $products->orderBy('name');
        }elseif ($criteria === 'price') {
            return $products->orderBy('price', 'desc');
        }else{
            return $products;
        }
    }

    public function filterByPriceMinMax($min, $max, $products)
    {
        if($min !== null && $max !== null){
            return $products->whereBetween('price', [$min, $max]);
        }

        return $products;
    }

    public function shop(Request $request, $category = 'All', $criteria = null, $minPrice = null, $maxPrice = null)
    {
        $products = $this->filterByCategory($category);
        $products = $this->filterByPriceMinMax($minPrice, $maxPrice, $products);
        $products = $this->orderBy($criteria, $products);
        $query = $request->get('query');
        if($query){
            $products = $products->where('name', 'LIKE', "%$query%")->paginate(10);
        }else{
            $products = $products->paginate(10);
        }

        $categories = Category::all();
        return view('app.customer.shop', compact('products', 'categories'));
    }
}
