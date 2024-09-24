<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\User;
use App\Models\Rental;
use App\Helper\ResponsHelper;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingMailForAdmin;
use App\Models\CustomerProfile;
use Carbon\Carbon;
use App\Mail\BookingMailForCustomer;

class RentalController extends Controller
{
    

    function carBooking(Request $request){

        try{
            $user_id = $request->header('userId');
            $email = $request->header('userEmail');
            $car_id = $request->input('car_id');


            $adminMail = User::where('role', operator: 'admin')->first();
    
            $car = Car::where('id', $car_id)->first();
    
            $start_date = new \DateTime($request->input('start_date'));
            $end_date = new \DateTime($request->input('end_date'));
            $diff = $start_date->diff($end_date);
            $days = $diff->days + 1;
            $total_cost = $car->daily_rent_price * $days;
    
            $profile = User::where('id', $user_id)->first();

            //return $customerProfile;

    
            if($car->availability == 0){
                return ResponsHelper::out("failed","Car is not available",200);
            }
            else{
                $data= Rental::create([
                    'user_id' => $user_id,
                    'car_id' => $car_id,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'total_cost' => $total_cost
                ]);

                $car->update([
                    'availability' => 0
                ]);

                $carBookingDetails = [
                    'profile' => $profile,
                    'car' => $car,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'total_cost' => $total_cost
                ];


                Mail::to($adminMail->email)->send(new BookingMailForAdmin($carBookingDetails));

                Mail::to($email)->send(new BookingMailForCustomer($carBookingDetails));

                return ResponsHelper::out("success",$data,200);
            }
        }catch(\Exception $e){
            return ResponsHelper::out("failed",$e->getMessage(),200);
        }
    }

    function cancelBooking(Request $request){
        try{

            $user_id = $request->header('userId');
            $rental_id = $request->input('rental_id');
            $car_id = $request->input('car_id');
            $car = Car::where('id', $car_id)->first();

            $rental = Rental::where('id', $rental_id)->where('user_id', $user_id)->first();

            if(Carbon::now()->lt(Carbon::parse($rental->start_date))){
                $rental->update([
                    'status' => 'Canceled'
                ]);

                $car->update([
                    'availability' => 1
                ]);
                return ResponsHelper::out("success","Car booking cancelled",200);

            }else{
                return ResponsHelper::out("failed","Car rental already started",200);
            }
            
            

        }catch(\Exception $e){
            return ResponsHelper::out("failed",$e->getMessage(),200);
        }
    }





}
