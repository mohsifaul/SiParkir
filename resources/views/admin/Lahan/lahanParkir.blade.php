@extends('admin.layout.app')
@section('content')
    {{-- <div class="row"> --}}
        <div class="col-lg-12 col-md-12 col-12">
        <!-- Page header -->
            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mb-0 mb-lg-0">
                        <h3 class="mb-0  text-white">Data Lahan Parkir</h3>
                    </div>
                    <a href="/tambahlahanParkir" class="btn btn-light text-primary fw-bold"><i class="bi bi-plus-circle-fill"></i> Tambah</a>
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
                                <th class="ps-1">Kode Lahan Parkir</th>
                                <th>Nama</th>
                                <th>Daya Tampung</th>
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
                                <td>LP001</td>
                                <td>Lahan Parkir 1</td>
                                <td>150 Motor</td>
                                <td>
                                <a href="#!" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                    data-template="eyeOne"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalDetail">
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
            document.querySelectorAll('.btn-ghost').forEach(function(button) {
                button.addEventListener('click', function() {
                    var data = JSON.parse(this.getAttribute('data-detail'));
                    document.getElementById('namaLahanParkir').textContent = data.namaLahanParkir;
                    document.getElementById('totalDayaTampung').textContent = data.totalDayaTampung;
                });
            });
        </script>
        
        
    {{-- </div> --}}
    <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
    <script>
        axios.get('http://localhost:8001/api/lahan-parkir')
            .then(function (response) {
                // handle success
                const data = response.data.data;
                const tableBody = document.querySelector('tbody'); // Ganti ini dengan selector yang sesuai
                console.log(data)
                data.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="pe-0">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="contactCheckbox2">
                                <label class="form-check-label" for="contactCheckbox2">
                                </label>
                            </div>
                        </td>
                        <td>${item.kd_lahan_parkir}</td>
                        <td>${item.nama_lahan_parkir}</td>
                        <td>${item.total_daya_tampung}</td>
                        <td>
                            <a href="#!" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                data-template="eyeOne"
                                data-bs-toggle="modal" 
                                data-bs-target="#modalDetail">
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
                    `;
                    tableBody.appendChild(row);
                });
                // Loop melalui data dan tambahkan ke tabel
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            });
    </script>
@endsection