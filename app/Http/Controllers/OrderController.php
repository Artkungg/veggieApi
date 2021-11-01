<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Vegetable;
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
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return Order|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order();
        $order->cart_id = $request->input('cart_id');
        $order->vegetable_id = $request->input('vegetable_id');
        $order->name = $request->input('name');
        $order->total_weight = $request->input('total_weight');
        $order->total_price = $request->input('total_price');
        $order->save();
        return $order;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Order::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->cart_id = $request->input('cart_id');
        $order->name = $request->input('name');
        $order->total_weight = $request->input('total_weight');
        $order->total_price = $request->input('total_price');
        $order->save();
        return $order;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
    }

    public function getAmount($id){
        return Order::where('cart_id',$id)->sum('total_price');
    }
}
