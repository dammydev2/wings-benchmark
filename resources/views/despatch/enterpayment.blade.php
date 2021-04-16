@extends('layouts.app')

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<div class="container">
	<div class="row">

		<div class="col-sm-5 col-sm-12 panel panel-primary">
			<div class="panel-heading">Payment</div>
			<div class="panel-body">

				@if ($errors->any())
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</div>
				@endif

				@if(Session::has('success'))
				<div class="alert alert-success">{{ Session::get('success') }}</div>
				@endif

				<form method="post" action="{{ url('/inputpayment') }}">
					@csrf

					@foreach($data as $row)
					<div class="form-group">
						<label>Order ID</label>
						<input type="text" name="order_id" readonly="" value="{{ $row->order_id }}" class="form-control">
					</div>
					
					<div class="container form-group col-lg-6 col-sm-12">
						<div style="position: relative">
							<label>Delivery Time:</label>
							<input class="timepicker form-control" type="text" name="delivery_time">
						</div>
					</div>

					<div class="form-group col-lg-6 col-sm-12">
						<label>Amount</label>
						<input type="text" name="amount" readonly="" value="{{ $row->amount }}" class="form-control">
					</div>

					<div class="form-group">
						<label>Customer Name</label>
						<input type="text" name="name" readonly="" value="{{ $row->name }}" class="form-control">
					</div>

					<div class="form-group">
						<label>Payment mode</label>
						<select class="form-control" onchange="showMe(this);" name="mode">
							<option>Cash</option>
							<option>credit</option>
							<option>POS</option>
							<option>Transfer</option>
							<option>Wings Deposit</option>
						</select>
					</div>

					<div id="idShowMe" class="form-group" style="display: none">
						<label>Wings ID</label>
						<input type="text" name="wings_id" class="form-control">
					</div>
					
					<input type="hidden" name="type" value="{{ $row->type }}" class="form-control">
					
					@endforeach

					<input type="submit" class="btn btn-primary" name="">

				</form>

			</div>  
		</div>



	</div>
</div>
<script type="text/javascript">
	function showMe(e) {
		var strdisplay = e.options[e.selectedIndex].value;
		var e = document.getElementById("idShowMe");
		if(strdisplay == "Wings Deposit") {
			e.style.display = "block";
		} else {
			e.style.display = "none";
		}
	}
</script>
<script type="text/javascript">

	$('.timepicker').datetimepicker({

		format: 'HH:mm:ss'

	}); 

</script>
@endsection
