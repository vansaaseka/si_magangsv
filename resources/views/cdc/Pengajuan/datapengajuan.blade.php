@extends('cdc.layouts.main')

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
                                            <label class="">Kelompok</label>
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
                                                data-target="#editModal{{ $data->id }}">Perbaikan
                                                Proposal</button>
                                        @elseif ($data->status === 'proses validasi')
                                            <button class="badge badge-warning border-0 text-dark">Proses Validasi
                                                Pimpinan
                                                SV</button>
                                        @elseif ($data->status === 'siap download')
                                            <button class="badge badge-success border-0 text-light">Siap Download</button>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm edit-btn" data-toggle="modal"
                                            data-target="#revisiModal{{ $data->id }}" data-id="{{ $data->id }}"><i
                                                class="fas fa-sm fa-edit "></i></button>
                                        <button class="btn btn-info btn-sm"><i
                                                class="fas fa-info-circle fa-sm"></i></button>
                                        <!-- Edit Modal -->
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
                                                                <label
                                                                    for="perbaikanProposal{{ $data->id }}">Perbaikan
                                                                    Proposal</label>
                                                            </div>
                                                            {{-- <div class="form-group form checkbox-wrapper">
                                                                <input type="radio" class="form-"
                                                                    id="prosesValidasi{{ $data->id }}" name="status[]"
                                                                    value="proses validasi">
                                                                <label for="prosesValidasi{{ $data->id }}">Proses
                                                                    Validasi Pimpinan SV</label>
                                                            </div> --}}
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
                                        {{-- <form action="{{ route('datapengajuan.delete', $data->id) }}" method="POST"
                                            style="display:inline;" id="deleteForm{{ $data->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                data-id="{{ $data->id }}"><i
                                                    class="fas fa-trash-alt fa-sm"></i></button>
                                        </form> --}}
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
