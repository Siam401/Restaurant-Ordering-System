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
                                <h5>Set Menu</h5>
                                <button type="button" style="float: right" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Set</button>
                            </div>
                            <div class="card-block">
                                <div class="dt-responsive table-responsive">
                                    {{-- <table id="multi-colum-dt" class="table table-striped table-bordered nowrap"> --}}
                                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>Set Name</th>
                                                <th>Fixed Item</th>
                                                <th>Selected Item</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($setitems as $row)
                                                <tr>
                                                    <td>{{ $row->setname }}</td>
                                                    <td>
                                                    @php
                                                        $fixeditems=explode(",",$row->fixeditem); 

                                                        if(count($fixeditems)>1){
                                                            foreach ($fixeditems as $fixeditem) {
                                                                $item = App\Item::findOrFail($fixeditem);
                                                                echo $item->itemname."|";
                                                            }
                                                        }elseif (count($fixeditems)==1) {
                                                            $item = App\Item::where('id',$fixeditems)->first();
                                                            echo $item->itemname;
                                                        }    
                                                    @endphp
                                                    </td>
                                                    <td>
                                                    @php
                                                        $selecteditems=explode(",",$row->selecteditem); 

                                                        if(count($selecteditems)>1){
                                                            foreach ($selecteditems as $selecteditem) {
                                                                $item = App\Item::findOrFail($selecteditem);
                                                                echo $item->itemname."|";
                                                            }
                                                        }    
                                                    @endphp
                                                    </td>
                                                    <td>{{ $row->price }}</td>
                                                    <td>{{ $row->quantity }}</td>
                                                    
                                                    <td>
                                                        <a href="#" class="btn btn-danger">Delete</a>
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
                            <h5 class="modal-title" id="exampleModalLabel">Create Set</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('setitem.store') }}" method="post">
                                    @csrf    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="setname" class="form-control" placeholder="Type setmenu name">
                                        </div>
                                    </div>    
                                    {{-- <div class="form-group row">
                                        <label class="col-sm-12 col-form-label">Fixed Items</label>
                                    </div>    --}}
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            <label class="col-sm-2 col-form-label">Fixed</label> 
                                        </div>
                                        <div class="col-sm-10">
                                            <select multiple="multiple" class="form-control" id="my-select" name="fixeditem[]">
                                                @foreach ($items as $row)
                                                    <option value='{{ $row->id }}'>{{ $row->itemname }}</option>
                                                @endforeach
                                            </select>       
                                        </div>
                                    </div>   
                                    {{-- <div class="form-group row">
                                        <label class="col-sm-12 col-form-label">Selected Items</label>
                                    </div>    --}}
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            <label class="col-sm-2 col-form-label">Selected</label> 
                                        </div>
                                        <div class="col-sm-10">
                                            <select multiple="multiple" class="form-control" id="my-select1" name="selecteditem[]">
                                                @foreach ($items as $row)
                                                    <option value='{{ $row->id }}'>{{ $row->itemname }}</option>
                                                @endforeach
                                            </select>       
                                        </div>
                                    </div>  
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Price</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="price" class="form-control" placeholder="Type price">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Quantiy</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="quantity" class="form-control" placeholder="Type quantity">
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
    $('#my-select').multiSelect();
    $('#my-select1').multiSelect();
    });
</script>
@endsection
												