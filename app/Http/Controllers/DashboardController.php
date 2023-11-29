<?php

// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        // Fetch recipes from The Meal DB API based on the search query
        $recipes = $this->getRecipesFromApi($search);

        return view('dashboard', compact('recipes', 'search'));
    }

    private function getRecipesFromApi($search)
    {
        $response = Http::get("https://www.themealdb.com/api/json/v1/1/search.php?s={$search}");
        $data = $response->json();

        return $data['meals'] ?? [];
    }
}
