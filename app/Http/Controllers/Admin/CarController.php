<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Helper\ResponsHelper;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Car::all();
        return Inertia::render('Admin/Cars',[
            'cars' => $data
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


            $name = $request->name;
            $brand = $request->brand;
            $model = $request->model;
            $year = $request->year;
            $car_type = $request->car_type;
            $daily_rent_price = $request->daily_rent_price;
            $availability = $request->availability;

            
            if($request->hasFile('image')){
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;
                $file->move('uploads/cars/', $filename);
                $image = 'uploads/cars/'.$filename;
            }else{
                $image = '';
            }
    
    
            $data = Car::create([
                'name' => $name,
                'brand' => $brand,
                'model' => $model,
                'year' => $year,
                'car_type' => $car_type,
                'daily_rent_price' => $daily_rent_price,
                'image' => $image,
                'availability' => $availability
            ]);
    
            return ResponsHelper::out("success",$data,200);
        }catch(\Exception $e){
            return ResponsHelper::out("failed",$e->getMessage(),200);
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $car_id)
    {
        $data = Car::where('id', $car_id)->first();
        return Inertia::render('Admin/CarDetails',[
            'car' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $car_id)
    {
        $data = Car::findOrFail($car_id);
        //return $data;
        return Inertia::render('Admin/CarUpdate',[
            'car' => $data
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        try{

            $car_id = $request->input('car_id');

            if($request->hasFile('image')){
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = time().'.'.$ext;
                $file->move('uploads/cars/', $filename);
                $image = 'uploads/cars/'.$filename;

                // delete old img
                $oldImgUrl = $request->input('oldImgUrl');
                File::delete($oldImgUrl);

                //update car

                $data= Car::where('id', $car_id)->update([
                    'name' => $request->input('name'),
                    'brand' => $request->input('brand'),
                    'model' => $request->input('model'),
                    'year' => $request->input('year'),
                    'car_type' => $request->input('car_type'),
                    'daily_rent_price' => $request->input('daily_rent_price'),
                    'availability' => $request->input('availability'),
                    'image' => $image,
                ]);

                return ResponsHelper::out("success",$data,200);


            }else{
                $data= Car::where('id', $car_id)->update([
                    'name' => $request->input('name'),
                    'brand' => $request->input('brand'),
                    'model' => $request->input('model'),
                    'year' => $request->input('year'),
                    'car_type' => $request->input('car_type'),
                    'daily_rent_price' => $request->input('daily_rent_price'),
                    'availability' => $request->input('availability'),
                ]);

                return ResponsHelper::out("success",$data,200);
            }
        }catch(\Exception $e){
            return ResponsHelper::out("failed",$e->getMessage(),200);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try{
            $car_id = $request->input('car_id');
            $oldImgUrl = $request->input('oldImgUrl');
            File::delete($oldImgUrl);
            $data = Car::where('id', $car_id)->delete();
            return ResponsHelper::out("success",$data,200);
        }catch(\Exception $e){
            return ResponsHelper::out("failed",$e->getMessage(),200);
        }
    }
}
