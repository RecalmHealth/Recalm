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
                            <div class="d-flex gap-2">
                                <div class="dropdown">
                                    <button
                                        class="btn btn-outline-secondary dropdown-toggle rounded-pill px-4 text-capitalize"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                        style="border-color: #6c757d;">
                                        Per - {{ $filter == 'year' ? 'tahun' : ($filter == 'month' ? 'bulan' : 'minggu') }}
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="?filter=week">Per - minggu</a></li>
                                        <li><a class="dropdown-item" href="?filter=month">Per - bulan</a></li>
                                        <li><a class="dropdown-item" href="?filter=year">Per - tahun</a></li>
                                    </ul>
                                </div>
                                <button onclick="downloadPdf()" class="btn btn-outline-secondary rounded-circle"
                                    style="width: 40px; height: 40px; border-color: #6c757d;">
                                    <i class="bi bi-download"></i>
                                </button>
                                <form id="downloadPdfForm" action="{{ route('statistik.download') }}" method="POST"
                                    target="_blank" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="filter" value="{{ $filter }}">
                                    <input type="hidden" name="chart_image" id="chartImageInput">
                                </form>
                            </div>
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
        <div class="row g-4">
            {{-- Mood List (Left Column) Ditambahkan --}}
            <div class="col-md-6">
                <!-- Fixed height for exactly 3 items (~300px + padding) -->
                <div style="height: 320px; overflow-y: auto; padding-right: 5px;">
                    @forelse($historyNotes as $note)
                        <div class="card border-0 shadow-sm mb-3" style="border-radius: 12px;">
                            <div class="card-body p-3 d-flex align-items-center gap-3">
                                <div style="width: 50px; height: 50px;">
                                    {{-- Dynamic Image Icon based on Mood --}}
                                    @if ($note->Mood == 'Senang')
                                        <img src="{{ asset('images/emots/senang.png') }}" width="100%" height="100%"
                                            alt="Senang">
                                    @elseif($note->Mood == 'Marah')
                                        <img src="{{ asset('images/emots/marah.png') }}" width="100%" height="100%"
                                            alt="Marah">
                                    @else
                                        <img src="{{ asset('images/emots/sedih.png') }}" width="100%" height="100%"
                                            alt="Sedih">
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h6 class="fw-bold m-0" style="color: #4361EE;">{{ $note->Mood }}</h6>
                                        <small class="text-muted"
                                            style="font-size: 0.7rem;">{{ $note->created_at->format('d F Y') }}</small>
                                    </div>
                                    <p class="text-secondary small m-0 text-truncate"
                                        style="font-size: 0.75rem; line-height: 1.3; max-width: 250px;">
                                        {{ Str::limit($note->Note, 60) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5 text-muted">
                            <p>Belum ada riwayat mood.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            {{-- Insight Card (Right Column) --}}
            <div class="col-md-6">
                <div class="card border-0 shadow-sm" style="border-radius: 15px; height: 320px;">
                    <div class="card-body p-4 d-flex flex-column justify-content-center align-items-center text-center">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="bi {{ $insightIcon }}" style="font-size: 1.5rem; color: {{ $insightColor }};"></i>
                            <h5 class="fw-bold m-0" style="color: {{ $insightColor }};">{{ $insightTitle }}</h5>
                        </div>
                        <p class="text-dark m-0" style="line-height: 1.8;">
                            {!! $insightDesc !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {{-- JS sama seperti Backlog 4 --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function downloadPdf() {
            const canvas = document.getElementById('moodChart');
            const chartImage = canvas.toDataURL('image/png');
            document.getElementById('chartImageInput').value = chartImage;
            document.getElementById('downloadPdfForm').submit();
        }
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('moodChart').getContext('2d');
            const currentFilter = '{{ $filter }}';
            const labels = [''].concat(@json($labels));
            let activeLabelOffset = -20;
            if (currentFilter === 'month') activeLabelOffset = -55;
            else if (currentFilter === 'week') activeLabelOffset = -25;
            else if (currentFilter === 'year') activeLabelOffset = -10;
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
                                labelOffset: activeLabelOffset
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
