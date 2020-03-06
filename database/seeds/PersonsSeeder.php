<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use App\Models\Persons;

class PersonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        factory(Persons::class, 10)->create();
    }
}
