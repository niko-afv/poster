<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account_types')->truncate();

        DB::table('account_types')->insert([
            'name' => 'Facebook Fanpage',
            'icon' => 'fa-facebook-official'
        ]);
        DB::table('account_types')->insert([
            'name' => 'Instagram Account',
            'icon' => 'fa-instagram'
        ]);
    }
}
