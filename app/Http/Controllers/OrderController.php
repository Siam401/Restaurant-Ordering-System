<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use App\Item;
use App\Setitem;
use App\Transection;
use App\Order;
use App\Tamp;
use App\Ordertamp;
use App\Tableno;
use Session;
use Response;
use DB;
use Carbon\Carbon;
use PDF;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
require __DIR__ . '/../../../vendor/autoload.php';


class OrderController extends Controller
{
    public function index()
    {
        $orders=DB::select(DB::raw("select invoice,tableno from orders where status=0 and billcomplete=0 group by invoice,tableno order by invoice desc"));

        return view('backend.orders.index',compact('orders'));
    }

    public function allorder()
    {
        $orders=DB::select(DB::raw("select invoice,tableno from orders where billcomplete=0 group by invoice,tableno order by invoice desc"));

        return view('backend.orders.allorders',compact('orders'));
    }
    
    public function completeorders()
    {
        $orders=DB::select(DB::raw("select invoice,tableno from orders where status=1 and billcomplete=0 group by invoice,tableno order by invoice desc"));

        return view('backend.orders.completeOrderList',compact('orders'));
    }
    
    public function billcomplete()
    {
        $orders=DB::select(DB::raw("select invoice,tableno from orders where billcomplete=1 group by invoice,tableno order by invoice desc"));

        return view('backend.orders.billcompletList',compact('orders'));
    }

    public function pdf()
    {
        $pdf = PDF::loadView('backend.orders.invoice');
        return $pdf->stream();
    }

    public function sale()
    {
        $tamps=Tamp::all();
        $items=Item::all();
        $setitems=Setitem::all();
        $listitems=Item::all();
        $listsetitems=Setitem::all();

        return view('backend.orders.sale',compact('items','setitems','listitems','listsetitems','tamps'));
    }
    
    public function search(Request $request)
    {
        $data=$request->except('_token');
        $keyword=ucfirst($data['search']);
        $listitems=Item::all();
        $listsetitems=Setitem::all();
        $items = Item::latest()->where('itemname', 'Like', "%{$keyword}%")->get();
        $setitems = Setitem::latest()->where('setname', 'Like', "%{$keyword}%")->get();

        $response['items']=$items;
        $response['setitems']=$setitems;

        return Response::json($response);
        // dd($setitems);
        // return view('backend.orders.sale',compact('items','setitems','listitems','listsetitems'));
    }

    public function additem($id)
    {
        $stock=Item::findOrFail($id);
        // dd($stockitem->quantity);
        if($stock->quantity>=1){
            $tamp_data=DB::table('tamps')->where('itemid', $id)->first();
            if(!$tamp_data){
                $stock->quantity=$stock->quantity-1;
                DB::table('items')->where('id', $id)->update(['quantity' => $stock->quantity]);

                $tamp_data['title']=$stock->itemname;
                $tamp_data['price']=$stock->price;
                $tamp_data['quantity']=1;
                $tamp_data['itemid']=$stock->id;

                Tamp::create($tamp_data);
                $tamp_all_data=DB::table('tamps')->get();

                return Response::json($tamp_all_data);
            }else{
                $stock->quantity=$stock->quantity-1;
                DB::table('items')->where('id', $id)->update(['quantity' => $stock->quantity]);

                $quantity=$tamp_data->quantity+1;
                DB::table('tamps')->where('itemid', $id)->update(['quantity' => $quantity]);
                $tamp_all_data=DB::table('tamps')->get();
                
                return Response::json($tamp_all_data);
            }
        }
    }

    public function addsetitem($id)
    {
        $stock=Setitem::findOrFail($id);
        // dd($stockitem->quantity);
        if($stock->quantity>=1){
            $tamp_data=DB::table('tamps')->where('setitemid', $id)->first();
            if(!$tamp_data){
                $stock->quantity=$stock->quantity-1;
                DB::table('setitems')->where('id', $id)->update(['quantity' => $stock->quantity]);

                $tamp_data['title']=$stock->setname;
                $tamp_data['price']=$stock->price;
                $tamp_data['quantity']=1;
                $tamp_data['setitemid']=$stock->id;

                Tamp::create($tamp_data);
                $tamp_all_data=DB::table('tamps')->get();

                return Response::json($tamp_all_data);
            }else{
                $quantity=$tamp_data->quantity+1;
                DB::table('tamps')->where('setitemid', $id)->update(['quantity' => $quantity]);
                $tamp_all_data=DB::table('tamps')->get();
                
                return Response::json($tamp_all_data);
            }
        }
    }

