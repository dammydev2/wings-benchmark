@extends('layouts.app')

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<div class="container">
	<div class="row">
<div class="container">
	<div class="row">

		<div class="col-sm-8 col-sm-12 panel panel-primary">
			<div class="panel-heading">Edit Order</div>
			<div class="panel-body">

				@if ($errors->any())
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</div>
				@endif

				<form method="post" action="{{ url('/update') }}">
					@csrf

            @foreach($data as $row)
					<div class="form-group col-lg-6 col-sm-12">
						<label>Customer Type</label>
						<input type="text" name="type" value="{{ $row->type }}" class="form-control">
					</div>

					<div class="form-group col-lg-6 col-sm-12">
						<label>Item</label>
						<input type="text" name="item" value="{{ $row->item }}" class="form-control">
					</div>

					<div class="form-group col-lg-12 col-sm-12">
						<label>Pick-up Address</label>
						<input type="text" name="address"  value="{{ $row->address }}" class="form-control">
					</div>
					
					<div class="container form-group col-lg-6 col-sm-12">
						<div style="position: relative">
							<label>Pick-up Time:</label>
							<input class="timepicker form-control" required type="text" name="pick_time">
						</div>
					</div>

					<div class="form-group col-lg-6 col-sm-12">
						<label>Delivery Type</label>
						<input type="text" name="delivery_type"  value="{{ $row->delivery_type }}" class="form-control">
						</div>

					<div class="form-group col-lg-6 col-sm-12">
						<label>Delivery Amount</label>
						<input type="text" name="amount"  value="{{ $row->amount }}" class="form-control">
					</div>

					<div class="form-group col-lg-6 col-sm-12">
						<label>Customer Name</label>
						<input type="text" name="name"  value="{{ $row->name }}" class="form-control">
					</div>

					<div class="form-group col-lg-6 col-sm-12">
						<label>Customer phone</label>
						<input type="text" name="cus_phone"  value="{{ $row->cus_phone }}" class="form-control">
					</div>

					<div class="form-group col-lg-6 col-sm-12">
						<label>Customer Email</label>
						<input type="email"  value="{{ $row->email }}" name="email" class="form-control">
					</div>

					<div class="form-group col-lg-6 col-sm-12">
						<label>Delivery Beneficiary Name</label>
						<input type="text" name="ben_name"  value="{{ $row->ben_name }}" class="form-control">
					</div>

					<div class="form-group col-lg-6 col-sm-12">
						<label>Beneficiary Phone</label>
						<input type="text" name="ben_phone"  value="{{ $row->ben_phone }}" class="form-control">
					</div>

					<div class="form-group col-lg-6 col-sm-12">
						<label>Delivery Address</label>
						<input type="text" name="pick_address"  value="{{ $row->pick_address }}" class="form-control">
					</div>
					
					<input type="hidden" name="id"  value="{{ $row->id }}" class="form-control">
					
					@endforeach

					<input type="submit" class="btn btn-primary" name="">

				</form>

			</div>  
		</div>



	</div>
</div>
<script type="text/javascript">

	$('.timepicker').datetimepicker({

		format: 'HH:mm:ss'

	}); 

</script>
@endsection
