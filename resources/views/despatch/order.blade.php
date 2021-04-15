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
    	
    	

    	<!--<table class="table" style="display: block; overflow-x: scroll; overflow-y: scroll; width: 80%">
    		<tr>
    			<th colspan="4"><center><a href="{{ url('/addorder') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add new order</a></center></th>
    		</tr>
    		<tr>
    		    <th></th>
    		    <th>Delivery Status</th>
    		    <th>Payment Status</th>
    		    <th></th>
    		    <th></th>
    		    <th></th>
    			<th>Type</th>
                <th>Item</th>
                <th>Pick-up Address</th>
                <th>Order ID</th>
    			<th>Amount</th>
    			<th>Customer name</th>
                <th>Customer phone</th>
                <th>Customer email</th>
                <th>Beneficiary Name</th>
                <th>Beneficiary phone</th>
                <th>Beneficiary address</th>
    		</tr>

            @foreach($data as $row)
            <tr>
                <td><a href="{{ url('/orderdelete/'.$row->id) }}" onclick="return confirm('sure to delete?')"><i class="fa fa-trash btn btn-danger"></i></a></td>
                <td>
                    @if($row->assigned == 0)

                   <span style="color: red;"> Unassigned </span>

                    @elseif($row->assigned == 1)

                   <span style="color: orange;"> Assigned </span>

                    @elseif($row->assigned == 2)

                   <span style="color: green;"> Delivered </span>

                    @endif
                </td>
                <td>{{ $row->status }}</td>
                <td>
                    @if($row->status != 'paid')
                    <form method="post" action="{{ url('/addpayment') }}">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $row->order_id }}">
                        <input type="submit" class="btn btn-link" value="add payment" name="">
                    </form>
                    @endif
                </td>
                <td>
                    @if($row->rider == '')
                    <a href="{{ url('/assign/'.$row->id) }}">Assign</a>
                    @endif
                </td>
                <td>
                    <a href="{{ url('/edit/'.$row->id) }}">Edit</a>
                </td>
                <td>{{ $row->type }}</td>
                <td>{{ $row->item }}</td>
                <td>{{ $row->address }}</td>
                <td>{{ $row->order_id }}</td>
                <td>{{ $row->amount }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->cus_phone }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->ben_name }}</td>
                <td>{{ $row->ben_phone }}</td>
                <td>{{ $row->pick_address }}</td>
            </tr>
            @endforeach

            {{ $data->links() }}
    		
    	</table>-->
    	
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    	<div class="container">
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3><center><a href="{{ url('/addorder') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add new order</a></center> </h3>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<input type="text" class="form-controller form-control" id="search" placeholder="Serach using: 'Names','Phone', 'Rider', 'address', 'order ID', 'delivery Type'  " name="search"></input>
						</div>
						<table class="table table-bordered table-hover" style="display: block; overflow-x: scroll; overflow-y: scroll; width: 90%">
							<thead>
								<tr>
									<th></th>
									<th></th>
                        		    <th>Type</th>
                        		    <th>Delivery Status</th>
                        		    <th>Payment Status</th>
                        		    <th></th>
                        			<th>Assign Rider</th>
                                    <th>Item</th>
                                    <th>Pick-up Address</th>
                                    <th>Pick-up Time</th>
                                    <th>Delivery Time</th>
                                    <th>Order ID</th>
                        			<th>Amount</th>
                        			<th>Customer name</th>
                                    <th>Customer phone</th>
                                    <th>Customer email</th>
                                    <th>Beneficiary Name</th>
                                    <th>Beneficiary phone</th>
                                    <th>Beneficiary address</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
		
			$(window).on('load', function () {
				$value="A";
				$.ajax({
					type : 'get',
					url : '{{URL::to('search')}}',
					data:{'search':$value},
					success:function(data){
						$('tbody').html(data);
					}
				});
			})
		
		
			$('#search').on('keyup',function(){
				$value=$(this).val();
				$.ajax({
					type : 'get',
					url : '{{URL::to('search')}}',
					data:{'search':$value},
					success:function(data){
						$('tbody').html(data);
					}
				});
			})
		</script>
		<script type="text/javascript">
			$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
		</script>

    	<script>
$(document).ready(function(){
    $("#product").on("click", function(){
        var dataId = $(this).attr("data-id");
        alert("The data-id of clicked item is: " + dataId);
        console.log(dataId);
    });
});
</script>
    	


    </div>
</div>
@endsection
