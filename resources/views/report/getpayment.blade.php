@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

         <div class="col-lg-12">
            <a href="#" onclick="window.print()" id="printPageButton" class="btn btn-primary"><i class="fa fa-print"></i>Print</a>
        </div>

    	<table class="table table-bordered">
            <tr>
                <th colspan="8">
                    <img src="{{ asset('images/wings-logo-80x80.png') }}" style="width: 50px; margin-left: 100px;"><h3 style="margin-top: -40px; margin-left:150px;">WINGS BY NIINESEAS LOGISTICS</h3>
                    <span><center> Suite 17, Block B, Alausa Shopping Complex, 131 Obafemi Awolowo, Ikeja, Lagos State. </center></span>
                    <span><center><i class="fa fa-phone"></i> 0908-6532-777 ,  08097765985 <i class="fa fa-envelope"></i> info@wingsng.com </center></span>
                </th>
            </tr>
            <tr>
                <th colspan="8"><center>All Payments from {{ Session::get('from') }} to {{ Session::get('to') }}</center></th>
            </tr>
    		<tr>
    			<th>Date</th>
    			<th>Order ID</th>
    			<th>Name</th>
    			<th>Amount</th>
    			<th>Payment Mode</th>
    		</tr>
            <?php $total = 0;?>
    		@foreach($data as $row)
    		<tr>
    			<th> {{ $row->created_at }} </th>
    			<th> {{ $row->order_id }} </th>
                <th> {{ $row->name }} </th>
    			<th> {{ $row->amount }} </th>
    			<th> {{ $row->mode }} </th>
    		</tr>
            <?php $total+=$row->amount; ?>
    		@endforeach
    	</table>
        Total amount generated from {{ Session::get('from') }} to {{ Session::get('to') }} is &#x20a6; {{ number_format($total, 2) }}
    </div>
</div>
<style type="text/css">
    @media print {
      #printPageButton {
        display: none;
    }
}
</style>
@endsection
