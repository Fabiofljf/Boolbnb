<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\Apartment;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 20; $i++) {
            $apartment = new Apartment;
            $apartment->title = $faker->sentence(4);
            $apartment->slug = Str::slug($apartment->title, '-');
            $apartment->thumb = $faker->imageUrl(600, 400, 'thumb_apartment', true, 'thumb', true, 'jpg');
            $apartment->description = $faker->text(500);
            $apartment->address = $faker->address();
            $apartment->save();
        }
    }
}
