<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('sales')->insert([
            ['nama_produk' => 'Produk A', 'tanggal_penjualan' => '2025-01-01', 'jumlah' => 2, 'harga' => 50000],
            ['nama_produk' => 'Produk B', 'tanggal_penjualan' => '2025-01-02', 'jumlah' => 1, 'harga' => 75000],
            ['nama_produk' => 'Produk C', 'tanggal_penjualan' => '2025-01-03', 'jumlah' => 2, 'harga' => 60000],
            ['nama_produk' => 'Produk D', 'tanggal_penjualan' => '2025-01-02', 'jumlah' => 2, 'harga' => 61000],
            ['nama_produk' => 'Produk E', 'tanggal_penjualan' => '2025-01-04', 'jumlah' => 1, 'harga' => 25000],
        ]);
    }
}
