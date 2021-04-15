@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		<div class="col-sm-5 col-sm-12 panel panel-primary">
			<div class="panel-heading">QR By Rider</div>
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

				<form method="post" action="{{ url('/multipleQR') }}">
					@csrf

					<div class="form-group">
						<label>Rider</label>
						<select class="form-control" name="rider">
							@foreach($data as $row)
							<option> {{ $row->name }} </option>
							@endforeach
						</select>
					</div>

					<div class="form-group col-sm-12 col-lg-6">
						<label>From</label>
						<input type="date" name="from" class="form-control">
					</div>

					<div class="form-group  col-sm-12 col-lg-6">
						<label>To</label>
						<input type="date" name="to" class="form-control">
					</div>

					<input type="submit" class="btn btn-primary" name="">

				</form>

			</div>  
		</div>

		<div class="col-sm-1"></div>

		<div class="col-sm-4 col-sm-12 panel panel-primary">
			<div class="panel-heading">Get QR code</div>
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

				@if(Session::has('error'))
				<div class="alert alert-danger">{{ Session::get('error') }}</div>
				@endif

				<form method="post" action="{{ url('/singleQR') }}">
					@csrf

					<div class="form-group col-sm-12 col-lg-12">
						<label>Order ID</label>
						<input type="text" name="order_id" class="form-control">
					</div>

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
