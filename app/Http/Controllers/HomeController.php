<?php

namespace App\Http\Controllers;

use App\Models\Toys;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function Home(Request $request)
    {
        // These toys for crausel
        $firstToy = Toys::first();
        $secondToy = Toys::skip(1)->take(1)->first();
        $thirdToy = Toys::skip(2)->take(1)->first();


        // Check if a search query is provided
        $query = $request->input('query');

        // If a search query exists, filter toys accordingly
        if ($query) {
            $toys = Toys::where('toyName', 'like', '%' . $query . '%')->get();
        } else {
            // If no search query, retrieve all toys
            $toys = Toys::all();
        }
        // Check if no toys are found
        $noToysFound = $toys->isEmpty();

        return view('home', compact('firstToy', 'secondToy', 'thirdToy', 'toys', 'noToysFound', 'query'));
    }
}
