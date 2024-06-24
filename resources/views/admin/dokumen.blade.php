@extends('admin.layouts.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Data Penerimaan Magang</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Prodi</th>
                            <th>Instansi</th>
                            <th>Jawaban</th>
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($databukti->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center">Data kosong</td>
                            </tr>
                        @else
                            @php $no = 1; @endphp
                            @foreach ($databukti as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ optional($data->users)->name }}</td>
                                    <td>{{ optional(optional($data->users)->units)->nama_prodi }}</td>
                                    <td>{{ optional($data->instansis)->nama_instansi }}</td>
                                    <td>
                                        @if (optional($data->buktimagangs)->jawaban === 'diterima')
                                            <span class="badge badge-success">{{ $data->buktimagangs->jawaban }}</span>
                                        @elseif (optional($data->buktimagangs)->jawaban === 'ditolak')
                                            <span class="badge badge-danger">{{ $data->buktimagangs->jawaban }}</span>
                                        @else
                                            <span class="badge badge-warning">Belum ada jawaban</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ asset('storage/buktimagang/' . $data->nama_file) }}"
                                            class="btn btn-info btn-sm" target="_blank">Lihat File</a>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#detailModal{{ $data->id }}">
                                            <i class="fas fa-info-circle fa-sm"></i>
                                        </button>
                                        @if (optional($data->buktimagangs)->jawaban === 'diterima')
                                            <button type="button" class="btn btn-primary btn-sm edit-btn"
                                                data-toggle="modal" data-target="#UploadFileModal{{ $data->id }}"
                                                data-id="{{ $data->id }}"><i class="fas fa-sm fa-edit "></i></button>
                                        @else
                                        @endif
                                        <!-- Modal Detail -->
                                        <div class="modal fade" id="detailModal{{ $data->id }}" tabindex="-1"
                                            aria-labelledby="detailModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title fs-5" id="detailModalLabel">Detail Pengajuan
                                                        </h3>
                                                        <button type="button" class="btn btn-close" data-dismiss="modal"
                                                            aria-label="Close">x</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table id="table" style="width: 100% !important;">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Nama Mahasiswa</th>
                                                                    <td>:</td>
                                                                    <td>{{ $data->users->name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>NIM</th>
                                                                    <td>:</td>
                                                                    <td>{{ $data->users->nim }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Prodi</th>
                                                                    <td>:</td>
                                                                    <td>{{ $data->users->units->nama_prodi }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Judul Kegiatan</th>
                                                                    <td>:</td>
                                                                    <td>{{ $data->proposals->judul_proposal }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Pembimbing</th>
                                                                    <td>:</td>
                                                                    <td>{{ $data->dosen_pembimbing }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Bobot SKS</th>
                                                                    <td>:</td>
                                                                    <td>{{ $data->bobot_sks }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Instansi</th>
                                                                    <td>:</td>
                                                                    <td>{{ $data->instansis->nama_instansi }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Alamat Instansi</th>
                                                                    <td>:</td>
                                                                    <td>{{ $data->instansis->alamat_instansi }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Tanggal Mulai</th>
                                                                    <td>:</td>
                                                                    <td>{{ $data->tanggal_mulai }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Tanggal Selesai</th>
                                                                    <td>:</td>
                                                                    <td>{{ $data->tanggal_selesai }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                                                        <button type="button" class="btn btn-primary"
                                                            data-dismiss="modal">OK</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="UploadFileModal{{ $data->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Upload Surat</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form
                                                        action="{{ route('dokumenmagang.surattugas', ['id' => $data->id]) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <!-- Menentukan metode yang sebenarnya, yaitu PUT -->
                                                        <div class="form-group">
                                                            <label for="surat_tugas">Surat Tugas</label>
                                                            <input type="file" class="form-control" id="surat_tugas"
                                                                name="surat_tugas" accept=".pdf" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Upload</button>
                                                    </form>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
