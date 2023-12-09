@extends('admin.layout.app')
@section('content')
    @include('sweetalert::alert')
    {{-- <div class="row"> --}}
        <div class="col-lg-12 col-md-12 col-12">
        <!-- Page header -->
            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mb-0 mb-lg-0">
                        <h3 class="mb-0  text-white">Data Lahan Parkir</h3>
                    </div>
                    <a href="/tambah-lahan-parkir" class="btn btn-light text-primary fw-bold"><i class="bi bi-plus-circle-fill"></i> Tambah</a>
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
                                    <th>Kode Lahan Parkir</th>
                                    <th>Nama</th>
                                    <th>Daya Tampung</th>
                                    <th>Sisa Daya Tampung</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{$data['kdLahanParkir']}}</td>
                                    <td>{{$data['namaLahanParkir']}}</td>
                                    <td>{{$data['totalDayaTampung']}}</td>
                                    <td>{{$data['sisaTotalDayaTampung']}}</td>
                                    <td class="text-center aligns-item-center">
                                        <div class="button-container d-flex justify-content-center align-items-center posting-form">
                                            <a href="#!" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                                data-template="eyeOne"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalDetail"
                                                data-detail='@json($data)'>
                                                <i data-feather="eye" class="icon-xs text-info"></i>
                                                <div id="eyeOne" class="d-none">
                                                <span>View</span>
                                                </div>
                                            </a>
                                            <a href="{{ route('edit-lahan', ['id' => $data['id']]) }}" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip" data-template="editOne" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                <i data-feather="edit" class="icon-xs text-warning"></i>
                                                <div id="editOne" class="d-none">
                                                    <span>Edit</span>
                                                </div>
                                            </a>
                                            <form action="{{ route('hapus-lahan', $data['id']) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip delete-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus"><i data-feather="trash-2" class="icon-xs text-danger"></i>
                                                    <div id="trashOne" class="d-none">
                                                        <span>Delete</span>
                                                    </div>
                                                </button>
                                            {{-- <a href="" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip delete-btn"
                                                data-template="trashOne"
                                                data-id="{{ $data['id'] }}">
                                                <i data-feather="trash-2" class="icon-xs"></i>
                                                <div id="trashOne" class="d-none">
                                                    <span>Delete</span>
                                                </div>
                                            </a> --}}
                                            </form>
                                        </div>
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
                                <td>Nama Lahan Parkir</td>
                                <td>:</td>
                                <td id="namaLahanParkir"></td>
                            </tr>
                            <tr>
                                <td>Daya Tampung</td>
                                <td>:</td>
                                <td id="totalDayaTampung"></td>
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
            document.addEventListener('DOMContentLoaded', function() {
                const deleteButtons = document.querySelectorAll('.delete-btn');
                deleteButtons.forEach(function(button) {
                    button.addEventListener('click', function(event) {
                        event.preventDefault();
                        const form = this.closest('form');
                        Swal.fire({
                            title: 'Konfirmasi',
                            text: 'Apakah Anda yakin ingin menghapus?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Hapus',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            });
            document.querySelectorAll('.btn-ghost').forEach(function(button) {
                button.addEventListener('click', function() {
                    var data = JSON.parse(this.getAttribute('data-detail'));
                    document.getElementById('namaLahanParkir').textContent = data.namaLahanParkir;
                    document.getElementById('totalDayaTampung').textContent = data.totalDayaTampung;
                });
            });
        </script>
@endsection