@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    <div class=" col-sm-12 col-lg-10">
    	<table class="table" border="1">
    		<tr>
    			<th>Date</th>
    			<th>Name of client</th>
    			<th>Pick up Point</th>
    			<th>Delivery Point</th>
    			<th>Amount</th>
                <!--<th>Status</th>-->
                <th>Assigned to</th>
                <th>Order ID</th>
    		</tr>
    		<?php $count =0; ?>
    		@foreach($data as $row)
    		<?php
    		    $dt = new DateTime($row->created_at);
    		    $count += (int)$row->amount;

$date = $dt->format('d/m/Y');
    		?>
    		<tr>
    			<td> {{ $date }} </td>
    			<td> {{ $row->name }} </td>
    			<td> {{ $row->address }} </td>
    			<td> {{ $row->destination }} </td>
    			<td> {{ $row->amount }} </td>
                <td> {{ $row->rider }} </td>
                <td> {{ $row->order_id }} </td>
    		</tr>
    		@endforeach
    		<tr>
    		    <th colspan="4" class="text-right">Total</th>
    		    <th>{{ number_format($count, 2) }}</th>
    		    <th colspan="2"></th>
    		</tr>
    	</table>
    	</div>

    </div>
</div>
<style>
    td{
        border: 1px solid #000;
    }
</style>
@endsection