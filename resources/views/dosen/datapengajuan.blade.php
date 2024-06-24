@extends('dosen.layouts.main')

@push('style')
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Data Pengajuan</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun Ajaran</th>
                            <th>Nama Mahasiswa</th>
                            <th>Prodi</th>
                            <th>NIM</th>
                            <th>Jenis Kegiatan</th>
                            <th>Nama Instansi</th>
                            <th>Proposal</th>
                            <th>Status Ajuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($dataajuan->isEmpty())
                            <tr>
                                <td colspan="10" class="text-center">Data kosong</td>
                            </tr>
                        @else
                            @php $no = 1; @endphp
                            @foreach ($dataajuan as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        @if ($data->tahun_ajaran_semester_id === 1)
                                            <label>Ganjil</label>
                                        @elseif ($data->tahun_ajaran_semester_id === 2)
                                            <label>Genap</label>
                                        @endif
                                    </td>
                                    <td>{{ $data->user->name }}</td>
                                    <td>{{ $data->user->units->nama_prodi }}</td>
                                    <td>{{ $data->user->nim }}</td>
                                    <td>
                                        @if ($data->jenis_kegiatan === 'individu')
                                            <label>Individu</label>
                                        @elseif ($data->jenis_kegiatan === 'kelompok')
                                            <button class="badge badge-primary border-0" data-id="{{ $data->id }}" data-toggle="modal" data-target="#modalKelompok{{ $data->id }}">Kelompok</button>
                                        @endif
                                    </td>
                                    <td>{{ $data->instansi->nama_instansi }}</td>
                                    <td>
                                        <a href="{{ 'storage/proposal/' . $data->proposal->nama_file }}" class="badge badge-info border-0" target="_blank">Proposal</a>
                                    </td>
                                    <td>
                                        @if ($data->status === 'ajuan diterima')
                                            <button class="badge badge-primary border-0" data-toggle="modal" data-id="{{ $data->id }}" data-target="#ModalAjuanDiterima{{ $data->id }}">Ajuan Diterima</button>
                                        @elseif ($data->status === 'perbaikan proposal')
                                            <span class="badge badge-warning">Perbaikan Proposal</span>
                                        @elseif ($data->status === 'proses validasi')
                                            @if ($data->verified === 'approve' && $data->surat_pengantar !== null)
                                                <button class="badge badge-warning border-0 text-dark" data-toggle="modal" data-id="{{ $data->id }}" data-target="#modalUnduh{{ $data->id }}">Proses Validasi Pimpinan SV</button>
                                            @else
                                                <span class="badge badge-warning text-dark">Proses Validasi Pimpinan SV</span>
                                            @endif
                                        @elseif ($data->status === 'siap download')
                                            <span class="badge badge-success text-light">Siap Download</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#detailModal{{ $data->id }}"><i class="fas fa-info-circle fa-sm"></i></button>
                                        <!-- Modal Detail -->
                                        <div class="modal fade" id="detailModal{{ $data->id }}" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title fs-5" id="detailModalLabel">Detail Pengajuan</h3>
                                                        <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">x</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table id="table" style="width: 100% !important;">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Nama Mahasiswa</th>
                                                                    <td>:</td>
                                                                    <td>{{ $data->user->name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>NIM</th>
                                                                    <td>:</td>
                                                                    <td>{{ $data->user->nim }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Prodi</th>
                                                                    <td>:</td>
                                                                    <td>{{ $data->user->units->nama_prodi }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Judul Kegiatan</th>
                                                                    <td>:</td>
                                                                    <td>{{ $data->proposal->judul_proposal }}</td>
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
                                                                    <td>{{ $data->instansi->nama_instansi }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Alamat Instansi</th>
                                                                    <td>:</td>
                                                                    <td>{{ $data->instansi->alamat_instansi }}</td>
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
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{ route('datapengajuan.approve', $data->id) }}" class="d-inline" method="POST" id="approveForm{{ $data->id }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="verified" value="approve">
                                            @if ($data->verified == 'approve')
                                                <button class="btn btn-success btn-sm edit-btn"><i class="fas fa-sm fa-check-circle"></i></button>
                                            @else
                                                <button type="button" class="btn btn-info approve-btn btn-sm edit-btn" data-id="{{ $data->id }}"><i class="fas fa-sm fa-check-circle"></i></button>
                                            @endif
                                        </form>
                                        @if ($data->verified == 'approve')
                                            <button type="button" class="btn btn-primary btn-sm edit-btn" data-toggle="modal" data-target="#UploadFileModal{{ $data->id }}" data-id="{{ $data->id }}"><i class="fas fa-sm fa-edit"></i></button>
                                        @endif
                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="UploadFileModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Upload File</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('datapengajuan.store', ['id' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="surat_pengantar">Surat Pengantar</label>
                                                                <input type="file" class="form-control" id="surat_pengantar" name="surat_pengantar" accept=".pdf" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama_file">Proposal Mahasiswa</label>
                                                                <input type="file" class="form-control" id="nama_file" name="nama_file" accept=".pdf" required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Additional Scripts --}}
@endpush
