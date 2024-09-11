<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SettingSeeder::class,
            RolesTableSeeder::class,
            StaffsTableSeeder::class,
            PartnersTableSeeder::class,
            PostsTableSeeder::class,
            CategoriesTableSeeder::class,
            SlidersTableSeeder::class,
            SpecialOffersTableSeeder::class,
            PagesTableSeeder::class,
            CompilationsTableSeeder::class,
            CurrenciesTableSeeder::class,
            RegionsTableSeeder::class,

            UserSeeder::class,
            // UsersTableSeeder::class,
        ]);
    }
}
