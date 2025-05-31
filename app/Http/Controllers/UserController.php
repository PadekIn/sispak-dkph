<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        try
        {
            $users = User::all();
            return view('pages.admin.user.index', compact('users'));
        } catch (\Exception $e) {
            Log::error('Error loading user index page: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengambil data user: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('pages.admin.user.create');
    }

    public function store(Request $request)
    {
        try
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'role' => 'required|in:admin,pengguna',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(10),
            ]);

            return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan');
        } catch (ValidationException $e) {
             return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error adding user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menambahkan user: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        try
        {
            $user = User::findOrFail($id);
            return view('pages.admin.user.edit', compact('user'));
        } catch (\Exception $e) {
            Log::error('Error loading user edit page: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengambil data user: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try
        {
            $user = User::findOrFail($id);
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|string|min:8|confirmed',
                'role' => 'required|in:admin,pengguna',
            ]);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return redirect()->route('admin.user.index')->with('success', 'User berhasil diubah');
        }  catch (ValidationException $e) {
             return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengubah data user: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try
        {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus data user: ' . $e->getMessage());
        }
    }
}
