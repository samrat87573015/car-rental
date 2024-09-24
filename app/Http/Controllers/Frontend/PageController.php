<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Car;
use App\Models\Rental;
use App\Helper\ResponsHelper;

class PageController extends Controller
{

    function homePage(){
        $cars = Car::where('availability' , 1)->take(6)->get();

        return Inertia::render('Frontend/Home',[
            'cars' => $cars
        ]);
    }

    function rentalPage(Request $request){

        $cars = Car::where('availability' , 1)->get();

        $car_types = Car::pluck('car_type')->unique();
        $brands = Car::pluck('brand')->unique();

        //return $cars;

        return Inertia::render('Frontend/Rental/Index',[
            'cars' => $cars,
            // 'filters' => $request->only('car_type', 'brand', 'min_price', 'max_price'),
            'car_types' => $car_types,
            'brands' => $brands
        ]);

    }

    function rentalHistory(Request $request){
        
        $user_id = $request->header('userId');
        $rentals = Rental::where('user_id', $user_id)->with('car')->get();
        //return $rentals;
        return Inertia::render('Frontend/Rental/History',[
            'rentals' => $rentals
        ]);
    }

    function aboutPage(){

        return Inertia::render('Frontend/About');
    }

    function contactPage(){

        return Inertia::render('Frontend/Contact');
    }

}
