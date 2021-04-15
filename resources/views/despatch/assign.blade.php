@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		<div class="col-sm-5 col-sm-12 panel panel-primary">
			<div class="panel-heading">Assign Despatch Rider</div>
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

				<form method="post" action="{{ url('/updateorder') }}">
					@csrf

					<div class="form-group">
						<label>Select Rider</label>
						<select name="rider" class="form-control">
							@foreach($data2 as $row)
							<option>{{ $row->name }}</option>
							@endforeach
						</select>
					</div>

					@foreach($data as $row)
					<div class="form-group">
						<label>Order ID</label>
						<input type="text" name="order_id" readonly="" value="{{ $row->order_id }}" class="form-control">
					</div>

					<div class="form-group">
						<label>Item</label>
						<input type="text" name="item" readonly="" value="{{ $row->item }}" class="form-control">
					</div>

					<div class="form-group">
						<label>Sender</label>
						<input type="text" name="name" readonly="" value="{{ $row->name }}" class="form-control">
					</div>

					<div class="form-group">
						<label>Pick-up Address</label>
						<input type="text" name="address" readonly="" value="{{ $row->address }}" class="form-control">
					</div>

					<div class="form-group">
						<label>Destination</label>
						<input type="text" name="destination" readonly="" value="{{ $row->pick_address }}" class="form-control">
					</div>
					
					<div class="form-group">
						<label>Rider to collect cash</label>
						<select class="form-control" name="collect">
						    <option value="0">NO</option>
						    <option value="1">Yes</option>
						</select>
					</div>

					
					
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
@endsection
