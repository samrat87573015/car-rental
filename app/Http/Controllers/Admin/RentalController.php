<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rental;
use App\Helper\ResponsHelper;
use App\Models\Car;
use Inertia\Inertia;
use App\Models\User;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Rental::with(['car', 'user'])->get();
        //return $data;

        return Inertia::render('Admin/Rental/Index',[
            'rentals' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cars = Car::where('availability' , 1)->select('id', 'name', 'daily_rent_price', 'model')->get();
        $customers = User::where('role', 'customer')
        ->select('id', 'name') // Ensure only users with a customerProfile are retrieved
        ->get();
        //return $cars;
        return Inertia::render('Admin/Rental/Create',[
            'cars' => $cars,
            'customers' => $customers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{


            $user_id = $request->input('user_id');
            $car_id = $request->input('car_id');

            $car = Car::where('id', $car_id)->first();

            $start_date = new \DateTime($request->input('start_date'));
            $end_date = new \DateTime($request->input('end_date'));
            $diff = $start_date->diff($end_date);
            $days = $diff->days + 1;
            $total_cost = $car->daily_rent_price * $days;
            //return $days;

            $profile = User::where('id', $user_id)->first();

            //return $profile;

            $data= Rental::create([
                'user_id' => $user_id,
                'car_id' => $car_id,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'total_cost' => $total_cost,
                'status' => $request->input('status'),
            ]);
            return ResponsHelper::out("success",$data,200);


        }catch(\Exception $e){
            return ResponsHelper::out("failed",$e->getMessage(),200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($rental_id)
    {

        $data = Rental::where('id', $rental_id)->with(['car', 'user'])->first();
        //return $data;
        return Inertia::render('Admin/Rental/Show',[
            'rental' => $data
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($rental_id)
    {

        $data = Rental::where('id', $rental_id)->with(['car', 'user'])->first();
        $cars = Car::select('id', 'name', 'daily_rent_price', 'model')->get();
        $customers = User::where('role', 'customer')
        ->select('id', 'name') // Ensure only users with a customerProfile are retrieved
        ->get();
        //return $data;
        return Inertia::render('Admin/Rental/Update',[
            'rental' => $data,
            'cars' => $cars,
            'customers' => $customers
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $rental_id = $request->input('rental_id');
            $user_id = $request->input('user_id');
            $car_id = $request->input('car_id');

            $car = Car::where('id', $car_id)->first();


            $start_date = new \DateTime($request->input('start_date'));
            $end_date = new \DateTime($request->input('end_date'));
            $diff = $start_date->diff($end_date);
            $days = $diff->days + 1;
            $total_cost = $car->daily_rent_price * $days;
            $status = $request->input('status');
            $data = Rental::where('id', $rental_id)->update([
                'user_id' => $user_id,
                'car_id' => $car_id,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'total_cost' => $total_cost,
                'status' => $status,
            ]);
            return ResponsHelper::out("success",$data,200);
              
        }catch(\Exception $e){
            return ResponsHelper::out("faied",$e->getMessage(),200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($rental_id)
    {
        try{
            $data = Rental::where('id', $rental_id)->delete();
            return ResponsHelper::out("success",$data,200);
        }catch(\Exception $e){
            return ResponsHelper::out("failed",$e->getMessage(),200);
        }
    }
}
