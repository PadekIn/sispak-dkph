<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pengguna'
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Cek apakah ada hasil diagnosa guest di session
        if ($guestDiagnosa = session('guest_diagnosa_result')) {
            try {
                // Buat history baru dengan hasil diagnosa guest
                \App\Models\History::create([
                    'user_id' => $user->id,
                    'gejala_terpilih' => json_encode($guestDiagnosa['gejala']),
                    'hasil_diagnosa' => json_encode($guestDiagnosa['hasil_diagnosa']),
                    'tanggal' => $guestDiagnosa['tanggal']
                ]);

                // Hapus hasil diagnosa dari session
                session()->forget('guest_diagnosa_result');

                // Redirect ke halaman hasil dengan pesan sukses
                return redirect()->route('pengguna.hasil')->with([
                    'success' => 'Berhasil daftar dan hasil diagnosa sebelumnya telah disimpan.',
                    'result' => $guestDiagnosa
                ]);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Error saving guest diagnosa after registration: ' . $e->getMessage());
                return redirect()->route('pengguna.diagnosa')->with('error', 'Terjadi kesalahan saat menyimpan hasil diagnosa.');
            }
        }

        return redirect()->route('pengguna.diagnosa');
    }
}
