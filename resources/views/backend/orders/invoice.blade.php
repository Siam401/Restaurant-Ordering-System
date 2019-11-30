<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice - #{{ $invoice }}</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .invoice h4 {
            margin-left: 15px;
        }
        .information {
            /* background-color: #60A7A6; */
            /* color: #FFF; */
        }
        .information .logo {
            /* margin: 5px; */
        }
        .information table {
            /* padding: 10px; */
        }
    </style>

</head>
<body>

<div class="information">
    <table width="100%">
        <tr>
            {{-- <td align="left" style="width: 40%;">
                <h3>John Doe</h3>
                <pre>
                    Street 15
                    123456 City
                    United Kingdom
                    <br /><br />
                    Date: 2018-01-01
                    Identifier: #uniquehash
                    Status: Paid
                </pre>


            </td> --}}
            <td></td>
            <td align="center">
                <h3>CompanyName</h3>
            </td>
            <td></td>
            {{-- <td align="right" style="width: 40%;">

                <h3>CompanyName</h3>
                <pre>
                    https://company.com

                    Street 26
                    123456 City
                    Bangladesh
                </pre>
            </td> --}}
        </tr>
        <tr>
            <td></td>
            <td align="center">
                Address1
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td align="center">
                Address2
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td align="center">
                Phone
            </td>
            <td></td>
        </tr>

    </table>
</div>

<br>

<div class="invoice">
    <h4>Invoice #{{ $invoice }}</h4>
    <h4>Tableno {{ $tableno }}</h4>
    <table width="100%">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Sub Total</th>
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
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                </tr>
                @endforeach
                @foreach($setitems as $setitem)
                <?php
                    $totalprice+=$setitem->price;
                ?>
                <tr>
                    <td>{{ $setitem->setname }}</td>
                    <td>{{ $setitem->quantity }}</td>
                    <td>{{ $setitem->price }}</td>
                </tr>
                @endforeach
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <th>Total Price</th>
                    <td>{{ $totalprice }}</td>
                </tr>
                <tr>
                    <td></td>
                    <th>Vat</th>
                    <td>15%</td>
                </tr>
                <?php
                    $vatamount=Round(($totalprice*15)/100);
                    $grandtotal=$totalprice+$vatamount;
                ?>
                <tr>
                    <td></td>
                    <th>Grand Total</th>
                    <td>{{ $grandtotal }}</td>
                </tr>
            </tbody>
        </table>
</div>

{{-- <div class="information" style="position: absolute; bottom: 0;width: 100%">
    <table width="100%">
        <tr>
            <td align="left" style="width: 50%;">
                &copy; {{ date('Y') }} {{ config('app.url') }} - All rights reserved.
            </td>
            <td align="right" style="width: 50%;">
                Company Name
            </td>
        </tr>

    </table>
</div> --}}
</body>
</html>