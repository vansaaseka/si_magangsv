@extends('admin.layouts.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Data Pengajuan</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
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
                                <td colspan="6" class="text-center">Data kosong</td>
                            </tr>
                        @else
                            @foreach ($dataajuan as $data)
                                <tr>
                                    <td>
                                        @if ($data->tahun_ajaran_semester_id === 1)
                                            <label>Ganjil</label>
                                        @elseif ($data->tahun_ajaran_semester_id === 2)
                                            <label>Genap</label>
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

                                        @elseif ($data->status === 'proses validasi')
                                            @if ($data->verified === 'approve' && $data->surat_pengantar !== null)
                                                <button class="badge badge-warning border-0 text-dark" data-toggle="modal"
                                                    data-id="{{ $data->id }}"
                                                    data-target="#modalUnduh{{ $data->id }}">Proses Validasi
                                                    Pimpinan
                                                    SV</button>
                                            @else
                                                <button class="badge badge-warning border-0 text-dark">Proses Validasi
                                                    Pimpinan
                                                    SV</button>
                                            @endif
                                        @elseif ($data->status === 'siap download')
                                            <button class="badge badge-success border-0 text-light">Siap Download</button>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('datapengajuan.approve', $data->id) }}" class="d-inline"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="verified" value="approve">
                                            <button class="btn btn-success btn-sm edit-btn"><i
                                                    class="fas fa-sm fa-check-circle "></i></button>
                                        </form>
                                        @if ($data->verified == 'approve')
                                            <button class="btn btn-primary btn-sm edit-btn" data-toggle="modal"
                                                data-target="#UploadFileModal{{ $data->id }}"
                                                data-id="{{ $data->id }}"><i class="fas fa-sm fa-edit "></i></button>
                                        @else
                                            <button class="btn btn-primary btn-sm edit-btn"><i
                                                    class="fas fa-sm fa-edit "></i></button>
                                        @endif
                                        {{-- <button class="btn btn-info btn-sm"><i
                                                class="fas fa-info-circle fa-sm"></i></button> --}}
                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="UploadFileModal{{ $data->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel"></h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="editForm"
                                                            action="{{ route('datapengajuan.store', ['id' => $data->id]) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="">Surat Pengantar</label>
                                                                <input type="file" class="form-control"
                                                                    name="surat_pengantar" accept=".pdf" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Proposal Mahasiswa</label>
                                                                <input type="file" class="form-control" accept=".pdf"
                                                                    name="nama_file" required>
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm float-end">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Unduh  -->
                                        <div class="modal fade" id="modalUnduh{{ $data->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modalUnduh" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalUnduh">Modal Siap Download</h5>
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
                                                                    id="siapDownload{{ $data->id }}" name="status[]"
                                                                    value="siap download">
                                                                <label for="siapDownload{{ $data->id }}">Siap
                                                                    Download</label>
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm float-end">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Kelompok -->
                                        <div class="modal fade" id="modalKelompok{{ $data->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Daftar Kelompok</h5>
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
                                                            @php
                                                                $jumlahId = count($proditerlibatIds);
                                                            @endphp

                                                            <!-- Tampilkan anggota kelompok -->
                                                            @foreach ($proditerlibatIds as $index => $prodiItem)
                                                                @php
                                                                    $prodiId = $prodiItem['id'];
                                                                    $prodi = App\Models\Anggota::find($prodiId);
                                                                @endphp
                                                                @if ($prodi)
                                                                    <p class="m-0 font-weight-bold"> {{ $index + 1 }}.
                                                                        {{ $prodi->nama }}</p>
                                                                    <p class="m-0">NIM :{{ $prodi->nim }}</p>
                                                                    @if (!$loop->last)
                                                                        <br>
                                                                    @endif
                                                                @endif
                                                            @endforeach
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
        document.addEventListener('DOMContentLoaded', function() {
            $('.edit-btn').on('click', function() {
                var id = $(this).data('id');
                // Make an AJAX request to get the data
                $.ajax({
                    url: '/dataajuan/' + id + '/edit',
                    method: 'GET',
                    success: function(data) {
                        $('#editForm').attr('action', '/dataajuan/update/' + id);
                        $('#tahun_ajaran_semester_id').val(data.tahun_ajaran_semester_id);
                        $('#nama_instansi').val(data.instansis.nama_instansi);
                        // Populate other fields as needed
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.delete-btn').on('click', function() {
                var id = $(this).data('id');

                // Tampilkan SweetAlert2 untuk konfirmasi penghapusan
                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus data!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika konfirmasi di-setujui, submit form untuk menghapus data
                        $('#deleteForm' + id).submit();
                    }
                });
            });
        });
    </script>
@endpush
