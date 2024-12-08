@extends('layouts.app')

@section('content')
    <h1>Query Results</h1>

    @if($results->isEmpty())
        <p>No data found matching your criteria.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Town</th>
                    <th>Year</th>
                    <th>Population Type</th>
                    <th>Population</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $result)
                    <tr>
                        <td>{{ $result->town->tname }}</td>
                        <td>{{ $result->ryear }}</td>
                        <td>{{ $result->population_type }}</td>
                        <td>{{ $result->$population_type }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
