@extends('cdc.layouts.main')

@section('content')
    <div class="row mb-4">
        <div class="col-md-6" style="margin-bottom: 10px">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Grafik Per-Jenis Magang</h4>
                    <canvas id="jenisKegiatanChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-6 mb-4">
                    <div class="card card-tale">
                        <div class="card-body">
                            <p class="mb-4">Program Studi</p>
                            <p class="fs-30 mb-2">{{ $totalProgramStudi }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4">
                    <div class="card card-dark-blue">
                        <div class="card-body">
                            <p class="mb-4">Instansi</p>
                            <p class="fs-30 mb-2">{{ $totalInstansi }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4">
                    <div class="card card-light-blue">
                        <div class="card-body">
                            <p class="mb-4">Total Pengajuan</p>
                            <p class="fs-30 mb-2">{{ $totalPengajuan }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4">
                    <div class="card card-light-danger">
                        <div class="card-body">
                            <p class="mb-4">Jenis Kegiatan</p>
                            <p class="fs-30 mb-2">{{ $jenisKegiatan['kelompok'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6" style="margin-bottom: 20px">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Kategori Instansi</h4>
                    <canvas id="kategoriInstansiChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Data grafik (contoh)
            var jenisKegiatanData = {!! json_encode($jenisKegiatan) !!};

            // Labels dan data untuk chart
            var labels = Object.keys(jenisKegiatanData);
            var data = Object.values(jenisKegiatanData);

            // Pengaturan opsi grafik
            var options = {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            };

            // Inisialisasi grafik menggunakan Chart.js
            var ctx = document.getElementById('jenisKegiatanChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah',
                        data: data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',    // Merah untuk Program Studi
                            'rgba(54, 162, 235, 0.2)',    // Biru untuk Instansi
                            'rgba(255, 206, 86, 0.2)',    // Kuning untuk Total Pengajuan
                            'rgba(75, 192, 192, 0.2)',    // Cyan (biru muda) untuk Jenis Kegiatan (Individu)
                            'rgba(153, 102, 255, 0.2)'   // Ungu untuk Jenis Kegiatan (Kelompok)
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: options
            });
        });

        $(document).ready(function() {
            // Data untuk doughnut chart
            var doughnutData = {
                labels: ['Label 1', 'Label 2', 'Label 3'],
                datasets: [{
                    data: [300, 50, 100],
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                    hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                }]
            };

            // Options untuk doughnut chart
            var doughnutOptions = {
                responsive: true
            };

            // Inisialisasi doughnut chart menggunakan Chart.js
            var ctxDoughnut = document.getElementById('doughnutChart').getContext('2d');
            var doughnutChart = new Chart(ctxDoughnut, {
                type: 'doughnut',
                data: doughnutData,
                options: doughnutOptions
            });

            // Data untuk bar chart (contoh)
            var barData = {
                labels: ['Label A', 'Label B', 'Label C'],
                datasets: [{
                    label: 'Data',
                    data: [10, 20, 30],
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                    borderColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                    borderWidth: 1
                }]
            };

            // Options untuk bar chart
            var barOptions = {
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            };

            // Inisialisasi bar chart menggunakan Chart.js
            var ctxBar = document.getElementById('barChart').getContext('2d');
            var barChart = new Chart(ctxBar, {
                type: 'bar',
                data: barData,
                options: barOptions
            });
        });
    </script>
@endsection
