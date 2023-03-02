<?php

namespace App\Http\Controllers;

use App\Http\Resources\invoiceResource;
use App\Models\invoiceModel;
use App\Models\mejaModel;
use Brick\Math\Exception\MathException;
use Faker\Core\Number;
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
        $file->no_meja = $request->no_meja;
        $file->waktu = $request->waktu;
        $file->ekstra_waktu = 'true';
        $file->save();
        if ($request->no_meja > 0) {
            mejaModel::where('no_meja', $request->no_meja)->update([
                'status' => 'notnull'
            ]);
        }
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
    public function getDate($date)
    {
        $invoice = invoiceModel::whereDate('created_at', $date )->get();
        return response()->json([
            'status' => true,
            'data' => invoiceResource::collection($invoice)
        ]);
    }
    public function getInvoiceDate($date)
    {
        $invoice = invoiceModel::where('created_at', '>=', $date)->get();
        return response()->json([
            'status' => 'true',
            'data' => invoiceResource::collection($invoice)
        ]);
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
        // just update time 
        invoiceModel::where('id', $id)->update([
            'waktu' => $request->waktu
        ]);
        return response()->json([
            'status' => true,
            'messages' => 'Invoice Berhasil Di Ubah'
        ]);
    }

    public function updateEkstra(Request $request, $id)
    {
        invoiceModel::where('id', $id)->update([
            'ekstra_waktu' => $request->ekstra_waktu
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
