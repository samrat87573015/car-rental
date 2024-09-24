<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use Inertia\Inertia;

class CarController extends Controller
{
    function carList(){
        $cars = Car::where('availability' , 1)->get();
        return $cars;
    }

    function carDetail($id){
        $car = Car::findOrFail($id);
        //return $car;
        return Inertia::render('Frontend/Car/Show',[
            'car' => $car
        ]);
    }
}
