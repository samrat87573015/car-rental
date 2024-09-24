<?php

namespace App\Http\Controllers\Admin;

use App\Helper\ResponsHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = User::where('role', 'customer')->get();
        
        //return $customers;
        return Inertia::render('Admin/Customers',[
            'customers' => $customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'password' => $request->input('password'),
            ]);
           
            return ResponsHelper::out('success',$user,200);

        }catch(\Exception $e){
           
            return ResponsHelper::out('error',$e->getMessage(),200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show( $customer_id)
    {

        $data = User::where('id', $customer_id)->first();
        //return $data;
        return Inertia::render('Admin/Customer/Show',[
            'customer' => $data
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $customer_id)
    {
        $data = User::where('id', $customer_id)->first();
        //return $data;
        return Inertia::render('Admin/Customer/Update',[
            'customer' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        try{

            $customer_id = $request->input('customer_id');

            //return $customer;

            User::where('id', $customer_id)->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'password' => $request->input('password'),
            ]);

        
            return ResponsHelper::out('success','customer updated successfully',200);
        }catch(\Exception $e){
            return ResponsHelper::out('error',$e->getMessage(),200);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Request $request, $customer_id)
    {

        try{
            //$customer_id = $request->input('customer_id');

            User::where('id', $customer_id)->delete();

            return ResponsHelper::out('success','customer deleted successfully',200);

        }catch(\Exception $e){
           
            return ResponsHelper::out('error',$e->getMessage(),200);
        }
    }
}
