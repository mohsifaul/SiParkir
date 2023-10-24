@extends('admin.layout.app')
@section('content')
    {{-- <div class="row"> --}}
        <div class="col-lg-12 col-md-12 col-12">
        <!-- Page header -->
            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mb-0 mb-lg-0">
                        <h3 class="mb-0 text-white">Maintenance Perangkat IoT</h3>
                    </div>
                    <div class="btn btn-light text-primary fw-bold"><i class="bi bi-plus-circle-fill"></i> Tambah</div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 mt-3">
        <!-- card -->
            <div class="card ">
                <!-- card body -->
                <div class="card-body">
                        <div class="table-responsive table-card">
                        <table id="example" class="table text-nowrap table-centered mt-0" style="width: 100%">
                            <thead class="table-light">
                                <tr>
                                    <th class="pe-0">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="checkAll">
                                            <label class="form-check-label" for="checkAll">
                                            </label>
                                        </div>
                                    </th>
                                    <th class="ps-1">Kode Perawatan</th>
                                    <th>Tanggal</th>
                                    <th>Kode Alat</th>
                                    <th>Keterangan</th>
                                    <th>Nama Pengecek</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="pe-0">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="contactCheckbox2">
                                            <label class="form-check-label" for="contactCheckbox2">
                                            </label>
                                        </div>
                                    </td>
                                    <td>KP001</td>                                
                                    <td>19 July, 2023</td>
                                    <td>IoT001</td>
                                    <td>Masih Bagus</td>
                                    <td>Pegawai BMN</td>
                                    <td>
                                        <span class="badge bg-light-success text-success text-xxl">Aman</span>
                                    </td>
                                    <td>
                                        <a href="#!" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                            data-template="eyeOne">
                                            <i data-feather="eye" class="icon-xs"></i>
                                            <div id="eyeOne" class="d-none">
                                            <span>View</span>
                                            </div>
                                        </a>
                                        <a href="#!" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                            data-template="trashOne">
                                            <i data-feather="trash-2" class="icon-xs"></i>
                                            <div id="trashOne" class="d-none">
                                            <span>Delete</span>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pe-0">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="contactCheckbox2">
                                            <label class="form-check-label" for="contactCheckbox2">
                                            </label>
                                        </div>
                                    </td>
                                    <td>KP001</td>                                
                                    <td>19 July, 2023</td>
                                    <td>IoT001</td>
                                    <td>Masih Bagus</td>
                                    <td>Pegawai BMN</td>
                                    <td>
                                        <span class="badge bg-light-danger text-danger text-xxl">Rusak</span>
                                    </td>
                                    <td>
                                        <a href="#!" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                            data-template="eyeOne">
                                            <i data-feather="eye" class="icon-xs"></i>
                                            <div id="eyeOne" class="d-none">
                                            <span>View</span>
                                            </div>
                                        </a>
                                        <a href="#!" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                            data-template="trashOne">
                                            <i data-feather="trash-2" class="icon-xs"></i>
                                            <div id="trashOne" class="d-none">
                                            <span>Delete</span>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
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