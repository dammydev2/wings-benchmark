@foreach($data as $row)
<tr>


    <td><a href="{{ url('/orderdelete/'.$row->id) }}" onClick="return confirm(' sure to delete?')"><i class="fa fa-trash btn btn-danger"></i></a></td>
    <td><a href="{{ url('/edit/'.$row->id) }}">Edit</a></td>
    <td> {{ $row->type}}</td>
    <td>
        @if($row->assigned == 0)
        <span style="color: red;"> Unassigned </span>

        @elseif($row->assigned == 1)
        <span style="color: orange;"> Assigned </span>

        @elseif($row->assigned == 2)
        <span style="color: green;"> Delivered </span>
        @endif
    </td>
    <td> {{ $row->status}}
        @if(\Auth::User()->user_type === 'editor')
        <a href="#" data-toggle="modal" data-target="#exampleModal{{ $row->id }}"><i class="fa fa-edit"></i></a>
        @endif
        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="color:black;" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit payment status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ url('editPayment') }}" method="post">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $row->order_id }}">
                            <div class="form-group">
                                <label for="">change status</label>
                                <select name="status" id="" class="form-control">
                                    <option>credit</option>
                                    <option>paid</option>
                                </select>
                            </div>
                            <input type="submit" class="btn btn-primary">
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </td>
    <td>
        @if($row->status != 'paid')
        <form method="post" action="addpayment">
            @csrf
            <input type="hidden" name="order_id" value="{{$row->order_id}}">
            <input type="submit" onclick="return confirm('Sure to confirm payment?')" class="btn btn-link" value="add payment" name="">
        </form>
        @endif
    </td>
    <td>
        @if($row->rider == '')
        <a href="{{ url('/assign/'.$row->id) }}">Assign</a>
        @endif
    </td>
    <td> {{ $row->item}}</td>
    <td> {{ $row->address}} </td>
    <!-- <td> {{ $row->pick_time}} </td>
    <td> {{ $row->delivery_time}} </td> -->
    <td> {{ $row->order_id}} </td>
    <td> {{ $row->amount}} </td>
    <td> {{ $row->name}} </td>
    <td> {{-- $row->cus_phone --}} <a href="#" data-toggle="modal" data-target="#detailsModal{{ $row->id }}">order details</a>  </td>
    <!-- <td> {{ $row->email }} </td>
    <td> {{ $row->ben_name}} </td>
    <td> {{ $row->ben_phone}} </td>
    <td> {{ $row->pick_address}} </td> -->
</tr>

<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="detailsModal{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <li>Customer Name <b>{{ $row->name}}</b></li>
                <li>Order cost: <b>{{ number_format($row->amount, 2) }}</b></li>
                <li>Order type: <b>{{ $row->type }}</b></li>
                <li>Status: <b>{{ $row->assigned }}</b></li>
                <li>Payment status: <b>{{ $row->status }}</b></li>
                <li>Payment status: <b>{{ $row->status }}</b></li>
                <li>Quantity of items: <b>{{ $row->item}}</b></li>
                <li>Pick-up address: <b>{{ $row->address}}</b></li>
                <li>Pick-up time: <b>{{ $row->pick_time}}</b></li>
                <li>Delivery time: <b>{{ $row->delivery_time}}</b></li>
                <li>Order id: <b>{{ $row->order_id}}</b></li>
                <li>Customer phone: <b>{{ $row->cus_phone}}</b></li>
                <li>Customer email: <b>{{ $row->email }}</b></li>
                <li>Beneficiary name: <b>{{ $row->ben_name}}</b></li>
                <li>Beneficiary phone: <b>{{ $row->ben_phone}}</b></li>
                <li>Beneficiary Address <b>{{ $row->pick_address}}</b></li>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>

</tr>
@endforeach
<tr>
    <td colspan="10" align="center">
        {!! $data->links() !!}
    </td>
</tr>