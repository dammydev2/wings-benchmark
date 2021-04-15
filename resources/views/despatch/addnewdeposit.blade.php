@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		<div class="col-sm-5 col-sm-12 panel panel-primary">
			<div class="panel-heading">Add New</div>
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

				<form method="post" action="{{ url('/addnewings') }}">
					@csrf

					<div class="form-group">
						<label>Customer Name</label>
						<input type="text" name="name" class="form-control">
					</div>

					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control">
					</div>

					<div class="form-group">
						<label>Phone</label>
						<input type="text" name="phone" class="form-control">
					</div>

					<div class="form-group">
						<label>Amount</label>
						<input type="text" name="amount" class="form-control">
					</div>

					<input type="submit" class="btn btn-primary" name="">

				</form>

			</div>  
		</div>



	</div>
</div>
@endsection
