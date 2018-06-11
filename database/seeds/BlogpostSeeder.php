<?php

use Illuminate\Database\Seeder;

class BlogpostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\blogpost::class, 30)->create();
    }
}
