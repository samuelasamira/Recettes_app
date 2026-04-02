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
            // ===== INGRÉDIENTS POUR ERU =====
            'Feuilles d\'eru',
            'Feuilles de waterleaf',
            'Crevettes séchées',
            'Poisson fumé',
            'Huile de palme rouge',
            
            // ===== INGRÉDIENTS POUR NDOLE =====
            'Feuilles de ndolé',
            'Arachides fraîches',
            'Crevettes fraîches',
            'Bœuf fumé',
            
            // ===== INGRÉDIENTS POUR KOKI =====
            'Haricots rouges secs',
            'Épinards frais',
            'Feuilles de plantain',
            
            // ===== INGRÉDIENTS POUR OKOK =====
            'Feuilles d\'okok',
            'Purée d\'arachides',
            
            // ===== INGRÉDIENTS POUR POULET DG =====
            'Poulet fermier',
            'Bananes plantains mûres',
            'Poivrons verts',
            'Poivrons rouges',
            'Carottes',
            'Sauce tomate',
            
            // ===== INGRÉDIENTS POUR MBONGO TCHOBI =====
            'Poisson frais (capitaine ou tilapia)',
            'Pâte mbongo',
            'Tomates fraîches',
            
            // ===== INGRÉDIENTS POUR KONDRE =====
            'Escargots de terre',
            'Piment rouge',
            
            // ===== INGRÉDIENTS POUR POISSON BRAISÉ =====
            'Bar entier',
            'Citron jaune',
            'Piment habanero',
            
            // ===== INGRÉDIENTS POUR SOYA =====
            'Bœuf tendre',
            'Poudre de kankan (arachide grillée)',
            'Charbon de bois',
            
            // ===== INGRÉDIENTS POUR BEIGNETS HARICOTS =====
            'Farine de blé',
            'Levure boulangère',
            'Haricots rouges',
            'Bouillie de maïs',
            
            // ===== INGRÉDIENTS DE BASE GÉNÉRAUX =====
            'Sel',
            'Poivre noir',
            'Oignons',
            'Ail',
            'Gingembre frais',
            'Gingembre en poudre',
            'Piment frais',
            'Piment sec',
            'Thym',
            'Laurier',
            'Curcuma',
            'Coriandre fraîche',
            'Persil',
            
            // ===== HUILES ET MATIÈRES GRASSES =====
            'Huile d\'arachide',
            'Huile d\'olive',
            'Beurre',
            'Margarine',
            
            // ===== LÉGUMES DE BASE =====
            'Tomates',
            'Oignons verts',
            'Poivrons',
            'Aubergines',
            'Courgettes',
            'Chou',
            'Concombre',
            
            // ===== FÉCULENTS =====
            'Riz blanc',
            'Riz étuvé',
            'Pâtes alimentaires',
            'Semoule de blé',
            'Farine de maïs',
            'Farine de manioc',
            'Maïs frais',
            'Mil',
            
            // ===== VIANDES ET PROTÉINES =====
            'Poulet',
            'Bœuf',
            'Agneau',
            'Poisson frais',
            'Poisson séché',
            'Crevettes',
            'Escargots',
            'Œufs',
            
            // ===== FRUITS =====
            'Citron',
            'Citron vert',
            'Mangue',
            'Papaye',
            'Banane douce',
            'Banane plantain',
            'Noix de coco fraîche',
            'Lait de coco',
            
            // ===== ÉPICES CAMEROUNAISES SPÉCIALES =====
            'Clou de girofle',
            'Cannelle',
            'Noix de muscade',
            'Maggi cube',
            'Bouillon de poisson en cube',
            'Piment de Cayenne',
            
            // ===== AUTRES =====
            'Miel',
            'Sauce soja',
            'Vinaigre blanc',
            'Vinaigre de cidre',
            'Crème fraîche',
            'Yaourt nature',
            'Fromage râpé',
        ];

        foreach ($ingredients as $name) {
            Ingredient::firstOrCreate(['name' => $name]);
        }
    }
}