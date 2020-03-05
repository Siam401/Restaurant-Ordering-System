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
                                @if(Session::has('message'))
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                @endif
                                <h5>Ingredient</h5>
                                <button type="button" style="float: right" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Ingredient</button>
                            </div>
                            <div class="card-block">
                                <div class="dt-responsive table-responsive">
                                    {{-- <table id="multi-colum-dt" class="table table-striped table-bordered nowrap"> --}}
                                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ingredients as $row)
                                                <tr>
                                                    <td>{{ $row->ingredientname }}</td>
                                                    <?php $unitname=DB::table('units')->select('unitname')->where('id',$row->unitid)->first(); ?>
                                                    <td>{{ $row->quantity }} {{ $unitname->unitname }}</td>
                                                    <td>{{ $row->price }}</td>
                                                    <td>
                                                        <form action="{{ route('ingredient.destroy',$row->id) }}" method="POST" onsubmit="if(confirm('Are you sure, you want to delete?')){return ture } else {return false };"> 
                                                        @csrf
                                                            <a href="{{ route('ingredient.edit',$row->id) }}" class="btn btn-info">Edit</a>
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
                            <h5 class="modal-title" id="exampleModalLabel">Create ingredient</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('ingredient.store') }}" method="post">
                                    @csrf    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="ingredientname" class="form-control" placeholder="Type ingredient name">
                                        </div>
                                    </div>    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Unit</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="unitid">
                                                @foreach ($units as $row)
                                                    <option value="{{ $row->id }}">{{ $row->unitname }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Price</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="price" class="form-control" placeholder="Type ingredient name">
                                        </div>
                                    </div>    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Quantity</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="quantity" class="form-control" placeholder="Type ingredient name">
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
@section('script')
<script>
$(document).ready(function() {
    $('#simpletable').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );
</script>
@endsection

												