<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class MasterUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return view('dashboard.user.index', ['users' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.user.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'email' => 'required|unique:users,email',
                'nama' => "required",
                'password' => "required",
            ]);

            User::create([
                'email' => $request->email,
                'nama' => $request->nama,
                'password' => Hash::make($request->password),
            ]);

            DB::commit();

            return redirect('/dashboard/user')->with('success', 'User Berhasil Ditambahkan');
        } catch (ValidationException $e) {
            // If validation fails, return back to the form with the validation errors
            DB::rollback();
            return redirect('/dashboard/user/create')->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/dashboard/user')->with('error', 'User Gagal Ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('dashboard.user.form', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'email' => 'required|unique:users,email',
                'nama' => "required",
                'password' => "required",
            ]);

            $user->update([
                'email' => $request->email,
                'nama' => $request->nama,
                'password' => Hash::make($request->password),
            ]);

            DB::commit();

            return redirect('/dashboard/user')->with('success', 'User Berhasil Diubah');
        } catch (ValidationException $e) {
            // If validation fails, return back to the form with the validation errors
            DB::rollback();
            return redirect('/dashboard/user/' . $user->email . '/edit')->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/dashboard/user')->with('error', 'User Gagal Diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect('/dashboard/user')->with('success', 'User Berhasil Dihapus');
        } catch (\Exception $e) {
            return redirect('/dashboard/user')->with('error', 'User Gagal Dihapus');
        }
    }
}
