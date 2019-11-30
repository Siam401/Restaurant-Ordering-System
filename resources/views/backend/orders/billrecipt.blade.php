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
    width: 75px;
    max-width: 75px;
}

td.quantity,
th.quantity {
    width: 40px;
    max-width: 40px;
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

.ticket {
	top:0;
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
                        <th class="description">Description</th>
                        <th class="quantity" >Quantity</th>
                        <th class="price" align="right">Price</th>
                        
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
                            <td align="center">{{ $item->quantity }}</td>
                            <td align="right">{{ $item->price }}</td>
                        </tr>
                        @endforeach
                        @foreach($sets as $setitem)
                        <?php
                            $totalprice+=$setitem->price;
                        ?>
                        <tr>
                            <td>{{ $setitem->setname }}</td>
                            <td align="center">{{ $setitem->quantity }}</td>
                            <td align="right">{{ $setitem->price }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <th>Total Price</th>
                            <td align="right">{{ $totalprice }}</td>
                        </tr>
                        <?php
                            $vatamount=Round(($totalprice*15)/100);
                            $grandtotal=$totalprice+$vatamount;
                        ?>
                        <tr>
                            <td></td>
                            <th>Vat(15%)</th>
                            <td align="right">{{ $vatamount  }}</td>
                        </tr>
                        <tr>
                            <td width="10%"></td>
                            <th width="60%">Grand Total</th>
                            <td width="30%" align="right">{{ $grandtotal }}</td>
                        </tr>
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