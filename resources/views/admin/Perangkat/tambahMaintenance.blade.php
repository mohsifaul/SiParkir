@extends('admin.layout.app')
@section('content')
    @include('sweetalert::alert')
    {{-- <div class="row"> --}}
        <div class="col-lg-12 col-md-12 col-12">
        <!-- Page header -->
            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn btn-light text-primary" onclick="goBack()"><i class="bi bi-arrow-bar-left fw-xxl"></i> Kembali</div>
                    <div class="mb-0 mb-lg-0">
                        <h3 class="mb-0  text-white">Tambah Data Maintenance Alat</h3>
                    </div>
                    <div></div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 mt-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <!-- card -->
            <div class="card ">
                <!-- card body -->
                <div class="card-body">
                    <form class="row g-3 needs-validation" novalidate action="{{route('simpan-maintenance')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom01" class="form-label">Kode Perawatan</label>
                                    <input type="text" class="form-control" id="validationCustom01" required placeholder="Masukkan Kode Perawatan" name="kdPerawatan">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Harap Isi Bidang ini.</div>
                                </div>
                                <div class="col-md-6 mb-3">   
                                    <label for="validationCustom02" class="form-label">Nama Perangkat</label>
                                    <select name="kdAlat" id="kdAlat" class="form-control">
                                        <option value="" selected disabled>-- Pilih Perangkat</option>
                                        @foreach ($data as $item)
                                            <option value="{{ $item['kdAlat'] }}">{{ $item['namaLahanParkir'] }}</option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Harap Isi Bidang ini.</div>
                                </div>                        
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02" class="form-label">Tanggal Perawatan</label>
                                    <input type="date" id="tanggalPerawatan" disabled class="form-control">
                                    <input type="hidden" id="hiddenTanggalPerawatan" name="tanggalPerawatan">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Harap Isi Bidang ini.</div>
                                </div>                        
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02" class="form-label">Nama Pengecek</label>
                                    <input type="text" name="namaPengecek" id="namaPengecek" class="form-control" required>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Harap Isi Bidang ini.</div>
                                </div>                        
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom02" class="form-label">Keterangan</label>
                                    <textarea name="keterangan" id="" cols="20" rows="5" class="form-control" required></textarea>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Harap Isi Bidang ini.</div>
                                </div>                        
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">Tambah</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="col-md-12">
                                <label for="validationCustom02" class="form-label">Upload Foto</label>
                                <input type="file" name="uploadFoto" id="uploadFoto" class="form-control" accept=".jpg, .jpeg, .png" onchange="previewImage(event)">
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Harap Isi Bidang ini.</div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="validationCustom02" class="form-label">Preview Foto</label>
                                <img id="preview" src="#" alt="Preview" style="max-width: 100%; max-height: 250px; display: none;">
                            </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            const inputTanggalDisabled = document.getElementById('tanggalPerawatan');
            const inputTanggalHidden = document.getElementById('hiddenTanggalPerawatan');

            const today = new Date();
            const formattedDate = today.toISOString().substr(0, 10);

            inputTanggalDisabled.value = formattedDate; // Set nilai default pada input yang disabled
            inputTanggalHidden.value = formattedDate; // Set nilai default pada input yang hidden
        });

        function previewImage(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const preview = document.getElementById('preview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>

@endsection