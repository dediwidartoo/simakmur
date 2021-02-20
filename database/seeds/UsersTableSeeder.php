<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'nama'              => 'Dedi Widarto',
            'username'          => 'dediwidarto',
            'email'             => 'admin@simakmur.com',
            'email_verified_at' => now(),
            'password'          => bcrypt('simakmur'),
            'remember_token'    => Str::random(10),
            'api_token'         => Str::random(18),
            'is_admin'          => true,
        ];
        
        DB::table('users')->insert($user);

        factory(App\Models\User::class,50)->create();
    }
}
