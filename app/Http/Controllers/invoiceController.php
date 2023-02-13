<?php

namespace App\Http\Controllers;

use App\Http\Resources\invoiceResource;
use App\Models\invoiceModel;
use Illuminate\Http\Request;

class invoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoice = invoiceModel::get();
        return response()->json([
            'status' => true,
            'data' => invoiceResource::collection($invoice)
        ]);
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
        $file = new invoiceModel();
        $file->id_menu = $request->id_menu;
        $file->id_pesanan = $request->id_pesanan;
        $file->jumlah_pesanan = $request->jumlah_pesanan;
        $file->total_harga = $request->total_harga;
        $file->save();
        return response()->json([
            'status' => true,
            'messages' => 'Berhasil Menambahkan Magazine Baru'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $invoice = invoiceModel::find($id);
        $invoice->id_menu = $request->id_menu;
        $invoice->id_pesanan = $request->id_pesanan;
        $invoice->jumlah_pesanan = $request->jumlah_pesanan;
        $invoice->total_harga = $request->total_harga;
        $invoice->save();

        return response()->json([
            'status' => true,
            'messages' => 'pesanan Berhasil Di Ubah'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = invoiceModel::find($id);
        invoiceModel::destroy($id);
        return response()->json([
            'status' => true,
            'messages' => 'Berhasil Di Hapus'
        ]);
    }
}
