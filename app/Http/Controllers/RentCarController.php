<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentCar;
use App\Models\Car;

class RentCarController extends Controller
{
    public function index() {
        $rent_cars = RentCar::orderBy('start_date', 'asc')->get();
        $total = RentCar::count();
        return view('admin.rent-car.index', compact(['rent_cars', 'total']));
    }
    
    public function custIndex() {
        $rent_cars = RentCar::orderBy('start_date', 'asc')->get();
        $total = RentCar::count();
        return view('customer.rent-car.index', compact(['rent_cars', 'total']));
    }

    public function save(Request $request) {
        $validation = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'days' => 'required',
            'est_price' => 'required',
            'car_id' => 'required',
            'user_id' => 'required'
        ]);

        $car = Car::findOrFail($request->car_id);
        $car->is_available = false;
        $car->save();

        $data = RentCar::create($validation);

        if($data && $car) {
            session()->flash('success', 'Mobil Berhasil Disewa');
            return redirect(route('customer.rents'));
        } else {
            session()->flash('error', 'Mobil Tidak Berhasil Disewa');
            return redirect(route('customer.cars.rent'));
        }
    }

    public function findByPlate(Request $request) {
        $car = Car::wherePlateNumber($request->plate_number)->firstOrFail();
        $rent = RentCar::whereCarId($car->id)->firstOrFail();

        return view('customer.return-car.index', compact('rent'));
    }
}
