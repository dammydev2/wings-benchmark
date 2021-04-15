<div class="col-lg-12 col-sm-12">
					<table class="table">

						<tr>
							<th colspan="13">

								<h3 style="margin-top: -40px; margin-left:150px;">WINGS BY NINESEAS LOGISTICS</h3>
								<span><center> Suite 17, Block B, Alausa Shopping Complex, 131 Obafemi Awolowo, Ikeja, Lagos State. </center></span>
								<span><center><i class="fa fa-phone"></i> 0908-6532-777 ,  08097765985 <i class="fa fa-envelope"></i> info@wingsng.com </center></span>
							</th>
						</tr>
						<tr>
							<th colspan="13"><center>{{ $client_name }} ({{ $phone }}) delivery data from {{ Session::get('from') }} to {{ Session::get('to') }}</center></th>
						</tr>
						<tr>
							<th>Date</th>
							@foreach($data as $row)
                             @endforeach
                             
                             @if($row->type == 'special order')
                             <th>Item</th>
                             @endif
							<th>Name of client</th>
							<th>Pick up Point</th>
							<th>Delivery Point</th>
							<th>Pickup Time</th>
							<th>Delivery Time</th>
							<th>Payment Status</th>
							<th>Order ID</th>
							<th>Beneficiary Name</th>
							<th>Beneficiary Address</th>
							<th>Beneficiary Phone</th>
							<th>Amount</th>
						</tr>
						<?php $sum=0; ?>
						@foreach($data as $row)
						<tr>
							<th> {{ $row->created_at }} </th>
							 @if($row->type == 'special order')
                             <th>{{ $row->item }}</th>
                             @endif
							<th> {{ $row->name }} </th>
							<th> {{ $row->address }} </th>
							<th> {{ $row->pick_address }} </th>
							<th> {{ $row->pick_time }} </th>
							<th> {{ $row->delivery_time }} </th>
							<th> {{ $row->status }} </th>
							<th> {{ $row->order_id }} </th>
							<th> {{ $row->ben_name }} </th>
							<th> {{ $row->pick_address }} </th>
							<th> {{ $row->ben_phone }} </th>
							<th> {{ $row->amount }} </th>
							<?php $sum += (int)$row->amount ?>
						</tr>
						@endforeach
						<tr>
							<th colspan="12" class="text-right">Cost of Delivery</th>
							<th> {{ number_format($sum, 2) }} </th>
						</tr>
						<tr style="color: green;">
							<th colspan="12" class="text-right">Paid</th>
							<th>
								<?php $sum2=0; ?> 
								@foreach($data2 as $row2)
								<?php $sum2 += (int)$row2->amount ?>
								@endforeach
								{{ number_format($sum2, 2) }}
							</th>
						</tr>
						<tr style="color: red;">
							<th colspan="12" class="text-right">Balance</th>
							<th>{{ $sum - $sum2 }}</th>
						</tr>
					</table>
				</div>


			<!--	<h1>Mail body goes  here</h1>
				<p>{{ $subject }}</p> -->

				<style type="text/css">
					th{
						border: 1px solid #000;
					}
					.text-right{
						text-align: right;
					}
					table{
					    font-size: 9px;
					}
				</style>

				<!-- Latest compiled and minified CSS -->
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

				<!-- jQuery library -->
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

				<!-- Latest compiled JavaScript -->
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>