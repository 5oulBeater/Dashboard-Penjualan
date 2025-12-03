<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;   // ➜ WAJIB DITAMBAH

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->start_date;
        $end = $request->end_date;

        $query = Sale::query();

        if ($start && $end) {
            $query->whereBetween('tanggal_penjualan', [$start, $end]);
        }

        $sales = $query->get();

        $total = $sales->sum(function($item){
            return $item->jumlah * $item->harga;
        });

        return view('dashboard', compact('sales', 'total'));
    }
}
