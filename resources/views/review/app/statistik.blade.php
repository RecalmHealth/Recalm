@extends('layouts.dashboard')

@section('title', 'Mood Kamu')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="fw-bold m-0" style="font-size: 1.25rem;">Statistic Summary</h4>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div style="height: 350px; width: 100%;">
                                    <canvas id="moodChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('moodChart').getContext('2d');

            const labels = [''].concat(@json($labels));

            const yAxisDecorationPlugin = {
                id: 'yAxisDecoration',
                afterDraw: (chart) => {
                    const ctx = chart.ctx;
                    const yAxis = chart.scales.y;
                    const xAxis = chart.scales.x;
                    const dotRadius = 8;
                    const dotX = xAxis.getPixelForTick(0);
                    const dots = [{
                            value: 25,
                            color: '#1E4F91'
                        },
                        {
                            value: 15,
                            color: '#E69500'
                        },
                        {
                            value: 5,
                            color: '#D32F2F'
                        }
                    ];
                    dots.forEach(dot => {
                        const y = yAxis.getPixelForValue(dot.value);
                        ctx.beginPath();
                        ctx.arc(dotX, y, dotRadius, 0, 2 * Math.PI);
                        ctx.fillStyle = dot.color;
                        ctx.fill();
                        ctx.closePath();
                    });
                }
            };
            const data = {
                labels: labels,
                datasets: [{
                        label: 'Senang',
                        data: [25].concat(@json($senangData).map(c => Math.min(25 + (c * 4),
                            30))),
                        borderColor: '#1E4F91',
                        backgroundColor: '#1E4F91',
                        borderWidth: 4,
                        tension: 0,
                        pointRadius: 0,
                        pointHoverRadius: 5
                    },
                    {
                        label: 'Marah',
                        data: [15].concat(@json($marahData).map(c => Math.min(15 + (c * 4),
                            20))),
                        borderColor: '#E69500',
                        backgroundColor: '#E69500',
                        borderWidth: 4,
                        tension: 0,
                        pointRadius: 0,
                        pointHoverRadius: 5
                    },
                    {
                        label: 'Sedih',
                        data: [5].concat(@json($sedihData).map(c => Math.min(5 + (c * 4), 10))),
                        borderColor: '#D32F2F',
                        backgroundColor: '#D32F2F',
                        borderWidth: 4,
                        tension: 0,
                        pointRadius: 0,
                        pointHoverRadius: 5
                    }
                ]
            };
            const config = {
                type: 'line',
                data: data,
                plugins: [yAxisDecorationPlugin],
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 5,
                            right: 20,
                            top: 10,
                            bottom: 10
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 14,
                                    weight: 'bold',
                                    family: "'Poppins', sans-serif"
                                },
                                color: '#1E4F91',
                                padding: 15,
                                labelOffset: -55
                            },
                            border: {
                                display: false
                            },
                            offset: false
                        },
                        y: {
                            display: true,
                            min: 0,
                            max: 40,
                            ticks: {
                                display: false
                            },
                            grid: {
                                color: (ctx) => [0, 10, 20, 30].includes(ctx.tick.value) ? '#e0e0e0' :
                                    'transparent',
                                drawBorder: false,
                                drawTicks: false
                            },
                            border: {
                                display: false
                            }
                        }
                    }
                }
            };
            new Chart(ctx, config);
        });
    </script>
@endsection
