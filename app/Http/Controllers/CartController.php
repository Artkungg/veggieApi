<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::with('orders')->get();
        return $cart;
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
     * @return Cart|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cart = new Cart;
        $cart->number = $request->input('number');
        $cart->order_date = $request->input('order_date');
        $cart->amount = $request->input('amount');
        $cart->status = $request->input('status');
        $cart->receive_date = $request->input('receive_date');
        $cart->save();
        return $cart;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\Response
     */
    public function show($id)
    {
        return Cart::with('orders')->findOrFail($id);
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
     * @return Cart|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->number = $request->input('number');
        $cart->order_date = $request->input('order_date');
        $cart->amount = $request->input('amount');
        $cart->status = $request->input('status');
        $cart->receive_date = $request->input('receive_date');
        $cart->save();
        return $cart;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
    }

    public function count($id){
        return Cart::findOrFail($id)->orders->count();
    }
}
