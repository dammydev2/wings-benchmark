@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-sm-12 col-lg-8">
            @if(Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            <table class="table table-bordered">
                <tr>
                    <th colspan="2"><center><a href="{{ url('/addworker') }}" class="btn btn-primary"><i class="fa fa-user-plus"></i>Add New Worker</a></center></th>
                </tr>
                <tr>
                 <th>Name</th>
                 <th>Email</th>
             </tr>
             @foreach($data as $row)
             <tr>
                <th> {{ $row->name }} </th>
                <th> {{ $row->email }} </th>
                <th>
                    @if($row->type == 1)
                    Front-Desk / Secretary
                    @elseif($row->type == 2)
                    Rider
                    @endif
                </th>
                <th>
                    <a href="{{ url('/workerdelete/'.$row->id) }}" onclick="return confirm('Are you sure?')"><i class="fa fa-trash btn btn-danger"></i></a>
                </th>
            </tr>
            @endforeach
            
        </table>
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
