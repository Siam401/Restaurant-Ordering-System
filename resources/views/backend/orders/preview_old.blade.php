@extends('backend.layouts.master')

@section('content')

						<div class="pcoded-inner-content">
							<div class="main-body">
								<div class="page-wrapper">
									<div class="page-body">
										<div class="row">
											<div class="col-sm-12">
												<div class="card">
													{{-- <div class="card-header">
															<h2 class="page-header">
																<small class="pull-left">Date: {{ $date->toDateString() }}</small>
															</h2>
													</div> --}}
													<div class="card-block">
															<!-- info row -->
																	<!-- Table row -->
																	<div class="row">
																			<div class="col-xs-12 table-responsive" id="printArea">
																					<table width="100%">
																							<tr>
																								<td></td>
																								<td align="center">
																									<h3>CompanyName</h3>
																								</td>
																								<td></td>
																							</tr>
																							<tr>
																								<td></td>
																								<td align="center">
																									Address1
																								</td>
																								<td></td>
																							</tr>
																							<tr>
																								<td></td>
																								<td align="center">
																									Address2
																								</td>
																								<td></td>
																							</tr>
																							<tr>
																								<td></td>
																								<td align="center">
																									Phone
																								</td>
																								<td></td>
																							</tr>
																					
																						</table>
																						<h4>Invoice #{{ $invoice }}</h4>
																						<h4>Tableno {{ $tableno }}</h4>		
																				<table class="table table-striped">
																					<thead>
																						<tr>
																							<th>Item</th>
																							<th>Qty</th>
																							<th>Sub Total</th>
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
																							<td>{{ $item->quantity }}</td>
																							<td>{{ $item->price }}</td>
																						</tr>
																						@endforeach
																						@foreach($sets as $setitem)
																						<?php
																							$totalprice+=$setitem->price;
																						?>
																						<tr>
																							<td>{{ $setitem->setname }}</td>
																							<td>{{ $setitem->quantity }}</td>
																							<td>{{ $setitem->price }}</td>
																						</tr>
																						<tr>
																							<td colspan="3">
																								@php
																								$fixeditems = App\Setitem::findOrFail($setitem->sl);
																								$fixeditems=explode(",",$fixeditems->fixeditem);$items=DB::select(DB::raw("select item,quantity from orders where invoice='$invoice' and setname!='' and sl=$setitem->sl")); 

																								if(count($fixeditems)>1){
																									foreach ($fixeditems as $fixeditem) {
																										$item = App\Item::findOrFail($fixeditem);
																										echo $item->itemname."(".$setitem->quantity.") |";
																									}
																								}elseif (count($fixeditems)==1) {
																									$item = App\Item::where('id',$fixeditems)->first();
																									echo $item->itemname." X (".$setitem->quantity.")";
																								}    
																								
																								if(count($items)>1){
																									foreach ($items as $fixeditem) {
																										echo $fixeditem->item."(".$fixeditem->quantity.") |";
																									}
																								}elseif (count($items)==1) {
																									echo $fixeditem->item." X (".$fixeditem->quantity.")";
																								}  
																								@endphp 
																							</td>
																						</tr>
																						@endforeach
																						{{-- <tr>
																							<td></td>
																						</tr>
																						<tr>
																							<td></td>
																						</tr> --}}
																						<tr>
																							<td></td>
																							<th>Total Price</th>
																							<td>{{ $totalprice }}</td>
																						</tr>
																						<tr>
																							<td></td>
																							<th>Vat</th>
																							<td>15%</td>
																						</tr>
																						<?php
																						$vatamount=Round(($totalprice*15)/100);
																						$grandtotal=$totalprice+$vatamount;
																						?>
																						<tr>
																							<td></td>
																							<th>Grand Total</th>
																							<td>{{ $grandtotal }}</td>
																						</tr>
																					</tbody>
																				</table>
																			</div><!-- /.col -->
																		</div><!-- /.row -->
															
									
															
									
															{{-- <div class="row">
																<div class="col-md-12">
																	<div class="table-responsive">
																		<table class="table">
																			<tbody>
																				<tr>
																					<th>Total:</th>
																					<td> </td>
																				</tr>
																			</tbody>
																		</table>
																	</div>
																</div>
															</div> --}}
									
															<!-- this row will not appear when printing -->
														<div class="card-footer">	
															<div class="row">
																<div class="col-sm-6">
																	{{-- <a href="" class="btn btn-info"><i class="fa fa-print"></i> Print</a> --}}
																</div>
																<div class="col-sm-6">	
																	{{-- <button class="btn btn-success" style="float: right"><i class="fa fa-credit-card"></i> Submit Payment</button> --}}
																	<a href="{{ route('order.pdfview',$invoice) }}" class="btn btn-primary" style="float: right;margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</a>
																	<button type="button" onclick="printDiv('printArea')" class="btn btn-primary" style="float: right;margin-right: 5px;">Print</button>
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
						</div>
@endsection
{{-- @section('script')
<script>
	function printDiv(divName) {
		window.print();
		alert('clicked');
		var printContents = document.getElementById(divName).innerHTML;
		alert(printContents);
		
		var originalContents = document.body.innerHTML;

		document.body.innerHTML = printContents;

		document.body.innerHTML = originalContents;
	}
</script>
@endsection --}}