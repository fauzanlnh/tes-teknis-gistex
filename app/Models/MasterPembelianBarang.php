<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterPembelianBarang extends Model
{
    protected $table = 'master_pembelian_barang';
    public $incrementing = false;
    protected $guarded = [];

    public function masterBarang()
    {
        return $this->hasMany(MasterBarang::class, 'kode_barang');
    }
}
