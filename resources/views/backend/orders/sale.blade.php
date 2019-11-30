@extends('backend.layouts.master')

@section('content')

<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-white">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-prepend">
                                                <label class="input-group-text"><i class="fa fa-search"></i></label>
                                                </span>
                                                <input type="text" id="search" class="form-control" placeholder="Search here" />
                                                {{-- <datalist id="items">
                                                    @foreach($listitems as $listitem) 
                                                        <option value="{{ $listitem->itemname }}">
                                                    @endforeach
                                                    @foreach($listsetitems as $listsetitem) 
                                                        <option value="{{ $listsetitem->setname }}">
                                                    @endforeach
                                                </datalist> --}}
                                            </div>
                                         </div>         
                                    </div>
                                </div>
                            </div>    
                        </div>    
                        <div class="card" style="overflow-y:scroll;height: 525px;width:100%">
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-borderless  mt-1">
                                                <thead>
                                                    <tr>
                                                        <th width="30%">Item</th>
                                                        <th width="15%">Price</th>
                                                        <th width="25">Available quantity</th>
                                                        <th width="15%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="sale-table">
                                                    @foreach($items as $item)
                                                    <tr>
                                                        <td>{{ $item->itemname }}</td>
                                                        <td align="center">{{ $item->price }}</td>
                                                        <td align="center">{{ $item->quantity }}</td>
                                                        <td>
                                                            <a href="javascript:void(0)" onclick="additem('{{ $item->id }}')" id="cart-add" class="btn btn-info btn-bg ">Add</a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @foreach($setitems as $setitem)
                                                    <tr>
                                                        <th>{{ $setitem->setname }}</th>
                                                        <th align="center">{{ $setitem->price }}</th>
                                                        <th align="center">{{ $setitem->quantity }}</th>
                                                        <td>
                                                            <a href="javascript:void(0)" onclick="addsetitem('{{ $setitem->id }}')" id="cart-add" class="btn btn-info btn-bg ">Add</a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                    </div>
                                </div>
                            </div>    
                        </div>    
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-block">
                                    {{-- <form method="POST" action="#" accept-charset="UTF-8" id="scan">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group">
                                                        <div class="input-group">
                                                                <span class="input-group-prepend">
                                                                <label class="input-group-text"><i class="fa fa-barcode"></i></label>
                                                                </span>
                                                                <input type="text" class="form-control" placeholder="Search here">
                                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" style="display: none">
                                        </form> --}}
                                                    <table class="table table-borderless  mt-1">
                                                        <thead>
                                                            <tr>
                                                                <th width="30%">Item</th>
                                                                <th width="20%">Qty</th>
                                                                <th width="15%">Price</th>
                                                                <th width="25">Total</th>
                                                                <th width="10%"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="sale-view-cart">
                                                            <?php $grandtotal = 0 ?>
                                                            @foreach ($tamps as $tamp)
                                                            <?php $grandtotal += $tamp->price * $tamp->quantity ?>
                                                                <tr>
                                                                    <td>{{ $tamp->title }}</td>
                                                                    <td>
                                                                        <input type="number" onchange="updatetamp('{{ $tamp->id }}')" class="form-control" min="1" autocomplete="off" name="qty" id="qty{{ $tamp->id }}" value="{{ $tamp->quantity }}" style="text-align:center">
                                                                    </td>
                                                                    <td>{{ $tamp->price }}</td>
                                                                    @php
                                                                        $total=$tamp->quantity*$tamp->price;
                                                                    @endphp
                                                                    <td>{{ $total }}</td>
                                                                    <td></td>
                                                                    <td>
                                                                        <a href="javascript:void(0)" id="cart-delete" onclick="deletetamp('{{ $tamp->id }}')" data-id="a21ffd04a22e4dd8522d27e854aa2878" class="btn btn-outline-danger btn-sm "><i class="fa fa-trash"></i></a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    
                                                    <form method="post" action="{{ route('order.completesale') }}">
                                                    @csrf    
                                                    <div id="total_count">
                                                        <div class="row">
                                                            <label class="col-sm-4 col-lg-6 col-form-label">Table</label>
                                                            <div class="col-sm-8 col-lg-6">
                                                                <div class="input-group">
                                                                    <span class="input-group-prepend">
                                                                    <label class="input-group-text">No</i></label>
                                                                    </span>
                                                                    <input type="number" min="1" name="tableno" id="tableno" class="form-control" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <label class="col-sm-4 col-lg-6 col-form-label">Grand-Total (Excluded Vat)</label>
                                                            <div class="col-sm-8 col-lg-6">
                                                                <div class="input-group">
                                                                    <span class="input-group-prepend">
                                                                    <label class="input-group-text">Tk</i></label>
                                                                    </span>
                                                                    <input type="number" min="1" id="grandtotal" class="form-control" value="{{ $grandtotal }}" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <label class="col-sm-4 col-lg-6 col-form-label">Vat</label>
                                                            <div class="col-sm-8 col-lg-6">
                                                                <div class="input-group">
                                                                    <span class="input-group-prepend">
                                                                    <label class="input-group-text">%</i></label>
                                                                    </span>
                                                                    <input type="number" min="1" max="100" class="form-control" id="vat" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <label class="col-sm-4 col-lg-6 col-form-label">Grand-Total (Inclusive Vat)</label>
                                                            <div class="col-sm-8 col-lg-6">
                                                                <div class="input-group">
                                                                    <span class="input-group-prepend">
                                                                    <label class="input-group-text">Tk</i></label>
                                                                    </span>
                                                                    <input type="number" min="1" id="vattotal" class="form-control" value="" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <label class="col-sm-4 col-lg-6 col-form-label">Paid Amount </label>
                                                            <div class="col-sm-8 col-lg-6">
                                                                <div class="input-group">
                                                                    <span class="input-group-prepend">
                                                                    <label class="input-group-text">Tk</i></label>
                                                                    </span>
                                                                    <input type="text" class="form-control" id="paidamount" value="0">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <label class="col-sm-4 col-lg-6 col-form-label">Return Change</label>
                                                            <div class="col-sm-8 col-lg-6">
                                                                <div class="input-group">
                                                                    <span class="input-group-prepend">
                                                                    <label class="input-group-text">Tk</i></label>
                                                                    </span>
                                                                    <input type="text" class="form-control" id="returnamount" value="0" aria-describedby="basic-addon1" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <a href="{{ route('order.deletetampdata') }}" onclick="return(confirm('Are You Sure to Discard'))" class="btn btn-danger btn-min-width ml-2 mb-1 float-left"><i class="fa fa-remove"></i> Discard Sales</a>
                                                    <button type="submit" id="complete-purchase" class="btn btn-info btn-min-width mr-1 mb-1" style="float: right"><i class="fa fa-money"></i> Complete Sales</button>
                                                    </form>
                 
                                                </div>
                                            </div>
                                        </div>
                                     
                            </div>
                        </div><!-- Row -->

                    </div>
                </div>
            </div>
        </div>
