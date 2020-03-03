<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
require __DIR__ . '/../../../vendor/autoload.php';

class Api extends Controller
{
    public function Data_Send(Request $request)
    {
    	$res = array();
    	$apikey  ='1234';
    	$api_key = input::get('api_key');
    	if($apikey == $api_key)
    	{
    		$category = DB::select(DB::raw("select * from categories"));
    		if(!empty($category))
    		{
    		  $res['category'] = $category;  
    		}
    		else
    		{
    			$res['category'] = $category;
    		}
    		$items = DB::select(DB::raw("select * from items"));
    		if(!empty($items))
    		{
    			$res['item'] = $items;
    		}
    		else
    		{
    			$res['item'] = $items;
    		}
    		$setitems = DB::select(DB::raw("select * from setitems"));
    		if(!empty($setitems))
    		{
    			$res['setitem'] = $setitems;
    		}
    		else
    		{
    			$res['setitem'] = $setitems;
    		}
    		$tablenos = DB::select(DB::raw("select * from tablenos"));
    		if(!empty($tablenos))
    		{
    			$res['tableno'] = $tablenos;
    		}
    		else
    		{
    			$res['tableno'] = $tablenos;
    		}
    		echo json_encode($res);
    		
    	}
    	else
    	{
    		$arr = array("Error"=>"API KEY NOT MATCH");
    		echo json_encode($arr);
    	}

    }
    
    public function Order_Receive(Request $request)
    {
        $apikey  ='1234';
        $api_key =Input::get('api_key');

       /* $order ='{"table":1,"item":[{"itemname":"Burger","price":"100","quantity":2},{"itemname":"Pizza","price":"100","quantity":2}],"setitem":[{"setname":"B","itemname":"Pizza","price":"100","quantity":2,"id":3},{"setname":"A","itemname":"Pizza3","price":"120","quantity":1,"id":1},{"setname":"A","itemname":"Pizza4","price":"120","quantity":1,"id":2}]}'; */
        $order=Input::get('orders');
        if($apikey == $api_key)
        {
            $decode  = json_decode($order);
            //dd($decode);
            $tableno = $decode->table;
            $invoices = $decode->invoice;
            $items =$decode->item;
            $setnames = $decode->setitem;
            $y = date('y');
            $m= date('m');
            $d =date('d');
            if($invoices !='')
            {
                $invoice =$invoices;
            }
            else
            {
               $lastinovienumber = DB::select(DB::raw("select invoice from orders where id = (select max(id) from orders)"));
                //dd($lastinovienumber);
                if(!empty($lastinovienumber))
                {
                    $invoiceno = $lastinovienumber[0]->invoice;
                    $day = substr($invoiceno,4, 2);
                    if($d==$day)
                    {
                         $inc =  substr($invoiceno,6, 4);
                         $inc +=1;
                         $add = str_pad($inc,4,"0",STR_PAD_LEFT);
                         $invoice=$y."".$m."".$d."".$add;
                    }
                    else
                    {
                         $inc=1;
                         $add = str_pad($inc,4,"0",STR_PAD_LEFT);
                         $invoice=$y."".$m."".$d."".$add;
                    }
                   
                   
                }
                else
                {
                     $inc=1;
                     $add = str_pad($inc,4,"0",STR_PAD_LEFT);
                     $invoice=$y."".$m."".$d."".$add;
                } 
            }
            
            if(!empty($items) || !empty($setnames))
            {
                foreach ($items as $row) {
                    $itemname = $row->itemname;
                    $price = $row->price;
                    $quantity = $row->quantity;
                    $itemorders = DB::table("orders")->insert(["invoice"=>$invoice,"tableno"=>$tableno,"item"=>$itemname,"quantity"=>$quantity,"price"=>$price]);
                }
                foreach ($setnames as $r) {
                    $id = $r->id; 
                    $setname = $r->setname;
                    $itemname = $r->itemname;
                    $price = $r->price;
                    $quantity = $r->quantity;
                    $setorders = DB::table("orders")->insert(["invoice"=>$invoice,"tableno"=>$tableno,"setname"=>$setname,"item"=>$itemname,"quantity"=>$quantity,"price"=>$price,"sl"=>$id]);
                }
               $returnJson = array("table"=>$tableno,"invoice"=>$invoice);
               echo json_encode($returnJson);
            }
            
           // echo $invoice;  
        }
        else
        {
            $arr = array("Error"=>"API KEY NOT MATCH");
            echo json_encode($arr);
        }
    }
    public function Cooking_Man(Request $request)
    {
        $apikey  ='1234';
        $api_key =Input::get('api_key');
        if($apikey==$api_key)
        {
            $allorders  = DB::table('orders')->where('status',0)->get();
            echo json_encode($allorders);
        }
        else
        {
            $arr = array("Error"=>"API KEY NOT MATCH");
            echo json_encode($arr);
        }
        
        
    }
    public function Cookingdone(Request $request)
    {
        $apikey  ='1234';
        $api_key =Input::get('api_key');
        if($apikey==$api_key)
        {
			$chef=Input::get('invoice');
			$invoice  = json_decode($chef);
			// $invoice='1911070001';
			$orders=DB::table('orders')->where('invoice',$invoice)->get();

			foreach($orders as $order){
				DB::table('orders')->where('id', $order->id)->update(['status' => 1]);
			}

			$arr = array("Order complete");
            echo json_encode($arr);
        }
        else
        {
            $arr = array("Error"=>"API KEY NOT MATCH");
            echo json_encode($arr);
        }
        
        
    }
    public function Ordercomplete(Request $request)
    {
        $apikey  ='1234';
		$api_key =Input::get('api_key');
		$ordercomplete=[];
        if($apikey==$api_key)
        {
			$response=Input::get('invoice');
			$invoice_ary  = json_decode($response);
			$invoices=$invoice_ary->invoice;

			// $response ='{"invoice":["1911190001","1911110004","1911110005"]}';

			// $invoice_ary  = json_decode($response);
			// $invoices=$invoice_ary->invoice;

			foreach($invoices as $invoice){
				$order=DB::table('orders')->where('invoice',$invoice)->where('status',1)->first();
				$billcomplete=DB::table('orders')->where('invoice',$invoice)->where('billcomplete',1)->first();
				// dd($order->invoice);				
				if(!empty($order)){
					$ordercomplete['cookingcomplete'][]=$order->invoice;
				}
				if(!empty($billcomplete)){
					$ordercomplete['billcomplete'][]=$billcomplete->invoice;
				}
				
            }
            // dd($ordercomplete);

			echo json_encode($ordercomplete);
			
        }
        else
        {
            $arr = array("Error"=>"API KEY NOT MATCH");
            echo json_encode($arr);
        }
        
        
    }
    public function logincheck(Request $request)
    {
        $apikey  ='1234';
		$api_key =Input::get('api_key');
		$credentials=[];
        if($apikey==$api_key)
        {
			$response=Input::get('credentials');
			$invoices  = json_decode($response);

			// $response ='{"username":"waiter1","password":"1234"}';

			// $invoice_ary  = json_decode($response);
			$username=$invoices->username;
			$password=md5($invoices->password);

			$result=DB::table('employees')->where('username',$username)->where('password',$password)->first();
			if($result==NULL){
				$credentials["status"]=false;
				$credentials["role"]=Null;
            	echo json_encode($credentials);
			}else{
				$credentials["status"]=true;
				$credentials["role"]=$result->role;
            	echo json_encode($credentials);
			}
        }
        else
        {
            $arr = array("Error"=>"API KEY NOT MATCH");
            echo json_encode($arr);
        }
        
        
    }

