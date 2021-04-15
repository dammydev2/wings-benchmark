@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    	@if(Session::has('success'))
    	<div class="alert alert-success">{{ Session::get('success') }}</div>
    	@endif

    	@if(Session::has('error'))
    	<div class="alert alert-danger">{{ Session::get('error') }}</div>
    	@endif

    	<table class="table table-bordered">
    	    @if(\Auth::User()->type == 0)
    		<tr>
    			<th colspan="4"><center><a href="{{ url('/addrider') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add new Rider</a></center></th>
    		</tr>
    		@endif
    		<tr>
    			<th>Rider Name</th>
    			<th>Rider id</th>
    			<th>Rider Address</th>
    			<th>Rider Phone</th>
    			<th></th>
    			<th></th>
    		</tr>
    		@foreach($data as $row)
    		<tr>
    			<th>{{ $row->name }}</th>
    			<th>{{ $row->rider_id }}</th>
    			<th>{{ $row->address }}</th>
    			<th>{{ $row->phone }}</th>
    			<td><a href="{{ url('/rideredit/'.$row->id) }}">Edit</a></td>
    			<td><a href="{{ url('/riderdelete/'.$row->id) }}"><i class="fa fa-trash btn btn-danger"></i></a></td>
    		</tr>
    		@endforeach
    	</table>


    </div>
</div>
@endsection
