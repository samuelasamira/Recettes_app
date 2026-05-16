<?php
namespace Database\Seeders;
use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        $recipes = [
            [
                'title'        => 'Ndolé aux crevettes',
                'description'  => 'Le plat national du Cameroun, préparé avec des feuilles amères, des crevettes séchées et de la pâte d\'arachides. Un incontournable des grandes occasions.',
                'instructions' => "1. Faire tremper les feuilles de ndolé 30 min pour réduire l'amertume\n2. Faire bouillir les arachides et les écraser en pâte lisse\n3. Faire revenir les oignons dans l'huile de palme\n4. Ajouter les crevettes séchées et la pâte d'arachides\n5. Incorporer les feuilles et cuire 20 min à feu doux\n6. Assaisonner avec Maggi et sel. Servir avec du plantain ou du miondo",
                'prep_time'    => 30,
                'cook_time'    => 60,
                'servings'     => 6,
                'cuisine_type' => 'Camerounaise',
                'difficulty'   => 'moyen',
                'image_url'    => 'https://kelianfood.com/wp-content/uploads/2023/07/IMG_5526-1200x800.jpg',
                'ingredients'  => [
                    'Feuilles de manioc' => '500g',
                    'Arachides'          => '200g',
                    'Crevettes séchées'  => '150g',
                    'Huile de palme'     => '3 c.s.',
                    'Oignons'            => '2 pièces',
                    'Maggi cube'         => '2 cubes',
                    'Sel'                => 'au goût',
                    'Piment frais'       => '1 pièce',
                ],
            ],
            [
                'title'        => 'Poulet DG',
                'description'  => 'Le fameux Poulet Directeur Général, un classique incontournable servi lors des grandes occasions. Poulet doré, plantain mûr, légumes sautés — un festin camerounais.',
                'instructions' => "1. Couper le poulet en morceaux, assaisonner avec ail, gingembre, sel et poivre\n2. Faire dorer le poulet dans l'huile chaude\n3. Faire revenir oignons, tomates et poivrons\n4. Faire frire les morceaux de plantain mûr séparément\n5. Mélanger tout et laisser mijoter 20 min\n6. Ajuster l'assaisonnement et servir chaud avec du riz",
                'prep_time'    => 20,
                'cook_time'    => 45,
                'servings'     => 4,
                'cuisine_type' => 'Camerounaise',
                'difficulty'   => 'moyen',
                'image_url'    => 'https://i.pinimg.com/736x/ba/7a/e2/ba7ae2e6fc0f44c6c5d08ed2f2edc268.jpg',
                'ingredients'  => [
                    'Poulet'         => '1 entier',
                    'Plantain'       => '2 pièces',
                    'Tomates'        => '3 pièces',
                    'Poivrons'       => '2 pièces',
                    'Oignons'        => '2 pièces',
                    'Ail'            => '4 gousses',
                    'Huile de palme' => '4 c.s.',
                    'Maggi cube'     => '3 cubes',
                    'Gingembre'      => '1 morceau',
                ],
            ],
            [
                'title'        => 'Eru et Water Fufu',
                'description'  => 'Un plat traditionnel de la région du Sud-Ouest camerounais, à base de feuilles d\'eru et d\'huile de palme. Accompagné du Water Fufu, c\'est un repas complet et savoureux.',
                'instructions' => "1. Laver et couper finement les feuilles d'eru\n2. Faire chauffer l'huile de palme dans une cocotte\n3. Ajouter les crevettes séchées et le poisson fumé émietté\n4. Incorporer les feuilles d'eru et mélanger\n5. Cuire à feu doux 30 min en remuant régulièrement\n6. Assaisonner avec sel et piment. Servir avec le water fufu",
                'prep_time'    => 20,
                'cook_time'    => 30,
                'servings'     => 4,
                'cuisine_type' => 'Camerounaise',
                'difficulty'   => 'facile',
                'image_url'    => 'https://cuisinedumboa.com/wp-content/uploads/2019/03/FB_IMG_15307324283946846-1.jpg',
                'ingredients'  => [
                    'Feuilles de manioc' => '600g',
                    'Huile de palme'     => '5 c.s.',
                    'Crevettes séchées'  => '100g',
                    'Poisson séché'      => '200g',
                    'Sel'                => 'au goût',
                    'Piment frais'       => '2 pièces',
                ],
            ],
            [
                'title'        => 'Koki de Maïs',
                'description'  => 'Un pudding traditionnel camerounais à base de maïs et d\'huile de palme, cuit dans des feuilles de bananier. Moelleux, savoureux et très nourrissant.',
                'instructions' => "1. Faire tremper le maïs toute une nuit\n2. Égoutter et broyer finement le maïs en pâte\n3. Mélanger la pâte avec l'huile de palme, sel et piment\n4. Ajouter les crevettes séchées si désiré\n5. Envelopper des portions dans des feuilles de bananier propres\n6. Cuire à la vapeur pendant 2 heures. Servir chaud ou froid",
                'prep_time'    => 60,
                'cook_time'    => 120,
                'servings'     => 8,
                'cuisine_type' => 'Camerounaise',
                'difficulty'   => 'difficile',
                'image_url'    => 'https://tse4.mm.bing.net/th/id/OIP.NWFwlke_53TTr2q6_MmgEQHaEK?r=0&rs=1&pid=ImgDetMain&o=7&rm=3',
                'ingredients'  => [
                    'Maïs'              => '1kg',
                    'Huile de palme'    => '200ml',
                    'Sel'               => 'au goût',
                    'Piment sec'        => '1 c.c.',
                    'Crevettes séchées' => '50g',
                ],
            ],
            [
                'title'        => 'Haricots au Plantain',
                'description'  => 'Un repas simple, nourrissant et délicieux. Les haricots blancs mijotés avec les épices et servis avec du plantain mûr frit — un classique du quotidien camerounais.',
                'instructions' => "1. Faire tremper les haricots 4 heures puis égoutter\n2. Cuire les haricots jusqu'à tendreté (environ 1h)\n3. Faire revenir oignons et tomates dans l'huile de palme\n4. Mélanger aux haricots cuits et assaisonner\n5. Éplucher et trancher le plantain mûr en diagonale\n6. Frire le plantain jusqu'à dorure et servir ensemble",
                'prep_time'    => 15,
                'cook_time'    => 90,
                'servings'     => 4,
                'cuisine_type' => 'Camerounaise',
                'difficulty'   => 'facile',
                'image_url'    => 'https://tse1.mm.bing.net/th/id/OIP.rMKfdXulClkIG_E853vBQQHaEK?r=0&rs=1&pid=ImgDetMain&o=7&rm=3',
                'ingredients'  => [
                    'Haricots'       => '500g',
                    'Plantain'       => '3 pièces',
                    'Tomates'        => '2 pièces',
                    'Oignons'        => '1 pièce',
                    'Huile de palme' => '2 c.s.',
                    'Maggi cube'     => '2 cubes',
                    'Sel'            => 'au goût',
                ],
            ],
            [
                'title'        => 'Beignets de Haricots',
                'description'  => 'Des beignets croustillants à base de haricots blancs, typiques des rues camerounaises au petit matin. Croustillants à l\'extérieur, moelleux à l\'intérieur.',
                'instructions' => "1. Faire tremper les haricots 8 heures et enlever la peau en frottant\n2. Mixer les haricots en pâte lisse sans eau\n3. Ajouter sel, piment haché et oignon mixé\n4. Battre énergiquement la pâte jusqu'à obtenir une texture aérée\n5. Chauffer l'huile à 180°C\n6. Déposer des cuillerées de pâte et frire 3-4 min de chaque côté\n7. Égoutter sur du papier absorbant et servir chaud",
                'prep_time'    => 30,
                'cook_time'    => 20,
                'servings'     => 6,
                'cuisine_type' => 'Camerounaise',
                'difficulty'   => 'facile',
                'image_url'    => 'https://sp-ao.shortpixel.ai/client/to_auto,q_glossy,ret_img,w_1365,h_2048/https://kelianfood.com/wp-content/uploads/2023/10/IMG_6500.jpg',
                'ingredients'  => [
                    'Haricots'       => '500g',
                    'Piment frais'   => '2 pièces',
                    'Oignons'        => '1 pièce',
                    'Sel'            => 'au goût',
                    'Huile de palme' => 'pour friture',
                ],
            ],
        ];

        foreach ($recipes as $data) {
            $recipe = Recipe::create([
                'user_id'      => $user->id,
                'title'        => $data['title'],
                'description'  => $data['description'],
                'instructions' => $data['instructions'],
                'prep_time'    => $data['prep_time'],
                'cook_time'    => $data['cook_time'],
                'servings'     => $data['servings'],
                'cuisine_type' => $data['cuisine_type'],
                'difficulty'   => $data['difficulty'],
                'image_path'   => $data['image_url'],
            ]);

            foreach ($data['ingredients'] as $name => $qty) {
                $ingredient = Ingredient::where('name', $name)->first();
                if ($ingredient)
                    $recipe->ingredients()->attach($ingredient->id, ['quantity' => $qty]);
            }
        }
    }
}