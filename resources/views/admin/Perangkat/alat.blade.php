@section('title')
    Tambah Alat | SiParkir
@endsection
@extends('admin.layout.app')
@section('content')
    @include('sweetalert::alert')
    <div class="col-lg-12 col-md-12 col-12">
        <div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="mb-0 mb-lg-0">
                    <h3 class="mb-0  text-white">Data Alat IoT</h3>
                </div>
                <a href="{{route('tambah-alat')}}" class="btn btn-light text-primary fw-bold"><i class="bi bi-plus-circle-fill"></i> Tambah</a>
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
                                <td>
                                    @if($data['statusAlat'] == 'Tidak ada kerusakan' || $data['statusAlat'] == 'baik')
                                        <span class="badge badge-xl bg-success">Tidak Ada Kerusakan</span>
                                    @elseif($data['statusAlat'] == 'rusak')
                                        <span class="badge badge-xl bg-danger">Perangkat Rusak</span>
                                    @elseif($data['statusAlat'] == 'perbaikan')
                                        <span class="badge badge-xl bg-warning">Perangkat Dalam Perbaikan</span>
                                    @endif
                                </td>
                                <td>
                                    @if($data['kdLahanParkir'] === 'Lahan Parkir Tidak ditemukan')
                                        <span class="text-danger fw-bold">{{ $data['kdLahanParkir'] }}</span>
                                    @else
                                        {{ $data['kdLahanParkir'] }}
                                    @endif
                                </td>
                                {{-- <td>{{ isset($data['kdLahanParkir']) ? $data['kdLahanParkir'] : 'Lahan Parkir Tidak Ditemukan' }}</td> --}}
                                <td>{{ date('d M Y', strtotime($data['jadwalMaintenance'])) }}</td>
                                <td class="text-center aligns-item-center">
                                    <div class="button-container d-flex justify-content-center align-items-center posting-form">
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
                                        <a href="{{route('edit-alat', ['id' => $data['id']]) }}" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                            data-template="editOne">
                                            <i data-feather="edit" class="icon-xs"></i>
                                            <div id="editOne" class="d-none">
                                            <span>Edit</span>
                                            </div>
                                        </a>
                                        <form action="{{ route('hapus-alat', $data['id']) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip delete-btn"><i data-feather="trash-2" class="icon-xs"></i>
                                                <div id="trashOne" class="d-none">
                                                    <span>Delete</span>
                                                </div>
                                            </button>
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
        });
        document.querySelectorAll('.btn-ghost').forEach(function(button) {
            button.addEventListener('click', function() {
                var data = JSON.parse(this.getAttribute('data-detail'));

                var kdAlat = data.kdAlat + " - " + (data.namaLahanParkir ? data.namaLahanParkir : 'Nama Tidak Ditemukan');
                document.getElementById('kdAlat').textContent = kdAlat;
                document.getElementById('namaLahanParkir').textContent = data.kdLahanParkir;

                // Menentukan teks berdasarkan status alat
                var statusText = '';
                if (data.statusAlat === 'rusak') {
                    statusText = 'Perangkat Rusak';
                } else if (data.statusAlat === 'baik' || data.statusAlat === 'Tidak ada kerusakan') {
                    statusText = 'Tidak Ada Kerusakan';
                } else if (data.statusAlat === 'perbaikan') {
                    statusText = 'Dalam Perbaikan';
                }
                document.getElementById('statusAlat').textContent = statusText;

                // Format tanggal terakhirMaintenance
                var terakhirMaintenance = new Date(data.terakhirMaintenance);
                var formattedTerakhirMaintenance = terakhirMaintenance.getDate() + ' ' + terakhirMaintenance.toLocaleString('default', { month: 'long' }) + ' ' + terakhirMaintenance.getFullYear();
                document.getElementById('terakhirMaintenance').textContent = formattedTerakhirMaintenance;

                // Format tanggal jadwalMaintenance
                var jadwalMaintenance = new Date(data.jadwalMaintenance);
                var formattedJadwalMaintenance = jadwalMaintenance.getDate() + ' ' + jadwalMaintenance.toLocaleString('default', { month: 'long' }) + ' ' + jadwalMaintenance.getFullYear();
                document.getElementById('jadwalMaintenance').textContent = formattedJadwalMaintenance;
            });
        });
        
    </script>

@endsection