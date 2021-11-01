<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index($id)
    {
//        $user = User::findOrFail($id);
//        if($user->role === 'CUSTOMER'){
//            $cart = Cart::where('user_id',$id)->with('orders')->get();
//        }
//        else{
//            $cart = Cart::with('orders')->get();
//        }
        $carts = Cart::where([['user_id',$id],['status','!=','cancel']])->with('orders')->get();
        return $carts;
    }

    public function getFromDate($id)
    {
        //get today
        if($id == 1){
            $today = Carbon::today()->format('Y-m-d');
            $carts = Cart::where('created_at','>=',$today)->where('status','success')->get();
            $sum = Cart::where('created_at','>=',$today)->where('status','success')->sum('amount');
        }

        //this week
        elseif($id == 2) {
            $today = Carbon::today();
            $weekStartDate = $today->startOfWeek()->format('Y-m-d');
            $weekEndDate = $today->endOfWeek()->format('Y-m-d');
            $carts = Cart::where([['created_at', '>=', $weekStartDate],['created_at', '<=', $weekEndDate]])
                            ->where('status','success')->get();
            $sum = Cart::where([['created_at', '>=', $weekStartDate],['created_at', '<=', $weekEndDate]])
                ->where('status','success')->sum('amount');
        }

        //this month
        elseif($id == 3){
            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now()->endOfMonth();
            $carts = Cart::where([['created_at','>=',$start],['created_at','<=',$end]])
                ->where('status','success')->get();
            $sum = Cart::where([['created_at','>=',$start],['created_at','<=',$end]])
                ->where('status','success')->sum('amount');
        }

        //show all cart list
        else{
            $carts = Cart::where('status','success')->get();
            $sum = Cart::where('status','success')->sum('amount');
        }

        $response = [
            'carts' => $carts,
            'sum' => $sum
        ];

        return $response;
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
        $cart->user_id = $request->input('user_id');
        $cart->number = $request->input('number');
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
        $cart = Cart::with('orders')->findOrFail($id);
//        $this->authorize('view',$cart);
        return $cart;
    }

    public function showByCartStatus($type)
    {
        if($type == 1) {
            $cart = Cart::where('status','pending confirm')->with('orders')->get();
        }
        elseif ($type == 2){
            $cart = Cart::where('status','Delivery')->with('orders')->get();
        }
        elseif ($type == 3){
            $cart = Cart::where('status','Pick up')->with('orders')->get();
        }
        elseif ($type == 4){
            $cart = Cart::with('orders')->get();
        }
        return $cart;
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
        $cart->user_id = $request->input('user_id');
        $cart->number = $request->input('number');
        $cart->amount = $request->input('amount');
        $cart->status = $request->input('status');
        $cart->receive_date = $request->input('receive_date');
        $cart->save();
        return $cart;
    }

    public function pay(Request $request, $id){
        $cart = Cart::findOrFail($id);
        $cart->customer_name = $request->input('customer_name');
        $cart->address = $request->input('address');
        $cart->phone_number = $request->input('phone_number');
        $cart->status = $request->input('status');
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