    public function updatetamp(Request $request)
    {
        $data=$request->all();
        $id=$data['id'];
        $quantity=$data['quantity'];
        $tamp=DB::table('tamps')->where('id', $id)->first();
        $itemid=$tamp->itemid;
        $setitemid=$tamp->setitemid;

        if($itemid){
            $item = Item::findOrFail($itemid);
            $itemquantity=$tamp->quantity+$item->quantity;
            if($itemquantity>=$quantity){
                $itemquantity=$itemquantity-$quantity;
                DB::table('items')->where('id', $itemid)->update(['quantity' => $itemquantity]);
                DB::table('tamps')->where('itemid', $itemid)->update(['quantity' => $quantity]);
            }
        }else{
            $setitem = Setitem::findOrFail($setitemid);
            $itemquantity=$tamp->quantity+$setitem->quantity;
            if($itemquantity>=$quantity){
                $itemquantity=$itemquantity-$quantity;
                DB::table('setitems')->where('id', $setitemid)->update(['quantity' => $itemquantity]);
                DB::table('tamps')->where('setitemid', $setitemid)->update(['quantity' => $quantity]);
            }
        }

        $tamps=Tamp::all();
        return Response::json($tamps);
    }

    public function completesale(Request $request)
    {
        $data=$request->all();
        $tableno=$data['tableno'];
        $y = date('y');
        $m= date('m');
        $d =date('d');
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
        
        $itemsdata=DB::table('tamps')->whereNull('setitemid')->get();
        $setitemsdata=DB::table('tamps')->whereNotNull('setitemid')->get();

        if(!empty($itemsdata)){
            foreach ($itemsdata as $row) {
                $itemname = $row->title;
                $price = $row->price;
                $quantity = $row->quantity;
                $subtotal=$price*$quantity;
                $itemorders = DB::table("orders")->insert(["invoice"=>$invoice,"tableno"=>$tableno,"item"=>$itemname,"quantity"=>$quantity,"price"=>$subtotal,"status"=>1]);
            }
        }
        if(!empty($setitemsdata)){
            foreach ($setitemsdata as $row) {
                $setname = $row->title;
                $price = $row->price;
                $quantity = $row->quantity;
                $subtotal=$price*$quantity;
                $itemorders = DB::table("orders")->insert(["invoice"=>$invoice,"tableno"=>$tableno,"setname"=>$setname,"quantity"=>$quantity,"price"=>$subtotal,"status"=>1]);
            }
        }

        Tamp::truncate();

        $setitems=DB::select(DB::raw("select setname,price,quantity from orders where invoice='$invoice' and setname!='' group by setname,price,quantity"));
        $items=DB::select(DB::raw("select item,price,quantity from orders where invoice='$invoice' and setname is NULL"));
        $table=DB::select(DB::raw("select tableno as tableno from orders where invoice='$invoice' group by tableno"));
        $tableno=$table[0]->tableno;
        $pdf = PDF::loadView('backend.orders.invoice',compact('setitems','items','tableno','invoice'));
        return $pdf->stream();
        // dd($setitemsdata);
            
    }

    public function placeOrder()
    {
        $items=Item::all();
        $setitems=Setitem::all();
        $ordertamps=Ordertamp::all();
        $tablenos=Tableno::all();

        return view('backend.orders.order',compact('items','setitems','ordertamps','tablenos'));
    }
    
    public function storeOrdertamp($id)
    {
        $stock=Item::findOrFail($id);
        // dd($stockitem->quantity);
        if($stock->quantity>=1){
            $tamp_data=DB::table('ordertamps')->where('itemid', $id)->first();
            // dd($tamp_data);
            if($tamp_data!=null){
                $stock->quantity=$stock->quantity-1;
                DB::table('items')->where('id', $id)->update(['quantity' => $stock->quantity]);

                $quantity=$tamp_data->quantity+1;
                $price=$stock->price*$quantity;
                DB::table('ordertamps')->where('itemid', $id)->update(['quantity' => $quantity,'price'=>$price]);

                $tamp_all_data=DB::table('ordertamps')->get();

                return Response::json($tamp_all_data);
            }else{
                $stock->quantity=$stock->quantity-1;
                DB::table('items')->where('id', $id)->update(['quantity' => $stock->quantity]);
                $item['itemname']=$stock->itemname;
                $item['quantity']=1;
                $item['price']=$stock->price;
                $item['itemid']=$stock->id;

                Ordertamp::create($item);
                $tamp_all_data=DB::table('ordertamps')->get();

                return Response::json($tamp_all_data);
            }
        }       
        // return redirect(route('order.create')); 
    }

