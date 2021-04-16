@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        @if(\Auth::User()->type == 0)
        <div class="col-md-3 board">
            <i class="fa fa-user"></i><br>
            <span class="text-lg">Total Clients</span><br>
            <p>&nbsp;</p>
            <br>
            <p><span class="text-lg">{{ $data['allUsers'] }}</span></p>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-3 board">
            <i class="fa fa-motorcycle"></i><br>
            <span class="text-lg">{{ date('M-Y') }} Order</span><br>
            <span class="text-lg">{{ $data['monthOrder'] }}</span><br>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-3 board" id="parent">
            <i class="fa fa-calendar"></i><br>
            <span class="text-lg">{{ date('M-Y') }} Remuneration</span><br>
            <span class="text-lg">{{ number_format($data['remuneration'], 2) }}</span><br>
            <div id="hover-content">
                this month amount for deliveries both paid and unpaid
            </div>
        </div>
        <div class="col-md-12 space"></div>
        <div class="col-md-3 board" id="parent">
            <i class="fa fa-credit-card"></i><br>
            <span class="text-lg">{{ date('M-Y') }} Income</span><br>
            <span class="text-lg">{{ number_format($data['income'], 2) }}</span><br>
            <div id="hover-content">
                all payment made this month
            </div>
        </div>
        @endif

    </div>
</div>

<style>
    .board {
        border: 10px solid #000;
        text-align: center;
    }

    .fa {
        font-size: 100px;
    }

    .text-lg {
        font-size: 40px;
    }

    #hover-content {
        display: none;
    }

    #parent:hover #hover-content {
        display: block;
    }

    .space {
        height: 30px;
    }
</style>
@endsection