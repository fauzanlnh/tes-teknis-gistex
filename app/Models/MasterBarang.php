<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterBarang extends Model
{
    protected $table = 'master_barang';
    protected $primaryKey = 'kode_barang';
    public $incrementing = false;
    protected $guarded = [];
}