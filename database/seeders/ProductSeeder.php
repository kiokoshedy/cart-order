<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'iPad',
                'description' => 'The latest iPad with advanced features.',
                'price' => 799.99,
                'stock' => 20,
                'image' => 'products/ipad.jpg',
            ],
            [
                'name' => 'iPhone',
                'description' => 'Apple iPhone with incredible performance.',
                'price' => 999.99,
                'stock' => 30,
                'image' => 'products/iphone.jpg',
            ],
            [
                'name' => 'iPhone 12',
                'description' => 'The iPhone 12 with a stunning design.',
                'price' => 899.99,
                'stock' => 25,
                'image' => 'products/iphone12.jpg',
            ],
            [
                'name' => 'iPhone 13',
                'description' => 'The iPhone 13 with enhanced features.',
                'price' => 999.99,
                'stock' => 25,
                'image' => 'products/iphone13.jpg',
            ],
            [
                'name' => 'iPhone 14',
                'description' => 'The iPhone 14 with an improved camera.',
                'price' => 1099.99,
                'stock' => 20,
                'image' => 'products/iphone14.jpg',
            ],
            [
                'name' => 'iPhone 15',
                'description' => 'The iPhone 15 with the latest technology.',
                'price' => 1199.99,
                'stock' => 15,
                'image' => 'products/iphone15.jpg',
            ],
            [
                'name' => 'iPhone 16',
                'description' => 'The future-ready iPhone 16.',
                'price' => 1299.99,
                'stock' => 10,
                'image' => 'products/iphone16.jpg',
            ],
            [
                'name' => 'Keyboard',
                'description' => 'A mechanical keyboard for smooth typing.',
                'price' => 79.99,
                'stock' => 50,
                'image' => 'products/keyboard.jpg',
            ],
            [
                'name' => 'Mac M2',
                'description' => 'The powerful Mac M2 laptop.',
                'price' => 1999.99,
                'stock' => 8,
                'image' => 'products/macM2.jpg',
            ],
            [
                'name' => 'TV',
                'description' => 'A high-definition smart TV.',
                'price' => 599.99,
                'stock' => 10,
                'image' => 'products/tv.jpg',
            ],
            [
                'name' => 'iPad',
                'description' => 'The latest iPad with advanced features.',
                'price' => 799.99,
                'stock' => 20,
                'image' => 'products/ipad.jpg',
            ],
            [
                'name' => 'iPhone',
                'description' => 'Apple iPhone with incredible performance.',
                'price' => 999.99,
                'stock' => 30,
                'image' => 'products/iphone.jpg',
            ],
            [
                'name' => 'iPhone 12',
                'description' => 'The iPhone 12 with a stunning design.',
                'price' => 899.99,
                'stock' => 25,
                'image' => 'products/iphone12.jpg',
            ],
            [
                'name' => 'iPhone 13',
                'description' => 'The iPhone 13 with enhanced features.',
                'price' => 999.99,
                'stock' => 25,
                'image' => 'products/iphone13.jpg',
            ],
            [
                'name' => 'iPhone 14',
                'description' => 'The iPhone 14 with an improved camera.',
                'price' => 1099.99,
                'stock' => 20,
                'image' => 'products/iphone14.jpg',
            ],
            [
                'name' => 'iPhone 15',
                'description' => 'The iPhone 15 with the latest technology.',
                'price' => 1199.99,
                'stock' => 15,
                'image' => 'products/iphone15.jpg',
            ],
            [
                'name' => 'iPhone 16',
                'description' => 'The future-ready iPhone 16.',
                'price' => 1299.99,
                'stock' => 10,
                'image' => 'products/iphone16.jpg',
            ],
            [
                'name' => 'Keyboard',
                'description' => 'A mechanical keyboard for smooth typing.',
                'price' => 79.99,
                'stock' => 50,
                'image' => 'products/keyboard.jpg',
            ],
            [
                'name' => 'Mac M2',
                'description' => 'The powerful Mac M2 laptop.',
                'price' => 1999.99,
                'stock' => 8,
                'image' => 'products/macM2.jpg',
            ],
            [
                'name' => 'TV',
                'description' => 'A high-definition smart TV.',
                'price' => 599.99,
                'stock' => 10,
                'image' => 'products/tv.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

