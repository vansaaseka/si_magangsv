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
                            {{-- <th>Tahun Ajaran</th> --}}
                            <th>Nama Mahasiswa</th>
                            <th>Prodi</th>
                            <th>NIM</th>
                            <th>Jenis Kegiatan</th>
                            <th>Nama Instansi</th>
                            <th>Proposal</th>
                            <th>Status Ajuan</th>
                            <th>Nilai</th>
                            <th>Laporan Akhir</th>
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
                                    {{-- <td>
                                        @if ($data->tahun_ajaran_semester_id === 1)
                                            <label>Ganjil</label>
                                        @elseif ($data->tahun_ajaran_semester_id === 2)
                                            <label>Genap</label>
                                        @endif
                                    </td> --}}
                                    <td>{{ $data->users->name }}</td>
                                    <td>{{ $data->users->units->nama_prodi }}</td>
                                    <td>{{ $data->users->nim }}</td>
                                    <td>
                                        @if ($data->jenis_kegiatan === 'individu')
                                            <label>Individu</label>
                                        @elseif ($data->jenis_kegiatan === 'kelompok')
                                            <button class="badge badge-primary border-0" data-id="{{ $data->id }}"
                                                data-toggle="modal"
                                                data-target="#modalKelompok{{ $data->id }}">Kelompok</button>
                                        @endif
                                    </td>
                                    <td>{{ $data->instansis->nama_instansi }}</td>
                                    <td>
                                        <a href="{{ 'storage/proposal/' . $data->proposals->nama_file }}"
                                            class="badge badge-info border-0" target="_blank">Proposal</a>
                                    </td>
                                    <td>
                                        @if ($data->status === 'ajuan diterima')
                                            <button class="badge badge-primary border-0" data-toggle="modal"
                                                data-id="{{ $data->id }}"
                                                data-target="#ModalAjuanDiterima{{ $data->id }}">Ajuan Diterima</button>
                                        @elseif ($data->status === 'perbaikan proposal')
                                            <span class="badge badge-warning">Perbaikan Proposal</span>
                                        @elseif ($data->status === 'proses validasi')
                                            @if ($data->verified === 'approve' && $data->surat_pengantar !== null)
                                                <button class="badge badge-warning border-0 text-dark" data-toggle="modal"
                                                    data-id="{{ $data->id }}"
                                                    data-target="#modalUnduh{{ $data->id }}">Proses Validasi Pimpinan
                                                    SV</button>
                                            @else
                                                <span class="badge badge-warning text-dark">Proses Validasi Pimpinan
                                                    SV</span>
                                            @endif
                                        @elseif ($data->status === 'siap download')
                                            <span class="badge badge-success text-light">Siap Download</span>
                                        @elseif ($data->status === 'selesai magang')
                                            <span class="badge badge-primary text-light">Magang Selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (empty($data->file_nilai))
                                            <p data-toggle="modal" data-id="{{ $data->id }}"
                                                data-target="#nilaiMagang{{ $data->id }}">-</p>
                                        @else
                                            <a href="{{ 'storage/' . $data->file_nilai }}"
                                                class="badge badge-secondary border-0" target="_blank">Lihat</a>
                                        @endif
                                    </td>
                                    {{-- Modal Nilai Magang --}}
                                    <div class="modal fade" id="nilaiMagang{{ $data->id }}">
                                        <div class="modal-dialog">
                                            <form action="{{ route('updateNilai', $data->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Nilai Magang</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group"></div>
                                                        <label for="file_nilai">Nilai</label>
                                                        <input type="file" name="file_nilai" class="form-control"
                                                            id="file_nilai">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit"
                                                            class="badge badge-info text-light border-0">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
            </div>
            <td>
                @if (empty($data->laporan_akhir))
                    <p data-toggle="modal" data-id="{{ $data->id }}" data-target="#laporanAkhir{{ $data->id }}">-
                    </p>
                @else
                    <a href="{{ 'storage/laporanakhir/' . $data->laporan_akhir }}" class="badge badge-secondary border-0"
                        target="_blank">Lihat</a>
                @endif
            </td>
            {{-- Modal Laporan Akhir --}}
            <div class="modal fade" id="laporanAkhir{{ $data->id }}">
                <div class="modal-dialog">
                    <form action="{{ route('updateLaporanAkhir', $data->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Laporan Akhir</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group"></div>
                                <label for="laporan_akhir">Laporan Akhir</label>
                                <input type="file" name="laporan_akhir" class="form-control" id="laporan_akhir">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="badge badge-info text-light border-0">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <td>
                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#detailModal{{ $data->id }}"><i
                        class="fas fa-info-circle fa-sm"></i></button>

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
                                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('datapengajuan.approve', $data->id) }}" class="d-inline" method="POST"
                    id="approveForm{{ $data->id }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="verified" value="approve final">
                    @if ($data->verified == 'approve final')
                        <button class="btn btn-success  btn-sm edit-btn"><i
                                class="fas fa-sm fa-check-circle"></i></button>
                    @else
                        <button type="button" class="btn btn-info approve-btn btn-sm edit-btn"
                            data-id="{{ $data->id }}"><i class="fas fa-sm fa-check-circle"></i></button>
                    @endif
                </form>
                @if ($data->verified == 'approve final')
                    <button type="button" class="btn btn-primary btn-sm edit-btn" data-toggle="modal"
                        data-target="#ModalSelesaiMagang{{ $data->id }}" data-id="{{ $data->id }}"><i
                            class="fas fa-sm fa-edit"></i></button>
                @endif
                <!-- Edit Modal -->
                <div class="modal fade" id="ModalSelesaiMagang{{ $data->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Modal Status</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editForm" action="{{ route('datapengajuan.update', ['id' => $data->id]) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group form checkbox-wrapper">
                                        <input type="radio" class="form-" id="prosesValidasi{{ $data->id }}"
                                            name="status[]" value="selesai magang">
                                        <label for="prosesValidasi{{ $data->id }}">Selesai Magang</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm float-end">Submit</button>
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

    <script>
        $('.approve-btn').on('click', function() {
            var id = $(this).data('id');
            console.log('Approve button clicked');
            Swal.fire({
                title: 'Anda yakin?',
                text: "Menyetujui Ajuan Magang ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#9ADE7B',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, saya setuju!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#approveForm' + id).submit();
                }
            });
        });
    </script>
@endsection