    public function placesetOrder(Request $request)
    {
        $data=$request->all();
        // dd(count($data['selecteditem']));
        $stock=Setitem::findOrFail($data['id']);
        if($stock->quantity>=1){
          if(count($data)>4){  
            if(count($data['selecteditem'])==1){
                $tamp_data=DB::table('ordertamps')->where('setitemid', $data['id'])->where('itemname', $data['selecteditem'][0])->first();
                // dd($tamp_data);
                if($tamp_data!=null){
                    $stock->quantity=$stock->quantity-1;
                    DB::table('setitems')->where('id', $data['id'])->update(['quantity' => $stock->quantity]);

                    $quantity=$tamp_data->quantity+1;
                    $price=$stock->price*$quantity;
                    DB::table('ordertamps')->where('setitemid', $data['id'])->where('itemname', $data['selecteditem'][0])->update(['quantity' => $quantity,'price'=>$price]);
                    
                }else{
                    // dd('empty');
                    $set['setname']=$data['setname'];
                    $set['itemname']=$data['selecteditem'][0];
                    $set['quantity']=1;
                    $set['price']=$data['price'];
                    $set['setitemid']=$data['id'];

                    Ordertamp::create($set);
                }
            }else{
                $selecteditems=$data['selecteditem'];
                foreach($selecteditems as $selecteditem){
                    $tamp_data=DB::table('ordertamps')->where('setitemid', $data['id'])->where('itemname', $selecteditem)->first();
                    // dd($tamp_data);
                    if($tamp_data!=null){
                            $stock->quantity=$stock->quantity-1;
                            DB::table('setitems')->where('id', $data['id'])->update(['quantity' => $stock->quantity]);
                            $quantity=$tamp_data->quantity+1;
                            $price=$stock->price*$quantity;
                            DB::table('ordertamps')->where('setitemid', $data['id'])->where('itemname', $selecteditem)->update(['quantity' => $quantity,'price'=>$price]);
                        
                    }else{
                        // dd('empty');
                        $set['setname']=$data['setname'];
                        $set['itemname']=$selecteditem;
                        $set['quantity']=1;
                        $set['price']=$data['price'];
                        $set['setitemid']=$data['id'];

                        Ordertamp::create($set);
                    }
                }
            } 
          }else{
            $tamp_data=DB::table('ordertamps')->where('setitemid', $data['id'])->first();
            // dd($tamp_data);
            if($tamp_data!=null){
                    $stock->quantity=$stock->quantity-1;
                    DB::table('setitems')->where('id', $data['id'])->update(['quantity' => $stock->quantity]);

                    $quantity=$tamp_data->quantity+1;
                    $price=$stock->price*$quantity;
                    DB::table('ordertamps')->where('setitemid', $data['id'])->update(['quantity' => $quantity,'price'=>$price]);
                
            }else{
                // dd('empty');
                $set['setname']=$data['setname'];
                $set['quantity']=1;
                $set['price']=$data['price'];
                $set['setitemid']=$data['id'];

                Ordertamp::create($set);
            }
          }     
        }    
        return redirect(route('order.create'));
    }

    public function updateItemOrder(Request $request)
    {
        $data=$request->all();
        // dd($id);
        $id=$data['id'];
        $quantity=$data['quantity'];

        $tamp=DB::table('ordertamps')->where('id', $id)->first();
        $itemid=$tamp->itemid;
        $setitemid=$tamp->setitemid;
        
        if($itemid){
            $item = Item::findOrFail($itemid);
            $itemquantity=$tamp->quantity+$item->quantity;
            $itemprice=$item->price*$quantity;
            if($itemquantity>=$quantity){
                $itemquantity=$itemquantity-$quantity;
                DB::table('items')->where('id', $itemid)->update(['quantity' => $itemquantity]);
                DB::table('ordertamps')->where('id', $id)->update(['quantity' => $quantity,'price' => $itemprice]);
            }
        }else{
            $setitem = Setitem::findOrFail($setitemid);
            $itemquantity=$tamp->quantity+$setitem->quantity;
            $itemprice=$setitem->price*$quantity;
            if($itemquantity>=$quantity){
                $itemquantity=$itemquantity-$quantity;
                DB::table('setitems')->where('id', $setitemid)->update(['quantity' => $itemquantity]);
                DB::table('ordertamps')->where('id', $id)->update(['quantity' => $quantity,'price' => $itemprice]);
            }
        }

        $tamps=Ordertamp::all();
        return Response::json($tamps);

        // return redirect(route('order.create'));
    }

