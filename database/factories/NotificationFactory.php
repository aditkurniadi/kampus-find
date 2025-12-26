<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    public function definition(): array
    {
        // Tentukan tipe secara acak
        $types = ['reward', 'system', 'info'];
        $selectedType = $this->faker->randomElement($types);

        // Tentukan Judul & Pesan berdasarkan Tipe agar terlihat real
        $content = match ($selectedType) {
            'reward' => [
                'title' => '🏆 Hore! Poin Kepercayaan Bertambah',
                'message' => 'Selamat! Anda mendapatkan +10 Poin Kepercayaan karena telah mengembalikan barang ' . $this->faker->words(2, true) . ' kepada pemiliknya. Teruskan perbuatan baikmu!'
            ],
            'system' => [
                'title' => '⚙️ Jadwal Maintenance Sistem',
                'message' => 'Halo Pengguna, sistem Kampus Find akan melakukan pemeliharaan pada ' . $this->faker->date() . '. Mohon maaf atas ketidaknyamanan sementara.'
            ],
            default => [ // Info
                'title' => '📩 Laporan Barang Ditemukan',
                'message' => 'Halo, ada laporan barang baru di area ' . $this->faker->word() . ' yang mungkin sesuai dengan ciri-ciri barang Anda yang hilang. Silakan cek sekarang.'
            ],
        };

        return [
            // User ID nanti di-override di Seeder
            'user_id' => User::factory(),
            'title'   => $content['title'],
            'message' => $content['message'],
            'type'    => $selectedType,
            'is_read' => $this->faker->boolean(20), // 20% peluang sudah dibaca, sisanya unread
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
