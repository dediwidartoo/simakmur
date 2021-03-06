<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(ImagesProductTableSeeder::class);
        $this->call(TransactionsSeeder::class);
        $this->call(ArtikelTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ScheduleTableSeeder::class);
    }
}
