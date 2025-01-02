<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CountryController extends Controller
{
    public function getCountry()
    {
        $jsonCountries = Storage::get('/data/countries.json');
        $countries = json_decode($jsonCountries, true);
        // dd(json_decode($jsonCountries, true));
        // dd($countries);
        return view('index', compact('countries'));
    }
}
