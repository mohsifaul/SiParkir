@extends('admin.layout.app')
@section('content')
    <div class="col-lg-12 col-md-12 col-12">
        <div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="mb-0 mb-lg-0">
                    <h3 class="mb-0  text-white">Data Alat IoT</h3>
                </div>
                <a href="/tambahlahanParkir" class="btn btn-light text-primary fw-bold"><i class="bi bi-plus-circle-fill"></i> Tambah</a>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 mt-3">
        <div class="card ">
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table id="example" class="table text-nowrap table-centered mt-0" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                                <th>Perangkat IoT</th>
                                <th>Status Alat</th>
                                <th>Lahan Parkir</th>
                                <th>Jadwal Maintenance</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td>
                                    <div class="d-flex m-auto mb-0">
                                        <div class="d-flex flex-column justify-content-center">
                                            <p class="mb-0 fw-bolder">{{$data['kdAlat']}}</p>
                                            <p class="mb-0">{{$data['namaLahanParkir']}}</p>
                                        </div>
                                    </div>
                                </td>
                                {{-- <td>{{$data['kdAlat']}}</td> --}}
                                {{-- <td>{{$data['namaLahanParkir']}}</td> --}}
                                <td><span class="badge badge-xl bg-success">{{$data['statusAlat']}}</span></td>
                                <td>{{$data['kdLahanParkir']}}</td>
                                <td>{{$data['jadwalMaintenance']}}</td>
                                <td class="mb-0">
                                    <a href="#!" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                        data-template="eyeOne"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalDetail"
                                        data-detail='@json($data)'>
                                        <i data-feather="eye" class="icon-xs"></i>
                                        <div id="eyeOne" class="d-none">
                                        <span>View</span>
                                        </div>
                                    </a>
                                    <a href="editlahanParkir" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                        data-template="editOne">
                                        <i data-feather="edit" class="icon-xs"></i>
                                        <div id="editOne" class="d-none">
                                        <span>Edit</span>
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
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Lahan Parkir</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <td>Perangkat IoT</td>
                            <td>:</td>
                            <td id="kdAlat" class="fw-bold"></td>
                        </tr>
                        <tr>
                            <td>Letak</td>
                            <td>:</td>
                            <td id="namaLahanParkir"></td>
                        </tr>
                        <tr>
                            <td>Status Alat</td>
                            <td>:</td>
                            <td id="statusAlat"></td>
                        </tr>
                        <tr>
                            <td>Terakhir Maintenance</td>
                            <td>:</td>
                            <td id="terakhirMaintenance"></td>
                        </tr>
                        <tr>
                            <td>Jadwal Maintenance</td>
                            <td>:</td>
                            <td id="jadwalMaintenance"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary text-light" data-bs-dismiss="modal">OKE</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.querySelectorAll('.btn-ghost').forEach(function(button) {
            button.addEventListener('click', function() {
                var data = JSON.parse(this.getAttribute('data-detail'));

                var lahanParkir = data.kdLahanParkir + " - " + data.namaLahanParkir;
                document.getElementById('kdAlat').textContent = data.kdAlat;
                document.getElementById('namaLahanParkir').textContent = lahanParkir;
                document.getElementById('statusAlat').textContent = data.statusAlat;
                document.getElementById('terakhirMaintenance').textContent = data.terakhirMaintenance;
                document.getElementById('jadwalMaintenance').textContent = data.jadwalMaintenance;
            });
        });
    </script>


@endsection