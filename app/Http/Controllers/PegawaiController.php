<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Jabatan;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::all();
        $jabatan = Jabatan::all();

        return view('pegawai.index', compact('pegawai', 'jabatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal_lahir' => 'required',
            'jabatan' => 'required',
        ]);

        $pegawai = new Pegawai;
        $pegawai->nama = $request->nama;
        $pegawai->tanggal_lahir = $request->tanggal_lahir;
        $pegawai->jabatan_id = $request->jabatan;
        $pegawai->save();

        return response()->json(['success' => true]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'nama' => 'required',
            'tanggal_lahir' => 'required',
            'jabatan' => 'required',
        ]);

        $pegawai = Pegawai::find($request->id);
        $pegawai->nama = $request->nama;
        $pegawai->tanggal_lahir = $request->tanggal_lahir;
        $pegawai->jabatan_id = $request->jabatan;
        $pegawai->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->delete();

        return response()->json(['success' => true]);
    }
}
