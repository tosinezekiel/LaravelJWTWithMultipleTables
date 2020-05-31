<?php

use Illuminate\Database\Seeder;

class InvestmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Investment::class, 5)->create();
    }
}
