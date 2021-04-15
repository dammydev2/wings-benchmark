@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		<div class="col-sm-5 col-sm-12 panel panel-primary">
			<div class="panel-heading">Add Deposit</div>
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

				<form method="post" action="{{ url('/updatewings') }}">
					@csrf

					@foreach($data as $row)
					<input type="hidden" name="amount" value="{{ $row->amount }}" class="form-control">
					<input type="hidden" name="id" value="{{ $row->id }}" class="form-control">

					<div class="form-group">
						<label>Amount</label>
						<input type="text" name="amount2" class="form-control">
					</div>
					@endforeach

					<input type="submit" class="btn btn-primary" name="">

				</form>

			</div>  
		</div>



	</div>
</div>
@endsection
