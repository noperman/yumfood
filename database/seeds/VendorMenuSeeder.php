<?php

use Illuminate\Database\Seeder;

class VendorMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\VendorMenu::class, 50)->create();
    }
}
