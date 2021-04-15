@foreach($data as $row)
<tr>
    
				
				<td><a href="{{ url('/orderdelete/'.$row->id) }}" onClick="return confirm("sure to delete?")"><i class="fa fa-trash btn btn-danger"></i></a></td>
				<td><a href="{{ url('/edit/'.$row->id) }}">Edit</a></td>
				<td>	{{ $row->type}} </td>
				<td>	
			    @if($row->assigned == 0)
				    <span style="color: red;"> Unassigned </span>
				
				@elseif($row->assigned == 1)
				    <span style="color: orange;"> Assigned </span>
				
				@elseif($row->assigned == 2)
				    <span style="color: green;"> Delivered </span>
				@endif
				</td>
				<td>	{{ $row->status}} </td>
				<td>	
				@if($row->status != 'paid')
			        <form method="post" action="addpayment">
                        @csrf
                        <input type="hidden" name="order_id" value="'.$row->order_id .'">
                        <input type="submit" class="btn btn-link" value="add payment" name="">
                    </form>
                    @endif
				</td>
				<td>	
			    @if($row->rider == '')
			        <a href="{{ url('/assign/'.$row->id) }}">Assign</a>
			    @endif
				</td> 
				<td>    {{ $row->item}}  </td> 
				<td>    {{ $row->address}}  </td> 
				<td>    {{ $row->pick_time}}  </td> 
				<td>    {{ $row->delivery_time}}  </td> 
				<td>    {{ $row->order_id}}  </td> 
				<td>    {{ $row->amount}}  </td> 
				<td>    {{ $row->name}}  </td> 
				<td>    {{ $row->cus_phone}}  </td> 
				<td>    {{ $row->email }} </td> 
				<td>    {{ $row->ben_name}}  </td> 
				<td>    {{ $row->ben_phone}}  </td> 
				<td>    {{ $row->pick_address}}  </td> 
			</tr>
       
       
      </tr>
      @endforeach
      <tr>
       <td colspan="10" align="center">
        {!! $data->links() !!}
       </td>
      </tr>