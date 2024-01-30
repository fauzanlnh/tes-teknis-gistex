<?php

namespace App\Http\Controllers;

use App\Models\MasterBarang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class MasterBarangController extends Controller
{

    private function generateId()
    {
        $latestData = MasterBarang::select('kode_barang')->orderBy('kode_barang', 'desc')->first();
        $latestId = substr($latestData->kode_barang, 1);
        $newId = 'K' . str_pad((int) $latestId + 1, 3, '0', STR_PAD_LEFT);
        return $newId;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stuffs = MasterBarang::all();
        return view('dashboard.barang.index', ['stuffs' => $stuffs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.barang.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'nama_barang' => 'required|unique:master_barang,nama_barang',
                'satuan' => "required",
                'qty' => "required",
                'harga' => "required",
            ]);

            $kodeBarang = $this->generateId();

            MasterBarang::create([
                'kode_barang' => $kodeBarang,
                'nama_barang' => $request->nama_barang,
                'satuan' => $request->satuan,
                'qty' => $request->qty,
                'harga' => $request->harga,
            ]);

            DB::commit();

            return redirect('/dashboard/barang')->with('success', 'barang Berhasil Ditambahkan');
        } catch (ValidationException $e) {
            // If validation fails, return back to the form with the validation errors
            DB::rollback();
            return redirect('/dashboard/barang/create')->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            ddd($e);
            DB::rollback();
            return redirect('/dashboard/barang')->with('error', 'barang Gagal Ditambahkan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($kodeBarang)
    {
        $stuff = MasterBarang::select("*")->where('kode_barang', $kodeBarang)->first();
        return view('dashboard.barang.form', ['stuff' => $stuff]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $kodeBarang)
    {
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'nama_barang' => [
                    'required',
                    Rule::unique('master_barang', 'nama_barang')->ignore($kodeBarang, 'kode_barang')
                ],
                'satuan' => "required",
                'qty' => "required",
                'harga' => "required",
            ]);

            $stuff = MasterBarang::select("*")->where('kode_barang', $kodeBarang)->first();

            $stuff->update([
                'nama_barang' => $request->nama_barang,
                'satuan' => $request->satuan,
                'qty' => $request->qty,
                'harga' => $request->harga,
            ]);

            DB::commit();

            return redirect('/dashboard/barang')->with('success', 'barang Berhasil diubah');
        } catch (ValidationException $e) {
            // If validation fails, return back to the form with the validation errors
            DB::rollback();
            return redirect("/dashboard/barang/{$kodeBarang}/edit")->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            ddd($e);
            DB::rollback();
            return redirect('/dashboard/barang')->with('error', 'barang Gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kodeBarang)
    {
        try {
            $stuff = MasterBarang::select("*")->where('kode_barang', $kodeBarang)->first();
            $stuff->delete();
            return redirect('/dashboard/barang')->with('success', 'barang Berhasil Dihapus');
        } catch (\Exception $e) {
            return redirect('/dashboard/barang')->with('error', 'barang Gagal Dihapus');
        }

    }
}
