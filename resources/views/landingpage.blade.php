<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Magang</title>
    <link rel="stylesheet" href="{{ asset('assets/landingpage/libs/OwlCarousel-2/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landingpage/dist/css/iconfont/tabler-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landingpage/dist/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<style>

  </style>
<body>
    <!------------------------------>
    <!-- Header Start -->
    <!------------------------------>
    <header class="main-header">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"><img src="{{ asset('assets/landingpage/assets/images/LogoSV.png') }}" width="200px" alt=""></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://cdc.vokasi.uns.ac.id/career/">Career Development</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>


    <!------------------------------>
     <!-- Header End  -->
    <!------------------------------>

    <!------------------------------>
    <!--- Banner Start--------->
    <!------------------------------>
    <section   class="hero-banner position-relative overflow-hidden">
        <div class="container">
            <div class="row d-flex flex-wrap align-items-center">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="position-relative left-hero-color">
                        <h1 class="mb-0 fw-bold">
                            Magang
                        </h1>
                        <p>Fakultas Sekolah Vokasi Universitas Sebelas Maret</p>
                        <a href="{{ route('login') }}" class="btn btn-warning btn-lg">LOGIN</a>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="position-relative right-hero-color">
                        <img src="{{ asset('/assets/images/group.png') }}" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!------------------------------>
    <!--- Banner End--------->
    <!------------------------------>

    <!---------------------------------->
    <!--- Katentuan Magang section Start------>
    <!---------------------------------->
    <section id="magang" class="our-service position-relative overflow-hidden">
        <div class="container">
                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ps-xxl-0 ps-xl-0 ps-lg-3 ps-md-3 ps-sm-3 ps-3">
                    <h2 class="fs-2 text-black mb-0">Ketentuan Magang</h2><br>
                    <ul class="list-unstyled mb-0 pl-0">
                        <li class="d-flex flex-wrap align-items-start">
                            <i class="ti ti-circle-check fs-4 pe-2"></i>
                            <span class="fs-7 text-black">Kegiatan Magang Mahasiswa (KMM) diselenggarakan pada semester 6 (D3)/ semester 8 (D4) di lembaga resmi atau usaha yang memiliki badan hukum.</span>
                        </li>
                        <li class="d-flex flex-wrap align-items-start">
                            <i class="ti ti-circle-check fs-4 pe-2"></i>
                            <span class="fs-7 text-black">Dalam kegiatan KMM, mahasiswa harus selalu patuh pada peraturan yang diselenggarakan lokasi KMM yang bersangkutan.</span>
                        </li>
                        <li class="d-flex flex-wrap align-items-start">
                            <i class="ti ti-circle-check fs-4 pe-2"></i>
                            <span class="fs-7 text-black">KMM dapat dilakukan secara individu maupun kelompok.</span>
                        </li>
                        <li class="d-flex flex-wrap align-items-start">
                            <i class="ti ti-circle-check fs-4 pe-2"></i>
                            <span class="fs-7 text-black">Mahasiswa harus login menggunakan akun SSO agar dapat melakukan proses pengajuan magang.</span>
                        </li>
                        <li class="d-flex flex-wrap align-items-start">
                            <i class="ti ti-circle-check fs-4 pe-2"></i>
                            <span class="fs-7 text-black">Mahasiswa harus menyusun proposal ringkas tentang rencana KMM. Struktur dan format proposal dapat diunduh setelah melakukan login.</span>
                        </li>
                        <li class="d-flex flex-wrap align-items-start">
                            <i class="ti ti-circle-check fs-4 pe-2"></i>
                            <span class="fs-7 text-black">Setiap mahasiswa dibimbing oleh 1 dosen tetap UNS yang berkewajiban membimbing mahasiswa sejak penyusunan proposal, pelaksanaan, hingga penulisan laporan KMM.</span>
                        </li>
                        <li class="d-flex flex-wrap align-items-start">
                            <i class="ti ti-circle-check fs-4 pe-2"></i>
                            <span class="fs-7 text-black">Proposal mahasiswa harus mendapatkan persetujuan Dosen Pembimbing dan Kepala Program Studi.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!------------------------------>
    <!--- Ketentuan Magang section End---->
    <!------------------------------>

    <!------------------------------>
    <!-- Panduan section Start---->
    <!------------------------------>
    <section class="portfolio position-relative bg_portofolio">
        <div class="container position-relative">
            <div class="row">
                <div class="col-12 d-xxl-flex d-xl-flex d-lg-flex d-md-flex d-sm-block d-block align-items-center justify-content-xxl-between justify-content-xl-between justify-content-lg-between justify-content-md-between justify-content-sm-between justify-content-sm-center ">
                    <h2 class="fs-3 text-white mb-0">Download Panduan Magang</h2>
                    <a href="#" class="btn btn-warning btn-hover-secondery section-btn btn-lg">Download</a>
                </div>
                <div class="col-12"><small class="fs-7 d-block text-warning">Silahkan Download Ketentuan dan Panduan KMM</small></div>
            </div>
        </div>
    </section>
    <!------------------------------>
    <!-- Panduan section End ----->
    <!------------------------------>

    <!------------------------------>
    <!------ FAQ section Start------>
    <!------------------------------>
    <section class="faq position-relative overflow-hidden">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <small class="fs-7 d-block">Frequently Asked Questions</small>
                    <h2 class="fs-3 text-black mb-0">Pertanyaan Yang Sering Diajukan</h2>
                </div>
            </div>
            <div class="accordion-block">
                    <div class="accordion row" id="accordionPanelsStayOpenExample">
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                  <button class="accordion-button text-black fs-7" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    Apakah Saya Boleh Mengajukan Lebih Dari 1 Proposal Secara Bersamaan?
                                  </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                  <div class="accordion-body fs-7 fw-500 pt-0">
                                    Silahkan ajukan 1 proposal KMM terlebih dahulu hingga mendapat respon dari Instansi/ Perusahaan tujuan.
                                  </div>
                                </div>
                            </div>
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                  <button class="accordion-button collapsed text-black fs-7" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    Berapa Lama Proses Pengajuan Surat Pengantar KMM?
                                  </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                                  <div class="accordion-body fs-7 fw-500 pt-0">
                                    Pembuatan surat diperkirakan memakan waktu 3-5 hari kerja, dan DAPAT BERUBAH dipengaruhi jadwal pejabat penandatangan surat, dengan alur pemrosesan sebagai berikut:<br><br>
                                    1. Pengecekan Kelengkapan Ajuan<br>
                                    2. Review Proposal oleh Unit Pengelola KMM<br>
                                    3.Penandatanganan Surat<br><br>
                                    Maka dari itu, kami sarankan untuk memperhitungkan waktu pengajuan dengan sebaik-baiknya.
                                  </div>
                                </div>
                            </div>
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                  <button class="accordion-button collapsed text-black fs-7" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    Jika Status Pengajuan "PERBAIKAN", Apa Yang Harus Dilakukan?
                                  </button>
                                </h2>
                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                                  <div class="accordion-body fs-7 fw-500 pt-0">
                                    Silakan lakukan perbaikan sesuai catatan. Kemudian klik PENGAJUAN MAGANG dan isi form kembali, pilih PERBAIKAN pada bagian jenis ajuan.
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="panelsStayOpen-headingfour">
                                  <button class="accordion-button collapsed text-black fs-7" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapsefour" aria-expanded="false" aria-controls="panelsStayOpen-collapsefour">
                                    Bagaimana Jika Permohonan Ajuan KMM Ditolak Oleh Instansi/ Perusahaan Tujuan?
                                  </button>
                                </h2>
                                <div id="panelsStayOpen-collapsefour" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingfour">
                                  <div class="accordion-body fs-7 fw-500 pt-0">
                                    Silakan laporkan di bagian STATUS PENERIMAAN KMM. Selanjutnya Anda dapat mengajukan kembali sesuai prosedur sebelumnya.
                                  </div>
                                </div>
                            </div>
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="panelsStayOpen-headingfive">
                                  <button class="accordion-button collapsed text-black fs-7" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapsefive" aria-expanded="false" aria-controls="panelsStayOpen-collapsefive">
                                    Bagaimana Jika 1 Kelompok Terdiri Dari 5 Orang Atau Lebih? Apakah Hanya Membuat 1 Proposal?
                                  </button>
                                </h2>
                                <div id="panelsStayOpen-collapsefive" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingfour">
                                  <div class="accordion-body fs-7 fw-500 pt-0">
                                    Anda dapat membagi kelompok tersebut menjadi 2 dan melakukan 2 ajuan surat pengantar KMM
                                  </div>
                                </div>
                            </div>
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="panelsStayOpen-headingsix">
                                  <button class="accordion-button collapsed text-black fs-7" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapsesix" aria-expanded="false" aria-controls="panelsStayOpen-collapsesix">
                                    Bagaimana Jika Saya Salah Input Di Sistem?
                                  </button>
                                </h2>
                                <div id="panelsStayOpen-collapsesix" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingsix">
                                  <div class="accordion-body fs-7 fw-500 pt-0">
                                      Anda dapat menghapus ajuan didalam sistem dan mengisi ajuan kembali
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>
    <!------------------------------>
    <!------ FAQ section End------>
    <!------------------------------>

    <!------------------------------>
    <!-----Contact section Start---->
    <!------------------------------>
    <section class="contact position-relative overflow-hidden">
        <div class="container position-relative d-flex justify-content-center">
            <img src="{{ asset('/assets/images/Prosedur-Pengajuan-KMM-7.png') }}" class="w-100">
            <div class="row">
            </div>
        </div>
    </section>
    <!------------------------------>
    <!-----Contact section End----->
    <!------------------------------>

    <!------------------------------>
    <!-----Footer Start------------->
    <!------------------------------>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12">
                    <div class="footer-logo-col">
                        <a href="#"><img class="img_footer" src="{{ asset('/assets/images/logokuningSV.png') }}"></a><br><br>
                        <div class="callus text-white fw-500 fs-7">
                            Kampus Tirtomoyo, Universitas Sebelas Maret
                            <br><br>Jl. Kolonel Sutarto 150 K, Jebres, Surakarta – Indonesia
                            <div class="blue-light">Call us: <a href="tel://0271664126" class="text-warning fw-500 fs-7 text-decoration-none">0271-664126</a></div>
                            <div class="blue-light">Email: <a href="mailto:vokasi@unit.uns.ac.id" class="text-warning fw-500 fs-7 text-decoration-none">vokasi@unit.uns.ac.id</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-1 col-sm-12">
                    <h5 class="text-white">Layanan CDC SV UNS</h5>
                    <ul class="list-unstyled mb-0 pl-0">
                        <li><a href="https://cdc.vokasi.uns.ac.id/magang/" target="_blank">Pengajuan Magang</a></li>
                        <li><a href="https://vokasi.uns.ac.id/kerjasama" target="_blank">Mitra dan DUDIKA</a></li>
                        <li><a href="https://cdc.vokasi.uns.ac.id/" target="_blank">Lowongan Kerja Terbaru</a></li>
                        <li><a href="https://cdc.uns.ac.id/" target="_blank">Tracer Study UNS</a></li>
                        <li><a href="https://cdc.vokasi.uns.ac.id/alumni/" target="_blank">Alumni</a></li>
                    </ul>
                </div>
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-2 col-sm-12">
                    <h5 class="text-white">Tautan Penting</h5>
                    <ul class="list-unstyled mb-0 pl-0">
                        <li><a href="https://uns.ac.id/id/" target="_blank" >Universitas Sebelas Maret</a></li>
                        <li><a href="https://vokasi.uns.ac.id/" target="_blank">Sekolah Vokasi UNS</a></li>
                        <li><a href="https://hibahmbkm.integrasi.uns.ac.id/" target="_blank">Hibah MBKM Terintegrasi</a></li>
                        <li><a href="https://mawa.uns.ac.id/" target="_blank">Kemahasiswaan UNS</a></li>
                        <li><a href="https://cdc.uns.ac.id/" target="_blank">Career Development Center UNS</a></li>
                    </ul>
                </div>
                <div class="col-xxl-1 col-xl-1 col-lg-1 col-md-2 col-sm-12">
                    <h5 class="text-white">Subscribe</h5>
                        <ul class="list-unstyled social  d-flex">
                            <li class="me-4"><a href="https://www.instagram.com/vokasiuns/"><i class="bi bi-instagram"></i></a></li>
                            <li class="me-4"><a href="#"><i class="bi bi-twitter-x"></i></a></li>
                            <li class=""><a href="https://www.youtube.com/@sekolahvokasiuns6828"><i class="bi bi-youtube"></i></a></li>
                        </ul>
                </div>
            </div>
        </div>
    </footer>
    <!------------------------------>
    <!-------Footer End------------->
    <!------------------------------>


    <script src="{{ asset('assets/landingpage/dist/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/landingpage/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/landingpage/libs/OwlCarousel-2/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/landingpage/dist/js/custom.js') }}"></script>
</body>
</html>