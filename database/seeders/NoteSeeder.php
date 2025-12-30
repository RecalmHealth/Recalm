<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NoteSeeder extends Seeder
{
    public function run(): void
    {
        $userId = 1; // Assuming default admin is ID 1
        $moods = ['Senang', 'Marah', 'Sedih'];
        $notes = [];

        // Generate data for the last 30 days
        for ($i = 0; $i < 30; $i++) {
            // Randomly skip some days to make it realistic
            if (rand(0, 10) > 8) continue;

            $date = Carbon::now()->subDays($i);
            $mood = $moods[array_rand($moods)];
            
            $notes[] = [
                'user_id' => $userId,
                'Note' => "Ini adalah contoh catatan dummy untuk tanggal " . $date->format('d F Y') . ". Saya merasa $mood hari ini.",
                'Mood' => $mood,
                'created_at' => $date,
                'updated_at' => $date,
            ];
        }

        // Add some specific recent data to ensure chart looks good
        $notes[] = ['user_id' => $userId, 'Note' => 'Dummy Note 1', 'Mood' => 'Senang', 'created_at' => Carbon::now()->subDays(1), 'updated_at' => Carbon::now()->subDays(1)];
        $notes[] = ['user_id' => $userId, 'Note' => 'Dummy Note 2', 'Mood' => 'Marah', 'created_at' => Carbon::now()->subDays(2), 'updated_at' => Carbon::now()->subDays(2)];
        $notes[] = ['user_id' => $userId, 'Note' => 'Dummy Note 3', 'Mood' => 'Sedih', 'created_at' => Carbon::now()->subDays(3), 'updated_at' => Carbon::now()->subDays(3)];

        DB::table('notes')->insert($notes);
    }
}
