@extends('master')

@section('form')
<form action="" method="POST">
    <div class="form-group">
      <label for="nama">Nama Jabatan</label>
      <input type="text" class="form-control" id="nama" placeholder="Nama">
    </div>
    <button type="submit">Kirim</button>
  </form>
@endsection