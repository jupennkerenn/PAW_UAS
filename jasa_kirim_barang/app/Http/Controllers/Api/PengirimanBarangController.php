<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Validation\Rule;
use Validator;
use App\Models\PengirimanBarang;

class PengirimanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengiriman_barangs = PengirimanBarang::all();

        if(count($pengiriman_barangs) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $pengiriman_barangs
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
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

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $pengiriman_barang = PengirimanBarang::create($storeData);
        return response([
            'message' => 'Add Barang Success',
            'data' => $pengiriman_barang
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengiriman_barang = PengirimanBarang::find($id);

        if(!is_null($pengiriman_barang)){
            return response([
                'message' => 'Retrieve Barang Success',
                'data' => $pengiriman_barang
            ], 200);
        }

        return response([
            'message' => 'Barang not Found',
            'data' => null
        ], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pengiriman_barang = PengirimanBarang::find($id);
        if(is_null($pengiriman_barang)){
            return response([
                'message' => 'Barang Not Found', 
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
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

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $pengiriman_barang->nama_barang = $updateData['nama_barang'];
        $pengiriman_barang->nama_pengirim = $updateData['nama_pengirim'];
        $pengiriman_barang->telp_pengirim = $updateData['telp_pengirim'];
        $pengiriman_barang->berat_barang = $updateData['berat_barang'];
        $pengiriman_barang->berat_barang = $updateData['berat_barang'];
        $pengiriman_barang->jenis_barang = $updateData['jenis_barang'];
        $pengiriman_barang->kota_asal = $updateData['kota_asal'];
        $pengiriman_barang->kota_tujuan = $updateData['kota_tujuan'];
        $pengiriman_barang->estimasi = $updateData['estimasi'];
        $pengiriman_barang->nama_penerima = $updateData['nama_penerima'];
        $pengiriman_barang->telp_penerima = $updateData['telp_penerima'];

        if($pengiriman_barang->save()){
            return response([
                'message' => 'Update Barang Success',
                'data' => $pengiriman_barang
            ], 200);
        }

        return response([
            'message' => 'Update Barang Failed',
            'data' => null
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengiriman_barang = PengirimanBarang::find($id);

        if(is_null($pengiriman_barang)){
            return response([
                'message' => 'Barang Not Found', 
                'data' => null
            ], 404);
        }

        if($pengiriman_barang->delete()){
            return response([
                'message' => 'Delete Barang Succes',
                'data' => $pengiriman_barang
            ], 200);
        }

        return response([
            'message' => 'Delete Barang Failed',
            'data' => null
        ], 400);
    }
}
