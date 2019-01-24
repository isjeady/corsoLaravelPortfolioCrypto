<?php

use Illuminate\Database\Seeder;

class TruncateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //php artisan db:seed --class=TruncateSeeder
        DB::table('cryptocurrencies')->truncate();
        $this->command->info('Truncate Executed!');
    }
}
