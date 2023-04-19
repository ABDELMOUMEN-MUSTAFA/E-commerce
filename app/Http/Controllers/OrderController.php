<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
        return view('app.products.orders.index', ['orders' => Order::all(), 'orderStatuses' => OrderStatus::all()]);
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
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('app.products.orders.show', ['order' => $order, 'orderStatuses' => OrderStatus::all()]);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
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
