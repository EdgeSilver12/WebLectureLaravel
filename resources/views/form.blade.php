@extends('layouts.app')

@section('content')
    <h1>Add New Data or Retrieve Data</h1>

    <!-- Section for adding new data (Task 5) -->
    <div>
        <h2>Add New Population Data</h2>

        <!-- Display success message if the data is successfully added -->
        @if(session('success'))
            <div>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Display validation errors -->
        @if($errors->any())
            <div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form to add new population data -->
        <form action="{{ route('add-data.store') }}" method="POST">
            @csrf

            <!-- County Dropdown -->
            <div>
                <label for="county">County</label>
                <select name="county" id="county" required>
                    <option value="">Select a County</option>
                    @foreach($counties as $county)
                        <option value="{{ $county->id }}">{{ $county->cname }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Town Dropdown -->
            <div>
                <label for="town">Town</label>
                <select name="town" id="town" required>
                    <option value="">Select a Town</option>
                    @foreach($towns as $town)
                        <option value="{{ $town->id }}">{{ $town->tname }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Year Input -->
            <div>
                <label for="year">Year</label>
                <input type="number" name="year" id="year" required placeholder="Enter Year (e.g. 2020)">
            </div>

            <!-- Women Population -->
            <div>
                <label for="women">Women Population</label>
                <input type="number" name="women" id="women" required placeholder="Enter number of women">
            </div>

            <!-- Total Population -->
            <div>
                <label for="total">Total Population</label>
                <input type="number" name="total" id="total" required placeholder="Enter total population">
            </div>

            <button type="submit">Add Data</button>
        </form>
    </div>

    <hr>

    <!-- Section for retrieving data (Task 4) -->
    <div>
        <h2>Retrieve Population Data</h2>

        <!-- Form to retrieve data -->
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
    </div>
@endsection
