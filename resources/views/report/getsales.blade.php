@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

<div class="col-lg-10 col-sm-12">
    	<table class="table">
    		<tr>
    			<th>Date</th>
    			<th>Name of client</th>
    			<th>Pick up Point</th>
    			<th>Delivery Point</th>
    			<th>Amount</th>
                <th>Status</th>
                <th>Desatch by</th>
                <th>Order ID</th>
    		</tr>
    		<?php $sum=0; ?>
    		@foreach($data as $row)
    		<tr>
    			<th> {{ $row->created_at }} </th>
    			<th> {{ $row->name }} </th>
    			<th> {{ $row->address }} </th>
    			<th> {{ $row->pick_address }} </th>
    			<th> {{ $row->amount }} </th>
                <th> {{ $row->status }} </th>
                <th> {{ $row->rider }} </th>
                <th> {{ $row->order_id }} </th>
    		</tr>
    		<?php $sum += (int)$row->amount ?>
    		@endforeach
    		<b>Total amount generated from {{ Session::get('from') }} to {{ Session::get('to') }} is {{ number_format($sum, 2) }} </b>
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
