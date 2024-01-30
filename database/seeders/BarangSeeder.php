<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('master_barang')->insert([
            'kode_barang' => 'K001',
            'nama_barang' => 'Celana Panjang',
            'satuan' => 'PC',
            'qty' => '200',
            'harga' => '80000',
        ]);

        DB::table('master_barang')->insert([
            'kode_barang' => 'K002',
            'nama_barang' => 'Celana Pendek',
            'satuan' => 'PC',
            'qty' => '200',
            'harga' => '75000',
        ]);

        DB::table('master_barang')->insert([
            'kode_barang' => 'K003',
            'nama_barang' => 'Baju Pria',
            'satuan' => 'PC',
            'qty' => '200',
            'harga' => '60000',
        ]);

        DB::table('master_barang')->insert([
            'kode_barang' => 'K004',
            'nama_barang' => 'Baju Wantia',
            'satuan' => 'PC',
            'qty' => '200',
            'harga' => '90000',
        ]);

        DB::table('master_barang')->insert([
            'kode_barang' => 'K005',
            'nama_barang' => 'Jaket',
            'satuan' => 'PC',
            'qty' => '200',
            'harga' => '70000',
        ]);
    }
}
