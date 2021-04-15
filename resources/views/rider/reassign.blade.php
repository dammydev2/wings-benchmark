@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		<div class="col-sm-4 col-sm-12 panel panel-primary">
			<div class="panel-heading">Reassign Rider</div>
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

				<form method="post" action="{{ url('/doreassign') }}">
					@csrf

					<div class="form-group col-sm-12 col-lg-12">
						<label>Order ID</label>
						<input type="text" name="order_id" class="form-control">
					</div>

					<input type="submit" class="btn btn-primary" value="Reassign" name="">

				</form>

			</div>  
		</div>

	</div>
</div>
@endsection
