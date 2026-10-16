<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Channel;
use App\Models\Content;
use Illuminate\Support\Facades\Hash;;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Dummy Creator
        $user = User::create([
            'name' => 'dummy_teo',
            'email' => 'dummyteo@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        // 2. Buat Channel Dummy untuk User tersebut
        $channel = Channel::create([
            'user_id' => $user->id,
            'platform' => 'youtube',
            'handle_name' => '@techcreator',
        ]);

        // 3. Buat Konten Dummy
        Content::create([
            'user_id' => $user->id,
            'channel_id' => $channel->id,
            'title' => 'Belajar Laravel 12 untuk Pemula',
            'description' => 'Video pengenalan dasar laravel dari awal sampai deploy.',
            'format_type' => 'long_video',
            'status' => 'idea',
            'priority' => 'high',
        ]);
    }
}
