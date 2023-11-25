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
                                            data-template="eyeOne" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat">
                                            <i data-feather="eye" class="icon-xs text-info"></i>
                                            <div id="eyeOne" class="d-none">
                                            <span>View</span>
                                            </div>
                                        </a>
                                        <a href="#!" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                            data-template="trashOne" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                            <i data-feather="trash-2" class="icon-xs text-danger"></i>
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

            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection