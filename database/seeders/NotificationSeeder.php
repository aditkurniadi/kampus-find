<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua user yang ada
        $users = User::all();

        // Loop setiap user, beri masing-masing 5-10 notifikasi acak
        foreach ($users as $user) {
            Notification::factory(rand(5, 10))->create([
                'user_id' => $user->id
            ]);
        }
    }
}
