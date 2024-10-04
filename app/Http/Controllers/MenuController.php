<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index() {
        $menus = Menu::orderBy('name', 'asc')->get();
        $total = Menu::count();
        return view('merchant.menu.index', compact(['menus', 'total']));
    }

    public function add() {
        return view('merchant.menu.add');
    }

    public function save(Request $request) {
        $validation = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
            'price' => 'required'
        ]);

        $data = Menu::create($validation);
        if($data) {
            session()->flash('success', 'Menu Berhasil Ditambahkan');
            return redirect(route('merchant.menus'));
        } else {
            session()->flash('error', 'Menu Tidak Berhasil Ditambahkan');
            return redirect(route('merchant.menu.add'));
        }
    }

    public function edit($id) {
        $menus = Menu::findOrFail($id);
        return view('merchant.menu.update', compact('menus'));
    }
    
    public function update(Request $request, $id) {
        $menus = Menu::findOrFail($id);
        $menus->name = $request->name;
        $menus->description = $request->description;
        $menus->image = $request->image;
        $menus->price = $request->price;
        
        // $menus->price = $price;
        $data = $menus->save();
        if($data) {
            session()->flash('success', 'Menu Berhasil Diedit');
            return redirect(route('merchant.menus'));
        } else {
            session()->flash('error', 'Menu Tidak Berhasil Diedit');
            return redirect(route('merchant.menu.update'));
        }
    }

    public function delete($id) {
        $data = Menu::findOrFail($id)->delete();
        if($data) {
            session()->flash('success', 'Menu Berhasil Dihapus');
            return redirect(route('merchant.menus'));
        } else {
            session()->flash('error', 'Menu Tidak Berhasil Dihapus');
            return redirect(route('merchant.menus'));
        }
    }
}
