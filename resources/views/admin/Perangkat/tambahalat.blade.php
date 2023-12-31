@extends('admin.layout.app')
@section('content')
    @include('sweetalert::alert')
    {{-- <div class="row"> --}}
        <div class="col-lg-12 col-md-12 col-12">
        <!-- Page header -->
            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn btn-light text-primary "  onclick="goBack()"><i class="bi bi-arrow-bar-left fw-xxl"></i> Kembali</div>
                    <div class="mb-0 mb-lg-0">
                        <h3 class="mb-0  text-white">Tambah Data Perangkat IoT</h3>
                    </div>
                    <div></div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 mt-3">
        <!-- card -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            <div class="card ">
                <!-- card body -->
                <div class="card-body">
                    <form class="row g-3 needs-validation" novalidate action="{{route('tambah-iot')}}" method="POST">
                        @csrf
                        <div class="col-md-3">
                            <label for="validationCustom01" class="form-label">Kode Perangkat IoT</label>
                            <input type="text" class="form-control" id="validationCustom01" required placeholder="Kode Perangkat" name="kdAlat" >                            
                            <div class="invalid-feedback">Harap Isi Bidang ini.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Nama Perangkat IoT</label>
                            <input type="text" class="form-control" id="validationCustom02" required placeholder="Nama Perangkat IoT" name="namaLahanParkir">                            
                            <div class="invalid-feedback">Harap Isi Bidang ini.</div>
                        </div>
                        <div class="col-md-3">
                            <label for="validationCustom02" class="form-label">Tanggal Pasang</label>
                            <input type="date" class="form-control" id="validationCustom02" required name="tanggalPasang">                            
                            <div class="invalid-feedback">Harap Isi Bidang ini.</div>
                        </div>
                        <div class="col-md-3">
                            <label for="validationCustom02" class="form-label">Status Alat</label>
                            <select name="statusAlat" id="validationCustom02" required class="form-control">
                                <option value="" selected disabled>-- Status Alat</option>
                                <option value="baik">Tidak Ada Kerusakan</option>
                                <option value="rusak">Alat Rusak</option>
                                <option value="perbaikan">Dalam Perbaikan</option>
                            </select>                            
                            <div class="invalid-feedback">Harap Isi Bidang ini.</div>
                        </div>
                        <div class="col-md-3">
                            <label for="tanggalMaintenance" class="form-label">Tanggal Maintenance</label>
                            <input type="date" class="form-control" id="terakhirMaintenance" required placeholder="Masukkan Tanggal Maintenance" name="terakhirMaintenance">                            
                            <div class="invalid-feedback">Harap Isi Bidang ini.</div>
                        </div>
                        <div class="col-md-3">
                            <label for="jadwalMaintenance" class="form-label">Jadwal Maintenance</label>
                            <input type="date" class="form-control" id="jadwalMaintenanceHidden" required placeholder="Tanggal Jadwal Maintenance" name="jadwalMaintenanceHidden" disabled>                                         
                            <input type="hidden" class="form-control" id="jadwalMaintenance" required placeholder="Tanggal Jadwal Maintenance" name="jadwalMaintenance">                                         
                            <div class="invalid-feedback">Harap Isi Bidang ini.</div>
                        </div>
                        <div class="col-md-3">
                            <label for="validationCustom02" class="form-label">Lokasi</label>
                            <select name="kdLahanParkir" id="kdLahanParkir" required class="form-control">
                                <option value="" selected disabled>-- Lahan Parkir</option>
                                @foreach($data as $lahan)
                                    <option value="{{ $lahan['kdLahanParkir'] }}">{{ $lahan['namaLahanParkir'] }}</option>
                                @endforeach
                            </select>                            
                            <div class="invalid-feedback">Harap Isi Bidang ini.</div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    {{-- </div> --}}
    <script>
        (() => {
            'use strict'
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
        function goBack() {
            window.history.back();
        }
        document.getElementById('terakhirMaintenance').addEventListener('change', function() {
            var tanggalMaintenance = new Date(this.value);
            var jadwalMaintenance = new Date(tanggalMaintenance.getFullYear(), tanggalMaintenance.getMonth() + 1, tanggalMaintenance.getDate());
            var formattedDate = jadwalMaintenance.toISOString().slice(0, 10);

            document.getElementById('jadwalMaintenance').value = formattedDate;
            document.getElementById('jadwalMaintenanceHidden').value = formattedDate;
            document.getElementById('jadwalMaintenanceHidden').disabled = true;
        });
    </script>
@endsection