@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
        <!-- Page header -->
            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mb-2 mb-lg-0">
                        <h3 class="mb-0  text-white">Sistem Informasi Parkir - SiParkir</h3>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($datas as $item)
            <div class="col-xl-4 col-lg-6 col-md-12 col-12 mt-6">
            <!-- card -->
                <div class="card ">
                    <!-- card body -->
                    <div class="card-body">
                    <!-- heading -->
                        <div class="d-flex justify-content-between align-items-center
                            mb-3">
                            <div>
                            <h4 class="mb-0">{{$item['namaLahanParkir']}}</h4>
                            </div>
                            <div class="icon-shape icon-md bg-light-primary text-primary
                            rounded-2">
                            <i class="bi bi-briefcase fs-4"></i>
                            </div>
                        </div>
                        <!-- project number -->
                        <div>
                            <h1 class="fw-bold">{{$item['totalDayaTampung']}}</h1>
                            <p class="mb-0"><span class="text-dark me-2">2</span>Kosong</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <br>
    <div class="col-md-12 mb-5 mb-lg-0">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Data Lahan Parkir</h4>
            </div>
            <div class="card-body pb-0">
                <canvas id="canvas-untuk-menggambar-grafik"></div>
            </div>
        </div>
    </div>

    
<script>
    function buatDataUntukGrafik(dataLahanParkir) {
        var label = dataLahanParkir.data.map(function (satuanData) {
            return satuanData.namaLahanParkir;
        });

        var totalDayaTampungParkir = dataLahanParkir.data.map(function (satuanData) {
            return satuanData.totalDayaTampung;
        });

        var sisaTotalDayaTampung = dataLahanParkir.data.map(function (satuanData) {
            return satuanData.sisaTotalDayaTampung;
        });

        var dataUntukGrafik = {
            labels: label,
            datasets: [{
                    label: "Total Daya Tampung",
                    backgroundColor: "rgb(153, 102, 255)",
                    data: totalDayaTampungParkir
                },
                {
                    label: "Sisa Total Daya Tampung",
                    backgroundColor: "rgb(255, 64, 64)",
                    data: sisaTotalDayaTampung
                }
            ]
        };

        return dataUntukGrafik;
    }


    function buatGrafik(dataLahanParkir) {
        var elemenCanvas = document.getElementById("canvas-untuk-menggambar-grafik");
        var penggambarCanvas = elemenCanvas.getContext("2d");

        var judulGrafik = "Data Lahan Parkir";
        var dataUntukGrafik = buatDataUntukGrafik(dataLahanParkir);

        var konfigurasiChartJS = {
            type: 'bar',
            data: dataUntukGrafik,
            options: {
            responsive: true,
            title: {
                display: true,
                text: judulGrafik
            },
            scales: {
                yAxes: [{
                    type: 'linear',
                    display: true,
                    position: 'left',
                    ticks: {
                        min: 0
                    },
                    id: 'sumbu-y-kiri'
                }, {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    ticks: {
                    min: 0
                    },
                    id: 'sumbu-y-kanan'
                }]
            }
            }
        }

        var grafik = new Chart(penggambarCanvas, konfigurasiChartJS);
    }

    window.onload = function() {
            
        var urlDataLahanParkir = "https://rose-caterpillar-sari.cyclic.app/api/lahan-parkir"; //awalnya DataPenduduk
        
        var dataLahanParkir;

        var requestDataLahanParkir = new XMLHttpRequest();
        requestDataLahanParkir.open("GET", urlDataLahanParkir, true);
        requestDataLahanParkir.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {
                dataLahanParkir = JSON.parse(this.responseText);
                buatGrafik(dataLahanParkir)
            } 
        };
        requestDataLahanParkir.send();
    }

</script>

@endsection