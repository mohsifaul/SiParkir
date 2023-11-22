@extends('admin.layout.app')
@section('content')
    {{-- <div class="row"> --}}
        <div class="col-lg-12 col-md-12 col-12">
        <!-- Page header -->
            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn btn-light text-primary" onclick="goBack()"><i class="bi bi-arrow-bar-left fw-xxl"></i> Kembali</div>
                    <div class="mb-0 mb-lg-0">
                        <h3 class="mb-0  text-white">Edit Data Lahan Parkir</h3>
                    </div>
                    <div></div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 mt-3">
        <!-- card -->
            <div class="card ">
                <!-- card body -->
                <div class="card-body">
                    <form class="row g-3 needs-validation" novalidate action="{{ route('update-lahan', $dataLahan['id']) }}" method="POST">
                        @csrf
                        <div class="col-md-4">
                            <label for="validationCustom01" class="form-label">Kode Lahan Parkir</label>
                            <input type="text" class="form-control" id="validationCustom01" required placeholder="Masukkan Kode Lahan Parkir" readonly disabled value="{{ $dataLahan['kdLahanParkir'] }}">
                            <input type="hidden" class="form-control" id="validationCustom01" required placeholder="Masukkan Kode Lahan Parkir" value="{{ $dataLahan['kdLahanParkir'] }}" name="kdLahanParkir">
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Harap Isi Bidang ini.</div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom02" class="form-label">Nama Lahan Parkir</label>
                            <input type="text" class="form-control" id="validationCustom02" required value="{{ $dataLahan['namaLahanParkir'] }}" placeholder="Masukkan Nama Lahan Parkir" name="namaLahanParkir">
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Harap Isi Bidang ini.</div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom02" class="form-label">Daya Tampung Lahan Parkir</label>
                            <input type="number" class="form-control" id="validationCustom02" required value="{{ $dataLahan['totalDayaTampung'] }}" placeholder="Masukkan Total Daya Tampung"  name="totalDayaTampung">
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Harap Isi Bidang ini.</div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Simpan</button>
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
    </script>
@endsection