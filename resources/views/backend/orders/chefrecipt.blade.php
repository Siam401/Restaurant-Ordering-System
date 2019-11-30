<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style>
            * {
	top:0;
    font-size: 10px;
    font-family: 'Times New Roman';
}

td,
th,
tr,
table {
    border-bottom: 1px dotted black;
    border-collapse: collapse;
}

td.description,
th.description {
    width: 120px;
    max-width: 120px;
}

td.quantity,
th.quantity {
    width: 55px;
    max-width: 55px;
    word-break: break-all;
}

td.price,
th.price {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
}

.centered {
    text-align: center;
    align-content: center;
}

.lefted {
    text-align: left;
    align-content: left;
}

.ticket {
	bottom:0;
    width: 155px;
    max-width: 155px;
}

img {
    max-width: inherit;
    width: inherit;
}

@media print {
    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
}
        </style>
        <title>Receipt</title>
    </head>
    <body onload="myFunction()">
        <div class="ticket">
            <!--<img src="./logo.png" alt="Logo">-->
            <p class="centered">RECEIPT
                <br>Address line 1
                <br>Address line 2</p>
            <p class="lefted">
                    Invoice #{{ $invoice }}
                <br>Tableno {{ $tableno }}</p>
            <table>
                <thead>
                    <tr>
                        <th class="description" align="left">Description</th>
                        <th class="quantity" align="right">Quantity</th>
                        
                    </tr>
                </thead>
                <tbody>
                        <?php $totalprice=0; ?>
                        @foreach($items as $item)
                        <?php
                            $totalprice+=$item->price;
                        ?>
                        <tr>
                            <td>{{ $item->item }}</td>
                            <td align="right">{{ $item->quantity }}</td>
                        </tr>
                        @endforeach
                        @foreach($sets as $setitem)
                        <?php
                            $totalprice+=$setitem->price;
                        ?>
                        <tr>
                            <td>{{ $setitem->setname }}</td>
                            <td align="right">{{ $setitem->quantity }}</td>
                        </tr>
                        <?php
                        $items=DB::select(DB::raw("select item,quantity from orders where invoice='$invoice' and setname!='' and item!='' and sl=$setitem->sl")); 

                        // dd($items);
                        if(!empty($items)){
                        ?>
                        <tr>
                            <td colspan="3">
                                @php
                                
                                    // if(!empty($items)){
                                    // 	if(count($items)>1){
                                            foreach ($items as $fixeditem) 
                                            {
                                                echo $fixeditem->item."(".$fixeditem->quantity.") |";
                                            }
                                    // 	}elseif (count($items)==1) {
                                    // 		echo $fixeditem->item." X (".$fixeditem->quantity.")";
                                    // 	}  
                                    // }
                                @endphp 
                            </td>
                        </tr>
                        <?php
                                    }		
                        ?>
                        @endforeach
                </tbody>
            </table>
        </div>
        {{-- <button id="btnPrint" class="hidden-print">Print</button> --}}
        <script src="script.js"></script>
    </body>
</html>
<script>
const $btnPrint = document.querySelector("#btnPrint");
$btnPrint.addEventListener("click", () => {
    window.print();
});

function myFunction(){
    window.print();
    setInterval(function(){ window.history.back(); }, 1000);
    // window.history.back();
}
</script>
