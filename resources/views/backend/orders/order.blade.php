@extends('backend.layouts.master')

@section('content')

<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">

                <div class="row">
                    <div class="col-md-6">
                        {{-- <div class="panel panel-white">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-prepend">
                                                <label class="input-group-text"><i class="fa fa-search"></i></label>
                                                </span>
                                                <input type="text" id="search" class="form-control" placeholder="Search here" />
                                                
                                            </div>
                                         </div>         
                                    </div>
                                </div>
                            </div>    
                        </div>     --}}
                        <div class="card" style="overflow-y:scroll;height: 560px;width:100%">
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
                                                    <form method="post" action="{{ route('order.set') }}">
                                                    @csrf  
                                                    <input type="hidden" name="id" value="{{ $setitem->id }}">
                                                    <input type="hidden" name="setname" value="{{ $setitem->setname }}">
                                                    <input type="hidden" name="price" value="{{ $setitem->price }}">
                                                    <tr>
                                                        <th>{{ $setitem->setname }}</th>
                                                        <th align="center">{{ $setitem->price }}</th>
                                                        <th align="center">{{ $setitem->quantity }}</th>
                                                        <td>
                                                            <?php 
                                                            if($setitem->selecteditem!=NUll){
                                                            ?>
                                                                <button onclick="addsetitem('{{ $setitem->id }}')"  id="cartadd{{ $setitem->id }}" class="btn btn-info btn-bg" disabled>Add</button>
                                                            <?php }else{ ?>
                                                                <button onclick="addsetitem('{{ $setitem->id }}')"  id="cartadd{{ $setitem->id }}" class="btn btn-info btn-bg">Add</button>
                                                            <?php } ?>

                                                        </td>
                                                    </tr>
                                                    <?php
                                                        $itemids=$setitem->fixeditem;
                                                        $itemid=explode(',',$itemids);
                                                    ?>
                                                    <tr>
                                                        <td colspan="4">
                                                            <p>- 
                                                                @foreach($itemid as $item)
                                                                    <?php
                                                                        $itemdata=App\Item::findOrFail($item);
                                                                        echo $itemdata->itemname.',';
                                                                    ?>
                                                                @endforeach
                                                            </p>
                                                        </td>    
                                                    </tr>
                                                    <?php
                                                    if($setitem->selecteditem!=NUll){
                                                        $itemids=$setitem->selecteditem;
                                                        $itemid=explode(',',$itemids);
                                                    ?>
                                                    <tr>
                                                        <td colspan="4">
                                                        @foreach($itemid as $item)
                                                        <?php
                                                            $itemdata=App\Item::findOrFail($item);
                                                        ?>
                                                            <div class="form-check-inline">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" name="selecteditem[]" class="form-check-input" onclick="enable('{{ $setitem->id }}')" value="{{$itemdata->itemname}}">
                                                                    {{$itemdata->itemname}}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                    </form>
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
                                                                <th width="40%">Item</th>
                                                                <th width="25%">Qty</th>
                                                                {{-- <th width="15%">Price</th> --}}
                                                                <th width="25">Total</th>
                                                                <th width="10%"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="sale-view-cart">
                                                            @foreach($ordertamps as $row)
                                                            <?php 
                                                                // var_dump($row);
                                                                if($row['itemid']!=null) {
                                                                    ?>
                                                                    <tr>
                                                                        <td>{{ $row->itemname }}</td>
                                                                        <td>
                                                                            <input onchange="updatetamp('{{ $row->id }}')" type="number" class="form-control" min="1" autocomplete="off" name="qty" id="qty{{ $row->id }}" value="{{ $row->quantity }}" style="text-align:center">
                                                                        </td>
                                                                        <td>{{ $row->price }}</td>
                                                                        <td>
                                                                            <a href="javascript:void(0)" id="cart-delete" onclick="deletetamp('{{ $row->id }}')" data-id="a21ffd04a22e4dd8522d27e854aa2878" class="btn btn-outline-danger btn-sm "><i class="fa fa-trash"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                }else{
                                                                ?>
                                                                <tr>
                                                                        <?php if($row->itemname!=Null){ ?>
                                                                            <td>{{ $row->setname.'-'.$row->itemname }}</td>
                                                                        <?php }else{ ?>
                                                                            <td>{{ $row->setname }}</td>
                                                                        <?php } ?>
                                                                        <td>
                                                                            <input onchange="updatetamp('{{ $row->id }}')" type="number" class="form-control" min="1" autocomplete="off" name="qty" id="qty{{ $row->id }}" value="{{ $row->quantity }}" style="text-align:center">                                         </td>
                                                                        <td>{{ $row->price }}</td>
                                                                        <td>
                                                                            <a href="javascript:void(0)" id="cart-delete" onclick="deletetamp('{{ $row->id }}')" class="btn btn-outline-danger btn-sm "><i class="fa fa-trash"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                    }
                                                                ?>
                                                                
                                                                @endforeach
                                                        </tbody>
                                                    </table>
                                                    
                                                    <form method="post" action="{{ route('order.send') }}">
                                                    @csrf    
                                                        <div id="total_count">
                                                            <div class="form-group row">
                                                                <label class="col-sm-3 col-form-label">Table No</label>
                                                                <div class="col-sm-9">
                                                                    <select onchange="enableOrderButton()" name="tableno" class="form-control fill" required>
                                                                        <option value="">Select Table No</option>
                                                                        @foreach($tablenos as $tableno)
                                                                            <option value="{{ $tableno->title }}">{{ $tableno->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        {{-- <a href="#" onclick="return(confirm('Are You Sure to Discard'))" class="btn btn-danger btn-min-width ml-2 mb-1 float-left"><i class="fa fa-remove"></i> Discard Sales</a> --}}
                                                        <button type="submit" id="complete-order" class="btn btn-info btn-min-width mr-1 mb-1" style="float: right" disabled><i class="fa fa-paper-plane"></i> Send Order</button>
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
    function enable(id){
        $("#cartadd"+id).prop('disabled', false);
    }

    function enableOrderButton(){
        // alert('set');
        $("#complete-order").prop('disabled', false);
    }

    //add item
    function additem(id){
    $.ajax({
        url: "{{ url('/place/order') }}" + '/' + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $('#sale-view-cart').empty();
          var tamps='';
        //   var grandtotal=$('#grandtotal').val();
          for(var i=0; i<data.length; i++){
            var id = data[i].id;
            var itemid = data[i].itemid;
            var setitemid = data[i].setitemid;
            var setname = data[i].setname;
            var itemname = data[i].itemname;
            var title = data[i].itemname;
            var price = data[i].price;
            var quantity = data[i].quantity;

            tamps = '<tr>';
            if(itemid){
                tamps += '<td>'+title+'</td>';
            }else if(setitemid){
                if(itemname!=null){
                    tamps += '<td>'+setname+'-'+title+'</td>';
                }else{
                    tamps += '<td>'+setname+'</td>';
                }
            }
            tamps += '<td>';
            tamps += '<input type="number" onchange="updatetamp('+id+')" class="form-control" min="1" autocomplete="off" name="qty" id="qty'+id+'" value="'+quantity+'" style="text-align:center">';
            tamps += '</td>';
            tamps += '<td>'+price+'</td>';
            tamps += '<td><a href="javascript:void(0)" id="cart-delete" onclick="deletetamp('+id+')" class="btn btn-outline-danger btn-sm "><i class="fa fa-trash"></i></a></td>';
            tamps += '</tr>';

            $("#sale-view-cart").append(tamps); 
          }
        },
        error: function (data) {
          alert('Ghorer Dim');
        }
      });
    }

    //update tamps
    function updatetamp(id){
        var id=id;
        var quantity=$("#qty"+ id).val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        // alert(CSRF_TOKEN);
        $.ajax({
                type:"POST",
                url:"{{ url('/update/set/order') }}",
                data: {_token: CSRF_TOKEN, quantity:quantity, id: id},
                dataType: "JSON",
                success:function(data){
                    console.log(data);
                    $('#sale-view-cart').empty();
                    var tamps='';
                    for(var i=0; i<data.length; i++){
                        var id = data[i].id;
                        var itemid = data[i].itemid;
                        var setitemid = data[i].setitemid;
                        var setname = data[i].setname;
                        var itemname = data[i].itemname;
                        var title = data[i].itemname;
                        var price = data[i].price;
                        var quantity = data[i].quantity;

                        tamps = '<tr>';
                        if(itemid){
                            tamps += '<td>'+title+'</td>';
                        }else if(setitemid){
                            if(itemname!=null){
                                tamps += '<td>'+setname+'-'+title+'</td>';
                            }else{
                                tamps += '<td>'+setname+'</td>';
                            }
                        }
                        tamps += '<td>';
                        tamps += '<input type="number" onchange="updatetamp('+id+')" class="form-control" min="1" autocomplete="off" name="qty" id="qty'+id+'" value="'+quantity+'" style="text-align:center">';
                        tamps += '</td>';
                        tamps += '<td>'+price+'</td>';
                        tamps += '<td><a href="javascript:void(0)" id="cart-delete" onclick="deletetamp('+id+')" class="btn btn-outline-danger btn-sm "><i class="fa fa-trash"></i></a></td>';
                        tamps += '</tr>';

                        $("#sale-view-cart").append(tamps); 
                    }
                },
                error : function (data) {
                    alert('Ghorer Dim');
                }
            });
    }

    //delete tamps
    function deletetamp(id){
        $.ajax({
        url: "{{ url('/delete/order') }}" + '/' + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#sale-view-cart').empty();
            var tamps='';
            for(var i=0; i<data.length; i++){
                var id = data[i].id;
                var itemid = data[i].itemid;
                var setitemid = data[i].setitemid;
                var setname = data[i].setname;
                var itemname = data[i].itemname;
                var title = data[i].itemname;
                var price = data[i].price;
                var quantity = data[i].quantity;

                tamps = '<tr>';
                if(itemid){
                    tamps += '<td>'+title+'</td>';
                }else if(setitemid){
                    if(itemname!=null){
                        tamps += '<td>'+setname+'-'+title+'</td>';
                    }else{
                        tamps += '<td>'+setname+'</td>';
                    }
                }
                tamps += '<td>';
                tamps += '<input type="number" onchange="updatetamp('+id+')" class="form-control" min="1" autocomplete="off" name="qty" id="qty'+id+'" value="'+quantity+'" style="text-align:center">';
                tamps += '</td>';
                tamps += '<td>'+price+'</td>';
                tamps += '<td><a href="javascript:void(0)" id="cart-delete" onclick="deletetamp('+id+')" class="btn btn-outline-danger btn-sm "><i class="fa fa-trash"></i></a></td>';
                tamps += '</tr>';

                $("#sale-view-cart").append(tamps); 
            }
        },
        error: function (data) {
          alert('Ghorer Dim');
        }
      });
    }
</script>
@endsection



												