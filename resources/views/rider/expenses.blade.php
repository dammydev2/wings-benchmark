@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		<div class="col-sm-5 col-sm-12 panel panel-primary">
			<div class="panel-heading">Exenses</div>
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

				<form method="post" action="{{ url('/enterexpense') }}">
					@csrf

					<div class="form-group">
						<label>Expenses For</label>
						<input type="text" name="expenses" class="form-control">
					</div>

					<div class="form-group">
						<label>Amount</label>
						<input type="number" name="amount" class="form-control">
					</div>

					<div class="form-group">
						<label>More Detals</label>
						<textarea class="form-control" name="details"></textarea>
					</div>

					<input type="submit" value="Add Expenses" class="btn btn-primary" name="">

				</form>

			</div>  
		</div>



	</div>
</div>
@endsection
