<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Coupon;
use App\Models\OrderStatus;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.admin.products.orders.index', ['orders' => Order::all(), 'orderStatuses' => OrderStatus::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'nullable|alpha_num:ascii|exists:coupons,code|max:20|min:6'
        ]);

        // get all products in shopping cart
        $productsInShoppingCart = auth()->user()->products;

        if(count($productsInShoppingCart) < 1){
            return back()->with('messageError', 'Order not created, because your shopping cart is empty.');
        }

        $order = Order::create(['user_id' => auth()->user()->id]);

        if(isset($request->code)){
            $coupon = Coupon::where('code', $request->code)->first();
            foreach ($productsInShoppingCart as $product) {
                if($product->id === $coupon->product_id){
                    $order->products()->attach([
                            $product->id => [
                                'quantity' => $product->pivot->quantity,
                                'unit_price' => substr($product->price, 1) * $coupon->discount * 0.01
                            ]
                        ]
                    );
                }else{
                    $order->products()->attach([
                            $product->id => [
                                'quantity' => $product->pivot->quantity,
                                'unit_price' => substr($product->price, 1)
                            ]
                        ]
                    );
                }  
            }
            $coupon->usage_limit -= 1;
            $coupon->save();
        }else{
            foreach ($productsInShoppingCart as $product) {
                $order->products()->attach([
                        $product->id => [
                            'quantity' => $product->pivot->quantity,
                            'unit_price' => substr($product->price, 1)
                        ]
                    ]
                );  
            }
        }

        return back()->with('message', 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('app.admin.products.orders.show', ['order' => $order, 'orderStatuses' => OrderStatus::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    public function cancelOrder(Order $order)
    {
        $order->order_status_id = 5;
        $order->cancelled_at = now();
        $order->save();
        return back()->with('message', 'Order cancelled successfully.');
    }

    public function changeOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status_id' => 'bail|required|integer|gt:1|exists:order_statuses,id'
        ]);

        switch ($request->input('status_id')) {
            case 2:
                $order->processed_at = now();
                break;
            case 3:
                $order->shipped_at = now();
                break;
            case 4:
                $order->delivered_at = now();
                break;
            default:
                $order->cancelled_at = now();
                break;
        }

        $order->order_status_id = $request->input('status_id');
        $order->save();
        return response()->json([
            'message' => "The order is changed to ".$order->orderStatus->status." successfully."
        ]);
    }
}
