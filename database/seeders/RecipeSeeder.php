<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer le premier utilisateur
        $user = User::first();

        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Admin Cuisine',
                'email' => 'admin@recettesapp.com',
            ]);
        }

        // ==================== MENU TRADITIONNEL ====================

        // 1. Eru
        Recipe::create([
            'user_id' => $user->id,
            'title' => 'Eru Traditionnel du Sud-Ouest',
            'description' => 'Une soupe de feuilles sauvages (Eru et Waterleaf) riche en saveurs, accompagnée de son Fufu Water de qualité. Plat emblématique du Cameroun.',
            'instructions' => "1. Laver et couper les feuilles d'éru et de waterleaf\n2. Faire revenir les oignons et l'ail dans l'huile de palme\n3. Ajouter les crevettes séchées et le poisson fumé\n4. Incorporer les feuilles et laisser mijoter 30 minutes\n5. Servir chaud avec du fufu ou du plantain",
            'prep_time' => 30,
            'cook_time' => 45,
            'servings' => 6,
            'cuisine_type' => 'Traditionnel',
            'difficulty' => 'moyen',
            'image_path' => 'https://taketako.com/wp-content/uploads/2025/09/493015083_1239081501552561_655803597310589877_n.jpg',
        ]);

        // 2. Ndole
        Recipe::create([
            'user_id' => $user->id,
            'title' => 'Ndole Royal aux Crevettes',
            'description' => "L'incontournable plat national camerounais, composé de feuilles de ndolé, arachides fraîches et crevettes marinées. Un délice authentique !",
            'instructions' => "1. Faire bouillir les feuilles de ndolé pour enlever l'amertume\n2. Préparer la sauce avec les arachides mixées\n3. Ajouter les crevettes et la viande fumée\n4. Laisser mijoter 20 minutes\n5. Servir avec du riz ou du plantain mûr",
            'prep_time' => 45,
            'cook_time' => 30,
            'servings' => 4,
            'cuisine_type' => 'Traditionnel',
            'difficulty' => 'difficile',
            'image_path' => 'https://taketako.com/wp-content/uploads/2025/09/441868620_835977465243897_3697812085574705273_n.jpg',
        ]);

        // 3. Koki
        Recipe::create([
            'user_id' => $user->id,
            'title' => 'Koki aux Haricots et Épinards',
            'description' => 'Un pudding de haricots noir enveloppé dans des feuilles de plantain, parfumé aux épices. Un classique des repas de fête.',
            'instructions' => "1. Mixer les haricots rouges pour obtenir une pâte\n2. Ajouter l'huile de palme, les épices et les feuilles d'épinards\n3. Envelopper dans des feuilles de plantain\n4. Cuire à la vapeur pendant 1h30\n5. Déguster chaud ou froid",
            'prep_time' => 60,
            'cook_time' => 90,
            'servings' => 8,
            'cuisine_type' => 'Traditionnel',
            'difficulty' => 'difficile',
            'image_path' => 'https://taketako.com/wp-content/uploads/2025/09/456951281_468398279502782_3034635848687688340_n.jpg',
        ]);

        // 4. Okok
        Recipe::create([
            'user_id' => $user->id,
            'title' => 'Okok Sauce Arachide',
            'description' => 'Une sauce onctueuse à base de feuilles d\'okok et d\'arachides, typique de la région du Centre-Cameroun.',
            'instructions' => "1. Laver et couper finement les feuilles d'okok\n2. Préparer la purée d'arachides\n3. Faire revenir les oignons dans l'huile de palme\n4. Ajouter la purée d'arachides et les feuilles\n5. Laisser mijoter 40 minutes",
            'prep_time' => 30,
            'cook_time' => 40,
            'servings' => 5,
            'cuisine_type' => 'Traditionnel',
            'difficulty' => 'moyen',
            'image_path' => 'https://taketako.com/wp-content/uploads/2025/09/493015083_1239081501552561_655803597310589877_n.jpg',
        ]);

        // ==================== MENU STREET FOOD ====================

        // 5. Poulet DG
        Recipe::create([
            'user_id' => $user->id,
            'title' => 'Poulet DG Authentique',
            'description' => 'Le plat des "Directeurs Généraux" : poulet frit, bananes plantains mûres et une farandole de légumes croquants. Un festin royal !',
            'instructions' => "1. Faire mariner le poulet avec épices et citron\n2. Frire le poulet jusqu'à dorure\n3. Faire revenir les plantains et légumes\n4. Mélanger le tout dans une sauce tomate parfumée\n5. Servir avec du riz ou des pommes de terre",
            'prep_time' => 40,
            'cook_time' => 30,
            'servings' => 6,
            'cuisine_type' => 'Street Food',
            'difficulty' => 'moyen',
            'image_path' => 'https://taketako.com/wp-content/uploads/2025/09/518254713_1061325956123205_4012436858608735082_n.jpg',
        ]);

        // 6. Mbongo Tchobi
        Recipe::create([
            'user_id' => $user->id,
            'title' => 'Mbongo Tchobi - Poisson Sauce Noire',
            'description' => "Un poisson mijoté dans une sauce noire parfumée aux épices locales. Le secret des mamans camerounaises !",
            'instructions' => "1. Griller légèrement le poisson\n2. Préparer la pâte d'épices mbongo\n3. Faire revenir oignons et tomates\n4. Ajouter la pâte mbongo et l'eau\n5. Incorporer le poisson et laisser mijoter",
            'prep_time' => 25,
            'cook_time' => 35,
            'servings' => 4,
            'cuisine_type' => 'Street Food',
            'difficulty' => 'moyen',
            'image_path' => 'https://taketako.com/wp-content/uploads/2025/09/441545292_835976855243958_6155980324635135609_n.jpg',
        ]);

        // 7. Kondre
        Recipe::create([
            'user_id' => $user->id,
            'title' => 'Kondre - Escargots à la Camerounaise',
            'description' => 'Des escargots mijotés dans une sauce tomate épicée, un délice de la cuisine de rue camerounaise.',
            'instructions' => "1. Nettoyer les escargots avec du citron\n2. Faire revenir les oignons et l'ail\n3. Ajouter la sauce tomate et les épices\n4. Incorporer les escargots\n5. Laisser mijoter 1 heure",
            'prep_time' => 20,
            'cook_time' => 60,
            'servings' => 4,
            'cuisine_type' => 'Street Food',
            'difficulty' => 'facile',
            'image_path' => 'https://taketako.com/wp-content/uploads/2025/09/491570949_1440390446940530_5352418268934549116_n-1.jpg',
        ]);

        // ==================== MENU MODERNE ====================

        // 8. Poisson Braisé
        Recipe::create([
            'user_id' => $user->id,
            'title' => 'Bar Braisé à la Kribienne',
            'description' => 'Un bar entier mariné aux épices du littoral, grillé au feu de bois et servi avec ses bâtons de manioc. Pure merveille !',
            'instructions' => "1. Nettoyer et inciser le poisson\n2. Mariner avec citron, ail, gingembre et piment\n3. Laisser reposer 1 heure\n4. Griller sur feu de bois\n5. Servir avec bâtons de manioc et sauce piment",
            'prep_time' => 60,
            'cook_time' => 20,
            'servings' => 2,
            'cuisine_type' => 'Moderne',
            'difficulty' => 'moyen',
            'image_path' => 'https://apparts-meubles.com/wp-content/uploads/2025/06/491399429_982861227393586_1143994795777114894_n.jpg',
        ]);

        // 9. Soya
        Recipe::create([
            'user_id' => $user->id,
            'title' => 'Soya du Nord Epicé',
            'description' => 'Brochettes de bœuf tendres grillées au charbon, enrobées de poudre de kankan (arachide et épices secrètes).',
            'instructions' => "1. Couper la viande en morceaux\n2. Mariner avec poudre de kankan, oignon et épices\n3. Enfiler sur des brochettes\n4. Griller au charbon\n5. Servir avec oignons frais et piment",
            'prep_time' => 40,
            'cook_time' => 15,
            'servings' => 4,
            'cuisine_type' => 'Moderne',
            'difficulty' => 'facile',
            'image_path' => 'https://apparts-meubles.com/wp-content/uploads/2025/06/494781040_1302180165023693_8305440958335834490_n-1011x1536.jpeg',
        ]);

        // 10. Beignets Haricots
        Recipe::create([
            'user_id' => $user->id,
            'title' => 'Beignets-Haricots (BH) Signature',
            'description' => 'Le petit-déjeuner iconique : beignets croustillants, haricots rouges savoureux et bouillie de maïs onctueuse.',
            'instructions' => "1. Préparer la pâte à beignets avec farine, levure\n2. Frire les beignets jusqu'à dorure\n3. Cuire les haricots rouges avec oignon et épices\n4. Servir avec bouillie de maïs\n5. Déguster le matin !",
            'prep_time' => 30,
            'cook_time' => 25,
            'servings' => 6,
            'cuisine_type' => 'Moderne',
            'difficulty' => 'facile',
            'image_path' => 'https://apparts-meubles.com/wp-content/uploads/2025/06/501790818_1022705050009263_4981438295992879654_n.jpg',
        ]);
    }
}