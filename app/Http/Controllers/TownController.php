<?php

namespace App\Http\Controllers;

use App\Models\Town;
use App\Models\County;
use Illuminate\Http\Request;

class TownController extends Controller
{
    public function index()
    {
        $towns = Town::all();
        return view('towns.index', compact('towns'));
    }

    public function create()
    {
        $counties = County::all(); // Get all counties for the dropdown
        return view('towns.create', compact('counties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tname' => 'required|string|max:255|unique:towns',
            'countyid' => 'required|exists:counties,id',
            'countyseat' => 'required|boolean',
            'countylevel' => 'required|boolean',
        ]);

        Town::create([
            'tname' => $request->tname,
            'countyid' => $request->countyid,
            'countyseat' => $request->countyseat,
            'countylevel' => $request->countylevel,
        ]);

        return redirect()->route('towns.index')->with('success', 'Town created successfully.');
    }

    public function edit($id)
    {
        $town = Town::findOrFail($id);
        $counties = County::all(); // Get all counties for the dropdown
        return view('towns.edit', compact('town', 'counties'));
    }

    public function update(Request $request, $id)
    {
        $town = Town::findOrFail($id);
        $request->validate([
            'tname' => 'required|string|max:255|unique:towns,tname,' . $town->id,
            'countyid' => 'required|exists:counties,id',
            'countyseat' => 'required|boolean',
            'countylevel' => 'required|boolean',
        ]);

        $town->update([
            'tname' => $request->tname,
            'countyid' => $request->countyid,
            'countyseat' => $request->countyseat,
            'countylevel' => $request->countylevel,
        ]);

        return redirect()->route('towns.index')->with('success', 'Town updated successfully.');
    }

    public function destroy($id)
    {
        $town = Town::findOrFail($id);
        $town->delete();

        return redirect()->route('towns.index')->with('success', 'Town deleted successfully.');
    }
}
