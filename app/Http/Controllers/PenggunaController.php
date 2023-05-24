<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::with('role')->where('role_id','!=',3)->get();
        // return $data;
        return view('pengguna.index',compact('data'));
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
            'nama_pengguna' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'level' => 'required',
        ]);
        try {
            $user = new User;
            $user->name = $request->get('nama_pengguna');
            $user->username = $request->get('username');
            $user->password = Hash::make($request->get('password'));
            $user->role_id = $request->get('level');
            $user->save();
            return redirect()->route('pengguna.index')->withStatus('Berhasil menambahkan data');
        } catch (Exception $e) {
            return redirect()->route('pengguna.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('pengguna.index')->withError('Terjadi kesalahan.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::find($id);
        return response()->json([
            'message' => 'Berhasil mengambil data.',
            'data' => $data,
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
        $data = User::find($id);
        return response()->json([
            'message' => 'Berhasil mengambil data.',
            'data' => $data,
        ]);
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
        try {
            $user = User::find($id);
            $user->name = $request->get('name');
            $user->username = $request->get('username');
            $user->role_id = $request->get('role_id');
            $user->update();
            return response()->json([
                'message' => 'Berhasil mengganti data.',
            ]);
        } catch (Exception $e) {
            return $e;
            return response()->json([
                'message' => 'terjadi kesalahan',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->back()->withStatus('Berhasil menghapus data');
    }
}
