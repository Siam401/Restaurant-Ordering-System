@extends('backend.layouts.master')

@section('css')
	<style>	
		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
		}
	</style>
@endsection
@section('content')

						<div class="pcoded-inner-content">
							<div class="main-body">
								<div class="page-wrapper">
									<div class="page-body">
										<div class="row justify-content-center">
											<div class="col-sm-3">
												<div class="card">
													{{-- <div class="card-header">
															<h2 class="page-header">
																<small class="pull-left">Date: {{ $date->toDateString() }}</small>
															</h2>
													</div> --}}
													<div class="card-block">
															<!-- info row -->
																	<!-- Table row -->
																	<div class="row" id="printArea">
																			<div class="col-xs-12 table-responsive">
																					
																						<h4>Invoice #{{ $invoice }}</h4>
																						<h4>Tableno {{ $tableno }}</h4>		
																				<table width="100%">
																					<thead>
																						<tr>
																							<th>Item</th>
																							<th align="right">Qty</th>
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
																							<td align="right">{{ $item->quantity }}</td>
																						</tr>
																						@endforeach
																						@foreach($sets as $setitem)
																						<?php
																							$totalprice+=$setitem->price;
																						?>
																						<tr>
																							<td>{{ $setitem->setname }}</td>
																							<td align="right">{{ $setitem->quantity }}</td>
																						</tr>
																						<?php
																						$items=DB::select(DB::raw("select item,quantity from orders where invoice='$invoice' and setname!='' and item!='' and sl=$setitem->sl")); 
											
																						// dd($items);
																						if(!empty($items)){
																						?>
																						<tr>
																							<td colspan="3">
																								@php
																								
																									// if(!empty($items)){
																									// 	if(count($items)>1){
																											foreach ($items as $fixeditem) 
																											{
																												echo $fixeditem->item."(".$fixeditem->quantity.") |";
																											}
																									// 	}elseif (count($items)==1) {
																									// 		echo $fixeditem->item." X (".$fixeditem->quantity.")";
																									// 	}  
																									// }
																								@endphp 
																							</td>
																						</tr>
																						<?php
																									}		
																						?>
																						@endforeach
																						
																					</tbody>
																				</table>
																				
																				<br><br><br><br>
																				
																				{{-- <table width="100%">
																					<tbody>	
																						<tr>
																							<td align="left">Adminname : {{ Auth::user()->name }}</td>
																							<th>Authorization</th>
																						</tr>
																					</tbody>
																				</table> --}}
																			</div><!-- /.col -->
																			<div class="col-sm-12">
																				<div class="row justify-content-center">
																					<div class="col-sm-6">
																						<p>{{ Auth::user()->name }}</p>
																					</div>
																					<div class="col-sm-6">
																						<p>Authorization</p>
																					</div>
																				</div>
																			</div>
																		</div><!-- /.row -->
																		
									
														<div class="card-footer">	
															<div class="row justify-content-center">
																<div class="col-sm-12">
																	<button type="button" onclick="printDiv('printArea')" class="btn btn-primary" style="margin-left:60px">Print</button>
																</div>
																{{-- <div class="col-sm-6">	 --}}
																	{{-- <button class="btn btn-success" style="float: right"><i class="fa fa-credit-card"></i> Submit Payment</button> --}}
																	{{-- <a href="{{ route('order.pdfview',$invoice) }}" class="btn btn-primary" style="float: right;margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</a> --}}
																	{{-- <button type="button" onclick="printDiv('printArea')" class="btn btn-primary">Print</button> --}}
																{{-- </div> --}}
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
@section('script')
<script>
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
@endsection