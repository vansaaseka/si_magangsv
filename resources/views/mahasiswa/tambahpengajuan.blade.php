@extends('mahasiswa.layouts.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">FORM AJUAN SURAT PENGANTAR</h4>
            <p class="card-description">
                Kegiatan Magang Mahasiswa (KMM) SV UNS
            </p>

            <form action="ajuan" enctype="multipart/form-data" method="post">

                @csrf
                <fieldset id="fieldset1">
                    <a href="https://docs.google.com/document/d/17BEthx2fzHfV0qSTNKzzaCbnYzbbKjxZ" target="_blank"
                    class= "mb-5 mt-3 btn btn-primary action-button float-end" type="button">Template Proposal KMM</a>
                    <input type="hidden" name="jenis_ajuan" value="jenis_baru">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Lengkap*</label>
                                <input class="form-control" placeholder="Nama Ketua Kelompok/Individu" name="user_id"
                                    value="{{ auth()->user()->name }}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tahun Ajaran Semester*</label>
                                <select class="form-control" name="tahun_ajaran_semester_id">
                                    <option value="1">Ganjil</option>
                                    <option value="2">Genap</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Kegiatan KMM*</label>
                                <select class="form-control" name="jenis_kegiatan" id="jenis_kegiatan">
                                    <option value="individu">Individu</option>
                                    <option value="kelompok">Kelompok</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bobot SKS*</label>
                                <select class="form-control" name="bobot_sks">
                                    <option value="2">2</option>
                                    <option value="4">4</option>
                                    <option value="6">6</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Dosen Pembimbing*</label>
                                <input class="form-control" placeholder="Nama Dosen Pembimbing" name="dosen_pembimbing" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Angkatan*</label>
                                <input class="form-control" placeholder="2022" name="angkatan" />
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Mulai Magang*</label>
                                <input type="date" class="form-control" placeholder="dd/mm/yyyy" name="tanggal_mulai" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Selesai Magang*</label>
                                <input type="date" class="form-control" placeholder="dd/mm/yyyy"
                                    name="tanggal_selesai" />
                            </div>
                        </div>
                    </div>
                    <!-- Bagian untuk Anggota -->
                    <div id="anggota_section" style="display: none;">
                        <!-- Bagian untuk Anggota 1 -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama (Anggota 1)</label>
                                    <input type="text" class="form-control" placeholder="Nama Anggota" name="nama[]" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NIM (Anggota 1)</label>
                                    <input type="text" class="form-control" placeholder="NIM Anggota" name="nim[]" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Bagian untuk menambah anggota -->
                    <div id="tambah_anggota_section" style="display: none; margin-bottom: 10px;">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-success" id="tambah_anggota">Tambah Anggota</button>
                            </div>
                        </div>
                    </div>
                    <!-- Bagian untuk Dosen Pembimbing -->
                    <!-- Anda bisa menambahkan lebih banyak bagian untuk anggota dengan cara yang serupa -->
                    <button type="button" class="next btn btn-info">Lanjut</button>
                </fieldset>
                <!-- Fieldset Kedua untuk Bagian Lainnya -->
                <fieldset id="fieldset2" style="display: none;">
                    <p class="card-description">
                        Kategori Instansi*<br>
                        Berikut beberapa contoh pengkategorisasian Instansi Lokasi KMM<br>
                        -Perusahaan Multinasional/Internasional<br>
                        -Perusahaan Nasional<br>
                        -Perusahaan Lokal (PT Lokal, CV, Agensi, Startup, dll)<br>
                        -Instansi Pemerintahan (OPD, Kementrian, dll)<br>
                        -BUMN (Bank, Pegadaian, PLN, dll)<br>
                        -BUMD (RSUD, BPR Daerah, dll)<br>
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama Instansi*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama_instansi" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kategori Instansi*</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="kategori_instansi_id">
                                        <option value="1">Perusahaan Multinasional/Internasional</option>
                                        <option value="2">Perusahaan Nasional</option>
                                        <option value="3">Perusahaan Lokal (PT Lokal, CV, Agensi, Startup, dll)</option>
                                        <option value="4">Instansi Pemerintahan (OPD, Kementrian, dll)</option>
                                        <option value="5">BUMN (Bank, Pegadaian, PLN, dll)</option>
                                        <option value="6">BUMD (RSUD, BPR Daerah, dll)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nomor Telpon Instansi*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="no_telpon" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-form-label">Alamat Surat Pengantar*</label>
                                <p class="card-description">
                                    Contoh : Yth.Kepala Dinas Pertanahan Kota Surakarta atau CEO Gojek Indonesia.
                                </p>
                                <input type="text" class="form-control" name="alamat_surat" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class=" col-form-label">Alamat Instansi*</label>
                                <p class="card-description">
                                    Contoh : <br>
                                    Jalan Raya Songgo Langit 20, <br>
                                    Gentan, Baki, Sukoharjo <br>
                                    Jawa Tengah 57194
                                </p>
                                <textarea name="alamat_instansi" class="w-100 form-control" style="height: 150px !important"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-form-label">Judul Proposal KMM*</label>
                                <p class="card-description">
                                    Contoh : Perbedaan Tingkat Stres Kerja Pegawai PT Adem Ayem Indonesia.<br>
                                    JANGAN KAPITAL SEMUA
                                </p>
                                <input type="text" class="form-control" name="judul_proposal" />
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding: 15px">
                        <div class="form-group">
                            <label class="col-form-label">Upload Proposal KMM*</label>
                            <p class="card-description">
                                Silahkan upload proposal yang sudah disetujui Pembimbing Magang dan Kaprodi. Tanda tangan
                                Wakil Dekan 1 akan
                                dibubuhkan pada file yang di-upload ke form ini dan dikirimkan kembali ke mahasiswa bersama
                                Surat Pengantar. <br>
                                NAMA FILE NIM-NamaMhs-ProposalKMM.pdf. Format dapat diunduh disini.
                            </p>
                            <div class="input-group col-xs-12">
                                <input type="file" accept=".pdf" name="nama_file"
                                    class="form-control file-upload-info" placeholder="Upload File">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-light previous">Kembali</button>
                    <button type="submit" class="next btn btn-info">Submit</button>
                </fieldset>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fieldsets = document.querySelectorAll('fieldset');
            let currentFieldsetIndex = 0;

            const showFieldset = index => {
                fieldsets.forEach((fieldset, i) => {
                    if (i === index) {
                        fieldset.style.display = 'block';
                    } else {
                        fieldset.style.display = 'none';
                    }
                });
            };

            showFieldset(currentFieldsetIndex);

            document.querySelector('.next').addEventListener('click', function() {
                currentFieldsetIndex++;
                if (currentFieldsetIndex >= fieldsets.length) {
                    currentFieldsetIndex =
                        0; // Jika sudah di fieldset terakhir, kembali ke fieldset pertama
                }
                showFieldset(currentFieldsetIndex);
            });

            document.querySelector('.previous').addEventListener('click', function() {
                currentFieldsetIndex--;
                if (currentFieldsetIndex < 0) {
                    currentFieldsetIndex = fieldsets.length -
                        1; // Kembali ke fieldset terakhir jika di fieldset pertama
                }
                showFieldset(currentFieldsetIndex);
            });

            document.querySelector('#jenis_kegiatan').addEventListener('change', function() {
                const anggotaSection = document.getElementById('anggota_section');
                const tambahAnggotaSection = document.getElementById('tambah_anggota_section');
                if (this.value === 'individu') {
                    anggotaSection.style.display = 'none';
                    tambahAnggotaSection.style.display = 'none';
                } else {
                    anggotaSection.style.display = 'block';
                    tambahAnggotaSection.style.display = 'block';
                }
            });

            // Tombol untuk menambah anggota
            const tambahAnggotaButton = document.querySelector('#tambah_anggota');
            const anggotaSection = document.getElementById('anggota_section');
            tambahAnggotaButton.addEventListener('click', function() {
                if (anggotaSection.children.length < 4) {
                    const newAnggotaRow = document.createElement('div');
                    newAnggotaRow.classList.add('row');
                    newAnggotaRow.innerHTML = `
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama (Anggota ${anggotaSection.children.length + 1})</label>
                        <input type="text" class="form-control" placeholder="Nama Anggota" name="nama[]"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>NIM (Anggota ${anggotaSection.children.length + 1})</label>
                        <input type="text" class="form-control" placeholder="NIM Anggota" name="nim[]"/>
                    </div>
                </div>
            `;
                    anggotaSection.appendChild(newAnggotaRow);
                }
                if (anggotaSection.children.length >= 4) {
                    tambahAnggotaButton.style.display =
                        'none'; // Sembunyikan tombol setelah mencapai maksimal anggota
                }
            });

        });
    </script>
@endsection
