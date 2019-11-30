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
                                <center><h5>Update item</h5></center>
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
                                <form action="{{ route('item.update',$item->id) }}" method="post" autocomplete="off">
                                @csrf    
                                    <input name="_method" type="hidden" value="PUT">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Category</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="categoryname" class="form-control" value="{{ $item->itemname }}" list="category">
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
                                            <input type="text" name="itemname" class="form-control" value="{{ $item->itemname }}">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Ingredient</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="ingredient" class="form-control" value="{{ $item->ingredient }}">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Price</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="price" class="form-control" value="{{ $item->price }}">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Portion</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="portion" class="form-control" value="{{ $item->portion }}">
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
@endsection