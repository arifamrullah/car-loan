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
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Cari Mobil Berdasarkan</h4>
                        <form action="{{ route('admin.cars.search') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="brand" placeholder="Merek Mobil" value="{{ Request()->brand ? Request()->brand : '' }}">
                            @error('brand')
                            <span class="text-danger">{{$message}}</span>
                            @enderror

                            <input type="text" name="type" placeholder="Model Mobil" value="{{ Request()->type ? Request()->type : '' }}">
                            @error('type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror

                            <select name="is_available" id="is_available">
                                <option value="" disabled selected hidden>-- Ketersediaan --</option>
                                <option value="true" {{ Request()->is_available == 'true' ? 'selected' : '' }}>Tersedia</option>
                                <option value="false" {{ Request()->is_available == 'false' ? 'selected' : '' }}>Tidak Tersedia</option>
                            </select>

                            <button class="btn btn-primary">Cari Mobil</button>
                            <a href="{{ route('admin.cars') }}" class="btn btn-danger">Reset</a>
                        </form>
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
                                <th>Tarif Sewa per Hari</th>
                                <th>Ketersediaan</th>
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
                                <td class="align-middle">Rp{{ number_format($car->rent_price,0,',','.') }}</td>
                                <td class="align-middle">
                                    @if($car->is_available == true)
                                        &#9989;
                                    @else
                                        &#10060;
                                        <br>
                                        @forelse ($car->rentCar as $rent)
                                            Tersedia pada tanggal {{ date("d-m-Y" ,strtotime("+1 day", strtotime($rent->end_date))) }}
                                        @empty
                                        @endforelse
                                    @endif
                                </td>
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