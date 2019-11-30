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
                                                <th>Ingredient</th>
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
                                                <td>{{ $row->ingredient }}</td>
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
        <div class="modal-dialog" role="document">
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
                            <label class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <input type="text" name="categoryid" class="form-control" placeholder="Type category name" list="category">
                                <datalist id="category">
                                    @foreach ($categories as $row)
                                        <option value="{{ $row->id."-".$row->categoryname }}">
                                    @endforeach
                                </datalist>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="itemname" class="form-control" placeholder="Type item name">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Ingredient</label>
                            <div class="col-sm-10">
                                <input type="text" name="ingredient" class="form-control" placeholder="Type ingredients">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input type="text" name="price" class="form-control" placeholder="Type price">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Quantity</label>
                            <div class="col-sm-10">
                                <input type="text" name="quantity" class="form-control" placeholder="Type quantity">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Portion</label>
                            <div class="col-sm-10">
                                <input type="text" name="portion" class="form-control" placeholder="Type portion">
                            </div>
                        </div>  
                
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

