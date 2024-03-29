<?php

namespace App\Http\Controllers;

use App\Http\Resources\keranjangResource;
use App\Models\keranjangModel;
use App\Models\pesananDetail;
use App\Models\pesananModel;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class keranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pesanan = keranjangModel::with('menu')->get();
        return response()->json([
            'status' => true,
            'data' => keranjangResource::collection($pesanan)
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
        $data = keranjangModel::where('id_user', 1)->get();
        if (count($data) > 0) {
            $pesanan = $data->firstWhere('id_menu', $request->id_menu);
            if (!empty($pesanan)) {
                $jumlah = $pesanan->jumlah_menu + $request->jumlah_menu;
                keranjangModel::where('id', $pesanan->id)
                    ->update([
                        'jumlah_menu' => $jumlah,
                        'total_harga' => $jumlah * $pesanan->harga_menu
                    ]);
            } else {
                keranjangModel::create([
                    'id_menu' => $request->id_menu,
                    'harga_menu' => $request->harga_menu,
                    'jumlah_menu' => $request->jumlah_menu,
                    'total_harga' => $request->harga_menu * $request->jumlah_menu,
                    'id_user' => $request->id_user,

                ]);
            }
        } else {
            $file = new keranjangModel();
            $file->id_menu = $request->id_menu;
            $file->harga_menu = $request->harga_menu;
            $file->jumlah_menu = $request->jumlah_menu;
            $file->total_harga = $request->harga_menu * $request->jumlah_menu;
            $file->id_user = $request->id_user;
            $file->save();
        }
        return response()->json([
            'status' => true,
            'messages' => 'Berhasil Menambahkan pesanan Baru'
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
        $menu = keranjangModel::find($id);
        $menu->id_menu = $request->id_menu;
        $menu->jumlah_menu = $request->jumlah_menu;
        $menu->total_harga = $request->total_harga;
        $menu->save();

        return response()->json([
            'status' => true,
            'messages' => 'keranjang Berhasil Di Ubah'
        ]);
    }
    public function updateJumlah(Request $request, $id)
    {
        $keranjang = keranjangModel::find($id);
        $keranjang->jumlah_menu = $request->jumlah_menu;
        $keranjang->total_harga = $request->jumlah_menu * $request->harga_menu;
        $keranjang->save();
        return response()->json([
            'status' => true,
            'messages' => 'keranjang Berhasil Di Ubah'
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
        $pesanan = keranjangModel::find($id);
        keranjangModel::destroy($id);
        return response()->json([
            'status' => true,
            'messages' => 'pesanan Berhasil Di Hapus'
        ]);
    }

    public function destroyCart()
    {
        $pesanans =  keranjangModel::truncate();
        return response()->json([
            'status' => true,
            'messages' => 'Berhasil Menghapus Seluruh pesanan'
        ]);
    }
}
