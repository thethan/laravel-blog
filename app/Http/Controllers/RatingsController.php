<?php

namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;

class RatingsController extends Controller
{
    public function index()
    {

    }

    public function show(Request $request, $slug)
    {
        $rating = Rating::where('slug', $slug)->firstOrFail();
        return view('ratings.show', compact('rating'));
    }
}