    public function sendOrder(Request $request)
    {
        $data=$request->all();
        $tableno=$data['tableno'];
        $y = date('y');
        $m= date('m');
        $d =date('d');
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
        $itemsdata=DB::table('ordertamps')->whereNull('setitemid')->get();
        $setitemsdata=DB::table('ordertamps')->whereNotNull('setitemid')->get();  
        
        if(!empty($itemsdata)){
            foreach ($itemsdata as $row) {
                $itemname = $row->itemname;
                $price = $row->price;
                $quantity = $row->quantity; 
                $itemorders = DB::table("orders")->insert(["invoice"=>$invoice,"tableno"=>$tableno,"item"=>$itemname,"quantity"=>$quantity,"price"=>$price]);
            }
        }
        if(!empty($setitemsdata)){
            foreach ($setitemsdata as $row) {
                $id = $row->setitemid;
                $setname = $row->setname;
                $itemname = $row->itemname;
                $price = $row->price;
                $quantity = $row->quantity; 
                $itemorders = DB::table("orders")->insert(["invoice"=>$invoice,"tableno"=>$tableno,"setname"=>$setname,"item"=>$itemname,"quantity"=>$quantity,"price"=>$price,"sl"=>$id]);
            }
        }
        Ordertamp::truncate();

        return redirect(route('order.create'));

    }
    
    
    public function billprint($invoice)
    {
        $date=Carbon::now();
        $setitems=DB::select(DB::raw("select setname,price,quantity from orders where invoice='$invoice' and setname!='' group by setname,price,quantity"));
        $items=DB::select(DB::raw("select item,price,quantity from orders where invoice='$invoice' and setname is NULL"));
        $table=DB::select(DB::raw("select tableno as tableno from orders where invoice='$invoice' group by tableno"));
        $tableno=$table[0]->tableno;
        $sets=DB::select(DB::raw("select setname,sum(quantity) as quantity,sum(price) as price,sl from orders where invoice='$invoice' and setname!='' group by setname,sl"));

        $orders=DB::table('orders')->where('invoice',$invoice)->get();

        foreach($orders as $order){
            DB::table('orders')->where('id', $order->id)->update(['status'=>1,'billcomplete' => 1]);
        }

        $itemsdata=DB::table('orders')->where('invoice',$invoice)->whereNull('sl')->get();
        $setitemsdata=DB::table('orders')->where('invoice',$invoice)->whereNotNull('sl')->get();

        if(!empty($itemsdata)){
            foreach ($itemsdata as $row) {
                $itemname = $row->item;
                $price = $row->price;
                $quantity = $row->quantity; 
                $itemorders = DB::table("transections")->insert(["invoice"=>$invoice,"tableno"=>$tableno,"item"=>$itemname,"quantity"=>$quantity,"price"=>$price,"vat"=>15]);
            }
        }
        if(!empty($setitemsdata)){
            foreach ($setitemsdata as $row) {
                $id = $row->sl;
                $setname = $row->setname;
                $itemname = $row->item;
                $price = $row->price;
                $quantity = $row->quantity; 
                $itemorders = DB::table("transections")->insert(["invoice"=>$invoice,"tableno"=>$tableno,"setname"=>$setname,"item"=>$itemname,"quantity"=>$quantity,"price"=>$price,"sl"=>$id,"vat"=>15]);
            }
        }

        // dd($setitemsdata);
        // return view('backend.orders.preview',compact('setitems','items','tableno','invoice','date','sets'));
        return view('backend.orders.billrecipt',compact('setitems','items','tableno','invoice','date','sets'));
    }
    
