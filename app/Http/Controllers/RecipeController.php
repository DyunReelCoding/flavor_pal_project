<?php

namespace App\Http\Controllers;

// app/Http/Controllers/RecipeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class RecipeController extends Controller
{
    private $mealDBApiBaseUrl = 'https://www.themealdb.com/api/json/v1/1/';

    public function index()
    {
        // Fetch recipes from The Meal DB API
        $recipes = $this->getRecipesFromApi();

        return response()->json(['recipes' => $recipes], 200);
    }

    public function show($id)
    {
        // Fetch a recipe from The Meal DB API
        $recipe = $this->getRecipeFromApi($id);

        if (!$recipe) {
            return response()->json(['error' => 'Recipe not found'], 404);
        }

        return response()->json(['recipe' => $recipe], 200);
    }

    private function getRecipesFromApi()
    {
        $client = new Client();
        $response = $client->get($this->mealDBApiBaseUrl . 'search.php?s=chicken'); // Change 'chicken' to your desired search term
        $data = json_decode($response->getBody(), true);

        return $data['meals'] ?? [];
    }

    private function getRecipeFromApi($id)
    {
        $client = new Client();
        $response = $client->get($this->mealDBApiBaseUrl . 'lookup.php?i=' . $id);
        $data = json_decode($response->getBody(), true);

        return $data['meals'][0] ?? null;
    }
}
