<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Mobil yang Disewa') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="mb-0">Daftar Mobil yang Disewa</h1>
                        <a href="{{ route('customer.cars.return') }}" class="btn btn-primary">Kembali Mobil</a>
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
                                <th>Mobil</th>
                                <th>Nomor Plat</th>
                                <th>Tanggal Sewa</th>
                                <th>Tanggal Kembali</th>
                                <th>Jumlah Hari Penyewaan</th>
                                <th>Estimasi Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rent_cars as $rent_car)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $rent_car->car->brand }} {{ $rent_car->car->type }}</td>
                                <td class="align-middle">{{ $rent_car->car->plate_number }}</td>
                                <td class="align-middle">{{ $rent_car->start_date }}</td>
                                <td class="align-middle">{{ $rent_car->end_date }}</td>
                                <td class="align-middle">{{ $rent_car->days }}</td>
                                <td class="align-middle">Rp{{ number_format($rent_car->est_price,0,',','.') }}</td>
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