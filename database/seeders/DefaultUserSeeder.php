<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::query()->updateOrCreate(['email' => 'user@twitter.com'], [
            'name' => 'Yousef', 'nick_name' => 'Yousef', 'avatar' => null,
            'phone' => '0790000000', 'password' => Hash::make('secret'),
        ]);

        User::query()->updateOrCreate(['email' => 'follower@twitter.com'], [
            'name' => 'Follower', 'nick_name' => 'Follower', 'avatar' => null,
            'phone' => '0790000001', 'password' => Hash::make('secret'),
        ]);

        User::query()->updateOrCreate(['email' => 'follower1@twitter.com'], [
            'name' => 'Follower1', 'nick_name' => 'Follower1', 'avatar' => null,
            'phone' => '0790000002', 'password' => Hash::make('secret'),
        ]);
    }
}