@endsection

@section('script')
<script>
    // search method
    $(function(){
        $('#search').keyup(function(){
            var search = $(this).val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            console.log(CSRF_TOKEN);
            $.ajax({
                type:"POST",
                url:"{{ url('/sale/search') }}",
                data: {_token: CSRF_TOKEN, search:search},
                dataType: "JSON",
                success:function(data){
                    console.log(data['items'].length);
                    $('#sale-table').empty();
                    var items='';
                    for(var i=0; i<data['items'].length; i++){
                        var id = data['items'][i].id;
                        var itemname = data['items'][i].itemname;
                        var price = data['items'][i].price;
                        var quantity = data['items'][i].quantity;

                        items = '<tr>';
                        items += '<td>'+itemname+'</td>';
                        items += '<td align="center">'+price+'</td>';
                        items += '<td align="center">'+quantity+'</td>';
                        items += '<td><a href="javascript:void(0)" onclick="additem('+id+')" id="cart-add" class="btn btn-info btn-bg ">Add</a></td>';
                        items += '</tr>';

                        $("#sale-table").append(items); 
                    }
                    for(var i=0; i<data['setitems'].length; i++){
                        var id = data['setitems'][i].id;
                        var setname = data['setitems'][i].setname;
                        var price = data['setitems'][i].price;
                        var quantity = data['setitems'][i].quantity;

                        items = '<tr>';
                        items += '<td>'+setname+'</td>';
                        items += '<td align="center">'+price+'</td>';
                        items += '<td align="center">'+quantity+'</td>';
                        items += '<td><a href="javascript:void(0)" onclick="addsetitem('+id+')" id="cart-add" class="btn btn-info btn-bg ">Add</a></td>';
                        items += '</tr>';

                        $("#sale-table").append(items); 
                    }
                    
                },
                error : function (data) {
                    alert('Ghorer Dim');
                }
            });
        });
    })
    // add item to cart method
    function additem(id){
    $.ajax({
        url: "{{ url('/sale/add/item') }}" + '/' + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $('#sale-view-cart').empty();
          $('#grandtotal').empty();
          var tamps='';
          var grandtotal=0;
        //   var grandtotal=$('#grandtotal').val();
          for(var i=0; i<data.length; i++){
            var id = data[i].id;
            var title = data[i].title;
            var price = data[i].price;
            var quantity = data[i].quantity;
            var total= data[i].price*data[i].quantity;
            grandtotal += total;

            tamps = '<tr>';
            tamps += '<td>'+title+'</td>';
            tamps += '<td>';
            tamps += '<input type="number" onchange="updatetamp('+id+')" class="form-control" min="1" autocomplete="off" name="qty" id="qty'+id+'" value="'+quantity+'" style="text-align:center">';
            tamps += '</td>';
            tamps += '<td>'+price+'</td>';
            tamps += '<td>'+total+'</td>';
            tamps += '<td><a href="javascript:void(0)" id="cart-delete" onclick="deletetamp('+id+')" class="btn btn-outline-danger btn-sm "><i class="fa fa-trash"></i></a></td>';
            tamps += '</tr>';

            $("#sale-view-cart").append(tamps); 
          }
          $('#grandtotal').val(grandtotal);
          var vat = $('#vat').val();
            var vatamount=(grandtotal*vat)/100;
            var vattotal = parseInt(total) + parseInt(vatamount);
            $('#vat').val('');
            $('#vattotal').val('');
            $('#paidamount').val('');
            $('#returnamount').val('');
        },
        error: function (data) {
          alert('Ghorer Dim');
        }
      });
    }
    // add setitem to cart method
    function addsetitem(id){
    $.ajax({
        url: "{{ url('/sale/add/setitem') }}" + '/' + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          console.log(data);
          $('#sale-view-cart').empty();
          $('#grandtotal').empty();
          var tamps='';
          var grandtotal=0;
          for(var i=0; i<data.length; i++){
            var id = data[i].id;
            var title = data[i].title;
            var price = data[i].price;
            var quantity = data[i].quantity;
            var total= data[i].price*data[i].quantity;
            grandtotal += total;

            tamps = '<tr>';
            tamps += '<td>'+title+'</td>';
            tamps += '<td>';
            tamps += '<input type="number" onchange="updatetamp('+id+')" class="form-control" min="1" autocomplete="off" name="qty" id="qty'+id+'" value="'+quantity+'" style="text-align:center">';
            tamps += '</td>';
            tamps += '<td>'+price+'</td>';
            tamps += '<td>'+total+'</td>';
            tamps += '<td><a href="javascript:void(0)" id="cart-delete" data-id="a21ffd04a22e4dd8522d27e854aa2878" onclick="deletetamp('+id+')" class="btn btn-outline-danger btn-sm "><i class="fa fa-trash"></i></a></td>';
            tamps += '</tr>';

            $("#sale-view-cart").append(tamps); 
          }
          $('#grandtotal').val(grandtotal);
          var vat = $('#vat').val();
            var vatamount=(grandtotal*vat)/100;
            var vattotal = parseInt(total) + parseInt(vatamount);
            $('#vat').val('');
            $('#vattotal').val('');
            $('#paidamount').val('');
            $('#returnamount').val('');
        },
        error: function (data) {
          alert('Ghorer Dim');
        }
      });
    }
    function updatetamp(id){
        var id=id;
        var quantity=$("#qty"+ id).val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
                type:"POST",
                url:"{{ url('/sale/update/item') }}",
                data: {_token: CSRF_TOKEN, quantity:quantity, id: id},
                dataType: "JSON",
                success:function(data){
                    console.log(data);
                    $('#sale-view-cart').empty();
                    $('#grandtotal').empty();
                    var tamps='';
                    var grandtotal=0;
                    for(var i=0; i<data.length; i++){
                        var id = data[i].id;
                        var title = data[i].title;
                        var price = data[i].price;
                        var quantity = data[i].quantity;
                        var total= data[i].price*data[i].quantity;
                        grandtotal += total;

                        tamps = '<tr>';
                        tamps += '<td>'+title+'</td>';
                        tamps += '<td>';
                        tamps += '<input type="number" onchange="updatetamp('+id+')" class="form-control" min="1" autocomplete="off" name="qty" id="qty'+id+'" value="'+quantity+'" style="text-align:center">';
                        tamps += '</td>';
                        tamps += '<td>'+price+'</td>';
                        tamps += '<td>'+total+'</td>';
                        tamps += '<td><a href="javascript:void(0)" id="cart-delete" onclick="deletetamp('+id+')" data-id="a21ffd04a22e4dd8522d27e854aa2878" class="btn btn-outline-danger btn-sm "><i class="fa fa-trash"></i></a></td>';
                        tamps += '</tr>';

                        $("#sale-view-cart").append(tamps); 
                    }
                    $('#grandtotal').val(grandtotal);
                    // var vat = $('#vat').val();
                    // var vatamount=(grandtotal*vat)/100;
                    // var vattotal = parseInt(total) + parseInt(vatamount);
                    $('#vat').val('');
                    $('#vattotal').val('');
                    $('#paidamount').val('');
                    $('#returnamount').val('');
                },
                error : function (data) {
                    alert('Ghorer Dim');
                }
            });
    }

    function deletetamp(id){
        $.ajax({
        url: "{{ url('/sale/item/delete') }}" + '/' + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#sale-view-cart').empty();
            $('#grandtotal').empty();
            var tamps='';
            var grandtotal=0;
            for(var i=0; i<data.length; i++){
                var id = data[i].id;
                var title = data[i].title;
                var price = data[i].price;
                var quantity = data[i].quantity;
                var total= data[i].price*data[i].quantity;
                grandtotal += total;

                tamps = '<tr>';
                tamps += '<td>'+title+'</td>';
                tamps += '<td>';
                tamps += '<input type="number" onchange="updatetamp('+id+')" class="form-control" min="1" autocomplete="off" name="qty" id="qty'+id+'" value="'+quantity+'" style="text-align:center">';
                tamps += '</td>';
                tamps += '<td>'+price+'</td>';
                tamps += '<td>'+total+'</td>';
                tamps += '<td><a href="javascript:void(0)" id="cart-delete" data-id="a21ffd04a22e4dd8522d27e854aa2878" onclick="deletetamp('+id+')" class="btn btn-outline-danger btn-sm "><i class="fa fa-trash"></i></a></td>';
                tamps += '</tr>';

                $("#sale-view-cart").append(tamps); 
            }
            $('#grandtotal').val(grandtotal);
            var vat = $('#vat').val();
            var vatamount=(grandtotal*vat)/100;
            var vattotal = parseInt(total) + parseInt(vatamount);
            $('#vat').val('');
            $('#vattotal').val('');
            $('#paidamount').val('');
            $('#returnamount').val('');
        },
        error: function (data) {
          alert('Ghorer Dim');
        }
      });
    }

    function deletetampdata(){
        $.ajax({
        url: "{{ url('/sale/item/delete/all') }}",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#sale-view-cart').empty();
            $('#grandtotal').empty();
        },
        error: function (data) {
          alert('Ghorer Dim');
        }
      });
    }

    $(function(){
        $('#vat').keyup(function(){
            var vat = $(this).val();
            var total = $('#grandtotal').val();
            var vatamount=(total*vat)/100;
            var vattotal = parseInt(total) + parseInt(vatamount);
            $('#vattotal').val(vattotal);
        });
    })
    $(function(){
        $('#paidamount').keyup(function(){
            var paidamount = $(this).val();
            var amount =$('#vattotal').val();
            var returnamount = paidamount-amount;
            $('#returnamount').val(returnamount);
        });
    })
</script>
@endsection


												