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

        <div class="col-sm-12 col-lg-8">
           <table class="table table-bordered" >
              <tr>
                 <th colspan="4"><center><h3>Consigned to me </h3></center></th>
             </tr>
             <tr>
                 <th>Type</th>
                 <th>Item</th>
                 <th>Order ID</th>
                 <th></th>
             </tr>

             @foreach($data as $row)
             <tr>
                <td>{{ $row->type }}</td>
                <td>{{ $row->item }}</td>
                <td>{{ $row->order_id }}</td>
                <td><a href="{{ url('/delivered/'.$row->id) }}" onclick="return confirm('Are you sure?')">Delivered</a></td>
            </tr>
            @endforeach


        </table>
    </div>


</div>
</div>
@endsection
