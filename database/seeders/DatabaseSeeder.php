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
                ['name' => 'Tresses africaines', 'price' => 15000, 'duration' => 120, 'image' => 'services/hero-coiffure.jpeg'],
                ['name' => 'Coupe femme', 'price' => 5000, 'duration' => 45],
                ['name' => 'Brushing', 'price' => 5000, 'duration' => 45],
                ['name' => 'Coloration', 'price' => 15000, 'duration' => 90],
                ['name' => 'Tissage', 'price' => 10000, 'duration' => 90],
                ['name' => 'Defrisage', 'price' => 8000, 'duration' => 60],
            ],
            'Coiffure homme' => [
                ['name' => 'Coupe homme classique', 'price' => 3000, 'duration' => 30, 'image' => 'services/barbier-homme.jpeg'],
                ['name' => 'Degrade', 'price' => 4000, 'duration' => 40],
                ['name' => 'Coupe + barbe', 'price' => 5000, 'duration' => 45],
            ],
            'Tresses hommes' => [
                ['name' => 'Tresses homme classique', 'price' => 8000, 'duration' => 60],
                ['name' => 'Tresses collees homme', 'price' => 10000, 'duration' => 75],
            ],
            'Pose lace frontale' => [
                ['name' => 'Pose lace frontale', 'price' => 25000, 'duration' => 120],
                ['name' => 'Entretien lace frontale', 'price' => 10000, 'duration' => 60],
                ['name' => 'Retrait lace frontale', 'price' => 5000, 'duration' => 30],
            ],
            'Coupe enfant' => [
                ['name' => 'Coupe enfant fille', 'price' => 2500, 'duration' => 30],
                ['name' => 'Coupe enfant garcon', 'price' => 2500, 'duration' => 25],
                ['name' => 'Tresses enfant', 'price' => 5000, 'duration' => 60],
            ],
            'Barbier' => [
                ['name' => 'Rasage classique', 'price' => 2000, 'duration' => 20],
                ['name' => 'Taille de barbe', 'price' => 2500, 'duration' => 25],
                ['name' => 'Soin barbe complet', 'price' => 5000, 'duration' => 40],
            ],
            'Decoloration' => [
                ['name' => 'Decoloration complete', 'price' => 15000, 'duration' => 90],
                ['name' => 'Meches', 'price' => 12000, 'duration' => 75],
                ['name' => 'Balayage', 'price' => 18000, 'duration' => 100],
            ],
            'Maquillage' => [
                ['name' => 'Maquillage jour', 'price' => 10000, 'duration' => 45, 'image' => 'services/maquillage.jpeg'],
                ['name' => 'Maquillage soiree', 'price' => 20000, 'duration' => 60],
                ['name' => 'Maquillage mariee', 'price' => 35000, 'duration' => 90],
                ['name' => 'Maquillage naturel', 'price' => 8000, 'duration' => 30],
            ],
            'Onglerie' => [
                ['name' => 'Pose vernis simple', 'price' => 3000, 'duration' => 30],
                ['name' => 'Pose gel', 'price' => 10000, 'duration' => 60],
                ['name' => 'Pose capsules', 'price' => 15000, 'duration' => 90],
                ['name' => 'Nail art', 'price' => 12000, 'duration' => 75, 'image' => 'services/nail-art.jpeg'],
            ],
            'Soins de visage' => [
                ['name' => 'Soin visage complet', 'price' => 15000, 'duration' => 60, 'image' => 'services/soins-visage.jpeg'],
                ['name' => 'Nettoyage de peau', 'price' => 10000, 'duration' => 45, 'image' => 'services/nettoyage-peau.jpeg'],
                ['name' => 'Masque hydratant', 'price' => 8000, 'duration' => 30],
                ['name' => 'Peeling visage', 'price' => 12000, 'duration' => 45],
            ],
            'Extensions de cils' => [
                ['name' => 'Cils Classic', 'price' => 15000, 'duration' => 90, 'image' => 'services/extensions-cils.jpeg'],
                ['name' => 'Cils Hybrid', 'price' => 20000, 'duration' => 100],
                ['name' => 'Cils Volume', 'price' => 25000, 'duration' => 120],
                ['name' => 'Cils Wispy', 'price' => 22000, 'duration' => 110],
                ['name' => 'Cils Wetset', 'price' => 18000, 'duration' => 100],
                ['name' => 'Retouche cils', 'price' => 10000, 'duration' => 60],
            ],
            'Manucure et pedicure' => [
                ['name' => 'Manucure complete', 'price' => 5000, 'duration' => 45],
                ['name' => 'Pedicure', 'price' => 7000, 'duration' => 60, 'image' => 'services/pedicure.jpeg'],
                ['name' => 'Manucure + Pedicure', 'price' => 10000, 'duration' => 90],
            ],
            'Microblading' => [
                ['name' => 'Microblading sourcils', 'price' => 50000, 'duration' => 120, 'image' => 'services/microblading-sourcils.jpeg'],
                ['name' => 'Dermopigmentation levres', 'price' => 45000, 'duration' => 120, 'image' => 'services/dermopigmentation-levres.jpeg'],
                ['name' => 'Retouche microblading', 'price' => 25000, 'duration' => 60],
            ],
            'Massages et relaxation' => [
                ['name' => 'Massage relaxant', 'price' => 15000, 'duration' => 60, 'image' => 'services/massage-electrostimulation.jpeg'],
                ['name' => 'Massage dos', 'price' => 10000, 'duration' => 30],
                ['name' => 'Electrostimulation', 'price' => 12000, 'duration' => 45],
                ['name' => 'Massage complet corps', 'price' => 25000, 'duration' => 90],
            ],
        ];

        $order = 0;
        foreach ($categories as $catName => $services) {
            $category = Category::create([
                'name' => $catName,
                'slug' => Str::slug($catName),
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
