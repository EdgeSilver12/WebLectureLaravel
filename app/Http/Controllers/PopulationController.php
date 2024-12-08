<?php

namespace App\Http\Controllers;

use App\Models\Population;
use App\Models\Town;
use Illuminate\Http\Request;

class PopulationController extends Controller
{
    public function index()
    {
        $populations = Population::all();
        return view('populations.index', compact('populations'));
    }

    public function create()
    {
        $towns = Town::all(); // Get all towns for the dropdown
        return view('populations.create', compact('towns'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'townid' => 'required|exists:towns,id',
            'ryear' => 'required|integer',
            'women' => 'required|integer',
            'total' => 'required|integer',
        ]);

        Population::create([
            'townid' => $request->townid,
            'ryear' => $request->ryear,
            'women' => $request->women,
            'total' => $request->total,
        ]);

        return redirect()->route('populations.index')->with('success', 'Population data created successfully.');
    }

    public function edit($id)
    {
        $population = Population::findOrFail($id);
        $towns = Town::all(); // Get all towns for the dropdown
        return view('populations.edit', compact('population', 'towns'));
    }

    public function update(Request $request, $id)
    {
        $population = Population::findOrFail($id);
        $request->validate([
            'townid' => 'required|exists:towns,id',
            'ryear' => 'required|integer',
            'women' => 'required|integer',
            'total' => 'required|integer',
        ]);

        $population->update([
            'townid' => $request->townid,
            'ryear' => $request->ryear,
            'women' => $request->women,
            'total' => $request->total,
        ]);

        return redirect()->route('populations.index')->with('success', 'Population data updated successfully.');
    }

    public function destroy($id)
    {
        $population = Population::findOrFail($id);
        $population->delete();

        return redirect()->route('populations.index')->with('success', 'Population data deleted successfully.');
    }
}
