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
        $vegetable->name = $request->input('name');
        $vegetable->weight = $request->input('weight');
        $vegetable->price = $request->input('price');
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
        $vegetable->name = $request->input('name');
        $vegetable->weight = $request->input('weight');
        $vegetable->price = $request->input('price');
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
        $veggie = Vegetable::where('name',$name)->get();
        return Vegetable::findOrFail($veggie[0]->id);
    }
}
