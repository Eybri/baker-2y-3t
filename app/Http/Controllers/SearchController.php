<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        try {
            $searchResults = (new Search())
                ->registerModel(\App\Models\Product::class, 'name', 'description')
                ->perform($request->input('query'));

            $results = $searchResults->map(function ($result) {
                return [
                    'label' => $result->searchable->name,
                    'value' => $result->searchable->name,
                ];
            });

            return response()->json($results);
        } catch (\Exception $e) {
            \Log::error('Search error: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }
}
