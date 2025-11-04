<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void {

        // Create sample categories
        $roses = \App\Models\Category::create(['name'=>'Roses']);
        $tulips = \App\Models\Category::create(['name'=>'Tulips']);

        // Insert multiple sample flowers
        \App\Models\Flower::insert([
            ['category_id'=>$roses->id,'name'=>'Red Rose','type'=>'Hybrid Tea','price'=>3.50],
            ['category_id'=>$roses->id,'name'=>'White Rose','type'=>'Floribunda','price'=>3.20],
            ['category_id'=>$tulips->id,'name'=>'Yellow Tulip','type'=>'Single Early','price'=>2.10],
            ['category_id'=>$tulips->id,'name'=>'Purple Tulip','type'=>'Triumph','price'=>2.40],
    ]);
}

}
