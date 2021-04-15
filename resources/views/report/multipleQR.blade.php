@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <a href="#" onclick="window.print()" id="printPageButton" class="btn btn-primary"><i class="fa fa-print"></i>Print</a>
    </div>

    <div class="col-lg-2"></div>

    <div class="col-lg-8">
        
        
            
      @foreach($data as $row)

<!--::::::::THE QR CODE IS HERE:::::::-->
            <span style=""> {!! QrCode::size(150)->generate('Item: '. $row->item. ' | Sender Name: '. $row->name . ' | Pick-up Address: '. $row->address . ' | Destination: '. $row->pick_address . ' | Reciever Name: '. $row->ben_name . ' | Reciever Phone: '. $row->ben_phone . ' | Wings Delivery ' ); !!}<br> <span style="margin-top: -150px;">{{ $row->order_id }}</span> </span><hr>

            @endforeach



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
