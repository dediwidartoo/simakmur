<?php

use Carbon\Carbon;
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
        factory(App\Models\User::class,40)->create();
        
        $user = [
            [
                'nama'              => 'Dedi Widarto',
                'username'          => 'dediwidarto',
                'email'             => 'admin@simakmur.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('simakmur'),
                'remember_token'    => Str::random(10),
                'api_token'         => Str::random(18),
                'is_admin'          => true,
                'created_at'        =>  Carbon::now(),
            ],
            [
                'nama'              => 'User Biasa',
                'username'          => 'user',
                'email'             => 'user@simakmur.com',
                'email_verified_at' => now(),
                'password'          => bcrypt('simakmur'),
                'remember_token'    => Str::random(10),
                'api_token'         => Str::random(18),
                'is_admin'          => false,
                'created_at'        =>  Carbon::now(),
            ]
        ];
        
        // DB::table('users')->insert($user);
        // factory(App\Models\User::class,50)->create();

        \App\Models\User::insert($user);
    }
}
