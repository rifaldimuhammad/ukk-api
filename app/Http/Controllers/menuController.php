<?php

namespace App\Http\Controllers;

use App\Http\Requests\menuRequest;
use App\Http\Resources\menuResource;
use App\Models\aktifitas;
use App\Models\menuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class menuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = menuModel::get();
        return response()->json([
            'status' => true,
            'data' => menuResource::collection($menu)
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
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'required',
            'harga' => 'required',
            'cover' => 'required|image|mimes:png,jpg,jpeg,svg,webp,gif,jfif'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Foto Menu Harus Berformat gamnbar'
            ]);
        }
        $cover = $this->uploadCover($request->cover);
        $file = new menuModel();
        $file->nama = $request->nama;
        $file->deskripsi = $request->deskripsi;
        $file->kategori = $request->kategori;
        $file->harga = $request->harga;
        $file->cover = $cover;
        $file->save();

        $aktifitas = $this->aktifitasStore($request->id_user, 'Menambahkan Menu Baru', $request->nama);
        return response()->json([
            'status' => true,
            'messages' => 'Berhasil Menambahkan Menu Baru'
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(menuModel $menu)
    {
        return response()->json([
            'status' => true,
            'data' => new menuResource($menu)
        ]);
    }
    public function showByCat($category)
    {
        $cat = menuModel::where('kategori', $category)->get();
        return response()->json([
            'status' => true,
            'data' => menuResource::collection($cat)
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
        $menu = menuModel::find($id);
        if (!empty($request->cover)) {
            $validator = Validator::make($request->all(), [
                'cover' => 'image|mimes:jpg,png,jpeg,gif,svg',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Foto Menu Harus Berformat Gambar digital'
                ]);
            }
            unlink($menu->cover);
            $cover = $this->uploadCover($request->cover);
            $menu->cover = $cover;
        }
        $menu->nama = $request->nama;
        $menu->deskripsi = $request->deskripsi;
        $menu->kategori = $request->kategori;
        $menu->harga = $request->harga;
        $menu->save();
        return response()->json([
            'status' => true,
            'message' => 'Menu Berhasil Di Ubah'
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
        $menu = menuModel::find($id);
        $cover = public_path($menu->cover);
        if ($cover) {
            unlink($menu->cover);
        }
        menuModel::destroy($id);
        return response()->json([
            'status' => true,
            'messages' => 'Menu Berhasil Di Hapus'
        ]);
    }
    public function uploadCover($cover)
    {
        $extFile =  $cover->getClientOriginalName();
        $path = $cover->move('cover',  date('Ymdhis') . $extFile);
        $path = str_replace('\\', '/', $path);
        return $path;
    }
    public function aktifitasStore($idUser, $message, $name)
    {
        $aktifitas = new aktifitas();
        $aktifitas->id_user = $idUser;
        $aktifitas->nama_aktifitas = "$message : $name";
        $aktifitas->read = 'false';
        $aktifitas->save();
        return response()->json([
            'status' => true,
            'messages' => 'Berhasil Menambahkan Menu Baru'
        ]);
    }
}
