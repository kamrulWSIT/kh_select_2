<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CountryController extends Controller
{
    public function getCountry()
    {
        return view('index');
    }


    public function getCountries(Request $request)
    {
        $jsonCountries = Storage::get('data/countries.json');
        $countries = collect(json_decode($jsonCountries, true));




        $term = $request->get('term', ''); // Get the search term

        // Filter countries based on the search term
        if (!empty($term)) {
            $countries = $countries->filter(function ($country) use ($term) {
                return stripos($country['name'], $term) !== false; // Case-insensitive search
            });
        }




        $perPage = 50;
        $currentPage = $request->get('page', 1);

        $paginatedCountries = $countries->forPage($currentPage, $perPage)->values();   //forpage for It returns a new collection containing only the items for the specified page | values for This method reindexes the resulting collection to use consecutive numeric keys starting from 0

        return response()->json([
            'paginatedCountries' => $paginatedCountries,
            'total' => $countries->count(),
            'per_page' => $perPage,
            'current_page' => $currentPage,
            'last_page' => ceil($countries->count() / $perPage),
        ]);
    }
}