    public function recipt(Request $request)
    {
        $apikey  ='1234';
		$api_key =Input::get('api_key');
        if($apikey==$api_key)
        {
            $chef=Input::get('invoice');
            $invoice  = json_decode($chef);
            // dd($invoice);
			// $invoice='1911260002';
            
            $connector = new WindowsPrintConnector("RONGTA11");
            /* Print a "Hello world" receipt" */
            $printer = new Printer($connector);
            $data=array();
            $set=array();
            $selecteditem='';
            $selectedquantity=array();

			$setitems=DB::select(DB::raw("select setname,price,quantity from orders where invoice='$invoice' and setname!='' group by setname,price,quantity"));
            $items=DB::select(DB::raw("select item,price,quantity from orders where invoice='$invoice' and setname is NULL"));
            $table=DB::select(DB::raw("select tableno as tableno from orders where invoice='$invoice' group by tableno"));
            $tableno=$table[0]->tableno;
            $sets=DB::select(DB::raw("select setname,sum(quantity) as quantity,sum(price) as price,sl from orders where invoice='$invoice' and setname!='' group by setname,sl"));
            $count1=count($items);
            $count2=count($sets);
            // dd($sets);
            for($i=0;$i<$count1;$i++){
                $data[]=new item($items[$i]->item, $items[$i]->quantity);
            }

            for($i=0;$i<$count2;$i++){
                $sl=$sets[$i]->sl;

                $itemdatas=DB::select(DB::raw("select item,quantity from orders where invoice='$invoice' and setname!='' and item!='' and sl=$sl")); 

                foreach($itemdatas as $row){
                    $selecteditem=$selecteditem.$row->item.'('.$row->quantity.')';
                }
                // if($selecteditem==''){
                //     $set[]=new item($sets[$i]->setname, $sets[$i]->quantity);
                // }else{
                //     $set[]=new item($sets[$i]->setname.'|'.$selecteditem, '');
                // }
                $set[]=new item($sets[$i]->setname.'|'.$selecteditem,$sets[$i]->quantity);
                $selecteditem='';
            }
        
            // $items = [];
            /* Date is kept the same for testing */
            // $date = date('l jS \of F Y h:i:s A');
            $date = "Monday 6th of April 2015 02:56:25 PM";

            
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            // $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            // $printer->text("Resturent.\n");
            // $printer->selectPrintMode();
            // $printer->text("Shop No. 42.\n");

            $printer->setEmphasis(true);
            $printer->text("Table $tableno \n");
            $printer->text("Invoice # $invoice \n");
            $printer->setEmphasis(false);
            $printer->feed();

             /* Items */
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            
            foreach ($data as $item) {
                $printer->text($item->getAsString(32)); 
            }
            
            foreach ($set as $item) {
                $printer->text($item->getAsString(32)); 
            }
            
            $printer->feed();
            $printer -> cut();
            $printer -> close();

            
        }
        else
        {
            $arr = array("Error"=>"API KEY NOT MATCH");
            echo json_encode($arr);
        }
        
        
    }
}
/* A wrapper to do organise item names & prices into columns */
class item
{
    public $name;
    public $quantity;
    public function __construct($name = '', $quantity = '')
    {
        $this->name = $name;
        $this->quantity = $quantity;
    }
    public function getAsString($width = 48)
    {
        $rightCols = 5;
        $leftCols = $width - $rightCols;
        $left = str_pad($this->name, $leftCols);
        $right = str_pad($this->quantity, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
    public function __toString()
    {
        return $this->getAsString();
    }
}
