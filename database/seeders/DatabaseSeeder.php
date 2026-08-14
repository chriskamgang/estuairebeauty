<?php

namespace Database\Seeders;

use App\Models\BusinessHour;
use App\Models\Category;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::firstOrCreate(
            ['email' => 'admin@estuairebeauty.com'],
            ['name' => 'Admin', 'password' => bcrypt('password'), 'is_admin' => true]
        );

        // Clear existing categories & services for re-seed
        Service::query()->delete();
        Category::query()->delete();

        // Categories & Services
        $categories = [
            'Coiffure femme' => [
                ['name' => 'Passe meche', 'price' => 7000, 'duration' => 150, 'image' => 'services/passe-meche.jpeg'],
                ['name' => 'Passe meche pon pon', 'price' => 10000, 'duration' => 200, 'image' => 'services/passe-meche-ponpon.jpeg'],
                ['name' => 'Rasta americain', 'price' => 7000, 'duration' => 240, 'image' => 'services/hero-coiffure.jpeg'],
                ['name' => 'French curls', 'price' => 18000, 'duration' => 300, 'image' => 'services/salon-coiffure.jpeg'],
                ['name' => 'Pose lace', 'price' => 5000, 'duration' => 60, 'image' => 'services/hero-coiffure.jpeg'],
            ],
            'Coiffure homme' => [
                ['name' => 'Coupe homme classique', 'price' => 3000, 'duration' => 30, 'image' => 'services/barbier-homme.jpeg'],
                ['name' => 'Degrade', 'price' => 4000, 'duration' => 40, 'image' => 'services/barbier-homme.jpeg'],
                ['name' => 'Coupe + barbe', 'price' => 5000, 'duration' => 45, 'image' => 'services/barbier-homme.jpeg'],
            ],
            'Tresses hommes' => [
                ['name' => 'Tresses homme classique', 'price' => 8000, 'duration' => 60, 'image' => 'services/salon-coiffure.jpeg'],
                ['name' => 'Tresses collees homme', 'price' => 10000, 'duration' => 75, 'image' => 'services/salon-coiffure.jpeg'],
            ],
            'Pose lace frontale' => [
                ['name' => 'Pose lace frontale', 'price' => 25000, 'duration' => 120, 'image' => 'services/hero-coiffure.jpeg'],
                ['name' => 'Entretien lace frontale', 'price' => 10000, 'duration' => 60, 'image' => 'services/hero-coiffure.jpeg'],
                ['name' => 'Retrait lace frontale', 'price' => 5000, 'duration' => 30, 'image' => 'services/hero-coiffure.jpeg'],
            ],
            'Coupe enfant' => [
                ['name' => 'Coupe enfant fille', 'price' => 2500, 'duration' => 30, 'image' => 'services/coupe-enfant.jpeg'],
                ['name' => 'Coupe enfant garcon', 'price' => 2500, 'duration' => 25, 'image' => 'services/coupe-enfant.jpeg'],
                ['name' => 'Tresses enfant', 'price' => 5000, 'duration' => 60, 'image' => 'services/coupe-enfant.jpeg'],
            ],
            'Barbier' => [
                ['name' => 'Rasage classique', 'price' => 2000, 'duration' => 20, 'image' => 'services/barbier-homme.jpeg'],
                ['name' => 'Taille de barbe', 'price' => 2500, 'duration' => 25, 'image' => 'services/barbier-homme.jpeg'],
                ['name' => 'Soin barbe complet', 'price' => 5000, 'duration' => 40, 'image' => 'services/barbier-homme.jpeg'],
            ],
            'Decoloration' => [
                ['name' => 'Coloration et decoloration', 'price' => 3000, 'duration' => 60, 'image' => 'services/salon-coiffure.jpeg'],
            ],
            'Maquillage' => [
                ['name' => 'Make up naturel', 'price' => 3000, 'duration' => 30, 'image' => 'services/maquillage-all.jpeg'],
                ['name' => 'Make up semi naturel', 'price' => 5000, 'duration' => 45, 'image' => 'services/maquillage-all.jpeg'],
                ['name' => 'Full face', 'price' => 8000, 'duration' => 60, 'image' => 'services/maquillage-all.jpeg'],
                ['name' => 'Make up soiree', 'price' => 10000, 'duration' => 80, 'image' => 'services/maquillage-all.jpeg'],
                ['name' => 'Make up mariee', 'price' => 15000, 'duration' => 105, 'image' => 'services/maquillage-all.jpeg'],
            ],
            'Onglerie' => [
                ['name' => 'Gainage main', 'price' => 5000, 'duration' => 45, 'image' => 'services/onglerie.jpeg'],
                ['name' => 'Simple pose et vernis gel', 'price' => 3000, 'duration' => 30, 'image' => 'services/onglerie.jpeg'],
                ['name' => 'Double pose et vernis gel', 'price' => 3500, 'duration' => 40, 'image' => 'services/onglerie.jpeg'],
                ['name' => 'Construction gel simple modele', 'price' => 5000, 'duration' => 60, 'image' => 'services/onglerie.jpeg'],
                ['name' => 'Construction modele delicat', 'price' => 8000, 'duration' => 90, 'image' => 'services/onglerie.jpeg'],
                ['name' => 'Gainage pieds', 'price' => 4000, 'duration' => 45, 'image' => 'services/onglerie.jpeg'],
            ],
            'Soins de visage' => [
                ['name' => 'Soins de visage simple', 'price' => 5000, 'duration' => 30, 'image' => 'services/soins-visage-all.jpeg'],
                ['name' => 'Soins visage complet', 'price' => 8500, 'duration' => 50, 'image' => 'services/soins-visage-all.jpeg'],
            ],
            'Extensions de cils' => [
                ['name' => 'Cils classique', 'price' => 5000, 'duration' => 30, 'image' => 'services/cils.jpeg'],
                ['name' => 'Cils hybride', 'price' => 7000, 'duration' => 45, 'image' => 'services/cils.jpeg'],
                ['name' => 'Cils volume', 'price' => 10000, 'duration' => 60, 'image' => 'services/cils.jpeg'],
                ['name' => 'Cils mega volume', 'price' => 12000, 'duration' => 90, 'image' => 'services/cils.jpeg'],
                ['name' => 'Cils wispy', 'price' => 10000, 'duration' => 75, 'image' => 'services/cils.jpeg'],
            ],
            'Manucure et pedicure' => [
                ['name' => 'Pedicure simple', 'price' => 4000, 'duration' => 30, 'image' => 'services/pedicure.jpeg'],
                ['name' => 'Pedicure complet', 'price' => 7000, 'duration' => 60, 'image' => 'services/pedicure.jpeg'],
            ],
            'Microblading' => [
                ['name' => 'Microblading discret', 'price' => 10000, 'duration' => 75, 'image' => 'services/microblading.jpeg'],
                ['name' => 'Microblading prononce', 'price' => 15000, 'duration' => 120, 'image' => 'services/microblading.jpeg'],
            ],
            'Massages et relaxation' => [
                ['name' => 'Massage dos', 'price' => 5000, 'duration' => 25, 'image' => 'services/massages.jpeg'],
                ['name' => 'Massage relaxant', 'price' => 7000, 'duration' => 30, 'image' => 'services/massages.jpeg'],
                ['name' => 'Electrostimulation', 'price' => 10000, 'duration' => 25, 'image' => 'services/massage-electrostimulation.jpeg'],
                ['name' => 'Massage capillaire', 'price' => 5000, 'duration' => 25, 'image' => 'services/massages.jpeg'],
                ['name' => 'Massage complet', 'price' => 10000, 'duration' => 45, 'image' => 'services/massages.jpeg'],
            ],
        ];

        $coverImages = [
            'Coiffure femme' => 'covers/coiffure.jpeg',
            'Coiffure homme' => 'covers/coiffure.jpeg',
            'Tresses hommes' => 'covers/coiffure.jpeg',
            'Pose lace frontale' => 'covers/coiffure.jpeg',
            'Coupe enfant' => 'covers/coupe-enfant.jpeg',
            'Barbier' => 'covers/coiffure.jpeg',
            'Decoloration' => 'covers/coiffure.jpeg',
            'Maquillage' => 'covers/maquillage.jpeg',
            'Onglerie' => 'covers/onglerie.jpeg',
            'Soins de visage' => 'covers/soins-visage.jpeg',
            'Extensions de cils' => 'covers/cils.jpeg',
            'Manucure et pedicure' => 'covers/manucure-pedicure.jpeg',
            'Microblading' => 'covers/microblading.jpeg',
            'Massages et relaxation' => 'covers/massages.jpeg',
        ];

        $order = 0;
        foreach ($categories as $catName => $services) {
            $category = Category::create([
                'name' => $catName,
                'slug' => Str::slug($catName),
                'cover_image' => $coverImages[$catName] ?? null,
                'order' => $order++,
                'is_active' => true,
            ]);

            $sOrder = 0;
            foreach ($services as $service) {
                Service::create([
                    'category_id' => $category->id,
                    'sub_category' => $service['sub_category'] ?? null,
                    'name' => $service['name'],
                    'slug' => Str::slug($service['name']),
                    'price' => $service['price'],
                    'duration' => $service['duration'],
                    'image' => $service['image'] ?? null,
                    'is_active' => true,
                    'order' => $sOrder++,
                ]);
            }
        }

        // Business Hours (Lundi-Samedi 8h-19h, Dimanche ferme)
        $days = [
            0 => false,  // Dimanche
            1 => false,  // Lundi
            2 => false,  // Mardi
            3 => false,  // Mercredi
            4 => false,  // Jeudi
            5 => false,  // Vendredi
            6 => false,  // Samedi
        ];

        foreach ($days as $day => $isClosed) {
            BusinessHour::updateOrCreate(
                ['day_of_week' => $day],
                ['open_time' => '08:00', 'close_time' => '19:00', 'is_closed' => $isClosed]
            );
        }

        // Settings
        $settings = [
            ['key' => 'site_name', 'value' => 'Estuaire Beauty', 'type' => 'string'],
            ['key' => 'site_description', 'value' => 'Votre salon de beaute premium a Bafoussam - Coiffure, Maquillage, Lace Frontale, Onglerie, Extensions de cils, Dermopigmentation, Soins & Massage', 'type' => 'text'],
            ['key' => 'logo', 'value' => null, 'type' => 'image'],
            ['key' => 'google_maps_api_key', 'value' => null, 'type' => 'string'],
            ['key' => 'address', 'value' => 'Quartier Macambou, derriere la Gendarmerie, Bafoussam, Cameroun', 'type' => 'string'],
            ['key' => 'phone', 'value' => '+237 00 00 00 00', 'type' => 'string'],
            ['key' => 'email', 'value' => 'contact@estuairebeauty.com', 'type' => 'string'],
            ['key' => 'whatsapp', 'value' => '+237 00 00 00 00', 'type' => 'string'],
            ['key' => 'facebook', 'value' => '', 'type' => 'string'],
            ['key' => 'instagram', 'value' => '', 'type' => 'string'],
            ['key' => 'hero_title', 'value' => 'Sublimez votre beaute', 'type' => 'string'],
            ['key' => 'hero_subtitle', 'value' => 'Coiffure, Maquillage, Lace Frontale, Onglerie, Extensions de cils & Dermopigmentation - Bafoussam', 'type' => 'string'],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'type' => $setting['type']]
            );
        }
    }
}
