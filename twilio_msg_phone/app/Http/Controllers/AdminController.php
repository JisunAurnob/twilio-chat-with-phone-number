<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $customers = Customer::all();
        return view('Admin.admin_dashboard')->with('customers',$customers);
    }

    public function addCustomer(){
        return view('Admin.add_customer');
    }
    public function addCustomerPost(Request $request){
        
        $this->validate(
            $request,
            [
                'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/'
            ],
            [
                'name.required'=>'Name is needed',
                'name.min'=>'Name should be more than 4 charecters'
            ]
            );
            $var = new Customer();
            $var->phone = $request->phone;
            $var->save();
            $msg = 'Customer Added';
            redirect()->route('admin')->with('successMSG', $msg);
    }
}
