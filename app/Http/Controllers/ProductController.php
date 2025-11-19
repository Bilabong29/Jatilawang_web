<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Mengambil semua item dari database sebagai katalog
        $items = Item::all();
        return view('products.index', ['items' => $items]);
    }

    public function show($item_id)
    {
        // Ambil item berdasarkan item_id
        $item = Item::where('item_id', $item_id)->firstOrFail();

        // convert to array structure used by the Blade view (compat with previous in-memory arrays)
        $product = [
            'id' => $item->item_id,
            'slug' => (string) $item->item_id,
            'name' => $item->item_name,
            'price' => 'Rp ' . number_format($item->rental_price_per_day ?? 0, 0, ',', '.') . ' / Hari',
            'numeric_price' => (int) ($item->rental_price_per_day ?? 0),
            'img' => basename($item->url_image ?? ''),
            'img_url' => $item->url_image ?? null,
            'desc' => $item->description ?? '',
            'material' => $item->material ?? null,
            'stock' => $item->rental_stock ?? 0,
            'category' => $item->category ?? null,
        ];

        // related products from DB by same category (fallback random if category null)
        if ($product['category']) {
            $related = Item::where('category', $product['category'])
                ->where('item_id', '!=', $item->item_id)
                ->limit(4)
                ->get();
        } else {
            $related = Item::where('item_id', '!=', $item->item_id)
                ->inRandomOrder()
                ->limit(4)
                ->get();
        }

        $relatedProducts = $related->map(function($it){
            return [
                'id' => $it->item_id,
                'slug' => (string) $it->item_id,
                'name' => $it->item_name,
                'price' => 'Rp ' . number_format($it->rental_price_per_day ?? 0, 0, ',', '.') . ' / Hari',
                'img' => basename($it->url_image ?? ''),
                'img_url' => $it->url_image ?? null,
                'category' => $it->category ?? null,
            ];
        })->toArray();

        return view('products.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}