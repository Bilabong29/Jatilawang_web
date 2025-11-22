<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\Item;
use App\Models\User;
use App\Models\Review;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRentals = Rental::count();
        $totalItems   = Item::count();
        $totalUsers   = User::count();
        $totalReviews = Review::count();

        $totalRevenueRentals = Rental::sum('total_price');

        $latestRentals = Rental::with('user')
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalRentals',
            'totalItems',
            'totalUsers',
            'totalReviews',
            'totalRevenueRentals',
            'latestRentals'
        ));
    }
}
