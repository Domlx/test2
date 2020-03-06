<?php

use App\Models\Requests;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class RequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        factory(Requests::class, 30)->create();
    }
}
