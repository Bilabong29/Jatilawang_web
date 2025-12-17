<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{

    public function index(Request $request)
    {
        $query = Item::query();

        // Ambil daftar kategori untuk filter dropdown
        $categories = Item::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('item_name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($category = $request->get('category')) {
            $query->where('category', 'like', "%{$category}%");
        }

        $sort = $request->get('sort', 'latest');

        switch ($sort) {
            case 'price_low':
                $query->orderByRaw('COALESCE(rental_price_per_day, 999999999) ASC');
                break;
            case 'price_high':
                $query->orderByRaw('COALESCE(rental_price_per_day, 0) DESC');
                break;
            case 'name_asc':
                $query->orderBy('item_name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('item_name', 'desc');
                break;
            case 'id_asc':
                $query->orderBy('item_id', 'asc');
                break;
            case 'latest':
            default:
                $query->orderByDesc('created_at');
                break;
        }

        $items = $query->paginate(20)->withQueryString();

        return view('admin.items.index', compact('items', 'categories'));
    }

    public function create()
    {
        $categories = Item::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('admin.items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_name'           => ['required', 'string', 'max:100'],
            'description'         => ['nullable', 'string'],
            'category_selected'   => ['nullable', 'string', 'max:20'],
            'new_category'        => ['nullable', 'string', 'max:20'],
            'url_image'           => ['nullable', 'url', 'max:255'],
            'rental_price_per_day'=> ['nullable', 'numeric', 'min:0'],
            'sale_price'          => ['nullable', 'numeric', 'min:0'],
            'rental_stock'        => ['nullable', 'integer', 'min:0', 'max:255'],
            'sale_stock'          => ['nullable', 'integer', 'min:0', 'max:255'],
            'penalty_per_days'    => ['nullable', 'numeric', 'min:0'],
            'is_rentable'         => ['required', 'boolean'],
            'is_sellable'         => ['required', 'boolean'],
        ]);

        $validator->after(function ($validator) use ($request) {
            $rentable = $request->boolean('is_rentable');
            $sellable = $request->boolean('is_sellable');

            if ($rentable === $sellable) {
                $validator->errors()->add('is_rentable', 'Pilih salah satu: hanya sewa atau hanya jual.');
            }
        });

        $validated = $validator->validate();

        $payload = $validated;
        $payload['description'] = $payload['description'] ?? null;

        $payload['category'] = $payload['new_category']
            ?: $payload['category_selected']
            ?: null;

        $payload['url_image'] = $payload['url_image'] ?? null;

        if ($payload['is_rentable']) {
            $payload['rental_price_per_day'] = $payload['rental_price_per_day'] ?? null;
            $payload['rental_stock'] = $payload['rental_stock'] ?? 0;
            $payload['penalty_per_days'] = $payload['penalty_per_days'] ?? 0;
        } else {
            $payload['rental_price_per_day'] = null;
            $payload['rental_stock'] = 0;
            $payload['penalty_per_days'] = 0;
        }

        if ($payload['is_sellable']) {
            $payload['sale_price'] = $payload['sale_price'] ?? null;
            $payload['sale_stock'] = $payload['sale_stock'] ?? 0;
        } else {
            $payload['sale_price'] = null;
            $payload['sale_stock'] = 0;
        }

        unset($payload['category_selected'], $payload['new_category']);

        Item::create($payload);

        return redirect()
            ->route('admin.items.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Item $item)
    {
        $categories = Item::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('admin.items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        $validator = Validator::make($request->all(), [
            'item_name'           => ['required', 'string', 'max:100'],
            'description'         => ['nullable', 'string'],
            'category_selected'   => ['nullable', 'string', 'max:20'],
            'new_category'        => ['nullable', 'string', 'max:20'],
            'url_image'           => ['nullable', 'url', 'max:255'],
            'rental_price_per_day'=> ['nullable', 'numeric', 'min:0'],
            'sale_price'          => ['nullable', 'numeric', 'min:0'],
            'rental_stock'        => ['nullable', 'integer', 'min:0', 'max:255'],
            'sale_stock'          => ['nullable', 'integer', 'min:0', 'max:255'],
            'penalty_per_days'    => ['nullable', 'numeric', 'min:0'],
            'is_rentable'         => ['required', 'boolean'],
            'is_sellable'         => ['required', 'boolean'],
        ]);

        $validator->after(function ($validator) use ($request) {
            $rentable = $request->boolean('is_rentable');
            $sellable = $request->boolean('is_sellable');

            if ($rentable === $sellable) {
                $validator->errors()->add('is_rentable', 'Pilih salah satu: hanya sewa atau hanya jual.');
            }
        });

        $validated = $validator->validate();

        $payload = $validated;

        $payload['category'] = $payload['new_category']
            ?: $payload['category_selected']
            ?: $item->category;

        if ($payload['is_rentable']) {
            $payload['rental_stock'] = $payload['rental_stock'] ?? 0;
            $payload['penalty_per_days'] = $payload['penalty_per_days'] ?? 0;
            $payload['rental_price_per_day'] = $payload['rental_price_per_day'] ?? null;
        } else {
            $payload['rental_stock'] = 0;
            $payload['penalty_per_days'] = 0;
            $payload['rental_price_per_day'] = null;
        }

        if ($payload['is_sellable']) {
            $payload['sale_stock'] = $payload['sale_stock'] ?? 0;
            $payload['sale_price'] = $payload['sale_price'] ?? null;
        } else {
            $payload['sale_stock'] = 0;
            $payload['sale_price'] = null;
        }

        unset($payload['category_selected'], $payload['new_category']);

        $item->update($payload);

        return redirect()
            ->route('admin.items.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()
            ->route('admin.items.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
