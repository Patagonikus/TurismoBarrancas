<?php

use App\PriceTag;
use Illuminate\Database\Seeder;

class PriceTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PriceTag::create([
            'min'=>0,
            'max'=>350000,
        ]);

        PriceTag::create([
            'min'=>350000,
            'max'=>750000,
        ]);

        PriceTag::create([
            'min'=>750000,
            'max'=>99999999,
        ]);
    }
}
