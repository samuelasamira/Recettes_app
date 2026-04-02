<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredients = [
            // Ingrédients de base
            'Farine',
            'Sucre',
            'Sel',
            'Beurre',
            'Œufs',
            'Lait',
            'Levure chimique',
            'Huile de palme',
            'Huile d\'arachide',
            'Poivre',
            
            // Ingrédients camerounais populaires
            'Piment frais',
            'Piment sec',
            'Arachides',
            'Feuilles de manioc',
            'Graine de courge (pépins)',
            'Noix de coco',
            'Lait de coco',
            'Épinards',
            'Poisson séché',
            'Crevettes séchées',
            
            // Légumes camerounais
            'Tomates',
            'Oignons',
            'Ail',
            'Poivrons',
            'Aubergines',
            'Carottes',
            'Pommes de terre',
            'Patates douces',
            'Igname',
            'Taro',
            'Plantain',
            'Maïs',
            'Haricots',
            'Pois de terre',
            'Concombre',
            'Courgettes',
            'Chou',
            'Oignons verts',
            'Persil',
            'Menthe',
            
            // Viandes et protéines
            'Poulet',
            'Boeuf',
            'Poisson frais',
            'Escargots',
            'Crevettes',
            'Oeuf',
            
            // Féculents
            'Riz',
            'Pâtes',
            'Semoule',
            'Farine de maïs',
            'Farine de manioc',
            'Grains de maïs',
            'Mil',
            'Sorgho',
            
            // Produits laitiers et condiments
            'Fromage',
            'Crème fraîche',
            'Yaourt',
            'Miel',
            'Sauce soja',
            'Vinaigre blanc',
            'Citron',
            'Citron vert',
            'Orange',
            'Papaye',
            'Mangue',
            'Banane plantain',
            'Banane douce',
            
            // Épices camerounaises
            'Gingembre',
            'Clou de girofle',
            'Cannelle',
            'Noix de muscade',
            'Curcuma',
            'Coriandre',
            'Thym',
            'Laurier',
            'Maggi cube',
            'Bouillon de poisson',
        ];

        foreach ($ingredients as $name) {
            Ingredient::firstOrCreate(['name' => $name]);
        }
    }
}