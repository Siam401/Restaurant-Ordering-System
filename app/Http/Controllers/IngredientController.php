<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredient;
use App\Unit;
use Session;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients=Ingredient::all();
        $units=Unit::all();

        return view('backend.ingredients.index',compact('ingredients','units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.ingredients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token');
        // dd($data);
        Ingredient::create($data);
        Session::flash('message','Ingredient created successfully');
        return redirect(route('ingredient.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ingredient=Ingredient::findOrFail($id);
        $units=Unit::all();
        return view('backend.ingredients.edit',compact('ingredient','units'));
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
        $ingredient=Ingredient::findOrfail($id);
        $data=$request->except('_token','_method');
        // dd($data);
        $ingredient->update($data);
        Session::flash('message','Updated successfully');
        return redirect(route('ingredient.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ingredient=Ingredient::findOrfail($id);
        $ingredient->delete();
        Session::flash('message','Deleted successfully');
        return redirect(route('ingredient.index'));
    }
}
