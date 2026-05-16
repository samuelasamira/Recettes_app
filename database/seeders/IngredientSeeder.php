<?php
namespace Database\Seeders;
use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    public function run(): void
    {
        $ingredients = [
            "Farine","Sucre","Sel","Beurre","Oeufs","Lait","Levure chimique",
            "Huile de palme","Huile d'arachide","Poivre",
            "Piment frais","Piment sec","Arachides","Feuilles de manioc",
            "Graine de courge","Noix de coco","Lait de coco","Epinards",
            "Poisson séché","Crevettes séchées","Tomates","Oignons","Ail",
            "Poivrons","Aubergines","Carottes","Pommes de terre","Patates douces",
            "Igname","Taro","Plantain","Maïs","Haricots","Pois de terre",
            "Concombre","Courgettes","Chou","Oignons verts","Persil","Menthe",
            "Poulet","Boeuf","Poisson frais","Escargots","Crevettes",
            "Riz","Pâtes","Semoule","Farine de maïs","Farine de manioc",
            "Mil","Sorgho","Fromage","Crème fraîche","Yaourt","Miel",
            "Sauce soja","Citron","Citron vert","Papaye","Mangue",
            "Banane plantain","Banane douce","Gingembre","Clou de girofle",
            "Cannelle","Noix de muscade","Curcuma","Coriandre","Thym",
            "Laurier","Maggi cube","Bouillon de poisson",
        ];
        foreach ($ingredients as $name)
            Ingredient::firstOrCreate(["name"=>$name]);
    }
}