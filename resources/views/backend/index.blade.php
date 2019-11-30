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
															<h2 class="page-header">
																<i class="fa fa-globe"></i> Admindek
																<small class="pull-right">Date: 2017/01/09</small>
															</h2>
													</div>
													<div class="card-block">
															<!-- info row -->
															<div class="row invoice-info">
																<div class="col-sm-4 invoice-col">
																	From
																	<address>
																		<strong></strong>
																	</address>
																</div><!-- /.col -->
																<div class="col-sm-4 invoice-col">
																	To
																	<address>
																		<strong>
																			Shahid                                    </strong>
																		<br>
																		Address:
																		Kollanpur                                    <br>
																		Phone:
																		123456789                                   <br>
																		Email:ggggg@gmail.com                                </address>
																</div><!-- /.col -->
																<div class="col-sm-4 invoice-col">
																	<b>Invoice #007612</b><br>
																	<br>
																	<b>Order ID:</b> 4F3S8J<br>
																	<b>Payment Due:</b> 2/22/2014<br>
																	<b>Account:</b> 968-34567
																</div><!-- /.col -->
															</div><!-- /.row -->
									
															<!-- Table row -->
															<div class="row">
																<div class="col-xs-12 table-responsive">
																	<table class="table table-striped">
																		<thead>
																			<tr>
																				<th>Qty</th>
																				<th>Item</th>
																				 <th>Price</th>
																				<th>Sub Total</th>
																			</tr>
																		</thead>
																		<tbody>
																			<tr>
																				<td>2</td>
																				<td>Beef Burger</td>
																				<td>200</td>
																				<td>400</td>
																			</tr>
																			<tr>
																				<td>3</td>
																				<td>Set A</td>
																				<td>250</td>
																				<td>750</td>
																			</tr>
																			<tr>
																				<td>1</td>
																				<td>Set B</td>
																				<td>300</td>
																				<td>300</td>
																			</tr>
																		</tbody>
																	</table>
																</div><!-- /.col -->
															</div><!-- /.row -->
									
															<div class="row">
																<!-- accepted payments column -->
																<div class="col-md-12">
																	<p class="lead">Amount Due 2/22/2014</p>
																	<div class="table-responsive">
																		<table class="table">
																			<tbody>
																				<tr>
																					<th>Total:</th>
																					<td> 1450</td>
																				</tr>
																			</tbody>
																		</table>
																	</div>
																</div><!-- /.col -->
															</div><!-- /.row -->
									
															<!-- this row will not appear when printing -->
														<div class="card-footer">	
															<div class="row">
																<div class="col-sm-6">
																	<a href="" class="btn btn-info"><i class="fa fa-print"></i> Print</a>
																</div>
																<div class="col-sm-6">	
																	<button class="btn btn-success" style="float: right"><i class="fa fa-credit-card"></i> Submit Payment</button>
																	<a href="{{ route('bill.pdf') }}" class="btn btn-primary" style="float: right;margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</a>
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