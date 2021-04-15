@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		<div class="col-sm-5 col-sm-12 panel panel-primary">
			<div class="panel-heading">Edit Rider</div>
			<div class="panel-body">

				@if ($errors->any())
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</div>
				@endif

				<form method="post" action="{{ url('/updaterider') }}">
					@csrf

					@foreach($data as $row)
					<div class="form-group">
						<label>Rider's Name</label>
						<input type="text" name="name" value="{{ $row->name }}" class="form-control">
					</div>

					<div class="form-group">
						<label>Rider's Address</label>
						<input type="text" name="address" value="{{ $row->address }}" class="form-control">
					</div>

					<div class="form-group">
						<label>Rider's Phone</label>
						<input type="text" name="phone" value="{{ $row->phone }}" class="form-control">
					</div>

					<input type="hidden" name="id" value="{{ $row->id }}">
					@endforeach

					<input type="submit" value="update" class="btn btn-primary" name="">

				</form>

			</div>  
		</div>



	</div>
</div>
@endsection
