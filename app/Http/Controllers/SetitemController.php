<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Item;
use App\Setitem;
use Session;
use DB;

class SetitemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setitems=Setitem::all();
        $items=Item::all();

        return view('backend.setitems.index',compact('setitems','items'));
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token');
        if(count($data)>4){
            $setname=$data['setname'];
            $price=$data['price'];
            $price=$data['quantity'];
            $fixeditem = $data['fixeditem'];
            $fixeditem=implode( ",", $fixeditem );
            // dd(count($data));
            $selecteditem = $data['selecteditem'];
            $selecteditem=implode( ",", $selecteditem );
            // dd($fixeditem);
            DB::table('setitems')->insert([
                'setname' => $setname, 
                'fixeditem' => $fixeditem, 
                'selecteditem' => $selecteditem, 
                'price' => $price
                ]);
        }else{
            $setname=$data['setname'];
            $price=$data['price'];
            $price=$data['quantity'];
            $fixeditem = $data['fixeditem'];
            $fixeditem=implode( ",", $fixeditem );
            DB::table('setitems')->insert([
                'setname' => $setname, 
                'fixeditem' => $fixeditem, 
                'price' => $price
                ]);
        }        
        Session::flash('message','Set Item created successfully');
        return redirect(route('setitem.index'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
    }
}
