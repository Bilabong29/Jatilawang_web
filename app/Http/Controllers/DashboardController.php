<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        // Contoh data dinamis (opsional)
        // $activeRentals = Rental::where('status','active')->count();
        // $totalRevenue = Transaction::where('payment_status','paid')->sum('amount');

        return view('dashboard'/*, compact('activeRentals','totalRevenue')*/);
    }
}
