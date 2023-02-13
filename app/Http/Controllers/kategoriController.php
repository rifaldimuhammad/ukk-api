<?php

namespace App\Http\Controllers;

use App\Http\Requests\kategoriRequest;
use App\Http\Resources\kategoriResource;
use App\Models\kategoriModel;
use App\Models\menuModel;
use Illuminate\Http\Request;

class kategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = kategoriModel::get();
        return response()->json([
            'status' => true,
            'data' => kategoriResource::collection($menu)
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
        $request->validate([
            "nama" => 'required',
            "cover" => 'required'
        ]);
        $cover = $this->uploadCover($request->cover);
        $file = new kategoriModel();
        $file->nama = $request->nama;
        $file->cover = $cover;
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
    public function show(menuModel $kategori)
    {
        return response()->json([
            'status' => true,
            'data' => new kategoriResource($kategori)
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
        $request->validate([
            "nama" => 'required',
            "cover" => 'required'
        ]);
        $menu = kategoriModel::find($id);

        if (!empty($request->cover)) {
            unlink($menu->cover);
            $cover = $this->uploadCover($request->cover);
            $menu->cover = $cover;
        }
        $menu->nama = $request->nama;
        $menu->save();
        return response()->json([
            'status' => true,
            'messages' => 'Magazine Berhasil Di Ubah'
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
        $menu = kategoriModel::find($id);
        $cover = public_path($menu->cover);
        if ($cover) {
            unlink($menu->cover);
        }
        kategoriModel::destroy($id);
        return response()->json([
            'status' => true,
            'messages' => 'Kategori Berhasil Di Hapus'
        ]);
    }
    public function uploadCover($cover)
    {
        $extFile = $cover->getClientOriginalName();
        $path =   $cover->move('kategori',  date('Ymdhis') . $extFile);
        $path = str_replace('\\', '/', $path);
        return $path;
    }
}
