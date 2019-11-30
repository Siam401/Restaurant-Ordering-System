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
                                <h5>Pending Orders</h5>
                            </div>
                            <div class="card-block" id="app">
                                <div class="dt-responsive table-responsive">
                                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
												<th>SL</th>
                                                <th>Invoice</th>
                                                <th>Table no</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											@php
												$sl=1;
											@endphp
                                            @foreach($orders as $order)
                                            <tr>
                                                <td>{{ $sl++ }}</td>
                                                <td>{{ $order->invoice }}</td>
                                                <td>{{ $order->tableno }}</td>
                                                <td>
                                                	{{-- <a href="{{ route('order.bill',$order->invoice) }}" class="btn btn-info">Bill</a>
                                                	<a href="{{ route('order.chefpreview',$order->invoice) }}" class="btn btn-info">Chef</a> --}}
                                                	<a href="{{ route('order.preview',$order->invoice) }}" class="btn btn-info">Preview</a>
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



            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function() {
    $('#simpletable').DataTable( {
        "order": [[ 1, "desc" ]]
    } );
} );
</script>
@endsection

