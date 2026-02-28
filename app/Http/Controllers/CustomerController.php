<?php

namespace App\Http\Controllers;
use App\Models\Customer;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function AllCustomer()
    {
        $customer = Customer::latest()->get();
        return view("admin.backend.customer.all_customer", compact("customer"));
    }
    //End Method

    public function AddCustomer()
    {
        return view("admin.backend.customer.add_customer");
    }
    //End Method

        public function StoreCustomer(Request $request)
    {
        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        $notification = array(
            'message' => 'Your Customer Inserted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('all.customer')->with($notification);
    }
    //End Method

    public function EditCustomer($id)
    {
        $customer = Customer::find($id);
        return view('admin.backend.customer.edit_customer', compact('customer'));
    }
    //End Method

        public function UpdateCustomer(Request $request)
    {
        $customer_id = $request->id;
        Customer::find($customer_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        $notification = array(
            'message' => 'Your Customer Updated Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('all.customer')->with($notification);
    }
    //End Method

        public function DeleteCustomer($id)
    {
        Customer::find($id)->delete();

        $notification = array(
            'message' => 'Customer Deleted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    //End Method
}
