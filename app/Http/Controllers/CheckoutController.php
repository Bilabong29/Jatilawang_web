<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CheckoutController extends Controller
{
    private const SESSION_KEY = 'cart.items';

    /**
     * Halaman checkout (wajib login — sudah diproteksi middleware 'auth' di routes).
     */
    public function index()
    {
        // Ambil isi cart dari session
        $items = collect(session(self::SESSION_KEY, [])); // [id => qty]

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('warning', 'Keranjang masih kosong.');
        }

        $products = Product::whereIn('id', $items->keys())->get()->keyBy('id');

        $rows = $items->map(function ($qty, $productId) use ($products) {
            $p = $products->get($productId);
            if (!$p) return null;

            return [
                'product' => $p,
                'qty'     => (int) $qty,
                'price'   => (int) $p->price,
                'total'   => (int) $p->price * (int) $qty,
            ];
        })->filter();

        if ($rows->isEmpty()) {
            return redirect()->route('cart.index')->with('warning', 'Keranjang masih kosong.');
        }

        $subtotal = (int) $rows->sum('total');

        return view('checkout.index', [
            'rows'     => $rows,
            'subtotal' => $subtotal,
            // bisa tambahkan ongkir, pajak, dsb di sini
        ]);
    }

    /**
     * Proses checkout sederhana (contoh).
     * Di sini biasanya:
     * - validasi alamat & metode bayar
     * - buat order + order_items
     * - panggil gateway pembayaran
     * - kosongkan cart session
     */
    public function process(Request $request)
    {
        $data = $request->validate([
            'name'    => ['required', 'string', 'max:100'],
            'phone'   => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:500'],
        ]);

        $items = collect(session(self::SESSION_KEY, []));
        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('warning', 'Keranjang masih kosong.');
        }

        // ---- pseudo create order (silakan ganti dengan implementasi real) ----
        // $order = \DB::transaction(function () use ($items, $data) {
        //     $order = auth()->user()->orders()->create([
        //         'name' => $data['name'],
        //         'phone' => $data['phone'],
        //         'address' => $data['address'],
        //         'status' => 'pending',
        //     ]);
        //     $products = Product::whereIn('id', $items->keys())->get()->keyBy('id');
        //     foreach ($items as $pid => $qty) {
        //         if (!isset($products[$pid])) continue;
        //         $order->items()->create([
        //             'product_id' => $pid,
        //             'qty'        => (int) $qty,
        //             'price'      => (int) $products[$pid]->price,
        //         ]);
        //     }
        //     return $order;
        // });

        // Kosongkan cart session setelah order dibuat
        session()->forget(self::SESSION_KEY);

        // return redirect()->route('orders.show', $order)->with('success', 'Order berhasil dibuat.');
        return redirect()->route('home')->with('success', 'Checkout berhasil (contoh). Implementasi order dapat ditambahkan.');
    }
}
