<x-app-layout>
    <script>
        $(document).ready(function(){
            $("input[name='end_date']").on('change', function(){

                if($("input[name='end_date']").val().length > 0){
                    var $end_date = $("input[name='end_date']").val();
                    var $diff = new Date($end_date) - new Date($("input[name='start_date']").val());
                    var $days = $diff/1000/60/60/24 + 1;
                    var $total_price = {{ $rent->car->rent_price }} * $days;
                    
                    $("input[name='total_price']").val($total_price);
                    $("input[name='days']").val($days);
                }

            });
        })
    </script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kembali Mobil') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="mb-0">Kembali Mobil</h1>
                    <hr/>
                    @if (session()->has('error'))
                    <div>
                        {{session('error')}}
                    </div>
                    @endif
                    <form action="{{ route('customer.returns.save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="car_id" value="{{$rent->car->id}}">
                        <input type="hidden" name="user_id" value="{{$rent->user->id}}">
                        <input type="hidden" name="rent_cars_id" value="{{$rent->id}}">
                        <div class="row mb-3">
                            <div class="col">
                                Nama Penyewa : {{ $rent->user->name }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Tanggal Sewa</label>
                                <input type="date" name="start_date" value="{{ $rent->start_date }}" class="form-control" readonly>
                                @error('start_date')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Tanggal Akhir Sewa</label>
                                <input type="date" name="end_date" value="{{ $rent->end_date }}" class="form-control">
                                @error('end_date')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Harga Sewa per Hari</label>
                                <input type="text" name="rent_price" value="{{ $rent->car->rent_price }}" class="form-control" placeholder="0" readonly>
                                @error('rent_price')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Jumlah Hari Penyewaan</label>
                                <input type="text" name="days" class="form-control" value="{{ $rent->days }}" readonly>
                                @error('days')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Jumlah Biaya Sewa</label>
                                <input type="text" name="total_price" class="form-control" value="{{ $rent->est_price }}" readonly>
                                @error('total_price')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-grid">
                                <button class="btn btn-primary">Kembali Mobil</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>