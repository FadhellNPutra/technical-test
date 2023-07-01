@extends('master')

@section('home')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Pegawai</h4>
                    <button class="btn btn-primary float-right" data-toggle="modal" data-target="#tambahModal">Tambah Pegawai</button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="pegawaiTable">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                                <th>Jabatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pegawai as $pgw)
                            <tr>
                                <td>{{ $pgw->nama }}</td>
                                <td>{{ $pgw->tanggal_lahir }}</td>
                                <td>{{ $pgw->jabatan->nama }}</td>
                                <td>
                                    <button class="btn btn-info btn-edit" data-id="{{ $pgw->id }}" data-nama="{{ $pgw->nama }}" data-tanggal="{{ $pgw->tanggal_lahir }}" data-jabatan="{{ $pgw->jabatan_id }}">Edit</button>
                                    <button class="btn btn-danger btn-delete" data-id="{{ $pgw->id }}">Hapus</button>
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

<!-- Modal Tambah Pegawai -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formTambahPegawai">
                    <div class="form-group">
                        <label for="tambah-nama">Nama Pegawai</label>
                        <input type="text" class="form-control" id="tambah-nama" placeholder="Nama" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="tambah-tanggal">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tambah-tanggal" placeholder="Tanggal Lahir" name="tanggal_lahir">
                    </div>
                    <div class="form-group">
                        <label for="tambah-jabatan">Jabatan</label>
                        <select class="form-control" id="tambah-jabatan" name="jabatan">
                            <option value="">Pilih Jabatan</option>
                            @foreach ($jabatan as $jbtn)
                            <option value="{{ $jbtn->id }}">{{ $jbtn->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-submit" id="btnTambahPegawai">Tambah</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Pegawai -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditPegawai">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="form-group">
                        <label for="edit-nama">Nama Pegawai</label>
                        <input type="text" class="form-control" id="edit-nama" placeholder="Nama" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="edit-tanggal">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="edit-tanggal" placeholder="Tanggal Lahir" name="tanggal_lahir">
                    </div>
                    <div class="form-group">
                        <label for="edit-jabatan">Jabatan</label>
                        <select class="form-control" id="edit-jabatan" name="jabatan">
                            <option value="">Pilih Jabatan</option>
                            @foreach ($jabatan as $jbtn)
                            <option value="{{ $jbtn->id }}">{{ $jbtn->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-submit" id="btnEditPegawai">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTable
        $('#pegawaiTable').DataTable();

        // Tambah Pegawai
        $('#btnTambahPegawai').click(function() {
            var form = $('#formTambahPegawai');
            var url = form.attr('action');
            var method = form.attr('method');
            var data = form.serialize();

            $.ajax({
                url: url,
                method: method,
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#tambahModal').modal('hide');
                        form.trigger('reset');
                        location.reload();
                    }
                },
                error: function(xhr) {
                    if (xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            form.find('#tambah-' + key).addClass('is-invalid');
                            form.find('#tambah-' + key).next('.invalid-feedback').text(value[0]);
                        });
                    }
                }
            });
        });

        // Edit Pegawai
        $(document).on('click', '.btn-edit', function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var tanggal = $(this).data('tanggal');
            var jabatan = $(this).data('jabatan');

            $('#edit-id').val(id);
            $('#edit-nama').val(nama);
            $('#edit-tanggal').val(tanggal);
            $('#edit-jabatan').val(jabatan);

            $('#editModal').modal('show');
        });

        $('#btnEditPegawai').click(function() {
            var form = $('#formEditPegawai');
            var url = '/pegawai/update';
            var method = 'PUT';
            var data = form.serialize();

            $.ajax({
                url: url,
                method: method,
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#editModal').modal('hide');
                        form.trigger('reset');
                        location.reload();
                    }
                },
                error: function(xhr) {
                    if (xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            form.find('#edit-' + key).addClass('is-invalid');
                            form.find('#edit-' + key).next('.invalid-feedback').text(value[0]);
                        });
                    }
                }
            });
        });

        // Hapus Pegawai
        $(document).on('click', '.btn-delete', function() {
            var id = $(this).data('id');
            var url = '/pegawai/delete/' + id;
            var method = 'DELETE';

            if (confirm('Apakah Anda yakin ingin menghapus pegawai ini?')) {
                $.ajax({
                    url: url,
                    method: method,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        }
                    }
                });
            }
        });
    });
</script>
@endsection
