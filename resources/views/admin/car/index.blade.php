<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Mobil') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="mb-0">Daftar Mobil</h1>
                        <a href="{{ route('admin.cars.add') }}" class="btn btn-primary">Tambah Mobil</a>
                    </div>
                    <hr />
                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Merk</th>
                                <th>Model</th>
                                <th>Nomor Plat</th>
                                <th>Tarif Sewa</th>
                                <th>QTY</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cars as $car)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $car->brand }}</td>
                                <td class="align-middle">{{ $car->type }}</td>
                                <td class="align-middle">{{ $car->plate_number }}</td>
                                <td class="align-middle">{{ $car->rent_price }}</td>
                                <td class="align-middle">{{ $car->qty }}</td>
                                <td class="align-middle">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('admin.cars.edit', ['id'=>$car->id]) }}" type="button" class="btn btn-secondary">Edit</a>
                                        <a href="{{ route('admin.cars.delete', ['id'=>$car->id]) }}" type="button" class="btn btn-danger">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="7">Mobil Tidak Ada</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>