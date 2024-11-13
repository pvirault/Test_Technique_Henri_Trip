<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Guide;
use Carbon\Carbon;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $guide = Guide::first();
        
        DB::table('activities')->insert([
            [
                'guide_id' => $guide->id,
                'title' => 'Visite du musée d\'histoire',
                'description' => 'Explorez les expositions et apprenez l\'histoire de la région.',
                'category' => 'Culture',
                'address' => '123 Rue de la Liberté, Paris',
                'phone' => '+33 1 23 45 67 89',
                'opening_hours' => '09:00 - 18:00',
                'website' => 'https://musee-histoire.fr',
                'order' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'guide_id' => $guide->id,
                'title' => 'Randonnée en montagne',
                'description' => 'Partez pour une randonnée guidée à travers les montagnes locales.',
                'category' => 'Nature',
                'address' => 'Point de départ : Parking Montagne, Chamonix',
                'phone' => '+33 4 56 78 90 12',
                'opening_hours' => '06:00 - 20:00',
                'website' => 'https://randonnee-montagne.fr',
                'order' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'guide_id' => $guide->id,
                'title' => 'Dégustation de vin',
                'description' => 'Découvrez et dégustez les vins locaux dans une ambiance chaleureuse.',
                'category' => 'Gastronomie',
                'address' => 'Château de la Vigne, 456 Rue du Vin, Bordeaux',
                'phone' => '+33 2 34 56 78 90',
                'opening_hours' => '14:00 - 22:00',
                'website' => 'https://degustation-vin.fr',
                'order' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
