@extends('cdc.layouts.main')

@section('content')
    <div class="container-fluid content-inner mt-n6 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Data Penerimaan Magang</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="filterJawaban">Filter Berdasarkan Jawaban:</label>
                                <select class="form-control" id="filterJawaban">
                                    <option value="semua">Semua</option>
                                    <option value="diterima">Diterima</option>
                                    <option value="ditolak">Ditolak</option>
                                    <option value="belum">Belum ada jawaban</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive mt-4">
                            <table id="tableData" class="table table-striped mb-0" role="grid">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Prodi</th>
                                        <th>Instansi</th>
                                        <th>Jawaban</th>
                                        <th>File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($databukti->isEmpty())
                                        <tr>
                                            <td colspan="6" class="text-center">Data kosong</td>
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
                                                        <span
                                                            class="badge badge-success">{{ $data->buktimagangs->jawaban }}</span>
                                                    @elseif (optional($data->buktimagangs)->jawaban === 'ditolak')
                                                        <span
                                                            class="badge badge-danger">{{ $data->buktimagangs->jawaban }}</span>
                                                    @else
                                                        <span class="badge badge-warning">Belum ada jawaban</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ asset('storage/buktimagang/' . $data->nama_file) }}"
                                                        class="btn btn-info btn-sm" target="_blank">Lihat File</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tableData').DataTable({
                "pageLength": 10,
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ entri",
                    "search": "Cari:",
                    "paginate": {
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>rt<"bottom"p><"clear">',
                "initComplete": function() {
                    // Custom styling for better integration with Bootstrap
                    $('.dataTables_filter').addClass('float-right');
                    $('.dataTables_length').addClass('float-left');
                }
            });

            $('#filterJawaban').change(function() {
                var filter = $(this).val().toLowerCase();
                $('#tableData tbody tr').each(function() {
                    var jawaban = $(this).find('td:nth-child(5)').text().toLowerCase();
                    if (filter === 'semua' || jawaban === filter) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            $('#search').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#tableData tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
@endpush
