<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // contoh 4 item tetap
        $preset = [
            ['name'=>'Sepatu Gunung Eiger EAGLE PLUM 2.0','slug'=>'eiger-eagle-plum-20','price'=>25000,'image_url'=>'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&auto=format','stock'=>12,'description'=>'Sepatu mid cut untuk hiking, waterproof.'],
            ['name'=>'Tenda Dome 2P','slug'=>'tenda-dome-2p','price'=>450000,'image_url'=>'https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?q=80&auto=format','stock'=>20],
            ['name'=>'Sleeping Bag 10°C','slug'=>'sleeping-bag-10c','price'=>230000,'image_url'=>'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&auto=format','stock'=>35],
            ['name'=>'Carrier 45L','slug'=>'carrier-45l','price'=>375000,'image_url'=>'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&auto=format','stock'=>15],
        ];
        foreach ($preset as $p) {
            Product::updateOrCreate(['slug'=>$p['slug']], $p);
        }

        // tambah dummy lain
        Product::factory()->count(16)->create();
    }
}

