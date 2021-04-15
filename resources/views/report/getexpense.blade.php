@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

<div class="col-sm-12 col-sm-10">
    	<table class="table" border="1" >
    		<tr>
    			<th>Date</th>
    			<th>Name</th>
    			<th>Expenses for</th>
    			<th>Details</th>
    			<th>amount</th>
    			<th></th>
    		</tr>
    		<?php $count=0; ?>
    		@foreach($data as $row)
    		<tr>
    			<th> {{ $row->created_at }} </th>
    			<th> {{ $row->name }} </th>
    			<th> {{ $row->expenses }} </th>
    			<th> {{ $row->details }} </th>
    			<th> {{ $row->amount }} </th>
    			<th><a href="{{ url('expensedelete/'.$row->id) }}"><i class="fa fa-trash btn btn-danger"></i></a></th>
    			<?php $count +=$row->amount; ?>
    		</tr>
    		@endforeach
    		<tr>
    		    <th colspan="4" class="text-right">Total</th>
    		    <th>{{ number_format($count,2) }}</th>
    		</tr>
    	</table>
    	</div>

    </div>
</div>
<style>
    th{
        border: 1px solid #000;
    }
</style>
@endsection
