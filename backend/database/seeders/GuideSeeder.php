<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;

class GuideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();

        DB::table('guides')->insert([
            [
                'title' => 'Guide 1 - Voyage à vélo',
                'description' => 'Un guide pour explorer la campagne à vélo.',
                'days_count' => 5,
                'options' => json_encode([
                    'mobilité' => 'vélo',
                    'saison' => 'printemps',
                    'audience_cible' => 'famille',
                ]),
                'created_by' => $user->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Guide 2 - Exploration en voiture',
                'description' => 'Un road trip en voiture à travers les montagnes.',
                'days_count' => 7,
                'options' => json_encode([
                    'mobilité' => 'voiture',
                    'saison' => 'automne',
                    'audience_cible' => 'couple',
                ]),
                'created_by' => $user->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Guide 3 - Aventure à pied',
                'description' => 'Une aventure à pied dans les montagnes.',
                'days_count' => 3,
                'options' => json_encode([
                    'mobilité' => 'pied',
                    'saison' => 'été',
                    'audience_cible' => 'amis',
                ]),
                'created_by' => $user->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}