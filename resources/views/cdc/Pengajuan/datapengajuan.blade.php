@extends('cdc.layouts.main')

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
                            <th>Instansi</th>
                            <th>Proposal</th>
                            <th>Status Ajuan</th>
                            <th>Nilai Akhir</th>
                            <th>Laporan Akhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($dataajuan->isEmpty())
                            <tr>
                                <td colspan="9" class="text-center">Data kosong</td>
                            </tr>
                        @else
                            @php $no = 1; @endphp
                            @foreach ($dataajuan as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        @if ($data->semester === 'ganjil')
                                            <label>Ganjil/{{ $data->tahun }}</label>
                                        @elseif ($data->semester === 'genap')
                                            <label>Genap/{{ $data->tahun }}</label>
                                        @endif
                                    </td>
                                    <td>{{ $data->users->name }}</td>
                                    <td>{{ $data->users->units->nama_prodi }}</td>
                                    <td>{{ $data->users->nim }}</td>
                                    <td>
                                        @if ($data->jenis_kegiatan === 'individu')
                                            <label class="">Individu</label>
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
                                            <button class="badge badge-danger border-0 text-white bg-danger"
                                                data-toggle="modal" data-id="{{ $data->id }}"
                                                data-target="#editModal{{ $data->id }}">Perbaikan Proposal</button>
                                        @elseif ($data->status === 'proses validasi')
                                            <button class="badge badge-warning border-0 text-dark">Proses Validasi Pimpinan
                                                SV</button>
                                        @elseif ($data->status === 'siap download')
                                            <button class="badge badge-success border-0 text-light">Siap Download</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if (empty($data->file_nilai))
                                            <p>-</p>
                                        @else
                                        <a href="{{ 'storage/nilaimagang/' . $data->file_nilai }}"
                                            class="badge badge-secondary border-0" target="_blank">Lihat</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if (empty($data->file_nilai))
                                            <p>-</p>
                                        @else
                                        <a href="{{ 'storage/laporanakhir/' . $data->laporan_akhir }}"
                                            class="badge badge-secondary border-0" target="_blank">Lihat</a>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm edit-btn" data-toggle="modal"
                                            data-target="#revisiModal{{ $data->id }}" data-id="{{ $data->id }}"><i
                                                class="fas fa-sm fa-edit "></i></button>
                                        <button class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#detailModal{{ $data->id }}"><i
                                                class="fas fa-info-circle fa-sm"></i></button>
                                        <div class="modal fade" id="ModalAjuanDiterima{{ $data->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Modal Status</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="editForm"
                                                            action="{{ route('datapengajuan.update', ['id' => $data->id]) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group form checkbox-wrapper">
                                                                <input type="radio" class="form-"
                                                                    id="prosesValidasi{{ $data->id }}" name="status[]"
                                                                    value="proses validasi">
                                                                <label for="prosesValidasi{{ $data->id }}">Proses
                                                                    Validasi Pimpinan SV</label>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Komentar Status</label>
                                                                <input type="text" class="form-control"
                                                                    name="komentar_status" required>
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm float-end">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- REVISI PROPOSAL --}}
                                        <div class="modal fade" id="revisiModal{{ $data->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Modal Perbaikan
                                                            Proposal
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="editForm"
                                                            action="{{ route('datapengajuan.update', ['id' => $data->id]) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group form checkbox-wrapper">
                                                                <input type="radio" class="form-"
                                                                    id="perbaikanProposal{{ $data->id }}"
                                                                    name="status[]" value="perbaikan proposal">
                                                                <label for="perbaikanProposal{{ $data->id }}">Perbaikan
                                                                    Proposal</label>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Komentar Status</label>
                                                                <input type="text" class="form-control"
                                                                    name="komentar_status" required>
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm float-end">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Modal Edit --}}
                                        <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Modal Status</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="editForm"
                                                            action="{{ route('datapengajuan.update', ['id' => $data->id]) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group form checkbox-wrapper">
                                                                <input type="radio" class="form-"
                                                                    id="prosesValidasi{{ $data->id }}"
                                                                    name="status[]" value="proses validasi">
                                                                <label for="prosesValidasi{{ $data->id }}">Proses
                                                                    Validasi Pimpinan SV</label>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Komentar Status</label>
                                                                <input type="text" class="form-control"
                                                                    name="komentar_status" required>
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm float-end">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Detail -->
                                        <div class="modal fade" id="detailModal{{ $data->id }}" tabindex="-1"
                                            aria-labelledby="detailModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title fs-5" id="detailModalLabel">Detail
                                                            Pengajuan
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
                                                        <button type="button" class="btn btn-primary"
                                                            data-dismiss="modal">OK</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Kelompok -->
                                        <div class="modal fade" id="modalKelompok{{ $data->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modalKelompokLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalKelompokLabel">Daftar Kelompok
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @php
                                                            $proditerlibatIds = json_decode($data->anggota_id, true);
                                                        @endphp

                                                        @if (!empty($proditerlibatIds))
                                                            @foreach ($proditerlibatIds as $index => $prodiItem)
                                                                @php
                                                                    $prodiId = $prodiItem['id'];
                                                                    $prodi = App\Models\Anggota::find($prodiId);
                                                                @endphp
                                                                @if ($prodi)
                                                                    <p class="m-0 font-weight-bold">{{ $index + 1 }}.
                                                                        {{ $prodi->nama }}</p>
                                                                    <p class="m-0">NIM :{{ $prodi->nim }}</p>
                                                                    @if (!$loop->last)
                                                                        <br>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <p>Data anggota tidak ditemukan.</p>
                                                        @endif
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
    <script>
        $(document).ready(function() {
            // Add event listener for opening the modal
            $('.edit-btn').on('click', function() {
                var id = $(this).data('id');
                // Make an AJAX request to get the data
                $.ajax({
                    url: '/dataajuan/' + id + '/edit',
                    method: 'GET',
                    success: function(data) {
                        $('#editModal' + id).find('.modal-body').html(data);
                    }
                });
            });
        });
    </script>
@endpush