    public function chefpreview($invoice)
    {
        $date=Carbon::now();
        $setitems=DB::select(DB::raw("select setname,price,quantity from orders where invoice='$invoice' and setname!='' group by setname,price,quantity"));
        $items=DB::select(DB::raw("select item,price,quantity from orders where invoice='$invoice' and setname is NULL"));
        $table=DB::select(DB::raw("select tableno as tableno from orders where invoice='$invoice' group by tableno"));
        $tableno=$table[0]->tableno;
        $sets=DB::select(DB::raw("select setname,sum(quantity) as quantity,sum(price) as price,sl from orders where invoice='$invoice' and setname!='' group by setname,sl"));

        // dd($setitems);
        return view('backend.orders.chefrecipt',compact('setitems','items','tableno','invoice','date','sets'));
    }

    public function pdfview($invoice)
    {
        $setitems=DB::select(DB::raw("select setname,price,quantity from orders where invoice='$invoice' and setname!='' group by setname,price,quantity"));
        $items=DB::select(DB::raw("select item,price,quantity from orders where invoice='$invoice' and setname is NULL"));
        $table=DB::select(DB::raw("select tableno as tableno from orders where invoice='$invoice' group by tableno"));
        $tableno=$table[0]->tableno;

        // dd($orders);
        $pdf = PDF::loadView('backend.orders.invoice',compact('setitems','items','tableno','invoice'));
        return $pdf->stream();
    }
    
    public function preview($invoice)
    {
        $date=Carbon::now();
        $setitems=DB::select(DB::raw("select setname,price,quantity from orders where invoice='$invoice' and setname!='' group by setname,price,quantity"));
        $items=DB::select(DB::raw("select item,price,quantity from orders where invoice='$invoice' and setname is NULL"));
        $table=DB::select(DB::raw("select tableno as tableno from orders where invoice='$invoice' group by tableno"));
        $tableno=$table[0]->tableno;
        $sets=DB::select(DB::raw("select setname,sum(quantity) as quantity,sum(price) as price,sl from orders where invoice='$invoice' and setname!='' group by setname,sl"));

        // dd($orders);
        return view('backend.orders.preview',compact('setitems','items','tableno','invoice','date','sets'));
    }


    public function deleteOrder($id)
    {
        $ordertamp=Ordertamp::findOrFail($id);
        $itemid=$ordertamp->itemid;
        $setitemid=$ordertamp->setitemid;
        if($itemid){
            $item=Item::findOrFail($itemid);
            $item->quantity=$item->quantity+$ordertamp->quantity;
            DB::table('items')->where('id', $itemid)->update(['quantity' => $item->quantity]);            
        }else{
            $setitem=Setitem::findOrFail($setitemid);
            $setitem->quantity=$setitem->quantity+$ordertamp->quantity;
            DB::table('setitems')->where('id', $setitemid)->update(['quantity' => $setitem->quantity]);
        }
        $ordertamp->delete();
        $tamps=Ordertamp::all();
        return Response::json($tamps);
        // return redirect(route('order.create'));
    }

    public function deletetamp($id)
    {
        $tamp=Tamp::findOrFail($id);
        $itemid=$tamp->itemid;
        $setitemid=$tamp->setitemid;
        if($itemid){
            $item=Item::findOrFail($itemid);
            $item->quantity=$item->quantity+$tamp->quantity;
            DB::table('items')->where('id', $itemid)->update(['quantity' => $item->quantity]);            
        }else{
            $setitem=Setitem::findOrFail($setitemid);
            $setitem->quantity=$setitem->quantity+$tamp->quantity;
            DB::table('setitems')->where('id', $setitemid)->update(['quantity' => $setitem->quantity]);
        }
        $tamp->delete();

        $tamps=Tamp::all();
        return Response::json($tamps);
    }

    public function deletetampdata()
    {
        $tamps=Tamp::all();
        foreach($tamps as $tamp){
            $itemid=$tamp->itemid;
            $setitemid=$tamp->setitemid;
            if($itemid){
                $item=Item::findOrFail($itemid);
                $item->quantity=$item->quantity+$tamp->quantity;
                DB::table('items')->where('id', $itemid)->update(['quantity' => $item->quantity]);            
            }else{
                $setitem=Setitem::findOrFail($setitemid);
                $setitem->quantity=$setitem->quantity+$tamp->quantity;
                DB::table('setitems')->where('id', $setitemid)->update(['quantity' => $setitem->quantity]);
            }
        }
        Tamp::truncate();

        return redirect(route('order.sale'));
    }
}
