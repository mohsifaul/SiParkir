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
                    <a href="/tambah-maintenance-alat" class="btn btn-light text-primary fw-bold"><i class="bi bi-plus-circle-fill"></i> Tambah</a>
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
                                    {{-- <th class="ps-1">Kode Perawatan</th> --}}
                                    <th>Tanggal</th>
                                    <th>Nama Alat</th>
                                    <th>Keterangan</th>
                                    <th>Nama Pengecek</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataLog as $item)
                                <tr>
                                    {{-- <td>{{ $item['kdPerawatan'] }}</td>                                 --}}
                                    <td>{{ date('d M Y', strtotime($item['tanggalPerawatan'])) }}</td>
                                    <td>{{ isset($item['kdAlat']) ? $item['kdAlat'] : 'Perangkat Tidak Ditemukan' }}</td>
                                    <td>{{ $item['keterangan'] }}</td>
                                    <td>{{ $item['namaPengecek'] }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm btn-icon view-image" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Foto" data-bs-target="#imageModal" data-image-url="{{ $item['linkFotoMaintenance'] }}">
                                            <i data-feather="eye" class="icon-xs"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <a href="#!" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                            data-template="eyeOne"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalDetail"
                                            data-detail='@json($item)'>
                                            <i data-feather="eye" class="icon-xs text-info"></i>
                                            <div id="eyeOne" class="d-none">
                                            <span>View</span>
                                            </div>
                                        </a>
                                        <form action="{{ route('hapus-maintenance', $item['id']) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip delete-btn">
                                                <i data-feather="trash-2" class="icon-xs text-danger"></i>
                                                <div id="trashOne" class="d-none">
                                                    <span>Delete</span>
                                                </div>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
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
    <!-- Modal -->
    <div class="modal" tabindex="-1" id="imageModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Gambar Foto Perawatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modalImage" src="" alt="Gambar" style="width: 100%;" />
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Data Maintenance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        
                    </button>
                </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <td>Kode Perawatan</td>
                            <td>:</td>
                            <td id="kdPerawatan" class="fw-bold"></td>
                        </tr>
                        <tr>
                            <td>Kode Alat</td>
                            <td>:</td>
                            <td id="kdAlat"></td>
                        </tr>
                        <tr>
                            <td>Tanggal Perawatan</td>
                            <td>:</td>
                            <td id="tanggalPerawatan"></td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td id="keterangan"></td>
                        </tr>
                        <tr>
                            <td>Nama Pengecek</td>
                            <td>:</td>
                            <td id="namaPengecek"></td>
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
        document.addEventListener('DOMContentLoaded', function () {
            const modalImage = document.getElementById('modalImage');
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));

            const viewButtons = document.querySelectorAll('.view-image');
            viewButtons.forEach((button) => {
                button.addEventListener('click', function () {
                    const imageUrl = this.getAttribute('data-image-url');
                    modalImage.src = imageUrl;
                    modal.show();
                });
            });

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

            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            //modal detail
            document.querySelectorAll('.btn-ghost').forEach(function(button) {
                button.addEventListener('click', function() {
                    var data = JSON.parse(this.getAttribute('data-detail'));

                    var kdPerawatan = data.kdPerawatan + " - " + (data.kdAlat ? data.kdAlat : 'Nama Tidak Ditemukan');
                    document.getElementById('kdPerawatan').textContent = kdPerawatan;
                    document.getElementById('kdAlat').textContent = data.kdAlat;

                    // Format tanggal tanggalPerawatan
                    var tanggalPerawatan = new Date(data.tanggalPerawatan);
                    var formattedtanggalPerawatan = tanggalPerawatan.getDate() + ' ' + tanggalPerawatan.toLocaleString('default', { month: 'long' }) + ' ' + tanggalPerawatan.getFullYear();
                    document.getElementById('tanggalPerawatan').textContent = formattedtanggalPerawatan;

                    
                    document.getElementById('keterangan').textContent = data.keterangan;
                    document.getElementById('namaPengecek').textContent = data.namaPengecek;
                });
            });
        });
    </script>
@endsection