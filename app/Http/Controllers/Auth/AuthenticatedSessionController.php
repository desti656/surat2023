<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\ProfilDesa;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $profil = ProfilDesa::first();
        return view('auth.login', compact('profil'));
    }

    public function createWarga()
    {
        $profil = ProfilDesa::first();
        return view('auth.login-warga', compact('profil'));
    }

    public function registerWarga()
    {
        $profil = ProfilDesa::first();
        return view('auth.register-warga', compact('profil'));


    }

    public function postWarga(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required|unique:users,username',
            'alamat' => 'required',
            'password' => 'required',
            'no_kk' => 'required|unique:users,no_kk',
        ], [
            'required' => ':attribute harus diisi.',
            'unique' => ':attribute telah digunakan.',
        ], [
            'nama' => 'Nama',
            'nik' => 'NIK',
            'alamat' => 'Alamat',
            'password' => 'Password',
            'no_kk' => 'Nomor Kartu Keluarga'
        ]);
        try {
            $warga = new User;
            $warga->name = $request->get('nama');
            $warga->username = $request->get('nik');
            $warga->password = Hash::make($request->get('password'));
            $warga->no_kk = $request->get('no_kk');
            $warga->role_id = 3;
            $warga->save();
            return redirect()->route('login-warga')->withStatus('Berhasil register.');
        } catch (Exception $e) {
            return redirect()->route('register-warga')->withError('Terjadi kesalahan');
        }
    }
    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function store(LoginRequest $request)
    public function store(Request $request)
    {
        if ($request->has('nik')) {
            $credentials = $request->validate([
                'nik' => 'required',
            ]);
            $request->merge(
                    [
                        'username' => $request->get('nik'),
                        'password' => $request->get('password')
                    ]);
            $credentials = $request->only('username','password');
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended(RouteServiceProvider::HOME);
            }else{
                return redirect()->back()->withError('Tidak memiliki akses');
            }

        }else{
            $credentials = $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);
            $credentials = $request->only('username', 'password');
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended(RouteServiceProvider::HOME);
            }else{
                return redirect()->back()->withError('Tidak memiliki akses');
            }
        }
        // RateLimiter::clear($this->throttleKey());

        // $request->authenticate();


    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeWarga(LoginRequest $request)
    {
        // $request->authenticate();

        // $request->session()->regenerate();

        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/dashboard');
    }
}
