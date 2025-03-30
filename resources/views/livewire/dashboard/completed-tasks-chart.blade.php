<div>

    <div class="w-full">
        <canvas id="completedTasksChart"
                class="h-96 w-full"></canvas>
    </div>
</div>


@assets

@endassets
<script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
@script
    <script>
        renderChart();
        function renderChart() {
            const ctx = document.getElementById('completedTasksChart').getContext('2d');
            const labels = $wire.labels;
            const data = $wire.data;

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Low Priority',
                            data: data.low,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Medium Priority',
                            data: data.medium,
                            backgroundColor: 'rgba(237, 208, 63, 0.2)',
                            borderColor: 'rgba(237,208,63,1)',
                            borderWidth: 1
                        },
                        {
                            label: 'High Priority',
                            data: data.high,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Important for custom height
                    plugins: {
                        legend: {
                            display: true
                        },
                        title: {
                            display: true,
                            text: 'Completed Tasks (By Priority)',
                            font: {
                                size: 20,
                                weight: 'bold',
                            },
                            padding: {
                                top: 20, // Padding above the title
                                bottom: 30 // Padding below the title
                            },
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Months'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Number of Completed Tasks'
                            },
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    // Ensure only integers are displayed
                                    if (Number.isInteger(value)) {
                                        return value; // Return the integer value
                                    }
                                },
                                stepSize: 1 // Force the steps to increment by 1
                            }
                        }
                    }
                }
            });
        }
    </script>
@endscript
