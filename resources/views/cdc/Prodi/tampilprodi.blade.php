@extends('cdc.layouts.main')

@section('content')
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Daftar Prodi</h4>
                        </div>

                        <button type="button" class="btn btn-success" data-toggle="modal"
                            data-target="#modalTambahProdi">Tambah Prodi</button>

                        {{-- Modal Tambah --}}
                        <div class="modal fade" id="modalTambahProdi" tabindex="-1" role="dialog"
                            aria-labelledby="modalTambahProdiLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTambahProdiLabel">Tambah Nama Prodi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form Tambah Nama Prodi -->
                                        <form id="formTambahProdi" action="{{ route('dataprodi.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="namaprodi">Nama Prodi</label>
                                                <input type="text" class="form-control" id="namaprodi" name="namaprodi"
                                                    placeholder="Masukkan Nama Prodi">
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
                                        <th>Nama Prodi</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp

                                    @foreach ($prodi as $data)
                                        <tr role="row" class="odd">
                                            <th scope="row">{{ $no++ }}</th>
                                            {{-- Diambil dari as $ -> nama di database --}}
                                            <td>
                                                <div class="d-flex align-items-center">{{ $data->nama_prodi }}</div>
                                            </td>
                                            <td class="text-center">
                                                <div
                                                    class="d-flex align-items-center justify-content-center list-user-action">
                                                    <!-- Button Edit -->
                                                    <button type="button" class="btn btn-sm btn-icon btn-primary mr-2"
                                                        data-toggle="modal"
                                                        data-target="#modaleditprodi{{ $data->id }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>

                                                    {{-- Modal --}}
                                                    <div class="modal fade" id="modaleditprodi{{ $data->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="modaleditprodiLabel{{ $data->id }}"
                                                        aria-hidden="true" style="text-align: left">
                                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="modaleditprodiLabel{{ $data->id }}">
                                                                        Edit Data Prodi
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
                                                                                        action="{{ route('dataprodi.update', $data->id) }}"
                                                                                        method="POST"
                                                                                        enctype="multipart/form-data">
                                                                                        @csrf
                                                                                        <div class="form-group">
                                                                                            <label for="namaprodi">Nama
                                                                                                Prodi</label>
                                                                                            <input type="text"
                                                                                                name="namaprodi"
                                                                                                class="form-control"
                                                                                                id="daftarprodi"
                                                                                                placeholder="Nama Prodi"
                                                                                                value="{{ $data->nama_prodi }}">
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
                                                    <!-- Button Delete -->
                                                    <form id="deleteForm{{ $data->id }}"
                                                        action="{{ route('dataprodi.delete', $data->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-icon btn-danger delete"
                                                            data-nama="{{ $data->nama }}"
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

                var namaProdi = $(this).data('nama');

                // Use SweetAlert for confirmation
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda akan menghapus Prodi " + namaProdi + "?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var prodiId = $(this).data('id');
                        $('#deleteForm' + prodiId).submit();
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
