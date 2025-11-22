<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with('user')
            ->orderByDesc('created_at')
            ->paginate(20);

        $rentals->getCollection()->transform(function ($rental) {
            $rental->computed_status = $this->computeStatus($rental);
            return $rental;
        });

        return view('admin.rentals.index', compact('rentals'));
    }

    public function show(Rental $rental)
    {
        $rental->load('user', 'items');

        $computedStatus = $this->computeStatus($rental);

        return view('admin.rentals.show', compact('rental', 'computedStatus'));
    }

    public function update(Request $request, Rental $rental)
    {
        $validated = $request->validate([
            'return_date' => ['nullable', 'date'],
            'total_price' => ['nullable', 'numeric', 'min:0'],
        ]);

        $rental->update($validated);

        return redirect()
            ->route('admin.rentals.show', $rental)
            ->with('success', 'Data rental berhasil diperbarui.');
    }

    private function computeStatus(Rental $rental): string
    {
        $today = Carbon::today();

        if ($rental->return_date) {
            return 'returned';
        }

        if ($today->lt(Carbon::parse($rental->rental_start_date))) {
            return 'upcoming';
        }

        if ($today->between(
            Carbon::parse($rental->rental_start_date),
            Carbon::parse($rental->rental_end_date)
        )) {
            return 'on_rent';
        }

        if (!$rental->return_date && $today->gt(Carbon::parse($rental->rental_end_date))) {
            return 'late';
        }

        return 'unknown';
    }
}
