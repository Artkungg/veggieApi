<?php

namespace App\Http\Controllers;

use App\Models\Vegetable;
use Illuminate\Http\Request;

class VegetableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vegetable = Vegetable::get();
        return $vegetable;
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
     * @return Vegetable|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vegetable = new Vegetable;
        $vegetable->veg_name = $request->input('veg_name');
        $vegetable->veg_weight = $request->input('veg_weight');
        $vegetable->veg_price = $request->input('veg_price');
        $vegetable->description = $request->input('description');
        $vegetable->save();
        return $vegetable;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Vegetable::findOrFail($id);
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
        $vegetable = Vegetable::findOrFail($id);
        $vegetable->veg_name = $request->input('veg_name');
        $vegetable->veg_weight = $request->input('veg_weight');
        $vegetable->veg_price = $request->input('veg_price');
        $vegetable->description = $request->input('description');
        $vegetable->save();
        return $vegetable;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vegetable = Vegetable::findOrFail($id);
        $vegetable->delete();
    }

    public function getVeggie($name){
        $veggie = Vegetable::where('veg_name',$name)->get();
        return Vegetable::findOrFail($veggie[0]->id);
    }
}
