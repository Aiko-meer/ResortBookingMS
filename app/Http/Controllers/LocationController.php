<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    //
     public function provinces()
    {
        $response = Http::get('https://psgc.gitlab.io/api/provinces/');
        return response()->json($response->json());
    }

    public function cities($provinceCode)
    {
        $response = Http::get("https://psgc.gitlab.io/api/provinces/{$provinceCode}/cities-municipalities/");
        return response()->json($response->json());
    }

    public function barangays($cityCode)
    {
        $response = Http::get("https://psgc.gitlab.io/api/cities-municipalities/{$cityCode}/barangays/");
        return response()->json($response->json());
    }
}
