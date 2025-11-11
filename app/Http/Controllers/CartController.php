<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // KEY session untuk cart
    private const SESSION_KEY = 'cart.items'; // bentuk: [product_id => qty]

    /**
     * Tampilkan isi keranjang (dari session).
     */
    public function index()
    {
        $items = collect(session(self::SESSION_KEY, [])); // [id => qty]
        $products = Product::whereIn('id', $items->keys())
            ->get()
            ->keyBy('id');

        // susun baris yang siap dipakai di view
        $rows = $items->map(function ($qty, $productId) use ($products) {
            $p = $products->get($productId);
            if (!$p) return null;

            return [
                'product' => $p,
                'qty'     => (int) $qty,
                'price'   => (int) $p->price,              // asumsikan kolom price di products
                'total'   => (int) $p->price * (int) $qty,
            ];
        })->filter(); // buang null bila ada id yang tidak ditemukan

        $subtotal = (int) $rows->sum('total');

        return view('cart.index', [
            'rows'     => $rows,
            'subtotal' => $subtotal,
        ]);
    }

    /**
     * Tambah produk ke keranjang (session).
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'qty'        => ['nullable', 'integer', 'min:1'],
        ]);
        $qty = (int) ($data['qty'] ?? 1);

        $items = collect(session(self::SESSION_KEY, []));
        $items[$data['product_id']] = ($items[$data['product_id']] ?? 0) + $qty;

        session([self::SESSION_KEY => $items->toArray()]);

        return back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    /**
     * Ubah jumlah (qty) item tertentu.
     * Route: PATCH /cart/{product}
     */
    public function update(Request $request, Product $product)
    {
        $qty = (int) $request->validate([
            'qty' => ['required', 'integer', 'min:1'],
        ])['qty'];

        $items = collect(session(self::SESSION_KEY, []));
        if ($items->has($product->id)) {
            $items[$product->id] = $qty;
            session([self::SESSION_KEY => $items->toArray()]);
        }

        return back()->with('success', 'Jumlah produk diperbarui.');
    }

    /**
     * Hapus satu item dari keranjang.
     * Route: DELETE /cart/{product}
     */
    public function destroy(Product $product)
    {
        $items = collect(session(self::SESSION_KEY, []));
        $items->forget($product->id);
        session([self::SESSION_KEY => $items->toArray()]);

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
