<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $region1 = Region::create([
            'name' => [
                'ru' => 'Ташкент',
                'uz' => 'Toshkent'
            ]
        ]);

        $region1->cities()->createMany([
            [
                'name' => [
                    'ru' => 'Город Ташкент',
                    'uz' => 'Toshkent shahri'
                ]
            ],
            [
                'name' => [
                    'ru' => 'Город Бука',
                    'uz' => 'Bo`ka shahri'
                ]
            ],
        ]);
    }
}
