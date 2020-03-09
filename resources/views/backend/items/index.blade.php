@extends('backend.layouts.master')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('ui/backend/files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ui/backend/files/assets/pages/data-table/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ui/backend/files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
@endsection
@section('content')

<div class="pcoded-inner-content">
    <div class="main-body"> 
        <div class="page-wrapper">
            <div class="page-body">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            @if(Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                            @endif
                            @if(Session::has('error'))
                            <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
                            @endif
                            <div class="card-header">
                                <h5>Items</h5>
                                <button type="button" style="float: right" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Item</button>
                            </div>
                            <div class="card-block">
                                <div class="dt-responsive table-responsive">
                                    <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>Item Name</th>
                                                <th>Category</th>
                                                <th>Price</th>
                                                <th>Portion</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($items as $row)
                                            <tr>
                                                <td>{{ $row->itemname }}</td>
                                                @php
                                                    $category=DB::table('categories')->where('id',$row->categoryid)->first();    
                                                @endphp
                                                <td>{{ $category->categoryname }}</td>
                                                <td>{{ $row->price }}</td>
                                                <td>{{ $row->portion }}</td>
                                                <td>
                                                    <form action="{{ route('item.destroy',$row->id) }}" method="POST" onsubmit="if(confirm('Delete? are you sure?')){return ture } else {return false };"> 
                                                    @csrf
                                                        <a href="{{ route('item.edit',$row->id) }}" class="btn btn-info">Edit</a>
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="submit" class="btn btn-danger btn-rounded">Delete</button>
                                                    </form> 
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('item.store') }}" method="post" autocomplete="off">
                    @csrf    
                        <div class="form-group row">
                            <div class="col">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="categoryid" class="form-control" placeholder="Type category name" list="category" required>
                                        <datalist id="category">
                                            @foreach ($categories as $row)
                                                <option value="{{ $row->id."-".$row->categoryname }}">
                                            @endforeach
                                        </datalist>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="itemname" class="form-control" placeholder="Type item name" required>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <div class="col">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="0" name="price" class="form-control" placeholder="Type price" required>
                                    </div>
                                </div> 
                            </div>
                            <div class="col">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Quantity</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="0" name="quantity" class="form-control" placeholder="Type quantity" required>
                                    </div>
                                </div> 
                            </div>
                        </div>    
                        <div class="form-group row">
                            <div class="col">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Portion</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="portion" class="form-control" placeholder="Type portion">
                                    </div>
                                </div>  
                            </div>
                            <div class="col">

                            </div>
                        </div>    
                        {{-- <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <input type="text" name="ingredient" class="form-control" placeholder="Type ingredients">
                            </div>
                        </div>  --}}
                        <table class="table table-borderless">
                            <tbody class="field_package_wrapper">
                              <tr>
                                  <td>Package</td>
                                <td>
                                    <select class="form-control" name="packageid[]">
                                        <option value=""></option>
                                        @foreach ($ipackages as $row)
                                            <option value="{{ $row->packageid }}">{{ $row->packagename }}</option>
                                        @endforeach  
                                    </select>
                                </td>
                                <td>
                                  <input type="number" min="0" class="form-control mb-2 mr-sm-2" id="email2" placeholder="Enter Quantity" name="packagequantity[]" > 
                                </td>
                                <td><a href="javascript:void(0);" class="btn btn-success btn-sm add_package">+</a></td>
                              </tr>
                            </tbody>
                          </table> 
                        <table class="table table-borderless">
                            <tbody class="field_wrapper">
                              <tr>
                                  <td>Ingredient</td>
                                <td>
                                    <select class="form-control" name="ingredientid[]" >
                                        <option value=""></option>
                                        @foreach ($ingredients as $row)
                                            <option value="{{ $row->id }}">{{ $row->ingredientname }}</option>
                                        @endforeach  
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="ingredientunit[]" >
                                        <option value=""></option>
                                        @foreach ($units as $row)
                                          <option value="{{ $row->id }}">{{ $row->unitname }}</option>
                                        @endforeach  
                                    </select>
                                </td>
                                <td>
                                  <input type="number" min="0" class="form-control mb-2 mr-sm-2" id="email2" placeholder="Enter Quantity" name="ingredientquantity[]" > 
                                </td>
                                <td><a href="javascript:void(0);" class="btn btn-success btn-sm add_ingredient">+</a></td>
                              </tr>
                            </tbody>
                          </table>  
                         
                
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Create</button>
            </form>
            </div>
        </div>
        </div>
    </div>


            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function() {
    var x = 1;
    var fieldHTML = '';

    $.ajax({
        url: "{{ url('/ingredient/all') }}",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            fieldHTML = '<tr><td></td><td>';
            fieldHTML += '<select class="form-control" name="ingredientid[]">';
            fieldHTML += '<option value=""></option>';
            //loop
            for(var i=0; i<data.ingredients.length; i++){ 
                var id = data.ingredients[i].id;  
                var ingredientname = data.ingredients[i].ingredientname;  
                fieldHTML += '<option value="'+id+'">'+ingredientname+'</option>'
            }
            fieldHTML += '</select></td><td><select class="form-control" name="ingredientunit[]">';
            fieldHTML += '<option value=""></option>';
            //loop
            for(var i=0; i<data.units.length; i++){ 
                var id = data.units[i].id;  
                var unitname = data.units[i].unitname;  
                fieldHTML += '<option value="'+id+'">'+unitname+'</option>'
            }
            fieldHTML += '</select></td><td>';
            fieldHTML += '<input type="number" min="0" class="form-control mb-2 mr-sm-2" id="email2" placeholder="Enter Quantity" name="ingredientquantity[]" required>';
            fieldHTML += '</td><td><a href="javascript:void(0);" class="btn btn-danger btn-sm remove_button">-</a></td></tr>';
        },
        error: function (data) {
          alert('Ghorer Dim');
        }
    });
    

    $('.add_ingredient').click(function(){
        x++; //Increment field counter
        $('.field_wrapper').append(fieldHTML);
    });

    $('.field_wrapper').on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).closest('tr').remove(); //Remove field html
        x--; //Decrement field counter
    });

    var y = 1;
    var packageHTML = '';

    $.ajax({
        url: "{{ url('/ipackage/all') }}",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            console.log(data);
            packageHTML = '<tr><td></td><td>';
            packageHTML += '<select class="form-control" name="packageid[]">';
            packageHTML += '<option value=""></option>';
            //loop
            for(var i=0; i<data.ipackages.length; i++){ 
                var packageid = data.ipackages[i].packageid;  
                var packagename = data.ipackages[i].packagename;  
                packageHTML += '<option value="'+packageid+'">'+packagename+'</option>'
            }
            packageHTML += '</select></td><td>';
            packageHTML += '<input type="number" min="0" class="form-control mb-2 mr-sm-2" id="email2" placeholder="Enter Quantity" name="packagequantity[]" required>';
            packageHTML += '</td><td><a href="javascript:void(0);" class="btn btn-danger btn-sm remove_package_button">-</a></td></tr>';
        },
        error: function (data) {
          alert('Ghorer Dim');
        }
    });

    $('.add_package').click(function(){
        y++; //Increment field counter
        $('.field_package_wrapper').append(packageHTML);
    });

    $('.field_package_wrapper').on('click', '.remove_package_button', function(e){
        e.preventDefault();
        $(this).closest('tr').remove(); //Remove field html
        y--; //Decrement field counter
    });
});
</script>
@endsection
