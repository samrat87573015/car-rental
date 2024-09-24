<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Car;
use App\Models\Rental;
use App\Models\User;

class DashboardController extends Controller
{
    function dashboard()
    {

        $carNumber = Car::count();
        $availabilityCar = Car::where('availability', 1)->count();
        $rentalNumber = Rental::count();
        $totalEarnings = Rental::where('status', 'Completed')->sum('total_cost');
        $totalCustomer = User::count();

        $data = [
            'carNumber' => $carNumber,
            'rentalNumber' => $rentalNumber,
            'totalEarnings' => $totalEarnings,
            'availabilityCar' => $availabilityCar,
            'totalCustomer' => $totalCustomer

        ];

        //return $data;


        return Inertia::render('Admin/Dashboard',[
            'data' => $data
        ]);
    }
}
