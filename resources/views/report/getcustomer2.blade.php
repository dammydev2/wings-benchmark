@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

       <div class="col-lg-12">
        <a href="#" onclick="window.print()" id="printPageButton" class="btn btn-primary"><i class="fa fa-print"></i>Print</a>
        <button onclick="exportTableToExcel('tblData', '{{ $tableName }}')" class="btn btn-warning">Excel</button>
    </div>

    <div class="col-lg-10 col-sm-12">
    	<table class="table" id="tblData">
            <tr>
                <th colspan="13">
                    <img src="{{ asset('images/wings-logo-80x80.png') }}" style="width: 50px; margin-left: 100px;"><h3 style="margin-top: -40px; margin-left:150px;">WINGS BY NINESEAS LOGISTICS</h3>
                    <span><center> Suite 17, Block B, Alausa Shopping Complex, 131 Obafemi Awolowo, Ikeja, Lagos State. </center></span>
                    <span><center><i class="fa fa-phone"></i> 0908-6532-777 ,  08097765985 <i class="fa fa-envelope"></i> info@wingsng.com </center></span>
                </th>
            </tr>
            <tr>
                <th colspan="13"><center>{{ Session::get('customer') }} delivery data from {{ Session::get('from') }} to {{ Session::get('to') }}</center></th>
            </tr>
            <tr>
             <th>Date</th>
             @foreach($data as $row)
             @endforeach
             
             @if($row->type == 'special order')
             <th>Item</th>
             @endif
             <th>Name of client</th>
             <th>Pick up Point</th>
             <th>Delivery Point</th>
             <th>Payment Status</th>
             <th>Pick-up Time</th>
             <th>Delivery Time</th>
             <th>Order ID</th>
             <th>Beneficiary Name</th>
             <th>Beneficiary Address</th>
             <th>Beneficiary Phone</th>
             <th>Amount</th>
         </tr>
         <?php $sum=0; ?>
         @foreach($data as $row)
         <tr>
             <th> {{ $row->created_at }} </th>
             @if($row->type == 'special order')
             <th>{{ $row->item }}</th>
             @endif
             <th> {{ $row->name }} </th>
             <th> {{ $row->address }} </th>
             <th> {{ $row->pick_address }} </th>
             <th> {{ $row->status }} </th>
             <th> {{ $row->pick_time }} </th>
             <th> {{ $row->delivery_time }} </th>
             <th> {{ $row->order_id }} </th>
             <th> {{ $row->ben_name }} </th>
             <th> {{ $row->pick_address }} </th>
             <th> {{ $row->ben_phone }} </th>
             <th> {{ $row->amount }} </th>
             <?php
             $aamt = str_replace(',', '', $row->amount);
             $sum += (int)$aamt
             
             ?>
         </tr>
         @endforeach
         <tr>
          <th colspan="12" class="text-right">Cost of Delivery</th>
          <th> {{ number_format($sum, 2) }} </th>
      </tr>
      <tr style="color: green;">
          <th colspan="12" class="text-right">Paid for</th>
          <th>
              <?php $sum2=0; ?> 
              @foreach($data2 as $row2)
              <?php $sum2 += (int)$row2->amount ?>
              @endforeach
              {{ number_format($sum2, 2) }}
          </th>
      </tr>
      <tr style="color: red;">
          <th colspan="12" class="text-right">Balance</th>
          <th>
              {{ number_format($balance = $sum - $sum2, 2) }}
          </th>
      </tr>
  </table>
</div>

<form class="col-sm-12 col-lg-8" method="post" action="{{ url('/sendmail2') }}">
    @csrf
    <div  class="col-sm-12 col-lg-4">
    <label>Email Address</label>
    <input type="email" name="email" class="form-control" value="{{ $row->email }}">
    </div>
    <div class="col-sm-12 col-lg-4">
        <label>Customer Name</label>
    <input type="text" name="name" class="form-control" value="{{ $row->name }}">
    </div>
    <div class="col-sm-12 col-lg-4">
        <label>Customer Phone</label>
    <input type="text" name="phone" class="form-control" value="{{ $row->cus_phone }}">
    </div>
    <input type="submit" name="" class="btn btn-primary" value="send to customer">
</form>

</div>
</div>
<style type="text/css">
    @media print {
      #printPageButton {
        display: none;
    }
}

th{
    border: 1px solid #000;
}
.active {
    background-color: #000;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script type="text/javascript">
    function Export() {
        html2canvas(document.getElementById('tblData'), {
            onrendered: function(canvas) {
                var data = canvas.toDataURL();
                var docDefinition = {
                    content: [{
                        image: data,
                        width: 500
                    }]
                };
                pdfMake.createPdf(docDefinition).download("Profit-margin.pdf");
            }
        });
    }
</script>
<script>
    function exportTableToExcel(tableID, filename = '') {
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
        // Specify file name
        filename = filename ? filename + '.xls' : 'excel_data.xls';
        // Create download link element
        downloadLink = document.createElement("a");
        document.body.appendChild(downloadLink);
        if (navigator.msSaveOrOpenBlob) {
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob(blob, filename);
        } else {
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
            // Setting the file name
            downloadLink.download = filename;
            //triggering the function
            downloadLink.click();
        }
    }
</script>
<script type="text/javascript">
$('th').click(function() {
    $(this).toggleClass('active');
});
</script>
@endsection