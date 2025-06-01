<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\History;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Cek apakah ada hasil diagnosa guest di session
        if ($guestDiagnosa = session('guest_diagnosa_result')) {
            try {
                // Buat history baru dengan hasil diagnosa guest
                \App\Models\History::create([
                    'user_id' => Auth::id(),
                    'gejala_terpilih' => json_encode($guestDiagnosa['gejala']),
                    'hasil_diagnosa' => json_encode($guestDiagnosa['hasil_diagnosa']),
                    'tanggal' => $guestDiagnosa['tanggal']
                ]);

                // Hapus hasil diagnosa dari session
                session()->forget('guest_diagnosa_result');

                // Redirect ke halaman hasil dengan pesan sukses
                return redirect()->route('pengguna.hasil')->with([
                    'success' => 'Login berhasil dan hasil diagnosa sebelumnya telah disimpan.',
                    'result' => $guestDiagnosa
                ]);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Error saving guest diagnosa: ' . $e->getMessage());
                return redirect()->route('pengguna.diagnosa')->with('error', 'Terjadi kesalahan saat menyimpan hasil diagnosa.');
            }
        }

        // Redirect berdasarkan role user
        if (Auth::user()->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'));
        } else {
            return redirect()->intended(route('pengguna.diagnosa'));
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}
