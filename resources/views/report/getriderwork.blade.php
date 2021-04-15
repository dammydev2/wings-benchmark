@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <a href="#" onclick="window.print()" id="printPageButton" class="btn btn-primary"><i class="fa fa-print"></i>Print</a>
    </div>

    <div class="col-lg-2"></div>

    <div class="col-lg-8">
        
         <img src="{{ asset('images/wings-logo-80x80.png') }}" style="width: 50px; margin-left: 100px;"><h3 style="margin-top: -40px; margin-left:150px;">WINGS BY NINESEAS LOGISTICS</h3>
            <span><center> Suite 17, Block B, Alausa Shopping Complex, 131 Obafemi Awolowo, Ikeja, Lagos State. </center></span>
            <span><center><i class="fa fa-phone"></i> 0908-6532-777 ,  08097765985 <i class="fa fa-envelope"></i> info@wingsng.com </center></span>
            
            <p class="text-center"><b>WORK ORDER FORM</b></p>
            
            <?php $count = 1; ?>
      @foreach($data as $row)
      <div class="col-lg-12" style="border: 1px solid">
        <div class="col-lg-12 text-bold text-center">
         {{ 'work order '.$count++ }} <b>({{ $row->order_id }})</b>
        </div>
        
        <hr>
        <p style="margin-top: -30px;">&nbsp;</p>
        <p>Name of dispatch Rider: {{ $row->rider }} <span style="margin-left: 120px;">Time in</span> <span style="margin-left: 100px;">Time out</span> </p>
        
         <p>
           
            <!--::::::::THE QR CODE IS HERE:::::::-->
            <span style="float: right; margin-top: -70px; margin-right: -10px;"> {!! QrCode::size(50)->generate('Item: '. $row->item. ' | Sender Name: '. $row->name . ' | Pick-up Address: '. $row->address . ' | Destination: '. $row->pick_address . ' | Reciever Name: '. $row->ben_name . ' | Reciever Phone: '. $row->ben_phone . ' | Wings Delivery ' ); !!}</span>
            <!--::::::::THE QR CODE IS HERE:::::::-->
          </p>

        <table class="table">
          <tr>
            <td>Pick up Address: {{ $row->address }} </td>
            <td>Sender Name: {{ $row->name }}  </td>
          </tr>
          <tr>
            <td>Sender Number: {{ $row->cus_phone }}  </td>
            <td>Item: {{ $row->item }}  </td>
          </tr>
          <tr>
            <td>Delivery Beneficiary Name: {{ $row->ben_name }} </td>
            <td>Delivery Address: {{ $row->pick_address }}  </td>
          </tr>
          <tr>
            <td>Beneficiary Recepient Number: {{ $row->ben_phone }} </td>
            <td>
                @if($row->collect == 1)
                Collect Cash: <h4>NGN {{ number_format($row->amount,2) }}</h4>
                @endif
            </td>
          </tr>
        </table>
          <!--<p> </p>
          <p>Sender Name: {{ $row->name }} </p>
          <p>Sender Number: {{ $row->phone }} </p>
          <p>Item: {{ $row->item }} </p>
          <p>Delivery Beneficiary Name: {{ $row->ben_name }} </p>
          <p>Deliver Address: {{ $row->pick_address }} </p>
          <p>Beneficiary Recepient Number: {{ $row->ben_phone }} </p>
          <p>Pick-up Address: {{ $row->pick_address }} </p>-->

        </div>
        <p style="margin-top: -25px;">&nbsp;</p>
         
        @endforeach
        <?php $count++ ?>
        {{$data->links()}}
      </div>
      
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
