<x-app-layout>
    <script>
        $(document).ready(function(){
            var $start_date;
            var $end_date;

            $("input[name='start_date'], input[name='end_date']").on('change', function(){

                if($("input[name='start_date']").val().length > 0){
                    $start_date = $("input[name='start_date']").val();
                }

                if($("input[name='end_date']").val().length > 0){
                    $end_date = $("input[name='end_date']").val();
                }

                if($start_date && $end_date) {
                    var $diff = new Date($end_date) - new Date($start_date);
                    var $days = $diff/1000/60/60/24 + 1;
                    var $est_price = {{ $cars->rent_price }} * $days;
                    
                    $("input[name='est_price']").val($est_price);
                    $("input[name='days']").val($days);
                }
            });
        })
    </script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sewa Mobil') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="mb-0">Sewa Mobil</h1>
                    <hr/>
                    @if (session()->has('error'))
                    <div>
                        {{session('error')}}
                    </div>
                    @endif
                    <form action="{{ route('customer.rents.save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="car_id" value="{{$cars->id}}">
                        <input type="hidden" name="user_id" value="{{Auth::id()}}">
                        <div class="row mb-3">
                            <div class="col">
                                {{ $cars->brand }} {{ $cars->type }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                Nomor Plat : {{ $cars->plate_number }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Tanggal Sewa</label>
                                <input type="date" name="start_date" class="form-control">
                                @error('start_date')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Sampai Tanggal</label>
                                <input type="date" name="end_date" class="form-control">
                                @error('end_date')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Jumlah Hari Penyewaan</label>
                                <input type="text" name="days" class="form-control" placeholder="0" readonly>
                                @error('days')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Estimasi Harga</label>
                                <input type="text" name="est_price" class="form-control" placeholder="0" readonly>
                                @error('est_price')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-grid">
                                <button class="btn btn-primary">Sewa Mobil</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>