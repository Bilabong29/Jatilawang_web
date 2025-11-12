<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // 🟢 Sepatu
            ['category_id' => 1, 'name' => 'Sepatu Gunung Eiger Plum 2.0', 'slug' => 'sepatu-gunung-eiger-plum-20', 'image' => 'sepatu-eiger-plum.png', 'price' => 25000, 'stock' => 3, 'material' => 'Full-grain leather', 'sizes' => json_encode([39, 40, 41, 42, 43]), 'description' => 'Sepatu hiking mid cut dengan sol anti slip dan bahan tahan air.'],
            ['category_id' => 1, 'name' => 'Sepatu Gunung Eiger Lynk', 'slug' => 'sepatu-gunung-eiger-lynk', 'image' => 'sepatu-gunung-lynk.png', 'price' => 25000, 'stock' => 3, 'material' => 'Waterproof leather', 'sizes' => json_encode([39, 40, 41, 42, 43]), 'description' => 'Sepatu hiking tangguh untuk jalur ekstrem.'],
            ['category_id' => 1, 'name' => 'Sepatu Gunung Rubtrack', 'slug' => 'sepatu-gunung-rubtrack', 'image' => 'sepatu-gunung-rubtrack.png', 'price' => 25000, 'stock' => 3, 'material' => 'Suede leather', 'sizes' => json_encode([39, 40, 41, 42, 43]), 'description' => 'Sepatu gunung dengan grip kuat dan desain stylish.'],
            ['category_id' => 1, 'name' => 'Sepatu Gunung Teon', 'slug' => 'sepatu-gunung-teon', 'image' => 'sepatu-gunung-teon.png', 'price' => 25000, 'stock' => 2, 'material' => 'Canvas anti air', 'sizes' => json_encode([39, 40, 41, 42]), 'description' => 'Sepatu ringan dan fleksibel untuk jalur lembab.'],
            ['category_id' => 1, 'name' => 'Sepatu Gunung Abu-Abu', 'slug' => 'sepatu-gunung-abu-abu', 'image' => 'sepatu-abu-abu.png', 'price' => 20000, 'stock' => 4, 'material' => 'Synthetic breathable', 'sizes' => json_encode([39, 40, 41]), 'description' => 'Sepatu serbaguna untuk hiking santai.'],
            ['category_id' => 1, 'name' => 'Sandal Gunung Eiger', 'slug' => 'sandal-gunung-eiger', 'image' => 'sandal-eiger.png', 'price' => 15000, 'stock' => 5, 'material' => 'Rubber outsole', 'sizes' => json_encode([38, 39, 40, 41, 42, 43]), 'description' => 'Sandal outdoor dengan grip kuat dan tali adjustable.'],

            // 🟢 Tenda
            ['category_id' => 2, 'name' => 'Tenda Camping', 'slug' => 'tenda-camping', 'image' => 'tenda-camping.png', 'price' => 35000, 'stock' => 2, 'material' => 'Polyester waterproof', 'sizes' => null, 'description' => 'Tenda ringan untuk 2–3 orang dengan ventilasi ganda.'],

            // 🟢 Jaket
            ['category_id' => 3, 'name' => 'Jaket Hitam Outdoor', 'slug' => 'jaket-hitam-outdoor', 'image' => 'jaket-hitam.png', 'price' => 30000, 'stock' => 3, 'material' => 'Waterproof nylon', 'sizes' => json_encode(['S','M','L','XL']), 'description' => 'Jaket tahan air dengan lapisan breathable dan saku dalam.'],

            // 🟢 Tas / Carrier
            ['category_id' => 4, 'name' => 'Carrier Eiger Streamline', 'slug' => 'carrier-eiger-streamline', 'image' => 'carrier-eiger-streamline.png', 'price' => 40000, 'stock' => 2, 'material' => 'Cordura 600D', 'sizes' => null, 'description' => 'Tas gunung 40L dengan bantalan punggung empuk.'],
            ['category_id' => 4, 'name' => 'Carrier Cosavior', 'slug' => 'carrier-cosavior', 'image' => 'carrier-cosavior.png', 'price' => 40000, 'stock' => 2, 'material' => 'Nylon + Mesh', 'sizes' => null, 'description' => 'Carrier besar dengan rain cover dan strap adjustable.'],
            ['category_id' => 4, 'name' => 'Carrier Streamline Bagian Belakang', 'slug' => 'carrier-streamline-bagian-belakang', 'image' => 'carrier-eiger-streamline-bagian-belakang.png', 'price' => 40000, 'stock' => 1, 'material' => 'Polyester tahan air', 'sizes' => null, 'description' => 'Tampilan belakang carrier streamline untuk ventilasi ekstra.'],

            // 🟢 Perlengkapan Hiking
            ['category_id' => 5, 'name' => 'Headlamp Antarestar', 'slug' => 'headlamp-antarestar', 'image' => 'headlamp-antarestar.png', 'price' => 10000, 'stock' => 4, 'material' => 'Plastic ABS', 'sizes' => null, 'description' => 'Headlamp terang dengan mode fokus dan flood.'],
            ['category_id' => 5, 'name' => 'Headlamp BigAdventure', 'slug' => 'headlamp-bigadventure', 'image' => 'headlamp-bigadventure.png', 'price' => 10000, 'stock' => 4, 'material' => 'Plastic ABS', 'sizes' => null, 'description' => 'Lampu kepala ringan dan tahan air untuk aktivitas malam.'],
            ['category_id' => 5, 'name' => 'Botol Minum Eiger', 'slug' => 'botol-minum-eiger', 'image' => 'botol-minum-eiger.png', 'price' => 15000, 'stock' => 6, 'material' => 'Aluminium + BPA Free', 'sizes' => null, 'description' => 'Botol 1L kuat dan tahan banting untuk kegiatan outdoor.'],
            ['category_id' => 5, 'name' => 'Celana Gunung', 'slug' => 'celana-gunung', 'image' => 'celana-gunung.png', 'price' => 20000, 'stock' => 4, 'material' => 'Ripstop fabric', 'sizes' => json_encode(['M','L','XL']), 'description' => 'Celana outdoor ringan dan cepat kering.'],
            ['category_id' => 5, 'name' => 'Kaos Kaki Oren', 'slug' => 'kaos-kaki-oren', 'image' => 'kaos-kaki-oren.png', 'price' => 5000, 'stock' => 10, 'material' => 'Cotton spandex', 'sizes' => json_encode([39, 40, 41, 42, 43]), 'description' => 'Kaos kaki nyaman untuk hiking.'],
            ['category_id' => 5, 'name' => 'Trekking Pole', 'slug' => 'treking-pole', 'image' => 'treking-pole.png', 'price' => 15000, 'stock' => 3, 'material' => 'Aluminium alloy', 'sizes' => null, 'description' => 'Tongkat pendakian ringan dan kuat untuk stabilitas.'],
            ['category_id' => 5, 'name' => 'Sleeping Bag Hijau', 'slug' => 'sleeping-bag-hijau', 'image' => 'sleeping-bag-hijau.png', 'price' => 25000, 'stock' => 3, 'material' => 'Polyester + Hollow cotton', 'sizes' => null, 'description' => 'Sleeping bag hangat untuk suhu dingin di gunung.'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
