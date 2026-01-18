<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $electronics = Category::where('name', 'Electronics')->first();
        $fashion = Category::where('name', 'Fashion')->first();
        $homeAndLiving = Category::where('name', 'Home & Living')->first();
        $books = Category::where('name', 'Books')->first();
        $sports = Category::where('name', 'Sports')->first();
        $foodAndBeverage = Category::where('name', 'Food & Beverage')->first();

        $products = [
            // Electronics
            [
                'category_id' => $electronics->id,
                'name' => 'Wireless Mouse',
                'description' => 'Ergonomic wireless mouse with 2.4GHz connection and long battery life',
                'price' => 150000,
                'cost' => 100000,
                'stock' => 50,
            ],
            [
                'category_id' => $electronics->id,
                'name' => 'Mechanical Keyboard',
                'description' => 'RGB mechanical gaming keyboard with blue switches',
                'price' => 750000,
                'cost' => 500000,
                'stock' => 30,
            ],
            [
                'category_id' => $electronics->id,
                'name' => 'USB-C Hub',
                'description' => '7-in-1 USB-C hub with HDMI, USB 3.0, and card reader',
                'price' => 350000,
                'cost' => 200000,
                'stock' => 40,
            ],
            [
                'category_id' => $electronics->id,
                'name' => 'Bluetooth Headphones',
                'description' => 'Noise-cancelling wireless headphones with 30-hour battery',
                'price' => 1200000,
                'cost' => 800000,
                'stock' => 25,
            ],

            // Fashion
            [
                'category_id' => $fashion->id,
                'name' => 'Cotton T-Shirt',
                'description' => 'Premium 100% cotton t-shirt in various colors',
                'price' => 99000,
                'cost' => 50000,
                'stock' => 100,
            ],
            [
                'category_id' => $fashion->id,
                'name' => 'Denim Jeans',
                'description' => 'Classic fit denim jeans with stretch fabric',
                'price' => 350000,
                'cost' => 200000,
                'stock' => 60,
            ],
            [
                'category_id' => $fashion->id,
                'name' => 'Leather Wallet',
                'description' => 'Genuine leather bifold wallet with multiple card slots',
                'price' => 250000,
                'cost' => 150000,
                'stock' => 45,
            ],
            [
                'category_id' => $fashion->id,
                'name' => 'Sunglasses',
                'description' => 'UV protection polarized sunglasses',
                'price' => 180000,
                'cost' => 100000,
                'stock' => 35,
            ],

            // Home & Living
            [
                'category_id' => $homeAndLiving->id,
                'name' => 'Coffee Maker',
                'description' => 'Automatic drip coffee maker with programmable timer',
                'price' => 650000,
                'cost' => 400000,
                'stock' => 20,
            ],
            [
                'category_id' => $homeAndLiving->id,
                'name' => 'Ceramic Mug Set',
                'description' => 'Set of 4 handcrafted ceramic mugs',
                'price' => 120000,
                'cost' => 70000,
                'stock' => 50,
            ],
            [
                'category_id' => $homeAndLiving->id,
                'name' => 'Throw Pillow',
                'description' => 'Decorative throw pillow with soft velvet cover',
                'price' => 85000,
                'cost' => 45000,
                'stock' => 80,
            ],
            [
                'category_id' => $homeAndLiving->id,
                'name' => 'Wall Clock',
                'description' => 'Modern minimalist wall clock with silent mechanism',
                'price' => 195000,
                'cost' => 120000,
                'stock' => 30,
            ],

            // Books
            [
                'category_id' => $books->id,
                'name' => 'Programming Guide',
                'description' => 'Comprehensive guide to modern web development',
                'price' => 250000,
                'cost' => 150000,
                'stock' => 40,
            ],
            [
                'category_id' => $books->id,
                'name' => 'Business Strategy Book',
                'description' => 'Essential strategies for growing your business',
                'price' => 180000,
                'cost' => 100000,
                'stock' => 35,
            ],
            [
                'category_id' => $books->id,
                'name' => 'Novel Collection',
                'description' => 'Bestselling fiction novel collection',
                'price' => 150000,
                'cost' => 90000,
                'stock' => 55,
            ],

            // Sports
            [
                'category_id' => $sports->id,
                'name' => 'Yoga Mat',
                'description' => 'Non-slip yoga mat with carrying strap',
                'price' => 250000,
                'cost' => 150000,
                'stock' => 45,
            ],
            [
                'category_id' => $sports->id,
                'name' => 'Resistance Bands Set',
                'description' => 'Set of 5 resistance bands for home workout',
                'price' => 180000,
                'cost' => 100000,
                'stock' => 60,
            ],
            [
                'category_id' => $sports->id,
                'name' => 'Water Bottle',
                'description' => 'Insulated stainless steel water bottle 750ml',
                'price' => 120000,
                'cost' => 70000,
                'stock' => 70,
            ],
            [
                'category_id' => $sports->id,
                'name' => 'Jump Rope',
                'description' => 'Adjustable speed jump rope for cardio workout',
                'price' => 85000,
                'cost' => 45000,
                'stock' => 50,
            ],

            // Food & Beverage
            [
                'category_id' => $foodAndBeverage->id,
                'name' => 'Premium Coffee Beans',
                'description' => 'Arabica coffee beans from premium estate 250g',
                'price' => 95000,
                'cost' => 55000,
                'stock' => 100,
            ],
            [
                'category_id' => $foodAndBeverage->id,
                'name' => 'Organic Green Tea',
                'description' => 'Organic green tea leaves 100g',
                'price' => 75000,
                'cost' => 40000,
                'stock' => 80,
            ],
            [
                'category_id' => $foodAndBeverage->id,
                'name' => 'Honey Jar',
                'description' => 'Pure natural honey 500g',
                'price' => 120000,
                'cost' => 70000,
                'stock' => 60,
            ],
            [
                'category_id' => $foodAndBeverage->id,
                'name' => 'Snack Box',
                'description' => 'Assorted healthy snacks variety pack',
                'price' => 150000,
                'cost' => 90000,
                'stock' => 40,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
