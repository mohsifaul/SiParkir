@extends('admin.layout.app')
@section('content')
    {{-- <div class="row"> --}}
        <div class="col-lg-12 col-md-12 col-12">
        <!-- Page header -->
            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mb-0 mb-lg-0">
                        <h3 class="mb-0  text-white">Data Log Histori Parkir</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 mt-3">
        <!-- card -->
            <div class="card mb-3">
                <!-- card body -->
                <div class="card-body">
                    <h3>Kendaraan Masuk</h3>
                    <div class="table-responsive table-card">
                        <table id="example2" class="table text-nowrap table-centered mt-0" style="width: 100%">
                            <thead class="table-light">
                            <tr>
                                <th>Jam</th>
                                <th>Kode Lahan Parkir</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>07 : 00</td>
                                <td>Lahan Parkir 1</td>
                                {{-- <td>
                                    <a href="#!" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                        data-template="eyeOne"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalDetail">
                                        <i data-feather="eye" class="icon-xs"></i>
                                        <div id="eyeOne" class="d-none">
                                        <span>View</span>
                                        </div>
                                    </a>
                                </td> --}}
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- heading -->
                    {{-- <div class="d-flex justify-content-between align-items-center
                        mb-3">
                        <div>
                            <h4 class="mb-0">Parkiran 1</h4>
                        </div>
                        <div class="btn bg-primary text-light rounded-2">
                        <i class="bi bi-plus fs-4"></i> Tambah 
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="card ">
                <!-- card body -->
                <div class="card-body">
                    <h3>Kendaraan Keluar</h3>
                    <div class="table-responsive table-card">
                        <table id="example" class="table text-nowrap table-centered mt-0" style="width: 100%">
                            <thead class="table-light">
                            <tr>
                                <th>Jam</th>
                                <th>Kode Lahan Parkir</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>07 : 00</td>
                                <td>Lahan Parkir 1</td>
                                {{-- <td>
                                    <a href="#!" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                        data-template="eyeOne"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalDetail">
                                        <i data-feather="eye" class="icon-xs"></i>
                                        <div id="eyeOne" class="d-none">
                                        <span>View</span>
                                        </div>
                                    </a>
                                </td> --}}
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- heading -->
                    {{-- <div class="d-flex justify-content-between align-items-center
                        mb-3">
                        <div>
                            <h4 class="mb-0">Parkiran 1</h4>
                        </div>
                        <div class="btn bg-primary text-light rounded-2">
                        <i class="bi bi-plus fs-4"></i> Tambah 
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    {{-- </div> --}}
@endsection