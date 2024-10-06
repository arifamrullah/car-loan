<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReturnCar;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;

class ReturnCarController extends Controller
{
    public function index() {
        $return_cars = ReturnCar::orderBy('id', 'asc')->get();
        $total = ReturnCar::count();
        return view('admin.return-car.index', compact(['return_cars', 'total']));
    }

    public function custIndex() {
        $user_id = Auth::user()->id;
        $return_cars = ReturnCar::whereUserId($user_id)->orderBy('id', 'asc')->get();
        $total = ReturnCar::count();
        return view('customer.return-car.index', compact(['return_cars', 'total']));
    }

    public function carReturn() {
        return view('customer.car.return');
    }

    public function save(Request $request) {
        $validation = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'days' => 'required',
            'total_price' => 'required',
            'car_id' => 'required',
            'user_id' => 'required',
            'rent_car_id' => 'required'
        ]);

        $car = Car::findOrFail($request->car_id);
        $car->is_available = true;
        $car->save();

        $data = ReturnCar::create($validation);

        if($data && $car) {
            session()->flash('success', 'Mobil Berhasil Dikembalikan');
            return redirect(route('customer.returns'));
        } else {
            session()->flash('error', 'Mobil Tidak Berhasil Dikembalikan');
            return redirect(route('customer.cars.return'));
        }
    }
}
