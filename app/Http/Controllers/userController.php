<?php

namespace App\Http\Controllers;

use App\Http\Resources\userResource;
use App\Models\aktifitas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::get();
        return response()->json([
            'status' => true,
            'data' => userResource::collection($user)
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
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(), 400
            ]);
        }
        $cover = $this->uploadCover($request->cover);
        $file = new User();
        $file->name = $request->name;
        $file->email = $request->email;
        $file->level = $request->level;
        $file->cover = $cover;
        $file->password = Hash::make($request->password);
        $file->save();

        $aktifitas = new aktifitas();
        $aktifitas->id_user = $request->id_user;
        $aktifitas->nama_aktifitas = "Menambahkan $request->level : $request->email";
        $aktifitas->read = 'false';
        $aktifitas->save();
        return response()->json([
            'status' => true,
            'messages' => 'Berhasil Menambahkan User Baru'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json([
            'status' => true,
            'data' => new userResource($user)
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
        $user = User::find($id);

        // return $request->cover == 'null';
        if (!empty($request->cover) && $request->cover != "null") {
            if (!empty($user->cover)) {
                unlink($user->cover);
                $cover = $this->uploadCover($request->cover);
                $user->cover = $cover;
            } else {
                $cover = $this->uploadCover($request->cover);
                $user->cover = $cover;
            }
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = $request->level;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'User Berhasil Di Rubah',
            'data'    => $user
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
        $user = User::find($id);
        $cover = public_path($user->cover);
        if ($cover) {
            unlink($user->cover);
        }
        User::destroy($id);

        return response()->json([
            'status' => true,
            'messages' => 'Kategori Berhasil Di Hapus'
        ]);
    }
    public function uploadCover($cover)
    {
        $extFile = $cover->getClientOriginalName();
        $path =   $cover->move('user',  date('Ymdhis') . $extFile);
        $path = str_replace('\\', '/', $path);
        return $path;
    }

    ///////////////////////////////////////////////////////////////
    ///////////////////LOGIN & REGISTER CONTROLLER/////////////////
    ///////////////////LOGIN & REGISTER CONTROLLER/////////////////
    ///////////////////LOGIN & REGISTER CONTROLLER/////////////////
    ///////////////////////////////////////////////////////////////

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Register Success!',
            'data'    => $user
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Login Failed!',
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Login Success!',
            'data'    => $user,
            'token'   => $user->createToken('authToken')->accessToken
        ]);
    }


    public function logout(Request $request)
    {
        $removeToken = $request->user()->tokens()->delete();
        if ($removeToken) {
            return response()->json([
                'success' => true,
                'message' => 'Logout Success!',
            ]);
        }
    }
}
