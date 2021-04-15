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

    	<table class="table" style="display: block; overflow-x: scroll; overflow-y: scroll;">
    		<tr>
    			<th colspan="4"><center><a href="{{ url('/addnewdeposit') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add new</a></center></th>
    		</tr>
    		<tr>
    			<th>Name</th>
                <th>Wings ID</th>
                <th>email</th>
    			<th>Phone</th>
                <th>Amount</th>
    		</tr>

            @foreach($data as $row)
            <tr>
                <td>{{ $row->name }}</td>
                <td>{{ $row->wings_id }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->phone }}</td>
                <td>{{ number_format($row->amount, 2) }}</td>
                <td><a href="{{ url('/addeposit/'.$row->id) }}">Add Payment</a></td>
            </tr>
            @endforeach

            
    		
    	</table>


    </div>
</div>
@endsection
