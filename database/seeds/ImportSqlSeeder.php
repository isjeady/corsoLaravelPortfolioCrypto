<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportSqlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=ImportSqlSeeder
        $sql = file_get_contents(database_path('seeds/demo.sql'));
		DB::unprepared($sql);
        $this->command->info('Demo table imported!');
    }
}
