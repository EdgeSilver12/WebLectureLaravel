<?php

namespace App\Http\Controllers;

use App\Models\County;
use App\Models\Town;
use App\Models\Population;
use Illuminate\Http\Request;

class DataController extends Controller
{
    // Show the form to retrieve data (from the previous task)
    public function showForm()
    {
        // Retrieve necessary data for the form (e.g., counties and towns)
        $counties = County::all();
        $towns = Town::all();
        
        return view('retrieve-data.form', compact('counties', 'towns'));
    }

    // Handle the form submission and display the result (from the previous task)
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

    // Show the form to add new data
    public function showAddForm()
    {
        // Retrieve necessary data for the form (e.g., counties and towns)
        $counties = County::all();
        $towns = Town::all();

        return view('add-data.form', compact('counties', 'towns'));
    }

    // Handle the form submission and store the new data
    public function storeData(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'county' => 'required|exists:counties,id',
            'town' => 'required|exists:towns,id',
            'year' => 'required|integer',
            'women' => 'required|integer',
            'total' => 'required|integer',
        ]);

        // Store the new population data
        Population::create([
            'townid' => $request->town,
            'ryear' => $request->year,
            'women' => $request->women,
            'total' => $request->total,
        ]);

        // Redirect with a success message
        return redirect()->route('add-data.form')->with('success', 'Data added successfully.');
    }

    public function showChart()
{
    // Fetch the data from the population table (you can modify this query as needed)
    $populations = Population::join('towns', 'populations.townid', '=', 'towns.id')
        ->select('towns.tname', 'populations.ryear', 'populations.total')
        ->get();

    // Group the data by year and town and store it in a proper structure
    $years = $populations->pluck('ryear')->unique();
    $townNames = $populations->pluck('tname')->unique();

    $popData = [];

    // Build a 2D array for population data (indexed by year and town)
    foreach ($years as $year) {
        foreach ($townNames as $town) {
            $townPop = $populations->where('ryear', $year)->where('tname', $town)->first();
            $popData[$year][$town] = $townPop ? $townPop->total : 0;
        }
    }

    // Pass the data to the view
    return view('population-chart', compact('popData', 'years', 'townNames'));
}

    
    




}
