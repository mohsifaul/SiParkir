@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
        <!-- Page header -->
            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h3 class="mb-0  text-white">Sistem Informasi Parkir - SiParkir</h3>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($datas as $item)
            <div class="col-xl-4 col-lg-6 col-md-12 col-12 mt-6">
            <!-- card -->
                <div class="card ">
                    <!-- card body -->
                    <div class="card-body">
                    <!-- heading -->
                        <div class="d-flex justify-content-between align-items-center
                            mb-3">
                            <div>
                            <h4 class="mb-0">{{$item['namaLahanParkir']}}</h4>
                            </div>
                            <div class="icon-shape icon-md bg-light-primary text-primary
                            rounded-2">
                            <i class="bi bi-briefcase fs-4"></i>
                            </div>
                        </div>
                        <!-- project number -->
                        <div>
                            <h1 class="fw-bold">{{$item['totalDayaTampung']}}</h1>
                            <p class="mb-0"><span class="text-dark me-2">2</span>Kosong</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection