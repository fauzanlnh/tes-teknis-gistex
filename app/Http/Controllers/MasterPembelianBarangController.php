<?php

namespace App\Http\Controllers;

use App\Models\MasterBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MasterPembelianBarang;
use Illuminate\Validation\ValidationException;

class MasterPembelianBarangController extends Controller
{
    private function generateId()
    {
        $latestData = MasterPembelianBarang::select('nomor_pembelian')->orderBy('nomor_pembelian', 'desc')->first();
        $latestId = explode('_', $latestData->nomor_pembelian);
        if ($latestId) {
            $latestId = explode('-', $latestId);
            $latestId = $latestId[1];
        } else {
            $latestId = 0;
        }
        $newId = 'K' . str_pad((int) $latestId + 1, 3, '0', STR_PAD_LEFT);
        return $newId;

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = DB::table('master_pembelian_barang')
            ->select(
                'nomor_pembelian',
                'tanggal',
                DB::raw("SUM(subtotal) AS grandtotal")
            )
            ->groupBy('nomor_pembelian', 'tanggal')
            ->get();
        return view('dashboard.pembelian-barang.index', ['pembelianBarang' => $results]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barang = MasterBarang::all();
        return view('dashboard.pembelian-barang.form', ['barang' => $barang]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'tanggal' => "required|date",
                'kode_barang' => "required|array",
                'qty' => 'required|array',
                'harga' => "required|array",
                'diskon' => "required|array",
                'subtotal' => "required|array",
            ]);

            $nomorPembelian = $this->generateId();
            ddd($nomorPembelian);
            // Update qty in master_barang
            foreach ($request->kode_barang as $index => $kode_barang) {
                if ($request->qty[$index] != '0') {
                    MasterPembelianBarang::create([
                        'nomor_pembelian' => $nomorPembelian,
                        'tanggal' => $request->tanggal,
                        'kode_barang' => $request->kode_barang[$index],
                        'qty' => $request->qty[$index],
                        'harga' => $request->harga[$index],
                        'diskon' => $request->diskon[$index],
                        'subtotal' => $request->subtotal[$index],
                    ]);

                    $barang = MasterBarang::where('kode_barang', $kode_barang)->first();
                    if ($barang) {
                        // Update qty in master_barang
                        $barang->update([
                            'qty' => $barang->qty - $request->qty[$index] // adjust as needed
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect('/dashboard/pembelian-barang')->with('success', 'pembelian barang Berhasil Ditambahkan');
        } catch (ValidationException $e) {
            // If validation fails, return back to the form with the validation errors
            DB::rollback();
            return redirect('/dashboard/pembelian-barang/create')->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            ddd($e);
            DB::rollback();
            return redirect('/dashboard/pembelian-barang')->with('error', 'pembelian barang Gagal Ditambahkan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasterPembelianBarang $masterPembelianBarang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasterPembelianBarang $masterPembelianBarang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($nomorPembelian)
    {
        DB::beginTransaction();
        try {
            $pembelianBarang = MasterPembelianBarang::where('nomor_pembelian')->get();
            foreach ($pembelianBarang as $item) {
                $barang = MasterBarang::where('kode_barang', $item->kode_barang)->first();
                $barang->update(['qty' => $barang->qty + $item->qty]);
                $pembelianBarang->delete();
            }
            DB::commit();
            return redirect('/dashboard/pembelian-barang')->with('success', 'pembelian barang Berhasil Dihapus');
        } catch (\Exception $e) {
            return redirect('/dashboard/pembelian-barang')->with('error', 'User Gagal Dihapus');
        }
    }
}
