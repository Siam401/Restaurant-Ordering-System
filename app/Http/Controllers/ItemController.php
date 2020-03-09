<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Item;
use App\Ingredient;
use App\Itemingredient;
use App\Ipackage;
use App\Unit;
use Session;
use DB;
use Carbon\Carbon;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $items=Item::all();
        $items=DB::table('items')->get();
        $ingredients=Ingredient::all();
        $units=Unit::all();
        $ipackages=Ipackage::groupBy('packageid','packagename')->select('packageid','packagename')->get();
        // $items=DB::select( DB::raw("select * from items"));
        $categories=Category::all();

        return view('backend.items.index',compact('items','categories','ingredients','units','ipackages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('backend.items.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $current_date_time = Carbon::now()->toDateTimeString();
        $data=$request->except('_token');
        $categoryid=$data['categoryid'];
        $categoryid=explode("-", $data['categoryid']);
        $data['categoryid'] = $categoryid[0];
        // dd(is_null($data['ingredientid'][0]));
        // dd($data);
        if(is_null($data['ingredientid'][0]) and is_null($data['packageid'][0]))
        {
            Session::flash('error','ingredient and package both can not be empty !');
            return redirect(route('item.index'));
        }else{
            $item=Item::create($data);
            $itemid=$item->id;
            if(!is_null($data['packageid'][0]))
            {
                $packageid_array=$data['packageid'];
                $packagecount=count($packageid_array);
                for($i=0;$i<$packagecount;$i++){
                    $packageid=$data['packageid'][$i];
                    $packagequantity=$data['packagequantity'][$i];
    
                    DB::table("itemingredients")->insert(["itemid"=>$itemid,"packageid"=>$packageid,"packagequantity"=>$packagequantity,"created_at"=>$current_date_time,"updated_at"=>$current_date_time]);
                }
            }
            if(!is_null($data['ingredientid'][0]))
            {
                $ingredientid_array=$data['ingredientid'];
                $ingredientcount=count($ingredientid_array);
                for($i=0;$i<$ingredientcount;$i++){
                    $ingredientid=$data['ingredientid'][$i];
                    $ingredientunit=$data['ingredientunit'][$i];
                    $ingredientquantity=$data['ingredientquantity'][$i];
    
                    DB::table("itemingredients")->insert(["itemid"=>$itemid,"ingredientid"=>$ingredientid,"ingredientunit"=>$ingredientunit,"ingredientquantity"=>$ingredientquantity,"created_at"=>$current_date_time,"updated_at"=>$current_date_time]);
                }
            }
        }
        
        Session::flash('message','Item created successfully');
        return redirect(route('item.index'));
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
        $item=Item::findOrFail($id);
        $categories=Category::all();

        return view('backend.items.edit',compact('item','categories'));
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
        $item=Item::findOrfail($id);
        $data=$request->except('_token','_method');
        $item->update($data);
        Session::flash('message','Updated successfully');
        return redirect(route('item.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('itemingredients')->where('itemid', $id)->delete();
        // dd($itemingredients);
        $item=Item::findOrfail($id);
        $item->delete();
        Session::flash('message','Deleted successfully');
        return redirect(route('item.index'));
    }
}
