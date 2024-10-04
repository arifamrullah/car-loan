<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function index() {
        $cars = Car::orderBy('brand', 'asc')->get();
        $total = Car::count();
        return view('admin.car.index', compact(['cars', 'total']));
    }

    public function add() {
        return view('admin.car.add');
    }

    public function save(Request $request) {
        $validation = $request->validate([
            'brand' => 'required',
            'type' => 'required',
            'plate_number' => 'required',
            'rent_price' => 'required',
            'qty' => 'required'
        ]);

        $data = Car::create($validation);
        if($data) {
            session()->flash('success', 'Mobil Berhasil Ditambahkan');
            return redirect(route('admin.cars'));
        } else {
            session()->flash('error', 'Mobil Tidak Berhasil Ditambahkan');
            return redirect(route('admin.car.add'));
        }
    }

    public function edit($id) {
        $cars = Car::findOrFail($id);
        return view('admin.car.update', compact('cars'));
    }
    
    public function update(Request $request, $id) {
        $cars = Car::findOrFail($id);
        $cars->brand = $request->brand;
        $cars->type = $request->type;
        $cars->plate_number = $request->plate_number;
        $cars->rent_price = $request->rent_price;
        $cars->qty = $request->qty;
        
        // $menus->price = $price;
        $data = $cars->save();
        if($data) {
            session()->flash('success', 'Mobil Berhasil Diedit');
            return redirect(route('admin.cars'));
        } else {
            session()->flash('error', 'Mobil Tidak Berhasil Diedit');
            return redirect(route('admin.car.update'));
        }
    }

    public function delete($id) {
        $data = Car::findOrFail($id)->delete();
        if($data) {
            session()->flash('success', 'Mobil Berhasil Dihapus');
            return redirect(route('admin.cars'));
        } else {
            session()->flash('error', 'Mobil Tidak Berhasil Dihapus');
            return redirect(route('admin.cars'));
        }
    }
}
