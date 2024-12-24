<?php

namespace Database\Seeders;

use App\Models\Asset;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Asset::create([
                'kodeasset' => 'A' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'namaasset' => 'Asset ' . $i,
                'tglbeli' => now()->subDays($i),
                'hrgbeli' => rand(1000000, 10000000),
                'aktif' => $i % 2 == 0 ? 'Y' : 'N',
            ]);
        }
    }
}
