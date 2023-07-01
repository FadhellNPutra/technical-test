@extends('master')

@section('form')
<form action="" method="POST">
    <div class="form-group">
      <label for="nama">Nama Pegawai</label>
      <input type="text" class="form-control" id="nama" placeholder="Nama">
    </div>
    <div class="form-group">
      <label for="tanggal">Tanggal lahir</label>
      <input type="date" class="form-control" id="tanggal" placeholder="tanggal">
    </div>
    <div class="form-group">
      <label for="jabatan">Jabatan</label>
      <input type="text" class="form-control" id="jabatan" placeholder="Jabatan`">
    </div>
    <button type="submit">Kirim</button>
  </form>
@endsection