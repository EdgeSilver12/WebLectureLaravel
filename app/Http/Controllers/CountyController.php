<?php

namespace App\Http\Controllers;

use App\Models\County;
use Illuminate\Http\Request;

class CountyController extends Controller
{
    public function index()
    {
        $counties = County::all();
        return view('counties.index', compact('counties'));
    }

    public function create()
    {
        return view('counties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cname' => 'required|string|max:255|unique:counties',
        ]);

        County::create([
            'cname' => $request->cname,
        ]);

        return redirect()->route('counties.index')->with('success', 'County created successfully.');
    }

    public function edit($id)
    {
        $county = County::findOrFail($id);
        return view('counties.edit', compact('county'));
    }

    public function update(Request $request, $id)
    {
        $county = County::findOrFail($id);
        $request->validate([
            'cname' => 'required|string|max:255|unique:counties,cname,' . $county->id,
        ]);

        $county->update([
            'cname' => $request->cname,
        ]);

        return redirect()->route('counties.index')->with('success', 'County updated successfully.');
    }

    public function destroy($id)
    {
        $county = County::findOrFail($id);
        $county->delete();

        return redirect()->route('counties.index')->with('success', 'County deleted successfully.');
    }
}
