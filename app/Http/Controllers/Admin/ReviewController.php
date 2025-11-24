<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('user')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'verified' => ['required', 'boolean'],
        ]);

        $review->update($validated);

        return redirect()
            ->route('admin.reviews.index')
            ->with('success', 'Review berhasil diperbarui.');
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()
            ->route('admin.reviews.index')
            ->with('success', 'Review berhasil dihapus.');
    }
}
