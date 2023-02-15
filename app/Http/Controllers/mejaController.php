<?php

namespace App\Http\Controllers;

use App\Http\Resources\mejaResource;
use App\Models\mejaModel;
use Illuminate\Http\Request;

class mejaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meja = mejaModel::get();
        return response()->json([
            'status' => true,
            'data' => mejaResource::collection($meja)
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
        $file = new mejaModel();
        $file->option = $request->option;
        $file->status = $request->status;
        $file->no_meja = $request->no_meja;
        $file->save();
        return response()->json([
            'status' => true,
            'messages' => 'Berhasil Menambahkan Meja Baru'
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
    //update to null
    public function update(Request $request, $id)
    {
        //$id sebagai no meja
        mejaModel::where('no_meja', $id)->update([
            'status' => 'null'
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
        //
    }
}
