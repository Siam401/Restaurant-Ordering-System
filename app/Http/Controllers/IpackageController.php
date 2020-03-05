<?php

namespace App\Http\Controllers;
use App\Ingredient;
use App\Unit;
use App\Ipackage;
use Session;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IpackageController extends Controller
{
    public function index(){
        $ingredients=Ingredient::all();
        $units=Unit::all();
        $ipackages=Ipackage::groupBy('packageid','packagename')->select('packageid','packagename')->get();
        return view('backend.ipackages.index',compact('ingredients','units','ipackages'));
    }

    public function store(Request $request)
    {
        $Ipackage=new Ipackage;
        $data=$request->except('_token');
        $current_date_time = Carbon::now()->toDateTimeString();
        $packageid=$data['packageid'];
        $packagename=$data['packagename'];
        $count=count($data['ingredientid']);
        for($i=0;$i<$count;$i++)
        {
            $ingredientid=$data['ingredientid'][$i];
            $unitid=$data['unit'][$i];
            $quantity=$data['quantity'][$i];

            DB::table("ipackages")->insert(["packageid"=>$packageid,"packagename"=>$packagename,"ingredientid"=>$ingredientid,"unitid"=>$unitid,"quantity"=>$quantity,"created_at"=>$current_date_time,"updated_at"=>$current_date_time]);
        }
        Session::flash('message','Ipackage created successfully');
        return redirect(route('ipackage.index'));
    }

    public function getIngredient()
    {
        $dataset=array();

        $ingredients=Ingredient::all();
        $units=Unit::all();

        $dataset['ingredients'] = $ingredients;  
        $dataset['units'] = $units;  

        return response()->json($dataset);
    }
    
    public function getIpackage()
    {
        $dataset=array();

        $ipackages=Ipackage::groupBy('packageid','packagename')->select('packageid','packagename')->get();
        $units=Unit::all();

        $dataset['ipackages'] = $ipackages;  
        $dataset['units'] = $units;  

        return response()->json($dataset);
    }

    public function showPackageDetail($id)
    {
        $jsonAry=array();
        $details=Ipackage::where('packageid', $id)->get();
        $packageid=$details[0]->packageid;
        $packagename=$details[0]->packagename;
        foreach($details as $row)
        {
            $jsonAry['packageid'][] = $packageid; 
            $jsonAry['packagename'][] = $packagename; 
            $ingredientname=DB::table('ingredients')->select('ingredientname')->where('id',$row->ingredientid)->first();
            $jsonAry['ingredientname'][] =$ingredientname->ingredientname; 
            $unitname=DB::table('units')->select('unitname')->where('id',$row->unitid)->first();
            $jsonAry['unitname'][] =$unitname->unitname; 
            $jsonAry['quantity'][] =$row->quantity; 
        }
        
        return response()->json($jsonAry);
    }

    public function destroy($id)
    {
        // $ipackages=Ipackage::where('packageid',$id)->get();
        DB::table('ipackages')->where('packageid',$id)->delete();
        Session::flash('message','Deleted successfully');
        return redirect(route('ipackage.index'));
    }
}
