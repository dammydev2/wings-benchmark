@if(\Auth::User()->type == 1)
<li><a href="{{ url('/order') }}">order</a></li>
<li><a href="{{ url('/rider') }}">Rider(s)</a></li>
<li><a href="{{ url('/expenses') }}">Expens(es)</a></li>
<li><a href="{{ url('/deposit') }}">Wings Deposit</a></li>
<li><a href="{{ url('/salesrider') }}">Rider Report</a></li>
<li><a href="{{ url('/expense') }}">Expense Report</a></li>
<li><a href="{{ url('/customer') }}">Customer Report</a></li>
<li><a href="{{ url('/Oassign') }}">Order Assigned</a></li>
<li><a href="{{ url('/unassigned') }}">Unassigned Order </a></li>
<li><a href="{{ url('/checkQR') }}">Print QR</a></li>
<li><a href="{{ url('/reassign') }}">Reassign Rider</a></li>

@if(\Auth::User()->email == 'olorunyomibalogun@gmail.com')
<li><a href="{{ url('/special') }}">special order</a></li>
<li><a href="{{ url('/specialcustomer') }}">Customer Report (Special)</a></li>
@endif

@endif

@if(\Auth::User()->type == 2)
<li><a href="{{ url('/consign') }}">My Consign</a></li>
@endif

@if(\Auth::User()->type == 0)
<li><a href="{{ url('/home') }}">home</a></li>
<li><a href="{{ url('/order') }}">order</a></li>
<li><a href="{{ url('/special') }}">special order</a></li>
<li><a href="{{ url('/salesrider') }}">Rider Report</a></li>
<li><a href="{{ url('/customer') }}">Customer Report</a></li>
<li><a href="{{ url('/specialcustomer') }}">Customer Report (Special)</a></li>
<li><a href="{{ url('/checkQR') }}">Print QR</a></li>
<li><a href="{{ url('/expense') }}">Expense Report</a></li>
<li><a href="{{ url('/expenses') }}">Expense(s)</a></li>
<li><a href="{{ url('/reassign') }}">Reassign Rider</a></li>
<li><a href="{{ url('/sales') }}">All Sales Report</a></li>
<li><a href="{{ url('/pay') }}">Payment Report</a></li>
<li><a href="{{ url('/worker') }}">Front Line</a></li>
<li><a href="{{ url('/rider') }}">Rider(s)</a></li>
<li><a href="{{ url('/deposit') }}">Wings Deposit</a></li>
<li><a href="{{ url('/consign') }}">My Consign</a></li>
<li><a href="{{ url('/Oassign') }}">Order Assigned</a></li>
<li><a href="{{ url('/unassigned') }}">Unassigned Order </a></li>
@endif