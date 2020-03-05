@extends('backend.layouts.master')

@section('content')

<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <center><h5>Update ingredient</h5></center>
                                <div class="card-header-right">
                                    <ul class="list-unstyled card-option">
                                        <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                        <li><i class="feather icon-maximize full-card"></i></li>
                                        <li><i class="feather icon-minus minimize-card"></i></li>
                                        <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                        <li><i class="feather icon-trash close-card"></i></li> <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row justify-content-center">
                                    <div class="col-sm-8">
                                    <form action="{{ route('ingredient.update',$ingredient->id) }}" method="post">
                                    @csrf    
                                    <input name="_method" type="hidden" value="PUT">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="ingredientname" class="form-control" value="{{ $ingredient->ingredientname }}">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Unit</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="unit">
                                                @foreach ($units as $row)
                                                    <option value="{{ $row->id }}" {{ $ingredient->unitid == $row->id ? 'selected="selected"' : '' }}>{{ $row->unitname }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Price</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="price" class="form-control" value="{{ $ingredient->price }}">
                                        </div>
                                    </div>    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Quantity</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="quantity" class="form-control" value="{{ $ingredient->quantity }}">
                                        </div>
                                    </div>
                                    <center><button type="submit" class="btn btn-primary">Update</button></center>   
                                    </form>  
                                    </div> 
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection