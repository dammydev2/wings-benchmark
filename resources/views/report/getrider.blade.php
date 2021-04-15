@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-sm-12 col-lg-10">
        	<table class="table table-bordered">
        		<tr>
        			<th>Date</th>
        			<th>Name of client</th>
        			<th>Pick up Point</th>
        			<th>Delivery Point</th>
        			<th>Amount</th>
                    <!--<th>Status</th>-->
                    <th>Desatch by</th>
                    <th>Order ID</th>
        		</tr>
        		<?php $count=0; ?>
        		@foreach($data as $row)
        		<?php $count += $row->amount ?>
        		<tr>
        			<th> {{ $row->created_at }} </th>
        			<th> {{ $row->name }} </th>
        			<th> {{ $row->address }} </th>
        			<th> {{ $row->destination }} </th>
        			<th> {{ number_format($row->amount, 2) }} </th>
                    <th> {{ $row->rider }} </th>
                    <th> {{ $row->order_id }} </th>
        		</tr>
        		@endforeach
        		<tr>
        		    <td colspan='4' class="text-right">Total</td>
        		    <td class="text-right">{{ number_format($count, 2) }}</td>
        		</tr>
        	</table>
        </div>

    </div>
</div>
@endsection
