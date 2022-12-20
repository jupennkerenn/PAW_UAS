<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanKeluhan;
use App\Models\PengirimanBarang;
use App\Http\Resources\LaporanKeluhanResource;
use Illuminate\Support\Facades\Validator;

class LaporanKeluhanController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index()
    {
        $penngiriman_barang = PengirimanBarang::latest()->get();
        $laporan_keluhan = LaporanKeluhan::with('pengiriman_barang')->latest()->get();

        return new LaporanKeluhanResource(true, 'List Data Keluhan User', $laporan_keluhan);
    }

    public function create(){
        return view('laporan_keluhan.create');
    }

    public function show($id){
        $penngiriman_barang = PengirimanBarang::all();
        $laporan_keluhan = LaporanKeluhan::with('pengiriman_barang')->find($id);
        return new LaporanKeluhanResource(true, 'Data Keluhan Berhasil Diambil', $laporan_keluhan);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'id_barang' => 'required',
            'keluhan' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        // Fungsi simpan data ke dalam Database
        $laporan_keluhan = LaporanKeluhan::create([
            'id_barang' => $request->id_barang,
            'keluhan' => $request->keluhan
        ]);

        return new LaporanKeluhanResource(true, 'Data Keluhan Berhasil Ditambahkan', $laporan_keluhan);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'id_barang' => 'required',
            'keluhan' => 'required',
        ]);

        if($validator->fails()){
            return (response()->json($validator->errors(), 422+ $id));
        }
   
        $laporan_keluhan = LaporanKeluhan::findorfail($id);
        $laporan_keluhan->update([
            'id_barang'   => $request->id_barang,
            'keluhan'      => $request->keluhan
        ]);

        return new LaporanKeluhanResource(true, 'Data Keluhan Berhasil Diedit', $laporan_keluhan);
        
    }

    public function destroy($id){
        $laporan_keluhan = LaporanKeluhan::find($id);
        $laporan_keluhan->delete();
        return new LaporanKeluhanResource(true, 'Data Keluhan Berhasil Dihapus', $laporan_keluhan);
    }
}
