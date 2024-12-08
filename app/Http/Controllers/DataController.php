<?php

namespace App\Http\Controllers;

use App\Models\County;
use App\Models\Town;
use App\Models\Population;
use Illuminate\Http\Request;

class DataController extends Controller
{
    // Show the form with dropdowns and radio buttons
    public function showForm()
    {
        // Retrieve all counties and towns for dropdowns
        $counties = County::all();
        $towns = Town::all();
        
        return view('retrieve-data.form', compact('counties', 'towns'));
    }

    // Handle the form submission
    public function handleForm(Request $request)
    {
        // Validate the form input
        $request->validate([
            'county' => 'nullable|exists:counties,id',
            'town' => 'nullable|exists:towns,id',
            'year' => 'nullable|integer',
            'population_type' => 'nullable|string|in:total,women',
        ]);

        // Initialize the query
        $query = Population::query();

        // Apply filters based on the form inputs
        if ($request->has('county') && $request->county) {
            $query->whereHas('town', function ($q) use ($request) {
                $q->where('countyid', $request->county);
            });
        }

        if ($request->has('town') && $request->town) {
            $query->where('townid', $request->town);
        }

        if ($request->has('year') && $request->year) {
            $query->where('ryear', $request->year);
        }

        if ($request->has('population_type') && $request->population_type) {
            $query->select($request->population_type);
        }

        // Execute the query and retrieve the results
        $results = $query->get();

        return view('retrieve-data.results', compact('results'));
    }
}
