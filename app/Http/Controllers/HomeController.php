<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Order;
use App\Payment;
use App\Rider;
use App\Wingsdeposit;
use App\Setrider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Hash;
use PDF;
use Mail;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['allUsers'] = User::distinct()->count('name');
        $data['monthOrder'] = Order::whereMonth('created_at', date('m'))->count('id');
        $data['remuneration'] = Order::whereMonth('created_at', date('m'))->sum('amount');
        $data['income'] = Order::whereMonth('created_at', date('m'))->where('status', 'paid')->sum('amount');
        // return $data;
        return view('home')->with('data', $data);
    }

    public function rider()
    {
        $data = Rider::orderBy('id', 'desc')->get();
        return view('rider.allriders', compact('data'));
    }

    public function addrider()
    {
        return view('rider.addrider');
    }

    public function newrider(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required| max:11 | min:11',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        Rider::create([
            'name' => $request['name'],
            'address' => $request['address'],
            'phone' => $request['phone'],
            'rider_id' => rand(),
        ]);
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => Hash::make($request['password']),
            'type' => $request['type']
        ]);
        Session::flash('success', 'Rider Added Successfully');
        return redirect('/rider');
    }

    public function rideredit($id)
    {
        $data = Rider::where('id', $id)->get();
        return view('rider.rideredit', compact('data'));
    }

    public function updaterider(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ]);
        Rider::where('id', $request['id'])
            ->update([
                'name' => $request['name'],
                'address' => $request['address'],
                'phone' => $request['phone'],
            ]);
        Session::flash('success', 'Rider information updated Successfully');
        return redirect('/rider');
    }

    public function riderdelete($id)
    {
        Rider::where('id', $id)->delete();
        Session::flash('error', 'deleted Successfully');
        return redirect('/rider');
    }

    public function expenses()
    {
        return view('rider.expenses');
    }

    public function enterexpense(Request $request)
    {
        $request->validate([
            'expenses' => 'required',
            'details' => 'required',
            'amount' => 'required',
        ]);
        Expense::create([
            'name' => \Auth::User()->name,
            'telephone' => \Auth::User()->telephone,
            'expenses' => $request['expenses'],
            'details' => $request['details'],
            'amount' => $request['amount'],
        ]);
        Session::flash('success', 'expenses added Successfully');
        return redirect('/expenses');
    }

    public function order()
    {
        $data = Order::orderBy('id', 'desc')->paginate(20);
        return view('despatch.order', compact('data'));
    }

    public function addorder()
    {
        return view('despatch.addorder');
    }

    public function neworder(Request $request)
    {
        $request->validate([
            'item' => 'required',
            'amount' => 'required',
            'address' => 'required',
            'name' => 'required',
            'cus_phone' => 'required | min:11 | max:11',
            'email' => 'required',
            'ben_name' => 'required',
            'ben_phone' => 'required | min:11 | max:11',
            'pick_address' => 'required',
        ]);
        Order::create([
            'type' => $request['type'],
            'item' => $request['item'],
            'address' => $request['address'],
            'delivery_type' => $request['delivery_type'],
            'amount' => $request['amount'],
            'name' => $request['name'],
            'cus_phone' => $request['cus_phone'],
            'email' => $request['email'],
            'ben_name' => $request['ben_name'],
            'ben_phone' => $request['ben_phone'],
            'pick_address' => $request['pick_address'],
            'pick_time' => $request['pick_time'],
            'order_id' => 'WG' . rand(),
        ]);
        if ($request['type'] == 'special order') {
            Session::flash('success', 'Order added Successfully');
            return redirect('/special');
        }
        Session::flash('success', 'Order added Successfully');
        return redirect('/order');
    }

    public function addpayment(Request $request)
    {
        // return $request;
        Session::put('order_id', $request['order_id']);
        return redirect('enterpayment');
    }

    public function enterpayment(Request $request)
    {
        $order_id = Session::get('order_id');
        $data = Order::where('order_id', $order_id)->get();
        return view('despatch.enterpayment', compact('data'));
    }

    public function inputpayment(Request $request)
    {
        if ($request['mode'] == 'credit') {
            Order::where('order_id', $request['order_id'])
                ->update([
                    'delivery_time' => $request['delivery_time']
                ]);
        } else {
            Order::where('order_id', $request['order_id'])
                ->update([
                    'status' => 'paid',
                    'delivery_time' => $request['delivery_time']
                ]);
        }
        Payment::create([
            'order_id' => $request['order_id'],
            'name' => $request['name'],
            'amount' => $request['amount'],
            'mode' => $request['mode'],
            'wings_id' => $request['wings_id'],
        ]);
        if ($request['wings_id'] != null) {
            $data = Wingsdeposit::where('wings_id', $request['wings_id'])->get();
            foreach ($data as $row) {
                $purse = $row->amount;
                $newamount = $purse - $request['amount'];
                Wingsdeposit::where('wings_id', $request['wings_id'])
                    ->update([
                        'amount' => $newamount
                    ]);
            }
        }

        if ($request['type'] == 'special order') {
            Session::flash('success', 'Order added Successfully');
            return redirect('/special');
        }
        Session::flash('success', 'Payment added Successfully');
        return redirect('/order');
    }

    public function deposit()
    {
        $data =  Wingsdeposit::orderBy('id', 'desc')->get();
        return view('despatch.deposit', compact('data'));
    }

    public function addnewdeposit()
    {
        return view('despatch.addnewdeposit');
    }

    public function addnewings(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'amount' => 'required',
        ]);
        Wingsdeposit::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'amount' => $request['amount'],
            'wings_id' => 'WNG' . rand(111111, 999999),
        ]);
        Session::flash('success', 'New Customer added Successfully');
        return redirect('/deposit');
    }

    public function addeposit($id)
    {
        $data = Wingsdeposit::where('id', $id)->get();
        return view('despatch.addeposit', compact('data'));
    }

    public function updatewings(Request $request)
    {
        $request->validate([
            'amount2' => 'required'
        ]);
        $newamount = $request['amount2'] + $request['amount'];
        Wingsdeposit::where('id', $request['id'])
            ->update([
                'amount' => $newamount
            ]);
        Session::flash('success', 'Amount added Successfully');
        return redirect('/deposit');
    }

    public function assign($id)
    {
        $data = Order::where('id', $id)->get();
        $data2 = Rider::all();
        return view('despatch.assign', compact('data', 'data2'));
    }

    public function updateorder(Request $request)
    {
        Order::where('order_id', $request['order_id'])
            ->update([
                'rider' => $request['rider'],
                'assigned' => 1,
                'collect' => $request['collect']
            ]);
        Setrider::create([
            'rider' => $request['rider'],
            'order_id' => $request['order_id'],
            'item' => $request['item'],
            'name' => $request['name'],
            'destination' => $request['destination'],
            'address' => $request['address'],
        ]);
        Session::put('order_id', $request['order_id']);
        return redirect('print');
    }

    public function print()
    {
        $order_id = Session::get('order_id');
        $data = Order::where('order_id', $order_id)->get();
        return view('despatch.print', compact('data'));
    }

    public function expense()
    {
        return view('report.expense');
    }

    public function getexpense(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',
        ]);
        $to =  date('Y-m-d', strtotime($request['to'] . ' +1 day'));
        $data = Expense::where('created_at', '>=', $request['from'])
            ->where('created_at', '<=', $to)->get();
        if ($data->isEmpty()) {
            Session::flash('error', 'no record found for these dates');
            return redirect('expense');
        }
        return view('report.getexpense', compact('data'));
    }

    public function sales()
    {
        return view('report.sales');
    }

    public function getsales(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',
        ]);
        Session::put('from', $request['from']);
        Session::put('to', $request['to']);
        $to =  date('Y-m-d', strtotime($request['to'] . ' +1 day'));
        $data = Order::where('created_at', '>=', $request['from'])
            ->where('created_at', '<=', $to)->get();
        // dd($data);
        return view('report.getsales', compact('data'));
    }

    public function salesrider()
    {
        $data = Rider::all();
        return view('report.salesrider', compact('data'));
    }

    public function getrider(Request $request)
    {

        // $to =  date('Y-m-d', strtotime($request['to'] . ' +1 day'));
        // $rider = 'Lere salau';
        // $data = DB::table('setriders')
        // ->select('setriders.*','orders.*')
        // ->join('orders','orders.order_id','=','setriders.order_id')
        // ->where('setriders.created_at', '>=', $request['from'])
        // ->where('setriders.created_at', '<=', $to)
        // ->where('setriders.rider', $rider)
        // ->where('orders.type', 'special order')
        // ->where('orders.ben_name', 'MECURE')
        // ->get();
        // dd($data);
        $request->validate([
            'from' => 'required',
            'to' => 'required',
        ]);
        $to =  date('Y-m-d', strtotime($request['to'] . ' +1 day'));

        $data = DB::table('setriders')
            ->select('setriders.*', 'orders.*')
            ->join('orders', 'orders.order_id', '=', 'setriders.order_id')
            ->where('setriders.created_at', '>=', $request['from'])
            ->where('setriders.created_at', '<=', $to)
            ->where('setriders.rider', $request['rider'])
            ->get();
        // return $data;
        // $data = Setrider::where('created_at', '>=', $request['from'])
        // ->where('created_at', '<=', $to)
        // ->where('rider', $request['rider'])->get();
        return view('report.getrider', compact('data'));
    }

    public function customer()
    {
        $data = Order::select('name')->distinct()->get();
        return view('report.customer', compact('data'));
    }

    public function getcustomer(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',
        ]);
        Session::put('customer', $request['name']);
        Session::put('to', $request['to']);
        Session::put('from', $request['from']);
        $to =  date('Y-m-d', strtotime($request['to'] . ' +1 day'));
        $data = Order::where('created_at', '>=', $request['from'])
            ->where('created_at', '<=', $to)
            ->where('name', $request['name'])->get();
        //get payment
        $data2 = Order::where('created_at', '>=', $request['from'])
            ->where('created_at', '<=', $to)
            ->where('name', $request['name'])
            ->where('status', "paid")->get();
        if ($data->isEmpty()) {
            Session::flash('error', 'Customer have on record these dates you have choose, please choose another date');
            return redirect('customer');
        }
        $tableName = $request['name'] . $request['from'] . ' - ' . $request['to'];
        return view('report.getcustomer', compact('data', 'data2'))->with('tableName', $tableName);
    }

    public function pay()
    {
        return view('report.pay');
    }

    public function getpayment(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',
        ]);
        Session::put('to', $request['to']);
        Session::put('from', $request['from']);
        $to =  date('Y-m-d', strtotime($request['to'] . ' +1 day'));
        $data = Payment::where('created_at', '>=', $request['from'])
            ->where('created_at', '<=', $to)->get();
        return view('report.getpayment', compact('data'));
    }

    public function worker()
    {
        $data = User::where('type', '!=', 0)->get();
        return view('report.worker', compact('data'));
    }

    public function addworker()
    {
        return view('report.addworker');
    }

    public function enterworker(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:11'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'telephone' => $request['phone'],
            'password' => Hash::make($request['password']),
            'type' => $request['type']
        ]);
        return redirect('worker');
    }

    public function getriderwork(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',
        ]);
        Session::put('from', $request['from']);
        Session::put('to', $request['to']);
        Session::put('rider', $request['rider']);
        return redirect('riderwork');
        $to =  date('Y-m-d', strtotime($request['to'] . ' +1 day'));
        $data = Order::where('created_at', '>=', $request['from'])
            ->where('created_at', '<=', $to)
            ->where('rider', $request['rider'])->paginate(10);
        return view('report.getriderwork', compact('data'));
    }

    public function riderwork()
    {
        $from = Session::get('from');
        $to = Session::get('to');
        $rider = Session::get('rider');
        $to =  date('Y-m-d', strtotime($to . ' +1 day'));
        $from =  date('Y-m-d', strtotime($from));
        $data = Order::where('created_at', '>=', $from)
            ->where('created_at', '<=', $to)
            ->where('rider', $rider)->paginate(10);
        return view('report.getriderwork', compact('data'));
    }

    public function consign()
    {
        $ridername = \Auth::User()->name;
        $data = Order::where('rider', $ridername)
            ->where('assigned', '!=', 2)->get();
        return view('despatch.consign', compact('data'));
    }

    public function delivered($id)
    {
        Order::where('id', $id)
            ->update([
                'assigned' => 2,
                'delivery_time' => date('H:i:s')
            ]);
        Session::flash('success', 'Despatched updated');
        return redirect('consign');
    }

    public function workerdelete($id)
    {
        User::where('id', $id)->delete();
        Session::flash('error', 'deleted Successfully');
        return redirect('/worker');
    }

    public function sendmail(Request $request)
    {
        ini_set('memory_limit', '256M');
        $data["email"] = $request['email'];
        $data["client_name"] = $request['name'];
        $data["phone"] = $request['phone'];
        $data["subject"] = 'invoice';
        $data["message"] = 'this is used to text if it will recieve';
        //the sent parameter
        $name = Session::get('customer');
        $to = Session::get('to');
        $from = Session::get('from');
        $to =  date('Y-m-d', strtotime($to . ' +1 day'));
        $data['data'] = DB::table('orders')->where('created_at', '>=', $from)
            ->where('created_at', '<=', $to)
            ->where('name', $name)->get();
        //get payment
        $data['data2'] = DB::table('orders')->where('created_at', '>=', $from)
            ->where('created_at', '<=', $to)
            ->where('name', $name)
            ->where('status', "paid")->get();
        //the sent parameters

        $pdf = PDF::loadView('mails.mailpdf', $data)->setPaper('a4', 'landscape');;

        try {
            Mail::send('mails.mail', $data, function ($message) use ($data, $pdf) {
                $message->to($data["email"], $data["client_name"])
                    ->subject($data["subject"])
                    ->attachData($pdf->output(), "invoice.pdf");
            });
        } catch (JWTException $exception) {
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }
        if (Mail::failures()) {
            $this->statusdesc  =   "Error sending mail";
            $this->statuscode  =   "0";
        } else {

            $this->statusdesc  =   "Message sent Succesfully";
            $this->statuscode  =   "1";
        }
        //return response()->json(compact('this'));
        Session::flash('success', 'invoice sent Succesfully');
        return redirect('customer');
    }

    public function checkQR()
    {
        $data = Rider::all();
        return view('report.checkQR', compact('data'));
    }

    public function multipleQR(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',
        ]);
        $to =  date('Y-m-d', strtotime($request['to'] . ' +1 day'));
        $data = Setrider::where('created_at', '>=', $request['from'])
            ->where('created_at', '<=', $to)
            ->where('rider', $request['rider'])->get();
        // return $data;
        return view('report.multipleQR', compact('data'));
    }

    public function singleQR(Request $request)
    {
        $request->validate([
            'order_id' => 'required'
        ]);
        $data = Setrider::where('order_id', $request['order_id'])->get();
        if ($data->isEmpty()) {
            Session::flash('error', 'no record found');
            return redirect('checkQR');
        }
        return view('report.singleQR', compact('data'));
    }

    public function reassign()
    {
        return view('rider.reassign');
    }

    public function doreassign(Request $request)
    {
        $request->validate([
            'order_id' => 'required'
        ]);
        $data = Setrider::where('order_id', $request['order_id'])->get();
        if ($data->isEmpty()) {
            Session::flash('error', 'no record found');
            return redirect('reassign');
        }
        Setrider::where('order_id', $request['order_id'])->delete();
        $data = Order::where('order_id', $request['order_id'])->get();
        $data2 = Rider::all();
        return view('despatch.assign', compact('data', 'data2'));
    }

    public function addspecial()
    {
        return view('despatch.addspecial');
    }

    public function orderdelete($id)
    {
        Order::where('id', $id)->delete();
        Session::flash('error', 'Deleted Successfully');
        return redirect('/order');
    }

    public function specialdelete($id)
    {
        Order::where('id', $id)->delete();
        Session::flash('error', 'Deleted Successfully');
        return redirect('/special');
    }

    public function edit($id)
    {
        $data = Order::where('id', $id)->get();
        return view('despatch.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'item' => 'required',
            'amount' => 'required',
            'address' => 'required',
            'name' => 'required',
            'cus_phone' => 'required | min:11 | max:11',
            'email' => 'required',
            'ben_name' => 'required',
            'ben_phone' => 'required | min:11 | max:11',
            'pick_address' => 'required',
        ]);
        Order::where('id', $request['id'])
            ->update([
                'type' => $request['type'],
                'item' => $request['item'],
                'address' => $request['address'],
                'delivery_type' => $request['delivery_type'],
                'amount' => $request['amount'],
                'name' => $request['name'],
                'cus_phone' => $request['cus_phone'],
                'email' => $request['email'],
                'ben_name' => $request['ben_name'],
                'ben_phone' => $request['ben_phone'],
                'pick_address' => $request['pick_address'],
                'pick_time' => $request['pick_time'],
                'order_id' => 'WG' . rand(),
            ]);
        if ($request['type'] == 'special order') {
            Session::flash('success', 'Order updated Successfully');
            return redirect('/special');
        }
        Session::flash('success', 'Order updated Successfully');
        return redirect('/order');
    }


    public function search(Request $request)
    {
        $output = "";

        $products = Order::all();

        if ($request->ajax()) {
            $products = DB::table('orders')->where('name', 'LIKE', '%' . $request->search . "%")
                ->orWhere('rider', 'LIKE', '%' . $request->search . "%")
                ->orWhere('email', 'LIKE', '%' . $request->search . "%")
                ->orWhere('address', 'LIKE', '%' . $request->search . "%")
                ->orWhere('cus_phone', 'LIKE', '%' . $request->search . "%")
                ->orWhere('ben_name', 'LIKE', '%' . $request->search . "%")
                ->orWhere('pick_address', 'LIKE', '%' . $request->search . "%")
                ->orWhere('order_id', 'LIKE', '%' . $request->search . "%")
                ->orWhere('ben_phone', 'LIKE', '%' . $request->search . "%")
                ->orWhere('delivery_type', 'LIKE', '%' . $request->search . "%")
                ->orderBy('id', 'desc')->get();
        }
        if ($products) {
            foreach ($products as $key => $product) {

                //CHECKING IF THE FORM IS ASSIGNED
                if ($product->assigned == 0) {
                    $sh = '<span style="color: red;"> Unassigned </span';
                } elseif ($product->assigned == 1) {
                    $sh = '<span style="color: orange;"> Assigned </span>';
                } elseif ($product->assigned == 2) {
                    $sh = '<span style="color: green;"> Delivered </span>';
                }

                //THE FORM CODE
                $form = "";
                if ($product->status != 'paid') {
                    $form = '<form method="post" action="addpayment">
                        ' . csrf_field() . '
                        <input type="hidden" name="order_id" value="' . $product->order_id . '">
                        <input type="submit" class="btn btn-link" value="add payment" name="">
                    </form>';
                }

                //THE RIDERS
                $rider = "";
                if ($product->rider == '') {
                    $rider = '<a href="/assign/' . $product->id . '">Assign</a>';
                }



                $output .= '<tr>' .

                    '<td><a href="/orderdelete/' . $product->id . '" onClick="return confirm("sure to delete?")"><i class="fa fa-trash btn btn-danger"></i></a></td>' .

                    '<td><a href="/edit/' . $product->id . '">Edit</a></td>' .
                    '<td>' .    $product->type . '</td>' .
                    '<td>' .    $sh    . '</td>' .
                    '<td>' .    $product->status . '</td>' .
                    '<td>' .    $form . '</td>' .
                    '<td>' .    $rider . '</td>' .
                    '<td>' . $product->item . '</td>' .
                    '<td>' . $product->address . '</td>' .
                    '<td>' . $product->pick_time . '</td>' .
                    '<td>' . $product->delivery_time . '</td>' .
                    '<td>' . $product->order_id . '</td>' .
                    '<td>' . $product->amount . '</td>' .
                    '<td>' . $product->name . '</td>' .
                    '<td>' . $product->cus_phone . '</td>' .
                    '<td>' . $product->email . '</td>' .
                    '<td>' . $product->ben_name . '</td>' .
                    '<td>' . $product->ben_phone . '</td>' .
                    '<td>' . $product->pick_address . '</td>' .
                    '</tr>';
            }
            return Response($output);
        }
    }

    public function Oassign()
    {
        return view('report.Oassign');
    }

    public function getassign(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',
        ]);
        $to =  date('Y-m-d', strtotime($request['to'] . ' +1 day'));
        $data = DB::table('setriders')
            ->select('setriders.*', 'orders.*')
            ->join('orders', 'orders.order_id', '=', 'setriders.order_id')
            ->where('setriders.created_at', '>=', $request['from'])
            ->where('setriders.created_at', '<=', $to)
            ->get();
        // return $data;
        // $data = Setrider::where('created_at', '>=', $request['from'])
        // ->where('created_at', '<=', $to)->get();
        return view('report.getassign', compact('data'));
    }

    public function specialcustomer()
    {
        $data = Order::select('ben_name')->where('type', 'special order')->distinct()->get();
        return view('report.specialcustomer', compact('data'));
    }

    public function getspecialcustomer(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',
        ]);
        Session::put('customer', $request['name']);
        Session::put('to', $request['to']);
        Session::put('from', $request['from']);
        $to =  date('Y-m-d', strtotime($request['to'] . ' +1 day'));
        $data = Order::where('created_at', '>=', $request['from'])
            ->where('created_at', '<=', $to)
            ->where('ben_name', $request['name'])
            ->where('type', 'special order')->get();
        //get payment
        $data2 = Order::where('created_at', '>=', $request['from'])
            ->where('created_at', '<=', $to)
            ->where('ben_name', $request['name'])
            ->where('status', "paid")->get();
        if ($data->isEmpty()) {
            Session::flash('error', 'Customer have on record these dates you have choose, please choose another date');
            return redirect('specialcustomer');
        }
        $tableName = $request['name'] . $request['from'] . ' - ' . $request['to'];
        return view('report.getcustomer2', compact('data', 'data2'))->with('tableName', $tableName);
    }

    public function sendmail2(Request $request)
    {
        ini_set('memory_limit', '256M');
        $data["email"] = $request['email'];
        $data["client_name"] = $request['name'];
        $data["phone"] = $request['phone'];
        $data["subject"] = 'invoice';
        $data["message"] = 'this is used to text if it will recieve';
        //the sent parameter
        $name = Session::get('customer');
        $to = Session::get('to');
        $from = Session::get('from');
        $to =  date('Y-m-d', strtotime($to . ' +1 day'));
        $data['data'] = DB::table('orders')->where('created_at', '>=', $from)
            ->where('created_at', '<=', $to)
            ->where('ben_name', $name)->get();
        //get payment
        $data['data2'] = DB::table('orders')->where('created_at', '>=', $from)
            ->where('created_at', '<=', $to)
            ->where('ben_name', $name)
            ->where('status', "paid")->get();
        //the sent parameters

        $pdf = PDF::loadView('mails.mailpdf', $data)->setPaper('a4', 'landscape');

        try {
            Mail::send('mails.mail', $data, function ($message) use ($data, $pdf) {
                $message->to($data["email"], $data["client_name"])
                    ->subject($data["subject"])
                    ->attachData($pdf->output(), "invoice.pdf");
            });
        } catch (JWTException $exception) {
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }
        if (Mail::failures()) {
            $this->statusdesc  =   "Error sending mail";
            $this->statuscode  =   "0";
        } else {

            $this->statusdesc  =   "Message sent Succesfully";
            $this->statuscode  =   "1";
        }
        //return response()->json(compact('this'));
        Session::flash('success', 'invoice sent Succesfully');
        return redirect('specialcustomer');
    }

    public function search2(Request $request)
    {
        $output = "";

        $products = Order::where('type', '!=', 'walk in')->get();

        if ($request->ajax()) {
            $products = DB::table('orders')
                ->where('type', 'special order')
                ->where('type', '!=', 'Contract Clients')
                ->where('type', '!=', 'Walk in')
                ->orwhere('name', 'LIKE', '%' . $request->search . "%")
                ->orWhere('rider', 'LIKE', '%' . $request->search . "%")
                ->orWhere('email', 'LIKE', '%' . $request->search . "%")
                ->orWhere('address', 'LIKE', '%' . $request->search . "%")
                ->orWhere('cus_phone', 'LIKE', '%' . $request->search . "%")
                ->orWhere('ben_name', 'LIKE', '%' . $request->search . "%")
                ->orWhere('pick_address', 'LIKE', '%' . $request->search . "%")
                ->orWhere('order_id', 'LIKE', '%' . $request->search . "%")
                ->orWhere('ben_phone', 'LIKE', '%' . $request->search . "%")
                ->orWhere('delivery_type', 'LIKE', '%' . $request->search . "%")
                ->orderBy('id', 'desc')->get();
        }
        if ($products) {
            foreach ($products as $key => $product) {

                //CHECKING IF THE FORM IS ASSIGNED
                if ($product->assigned == 0) {
                    $sh = '<span style="color: red;"> Unassigned </span';
                } elseif ($product->assigned == 1) {
                    $sh = '<span style="color: orange;"> Assigned </span>';
                } elseif ($product->assigned == 2) {
                    $sh = '<span style="color: green;"> Delivered </span>';
                }

                //THE FORM CODE
                $form = "";
                if ($product->status != 'paid') {
                    $form = '<form method="post" action="addpayment">
                        ' . csrf_field() . '
                        <input type="hidden" name="order_id" value="' . $product->order_id . '">
                        <input type="submit" class="btn btn-link" value="add payment" name="">
                    </form>';
                }

                //THE RIDERS
                $rider = "";
                if ($product->rider == '') {
                    $rider = '<a href="/assign/' . $product->id . '">Assign</a>';
                }



                $output .= '<tr>' .

                    '<td><a href="/orderdelete/' . $product->id . '" onClick="return confirm("sure to delete?")"><i class="fa fa-trash btn btn-danger"></i></a></td>' .

                    '<td><a href="/edit/' . $product->id . '">Edit</a></td>' .
                    '<td>' .    $product->type . '</td>' .
                    '<td>' .    $sh    . '</td>' .
                    '<td>' .    $product->status . '</td>' .
                    '<td>' .    $form . '</td>' .
                    '<td>' .    $rider . '</td>' .
                    '<td>' . $product->item . '</td>' .
                    '<td>' . $product->address . '</td>' .
                    '<td>' . $product->order_id . '</td>' .
                    '<td>' . $product->amount . '</td>' .
                    '<td>' . $product->name . '</td>' .
                    '<td>' . $product->cus_phone . '</td>' .
                    '<td>' . $product->email . '</td>' .
                    '<td>' . $product->ben_name . '</td>' .
                    '<td>' . $product->ben_phone . '</td>' .
                    '<td>' . $product->pick_address . '</td>' .
                    '</tr>';
            }
            return Response($output);
        }
    }

    public function special()
    {
        $data = DB::table('orders')
            ->where('type', 'special order')
            ->orderBy('id', 'desc')->paginate(25);
        // $data = Order::orderBy('id', 'desc')
        // ->where('type', 'special order')->paginate(20);
        return view('despatch.special', compact('data'));
    }

    function fetch_data(Request $request)
    {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $data = DB::table('orders')
                ->where('id', 'like', '%' . $query . '%')
                ->orWhere('ben_name', 'like', '%' . $query . '%')
                ->orWhere('rider', 'like', '%' . $query . '%')
                ->orwhere('name', 'LIKE', '%' . $query . "%")
                ->orWhere('email', 'LIKE', '%' . $query . "%")
                ->orWhere('address', 'LIKE', '%' . $query . "%")
                ->orWhere('cus_phone', 'LIKE', '%' . $query . "%")
                ->orWhere('pick_address', 'LIKE', '%' . $query . "%")
                ->orWhere('order_id', 'LIKE', '%' . $query . "%")
                ->orWhere('ben_phone', 'LIKE', '%' . $query . "%")
                ->orWhere('delivery_type', 'LIKE', '%' . $query . "%")
                ->where('type', 'special order')
                ->orderBy('id', 'desc')
                ->paginate(5);
            return view('pagination_data', compact('data'))->render();
        }
    }

    function fetch_data2(Request $request)
    {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $data = DB::table('orders')
                ->where('id', 'like', '%' . $query . '%')
                ->orWhere('ben_name', 'like', '%' . $query . '%')
                ->orWhere('rider', 'like', '%' . $query . '%')
                ->orwhere('name', 'LIKE', '%' . $query . "%")
                ->orWhere('email', 'LIKE', '%' . $query . "%")
                ->orWhere('address', 'LIKE', '%' . $query . "%")
                ->orWhere('cus_phone', 'LIKE', '%' . $query . "%")
                ->orWhere('pick_address', 'LIKE', '%' . $query . "%")
                ->orWhere('order_id', 'LIKE', '%' . $query . "%")
                ->orWhere('ben_phone', 'LIKE', '%' . $query . "%")
                ->orWhere('delivery_type', 'LIKE', '%' . $query . "%")
                ->where('type', '!=', 'special order')
                ->orderBy('id', 'desc')
                ->paginate(5);
            return view('pagination_data2', compact('data'))->render();
        }
    }

    public function expensedelete($id)
    {
        Expense::where('id', $id)->delete();
        Session::flash('error', 'deleted Successfully');
        return redirect('/expense');
    }

    public function unassigned()
    {
        $data = Order::where('assigned', 0)
            ->orderBy('id', 'desc')->get();
        return view('report.unassigned', compact('data'));
    }

    public function editPayment(Request $request)
    {
        Order::where('order_id', $request['order_id'])
            ->update([
                'status' => $request['status']
            ]);
        Payment::where('order_id', $request['order_id'])->delete();
        return redirect()->back()->with('success', 'payment updated successfully');
    }
}
