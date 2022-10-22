<?php

use Illuminate\Database\Seeder;
use App\Registration;

class RegistrationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Registration::class, 1000)->create();
    }
}
