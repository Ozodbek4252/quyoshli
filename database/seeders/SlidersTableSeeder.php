<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;

class SlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::create([
            'name' => 'banner1',
            'link' => 'https://',
            'language' => 'ru',
            'type' => 'mobile',
            'image' => 'vendor/site/img/banner_img.png',
            'placement' => 'top'
        ]);

        Slider::create([
            'name' => 'banner2',
            'link' => 'https://',
            'language' => 'ru',
            'type' => 'mobile',
            'image' => 'vendor/site/img/banner_img2.png',
            'placement' => 'top'
        ]);

        Slider::create([
            'name' => 'banner3',
            'link' => 'https://',
            'language' => 'ru',
            'type' => 'mobile',
            'image' => 'vendor/site/img/banner_img3.png',
            'placement' => 'top'
        ]);

        Slider::create([
            'name' => 'banner1',
            'link' => 'https://',
            'language' => 'uz',
            'type' => 'mobile',
            'image' => 'vendor/site/img/banner_img.png',
            'placement' => 'top'
        ]);

        Slider::create([
            'name' => 'banner2',
            'link' => 'https://',
            'language' => 'uz',
            'type' => 'mobile',
            'image' => 'vendor/site/img/banner_img2.png',
            'placement' => 'top'
        ]);

        Slider::create([
            'name' => 'banner3',
            'link' => 'https://',
            'language' => 'uz',
            'type' => 'mobile',
            'image' => 'vendor/site/img/banner_img3.png',
            'placement' => 'top'
        ]);

        Slider::create([
            'name' => 'banner1',
            'link' => 'https://',
            'language' => 'ru',
            'type' => 'desktop',
            'image' => 'vendor/site/img/banner_img.png',
            'placement' => 'top'
        ]);

        Slider::create([
            'name' => 'banner2',
            'link' => 'https://',
            'language' => 'ru',
            'type' => 'desktop',
            'image' => 'vendor/site/img/banner_img2.png',
            'placement' => 'top'
        ]);

        Slider::create([
            'name' => 'banner3',
            'link' => 'https://',
            'language' => 'ru',
            'type' => 'desktop',
            'image' => 'vendor/site/img/banner_img3.png',
            'placement' => 'top'
        ]);

        Slider::create([
            'name' => 'banner1',
            'link' => 'https://',
            'language' => 'uz',
            'type' => 'desktop',
            'image' => 'vendor/site/img/banner_img.png',
            'placement' => 'top'
        ]);

        Slider::create([
            'name' => 'banner2',
            'link' => 'https://',
            'language' => 'uz',
            'type' => 'desktop',
            'image' => 'vendor/site/img/banner_img2.png',
            'placement' => 'top'
        ]);

        Slider::create([
            'name' => 'banner3',
            'link' => 'https://',
            'language' => 'uz',
            'type' => 'desktop',
            'image' => 'vendor/site/img/banner_img3.png',
            'placement' => 'top'
        ]);

        Slider::create([
            'name' => 'banner4',
            'link' => 'https://',
            'language' => 'ru',
            'type' => 'desktop',
            'image' => 'vendor/site/img/banner_img3.png',
            'placement' => 'middle'
        ]);

        Slider::create([
            'name' => 'banner4',
            'link' => 'https://',
            'language' => 'uz',
            'type' => 'desktop',
            'image' => 'vendor/site/img/banner_img3.png',
            'placement' => 'middle'
        ]);

        Slider::create([
            'name' => 'banner4',
            'link' => 'https://',
            'language' => 'ru',
            'type' => 'mobile',
            'image' => 'vendor/site/img/banner_img3.png',
            'placement' => 'middle'
        ]);

        Slider::create([
            'name' => 'banner4',
            'link' => 'https://',
            'language' => 'uz',
            'type' => 'mobile',
            'image' => 'vendor/site/img/banner_img3.png',
            'placement' => 'middle'
        ]);
    }
}
