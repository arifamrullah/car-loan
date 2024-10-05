<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Mobil') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="mb-0">Edit Mobil</h1>
                    <hr />
                    <form action="{{ route('admin.cars.update', $cars->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Merek Mobil</label>
                                <input type="text" name="brand" class="form-control" placeholder="Merek Mobil" value="{{$cars->brand}}">
                                @error('brand')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Model Mobil</label>
                                <input type="text" name="type" class="form-control" placeholder="Model Mobil" value="{{$cars->type}}">
                                @error('type')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Nomor Plat</label>
                                <input type="text" name="plate_number" class="form-control" placeholder="Nomor Plat" value="{{$cars->plate_number}}">
                                @error('plate_number')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Tarif Sewa per Hari</label>
                                <input type="text" name="rent_price" class="form-control" placeholder="Tarif Sewa per Hari" value="{{$cars->rent_price}}">
                                @error('rent_price')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Ketersediaan</label>
                                <select name="is_available" id="is_available">
                                    @if($cars->is_available == true)
                                        <option value="true" selected>Tersedia</option>
                                        <option value="false">Tidak Tersedia</option>
                                    @else
                                        <option value="true">Tersedia</option>
                                        <option value="false" selected>Tidak Tersedia</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-grid">
                                <button class="btn btn-warning">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>