@extends('layouts.app')

@section('content')
    <h1>Population Chart</h1>

    <!-- Create a canvas element where the chart will be rendered -->
    <canvas id="populationChart" width="400" height="200"></canvas>

    <script>
        // Prepare the data passed from the controller
        const years = json($years);  // Array of years
        const townNames = json($townNames);  // Array of town names
        const popData = json($popData);  // 2D array containing population data

        // Prepare the chart data and labels
        const labels = townNames;  // Town names as the X-axis labels
        const datasets = years.map(year => {
            return {
                label: `Year ${year}`,  // Label for each dataset (year)
                data: townNames.map(town => {
                    // Safely access population data for each town in each year
                    return popData[year] && popData[year][town] ? popData[year][town] : 0;
                }),
                borderColor: getRandomColor(),
                fill: false
            };
        });

        // Generate random colors for the chart lines
        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        // Create the chart
        const ctx = document.getElementById('populationChart').getContext('2d');
        const populationChart = new Chart(ctx, {
            type: 'line',  // Type of chart (line chart)
            data: {
                labels: labels,  // Town names on the X-axis
                datasets: datasets  // Data for each year
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
