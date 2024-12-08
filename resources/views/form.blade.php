@extends('layouts.app')

@section('content')
    <h1>Retrieve Population Data</h1>

    <form action="{{ route('retrieve-data.handle') }}" method="POST">
        @csrf

        <!-- County Dropdown -->
        <div>
            <label for="county">County</label>
            <select name="county" id="county">
                <option value="">Select a County</option>
                @foreach($counties as $county)
                    <option value="{{ $county->id }}">{{ $county->cname }}</option>
                @endforeach
            </select>
        </div>

        <!-- Town Dropdown -->
        <div>
            <label for="town">Town</label>
            <select name="town" id="town">
                <option value="">Select a Town</option>
                @foreach($towns as $town)
                    <option value="{{ $town->id }}">{{ $town->tname }}</option>
                @endforeach
            </select>
        </div>

        <!-- Year Textbox -->
        <div>
            <label for="year">Year</label>
            <input type="text" name="year" id="year" placeholder="Enter Year (e.g. 2020)">
        </div>

        <!-- Population Type Radio Buttons -->
        <div>
            <label>Population Type</label>
            <label for="total">Total Population</label>
            <input type="radio" name="population_type" id="total" value="total">
            <label for="women">Women Population</label>
            <input type="radio" name="population_type" id="women" value="women">
        </div>

        <button type="submit">Retrieve Data</button>
    </form>
@endsection
