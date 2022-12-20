<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengirimanBarang;
use App\Http\Resources\PengirimanBarangResource;
use Illuminate\Support\Facades\Validator;

class PengirimanBarangController extends Controller
{
    /**
    * index
    *
    * @return void
    */
    public function index()
    {
        //get pengiriman barang
        $pengiriman_barang = PengirimanBarang::latest()->get();
        //render view with posts
        return new PengirimanBarangResource(true, 'List Data Pengiriman Barang', $pengiriman_barang);
    }

    /**
    * create
    *
    * @return void
    */

    public function create()
    {
        return view('pengiriman_barang.create');
    }

    public function show($id){
        $pengiriman_barang = PengirimanBarang::find($id);
        return new PengirimanBarangResource(true, 'Data Barang Berhasil Diambil', $pengiriman_barang);
    }

    /**
    * store
    *
    * @param Request $request
    * @return void
    */
    public function store(Request $request)
    {
        //Validasi Formulir
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|max:60',
            'nama_pengirim' => 'required',
            'telp_pengirim' => 'required|numeric',
            'berat_barang' => 'required|numeric|min:0|max:20',
            'jenis_barang' => 'required',
            'kota_asal' => 'required',
            'kota_tujuan' => 'required',
            'estimasi' => 'required',
            'nama_penerima' => 'required',
            'telp_penerima' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
            
        //Fungsi Post ke Database
        $pengiriman_barang = PengirimanBarang::create([
            'nama_barang' => $request->nama_barang,
            'nama_pengirim' => $request->nama_pengirim,
            'telp_pengirim' => $request->telp_pengirim,
            'berat_barang' => $request->berat_barang,
            'jenis_barang' => $request->jenis_barang,
            'kota_asal' => $request->kota_asal,
            'kota_tujuan' => $request->kota_tujuan,
            'estimasi' => $request->estimasi,
            'nama_penerima' => $request->nama_penerima,
            'telp_penerima' => $request->telp_penerima
        ]);

        return new PengirimanBarangResource(true, 'Data Pengiriman Barang Berhasil Ditambahkan!', $pengiriman_barang);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|max:60',
            'nama_pengirim' => 'required',
            'telp_pengirim' => 'required|numeric',
            'berat_barang' => 'required|numeric|min:0|max:20',
            'jenis_barang' => 'required',
            'kota_asal' => 'required',
            'kota_tujuan' => 'required',
            'estimasi' => 'required',
            'nama_penerima' => 'required',
            'telp_penerima' => 'required'
        ]);


        if($validator->fails()){
            return (response()->json($validator->errors(), 422+ $id));
        }

        
        $pengiriman_barang = PengirimanBarang::findorfail($id);
        $pengiriman_barang->update([
            'nama_barang' => $request->nama_barang,
            'nama_pengirim' => $request->nama_pengirim,
            'telp_pengirim' => $request->telp_pengirim,
            'berat_barang' => $request->berat_barang,
            'jenis_barang' => $request->jenis_barang,
            'kota_asal' => $request->kota_asal,
            'kota_tujuan' => $request->kota_tujuan,
            'estimasi' => $request->estimasi,
            'nama_penerima' => $request->nama_penerima,
            'telp_penerima' => $request->telp_penerima
        ]);

        return new PengirimanBarangResource(true, 'Data Barang Berhasil Diedit', $pengiriman_barang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $pengiriman_barang = PengirimanBarang::findorfail($id);
        $this->validate($request, [
            'nama_barang' => 'required|max:60',
            'nama_pengirim' => 'required',
            'telp_pengirim' => 'required|numeric',
            'berat_barang' => 'required|numeric|min:0|max:20',
            'jenis_barang' => 'required',
            'kota_asal' => 'required',
            'kota_tujuan' => 'required',
            'estimasi' => 'required',
            'nama_penerima' => 'required',
            'telp_penerima' => 'required'
        ]);

        $pengiriman_barang->update([
            'nama_barang' => $request->nama_barang,
            'nama_pengirim' => $request->nama_pengirim,
            'telp_pengirim' => $request->telp_pengirim,
            'berat_barang' => $request->berat_barang,
            'jenis_barang' => $request->jenis_barang,
            'kota_asal' => $request->kota_asal,
            'kota_tujuan' => $request->kota_tujuan,
            'estimasi' => $request->estimasi,
            'nama_penerima' => $request->nama_penerima,
            'telp_penerima' => $request->telp_penerima
        ]);

        try{
            // Mengisi variabel yang akan ditampilkan pada view mail
            $content = [
                'body' => $request->nama_barang,
            ];

            //Redirect jika berhasil mengirim email
            return new PengirimanBarangResource(true, 'Data Barang Berhasil Diedit', $pengiriman_barang);
        }catch(Exception $e){

            //Redirect jika gagal mengirim email
            return new PengirimanBarangResource(true, 'Data Barang Berhasil Diedit', $pengiriman_barang);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $pengiriman_barang = PengirimanBarang::find($id);
        $pengiriman_barang->delete();
        return new PengirimanBarangResource(true, 'Data Barang Berhasil Dihapus', $pengiriman_barang);
    }
}