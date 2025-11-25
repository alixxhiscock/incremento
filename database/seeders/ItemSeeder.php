<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::updateOrCreate(['name' => 'Coal Ore'], ['npc_sell' => 50]);
        Item::updateOrCreate(['name' => 'Tin Ore'], ['npc_sell' => 80]);
    }
}
