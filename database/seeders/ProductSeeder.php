<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Categories
        $categories = [
            'Oli Motor',
            'Lampu Motor',
            'Ban Motor',
            'Sparepart'
        ];

        // Insert categories
        $categoryIds = [];
        foreach ($categories as $category) {
            $categoryIds[$category] = DB::table('categories')->insertGetId([
                'name' => $category,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Products data
        $products = [
            // Oli Motor
            [
                'name' => 'Shell Advance AX5 10W-40',
                'category_id' => $categoryIds['Oli Motor'],
                'price' => 85000,
                'stock' => 20,
                'description' => 'Oli mesin berkualitas untuk performa optimal.',
                'image' => 'shell_ax5.jpg',
            ],
            [
                'name' => 'Castrol Power1 15W-50',
                'category_id' => $categoryIds['Oli Motor'],
                'price' => 95000,
                'stock' => 15,
                'description' => 'Pelumas premium untuk kendaraan roda dua.',
                'image' => 'castrol_power1.jpg',
            ],
            [
                'name' => 'Federal Oil Ultratec 10W-30',
                'category_id' => $categoryIds['Oli Motor'],
                'price' => 75000,
                'stock' => 30,
                'description' => 'Oli motor hemat bahan bakar.',
                'image' => 'federal_ultratec.jpg',
            ],
            [
                'name' => 'Motul 5100 Ester 10W-40',
                'category_id' => $categoryIds['Oli Motor'],
                'price' => 120000,
                'stock' => 10,
                'description' => 'Pelumas motor performa tinggi.',
                'image' => 'motul_5100.jpg',
            ],
            [
                'name' => 'Pertamina Enduro 4T 10W-40',
                'category_id' => $categoryIds['Oli Motor'],
                'price' => 65000,
                'stock' => 25,
                'description' => 'Oli motor lokal dengan kualitas terjamin.',
                'image' => 'pertamina_enduro.jpg',
            ],

            // Lampu Motor
            [
                'name' => 'Philips MotoVision H4',
                'category_id' => $categoryIds['Lampu Motor'],
                'price' => 125000,
                'stock' => 10,
                'description' => 'Lampu motor dengan pencahayaan optimal.',
                'image' => 'philips_motovision.jpg',
            ],
            [
                'name' => 'Osram Night Racer 110',
                'category_id' => $categoryIds['Lampu Motor'],
                'price' => 140000,
                'stock' => 8,
                'description' => 'Lampu motor untuk malam hari.',
                'image' => 'osram_night_racer.jpg',
            ],
            [
                'name' => 'Autovision LED M3',
                'category_id' => $categoryIds['Lampu Motor'],
                'price' => 95000,
                'stock' => 12,
                'description' => 'Lampu LED hemat energi.',
                'image' => 'autovision_led.jpg',
            ],
            [
                'name' => 'Stanley Halogen HS1',
                'category_id' => $categoryIds['Lampu Motor'],
                'price' => 85000,
                'stock' => 20,
                'description' => 'Lampu halogen untuk motor.',
                'image' => 'stanley_halogen.jpg',
            ],
            [
                'name' => 'Raja Motor Xenon H6',
                'category_id' => $categoryIds['Lampu Motor'],
                'price' => 70000,
                'stock' => 18,
                'description' => 'Lampu xenon berkualitas.',
                'image' => 'raja_motor_xenon.jpg',
            ],

            // Ban Motor
            [
                'name' => 'Pirelli Diablo Rosso II 90/90-14',
                'category_id' => $categoryIds['Ban Motor'],
                'price' => 350000,
                'stock' => 10,
                'description' => 'Ban motor performa tinggi.',
                'image' => 'pirelli_diablo.jpg',
            ],
            [
                'name' => 'Michelin Pilot Street 100/80-14',
                'category_id' => $categoryIds['Ban Motor'],
                'price' => 300000,
                'stock' => 8,
                'description' => 'Ban motor untuk kenyamanan.',
                'image' => 'michelin_pilot.jpg',
            ],
            [
                'name' => 'IRC NR91 80/90-14',
                'category_id' => $categoryIds['Ban Motor'],
                'price' => 200000,
                'stock' => 20,
                'description' => 'Ban motor ekonomis.',
                'image' => 'irc_nr91.jpg',
            ],
            [
                'name' => 'Dunlop D604 120/70-17',
                'category_id' => $categoryIds['Ban Motor'],
                'price' => 400000,
                'stock' => 5,
                'description' => 'Ban motor adventure.',
                'image' => 'dunlop_d604.jpg',
            ],
            [
                'name' => 'Bridgestone Battlax 110/70-17',
                'category_id' => $categoryIds['Ban Motor'],
                'price' => 450000,
                'stock' => 7,
                'description' => 'Ban motor racing.',
                'image' => 'bridgestone_battlax.jpg',
            ],

            // Sparepart
            [
                'name' => 'Busi NGK CR7HSA',
                'category_id' => $categoryIds['Sparepart'],
                'price' => 25000,
                'stock' => 50,
                'description' => 'Busi motor berkualitas.',
                'image' => 'ngk_cr7hsa.jpg',
            ],
            [
                'name' => 'Kampas Rem Yamaha NMAX',
                'category_id' => $categoryIds['Sparepart'],
                'price' => 80000,
                'stock' => 20,
                'description' => 'Kampas rem untuk Yamaha NMAX.',
                'image' => 'kampas_rem_nmax.jpg',
            ],
            [
                'name' => 'Filter Oli Honda Vario',
                'category_id' => $categoryIds['Sparepart'],
                'price' => 50000,
                'stock' => 30,
                'description' => 'Filter oli berkualitas.',
                'image' => 'filter_oli_vario.jpg',
            ],
            [
                'name' => 'Rantai DID 428HD',
                'category_id' => $categoryIds['Sparepart'],
                'price' => 120000,
                'stock' => 15,
                'description' => 'Rantai motor tahan lama.',
                'image' => 'rantai_did.jpg',
            ],
            [
                'name' => 'Bearing Roda FAG', 'category_id' => $categoryIds['Sparepart'],
                'price' => 70000,
                'stock' => 25,
                'description' => 'Bearing roda berkualitas.',
                'image' => 'bearing_fag.jpg',
            ],
        ];

        // Insert products
        foreach ($products as $product) {
            DB::table('products')->insert([
                'name' => $product['name'],
                'category_id' => $product['category_id'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'description' => $product['description'],
                'image' => $product['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
