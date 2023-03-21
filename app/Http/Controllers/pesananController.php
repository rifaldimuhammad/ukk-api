<?php

namespace App\Http\Controllers;


use App\Http\Resources\pesananResource;
use App\Models\keranjangModel;
use App\Models\mejaModel;
use App\Models\pesananDetail;
use App\Models\pesananModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class pesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoice = pesananModel::get();
        return response()->json([
            'status' => true,
            'data' => pesananResource::collection($invoice)
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
        $invoice = pesananModel::get();
        $randomId = $this->random_strings(6) . date('ymd') . count($invoice);
        $id_pesanan = "$randomId";
        $file = new pesananModel();
        $file->id_menu = $request->id_menu;
        $file->id_pesanan = $id_pesanan;
        $file->jumlah_pesanan = $request->jumlah_pesanan;
        $file->total_harga = $request->total_harga;
        $file->tunai = $request->tunai;
        $file->no_meja = $request->no_meja;
        if ($request->no_meja > 0) {
            mejaModel::where('no_meja', $request->no_meja)->update([
                'status' => 'notnull'
            ]);
            $file->waktu = $request->waktu;
            $file->ekstra_waktu = 'true';
        } else {
            $file->waktu = '0';
            $file->ekstra_waktu = 'false';
        }
        $file->save();
        $keranjang = keranjangModel::get();
        foreach ($keranjang as $keranjang) {
            pesananDetail::create([
                'id_pesanan' => $id_pesanan,
                'id_menu' => $keranjang->id_menu,
                'jumlah_pesanan' => $keranjang->jumlah_menu,
                'sub_total' => $keranjang->total_harga,
            ]);
        }
        return response()->json([
            'status' => true,
            'messages' => 'Berhasil Menambahkan Pesanan Baru'
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
        $pesanan = pesananModel::find($id);
        return response()->json([
            'status' => true,
            'data' => new pesananResource($pesanan)
        ]);
    }
    public function getDate($date)
    {
        $invoice = pesananModel::whereDate('created_at', $date)->get();
        return response()->json([
            'status' => true,
            'data' => pesananResource::collection($invoice)
        ]);
    }


    public function getPesananWeek()
    {
        $invoice = pesananModel::select("*")
            ->whereBetween(
                'created_at',
                [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
            )
            ->get();
        return response()->json([
            'status' => true,
            'startWeek' => Carbon::now()->startOfWeek()->format('Y-m-d'),
            'endWeek' => Carbon::now()->endOfWeek()->format('Y-m-d'),
            'data' => pesananResource::collection($invoice)
        ]);
    }
    public function getPesananDate($date)
    {
        $invoice = pesananModel::where('created_at', '>=', $date)->get();
        return response()->json([
            'status' => 'true',
            'data' => pesananResource::collection($invoice)
        ]);
    }


    public function getLastAdd()
    {
        $pesanan = pesananModel::where('created_at', pesananModel::max('created_at'))->orderBy('created_at', 'desc')->get();
        return response()->json([
            'status' => true,
            'data' => pesananResource::collection($pesanan)
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
        pesananModel::where('id', $id)->update([
            'waktu' => $request->waktu
        ]);
        return response()->json([
            'status' => true,
            'messages' => 'Invoice Berhasil Di Ubah'
        ]);
    }

    public function updateEkstra(Request $request, $id)
    {
        pesananModel::where('id', $id)->update([
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
        $invoice = pesananModel::find($id);
        pesananModel::destroy($id);
        return response()->json([
            'status' => true,
            'messages' => 'Berhasil Di Hapus'
        ]);
    }

    function random_strings($length_of_string)
    {
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        return substr(
            str_shuffle($str_result),
            0,
            $length_of_string
        );
    }
}
