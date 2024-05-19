@extends('cdc.layouts.main')

@section('content')
    <div class="conatiner-fluid content-inner mt-n6 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Daftar Mahasiswa</h4>
                        </div>

                        <button type="button" class="btn btn-success" data-toggle="modal"
                            data-target="#modalTambahMahasiswa">Tambah Mahasiswa</button>

                        {{-- Modal Tambah --}}
                        <div class="modal fade" id="modalTambahMahasiswa" tabindex="-1" role="dialog"
                            aria-labelledby="modalTambahMahasiswaLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTambahMahasiswaLabel">Tambah Data Mahasiswa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form Tambah Nama Mahasiswa -->
                                        <form id="formTambahMahasiswa" action="{{ route('datamahasiswa.store') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="namamahasiswa">Nama Mahasiswa</label>
                                                <input type="text" class="form-control" id="namamahasiswa"
                                                    name="namamahasiswa" placeholder="Masukkan Nama Mahasiswa">
                                            </div>
                                            <div class="form-group">
                                                <label for="prodimahasiswa">Prodi</label>
                                                <input type="text" class="form-control" id="prodimahasiswa"
                                                    name="prodimahasiswa" placeholder="Masukkan Prodi Mahasiswa">
                                            </div>
                                            <div class="form-group">
                                                <label for="nimmahasiswa">NIM</label>
                                                <input type="text" class="form-control" id="nimmahasiswa"
                                                    name="nimmahasiswa" placeholder="Masukkan NIM Mahasiswa">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mt-4">
                            <table id="basic-table" class="table table-striped mb-0" role="grid">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Prodi</th>
                                        <th>NIM</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp

                                    @foreach ($mergedData as $data)
                                        <tr role="row" class="odd">
                                            <th scope="row">{{ $no++ }}</th>
                                            <td>{{ $data->nama_mahasiswa ?? '' }}</td>
                                            <td>{{ $data->namaprodi ?? '' }}</td>
                                            <td>{{ $data->nim_mahasiswa ?? '' }}</td>
                                            <td>
                                                @if (isset($data->status))
                                                    @if ($data->status == 1)
                                                        <a href="{{ url('/ubahstatus/' . $data->id) }}"
                                                            class="btn btn-sm btn-success">Aktif</a>
                                                    @else
                                                        <a href="{{ url('/ubahstatus/' . $data->id) }}"
                                                            class="btn btn-sm btn-danger">Non-Aktif</a>
                                                    @endif
                                                @else
                                                    <span class="text-muted">Tidak ada status</span>
                                                @endif

                                            </td>
                                            <td class="text-center">
                                                <div
                                                    class="d-flex align-items-center justify-content-center list-user-action">
                                                    <!-- Button Edit -->
                                                    <button type="button" class="btn btn-sm btn-icon btn-primary mr-2"
                                                        data-toggle="modal"
                                                        data-target="#modaleditmahasiswa{{ $data->id }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>

                                                    {{-- Modal --}}
                                                    <div class="modal fade" id="modaleditmahasiswa{{ $data->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="modaleditmahasiswaLabel{{ $data->id }}"
                                                        aria-hidden="true" style="text-align: left">
                                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="modaleditmahasiswaLabel{{ $data->id }}">
                                                                        Edit Data Mahasiswa
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row d-flex justify-content-center">
                                                                        <div class="col-md-12">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <form
                                                                                        action="{{ route('datamahasiswa.update', $data->id) }}"
                                                                                        method="POST"
                                                                                        enctype="multipart/form-data">
                                                                                        @csrf
                                                                                        <div class="form-group">
                                                                                            <label for="namamahasiswa">Nama
                                                                                                Mahasiswa</label>
                                                                                            <input type="text"
                                                                                                name="namamahasiswa"
                                                                                                class="form-control"
                                                                                                id="daftarmahasiswa"
                                                                                                placeholder="Nama Mahasiswa"
                                                                                                value="{{ $data->nama_mahasiswa }}">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="prodimahasiswa">Prodi
                                                                                                Mahasiswa</label>
                                                                                            <select name="prodi_id"
                                                                                                class="selectpicker form-control"
                                                                                                data-style="py-0">
                                                                                                <option value="">
                                                                                                    --Pilih--</option>
                                                                                                @foreach ($prodi as $item)
                                                                                                    <option
                                                                                                        value="{{ $item->id }}"
                                                                                                        {{ old('prodi_id', $data->prodi_id) == $item->id ? 'selected' : '' }}>
                                                                                                        {{ $item->namaprodi }}
                                                                                                    </option>
                                                                                                @endforeach

                                                                                                @error('prodi_id')
                                                                                                    <div
                                                                                                        class="invalid-feedback">
                                                                                                        {{ $message }}
                                                                                                    </div>
                                                                                                @enderror
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="nimmahasiswa">NIM</label>
                                                                                            <input type="text"
                                                                                                name="nimmahasiswa"
                                                                                                class="form-control"
                                                                                                id="daftarmahasiswa"
                                                                                                placeholder="NIM Mahasiswa"
                                                                                                value="{{ $data->nim_mahasiswa }}">
                                                                                        </div>
                                                                                        <button type="submit"
                                                                                            class="btn btn-primary next action-button float-end">Submit</button>
                                                                                    </form>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Button Delete -->
                                                    <form id="deleteForm{{ $data->id }}"
                                                        action="{{ route('datamahasiswa.delete', $data->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-icon btn-danger delete"
                                                            data-nama="{{ $data->nama }}"
                                                            data-prodi="{{ $data->prodi }}"
                                                            data-nim="{{ $data->nim }}"
                                                            data-id="{{ $data->id }}"> <!-- Add data-id attribute -->
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            $('.delete').click(function(e) {
                e.preventDefault(); // Prevent default form submission

                var namaMahasiswa = $(this).data('nama');

                // Use SweetAlert for confirmation
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda akan menghapus Mahasiswa " + namaMahasiswa + "?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var mahasiswaId = $(this).data('id');
                        $('#deleteForm' + mahasiswaId).submit();
                    } else {
                        Swal.fire(
                            'Dibatalkan',
                            'Penghapusan dibatalkan',
                            'info'
                        );
                    }
                });
            });
        });
    </script>
@endsection
