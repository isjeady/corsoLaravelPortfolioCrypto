<?php

use Illuminate\Database\Seeder;

class CryptoCurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        //

        //php artisan db:seed --class=CryptoCurrenciesSeeder
        //php artisan migrate:refresh --seed

        DB::table('cryptocurrencies')->truncate();

        for ($i=0; $i < 100; $i++) {
            DB::table('cryptocurrencies')->insert([
                'name_id' => $faker->userName,
                'name' => $faker->userName,
                'symbol' => $faker->userName,
                'site_store' => $faker->safeEmailDomain,
                'my_token' => $faker->randomFloat(4,0,5000),
                'price' => $faker->randomFloat(4,0,5000),
                'my_price' => $faker->boolean(50),
                'my_gain' => 0,
                'percent_change_24h' => $faker->numberBetween(1,100),
                'percent_change_7d' => $faker->numberBetween(1,100)
            ]);
        }

    }
}
