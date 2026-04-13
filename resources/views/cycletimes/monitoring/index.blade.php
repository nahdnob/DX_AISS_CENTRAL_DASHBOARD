@extends('layouts.system-manager')

@section('content')


<div class="p-4 sm:ml-16 mt-14 transition-all duration-300">
    <div class="p-4 min-h-[calc(100vh-5rem)]">

        {{-- ===== HERO HEADER ===== --}}
        <div class="relative bg-white rounded-2xl border border-gray-100 shadow-sm mb-6 overflow-hidden">
            {{-- Decorative BG --}}
            <div class="absolute inset-0 bg-gradient-to-r from-white via-white to-red-50/70 pointer-events-none"></div>
            <div class="absolute right-4 top-1/2 -translate-y-1/2 w-40 h-40 rounded-full bg-red-100/30 blur-2xl pointer-events-none"></div>
            {{-- Left accent bar --}}
            <div class="absolute left-0 top-0 w-1 h-full bg-gradient-to-b from-red-500 to-rose-700 rounded-l-2xl"></div>

            <div class="relative flex flex-col sm:flex-row sm:items-center justify-between gap-4 px-6 py-5">
                <div class="flex items-center gap-4">
                    <div class="shrink-0 w-14 h-14 rounded-xl bg-red-100 flex items-center justify-center shadow-inner">
                        <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight leading-tight">Cycle Time Monitoring</h1>
                        <p class="mt-0.5 text-sm text-gray-500 max-w-lg leading-relaxed">
                            Real-time sensor performance &amp; cycle efficiency for
                            <span class="font-semibold text-red-600">AISS System</span>.
                        </p>
                    </div>
                </div>

                {{-- Select Mode + Quick Info --}}
                <div class="flex flex-wrap items-center gap-3">

                    {{-- Inline Pattern Selector --}}
                    <form action="{{ route('pattern-histories.store') }}" method="POST"
                          class="flex items-center gap-2 px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-2xl shadow-sm">
                        @csrf
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest whitespace-nowrap">Mode</label>
                        <select name="pattern"
                                class="bg-white border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-red-500 focus:border-red-500 px-3 py-1.5 transition-all">
                            @foreach($patterns as $p)
                                <option value="{{ $p->id }}" {{ $activePattern?->id == $p->id ? 'selected' : '' }}>
                                    {{ $p->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit"
                                class="px-4 py-1.5 bg-gray-900 hover:bg-red-600 text-white text-xs font-bold rounded-xl transition-all duration-200 active:scale-[0.98] whitespace-nowrap">
                            Apply
                        </button>
                    </form>

                    {{-- Quick Info Badge --}}
                    @if($activePattern)
                    <div class="flex items-center gap-4 px-5 py-3 bg-gray-50 rounded-2xl border border-gray-100 shadow-sm">
                        <div class="text-center">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Active Mode</p>
                            <p class="text-sm font-bold text-gray-900 mt-0.5">{{ $activePattern->name }}</p>
                        </div>
                        <div class="w-px h-8 bg-gray-200"></div>
                        <div class="text-center">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">SCL</p>
                            <p class="text-sm font-bold text-red-600 mt-0.5">{{ $activePattern->cycle_time }}s</p>
                        </div>
                        <div class="w-px h-8 bg-gray-200"></div>
                        <div class="text-center">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">LCL / UCL</p>
                            <p class="text-sm font-bold text-gray-700 mt-0.5">{{ $activePattern->min_time }}s / {{ $activePattern->max_time }}s</p>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>

        {{-- ===== SCATTER DIAGRAM ===== --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-sm font-bold text-gray-900 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-md bg-sky-100 flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                        </svg>
                    </span>
                    Scatter Diagram — Cycle Time Over Time
                </h3>
                <div class="flex items-center gap-4 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                    <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-emerald-400 inline-block"></span> Normal</span>
                    <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-red-400 inline-block"></span> Abnormal</span>
                    <span class="flex items-center gap-1.5"><span class="w-6 border-t-2 border-dashed border-red-500 inline-block"></span> SCL</span>
                </div>
            </div>
            @if($recentLogs->count() > 0)
            <div class="h-64 w-full">
                <canvas id="scatterChart"></canvas>
            </div>
            @else
            <div class="h-64 flex flex-col items-center justify-center text-gray-400">
                <svg class="w-10 h-10 mb-2 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="6" cy="6" r="1.5" fill="currentColor"/><circle cx="12" cy="10" r="1.5" fill="currentColor"/><circle cx="18" cy="4" r="1.5" fill="currentColor"/></svg>
                <p class="text-sm italic">No data to plot yet.</p>
            </div>
            @endif
        </div>

        {{-- ===== MAIN GRID ===== --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- Chart Card (2/3 width) --}}
            <div class="xl:col-span-2">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 h-full">
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-sm font-bold text-gray-900 flex items-center gap-2">
                            <span class="w-6 h-6 rounded-md bg-red-100 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                                </svg>
                            </span>
                            Real-time Performance Chart
                        </h3>
                        <div class="flex items-center gap-4 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                            <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-sm bg-emerald-400 inline-block"></span> Normal</span>
                            <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-sm bg-red-400 inline-block"></span> Abnormal</span>
                            <span class="flex items-center gap-1.5"><span class="w-6 border-t-2 border-dashed border-red-500 inline-block"></span> SCL</span>
                        </div>
                    </div>

                    @if(count($realtimeData) > 0)
                        <div class="h-72 w-full">
                            <canvas id="realtimeChart"></canvas>
                        </div>
                    @else
                    <div class="h-72 flex flex-col items-center justify-center text-gray-400">
                        <svg class="w-12 h-12 mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/></svg>
                        <p class="text-sm italic">No realtime data available yet.</p>
                        <p class="text-xs mt-1">Waiting for active pattern data...</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Logs Card (1/3 width) --}}
            <div class="xl:col-span-1">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden h-full flex flex-col">
                    <div class="px-6 py-4 border-b border-gray-50 flex items-center justify-between shrink-0">
                        <h3 class="text-sm font-bold text-gray-900 flex items-center gap-2">
                            <span class="w-6 h-6 rounded-md bg-gray-100 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                            </span>
                            Recent Activity Log
                        </h3>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest bg-gray-100 px-2.5 py-1 rounded-full">
                            {{ $recentLogs->total() }} entries
                        </span>
                    </div>

                    <div class="overflow-y-auto flex-1">
                        <table class="w-full text-left">
                            <thead class="sticky top-0">
                                <tr class="bg-gray-50/80">
                                    <th class="px-5 py-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Time</th>
                                    <th class="px-5 py-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Sensor</th>
                                    <th class="px-5 py-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-center">Dur.</th>
                                    <th class="px-5 py-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($recentLogs as $log)
                                    <tr class="hover:bg-gray-50/70 transition-colors duration-150">
                                        <td class="px-5 py-3 whitespace-nowrap">
                                            <span class="text-xs font-medium text-gray-500">
                                                {{ \Carbon\Carbon::parse($log->time)->format('H:i:s') }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-3">
                                            <div class="flex items-center gap-2">
                                                <div class="w-2 h-2 rounded-full {{ $log->status == 1 ? 'bg-emerald-400' : 'bg-red-400' }}"></div>
                                                <span class="text-xs font-semibold text-gray-700">{{ $log->sensor?->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-5 py-3 text-center">
                                            <span class="text-xs font-bold text-gray-900">{{ number_format($log->duration, 2) }}<span class="font-normal text-gray-400 ml-0.5">s</span></span>
                                        </td>
                                        <td class="px-5 py-3 text-center">
                                            @if($log->status == 1)
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 uppercase tracking-wide">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> OK
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-100 text-red-700 uppercase tracking-wide">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> NG
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center text-gray-400">
                                                <svg class="w-10 h-10 mb-2 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                                <p class="text-sm italic">No activity recorded yet.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($recentLogs->hasPages())
                    <div class="px-5 py-3 border-t border-gray-100 bg-gray-50 flex items-center justify-between text-xs">
                        <div class="w-full relative">
                            {{ $recentLogs->withQueryString()->links('pagination::simple-tailwind') }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>

        </div>

        {{-- ===== HOURLY SUMMARY ===== --}}
        <div class="mt-8 mb-6 flex items-center justify-between">
            <h2 class="text-sm font-bold text-gray-900 flex items-center gap-2 uppercase tracking-wide">
                <span class="w-6 h-6 rounded-md bg-rose-100 flex items-center justify-center">
                    <svg class="w-3.5 h-3.5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                Hourly Summarize
                <span class="text-sky-500 ml-1">Cycle Time</span>
            </h2>
        </div>

        <div class="space-y-6">
            @forelse ($summaryData as $i => $summary)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 overflow-hidden">
                    <h3 class="text-md font-bold text-gray-900 text-center uppercase tracking-widest mb-6">
                        {{ 'POS ' . substr($summary['sensor_name'], -1) }}
                    </h3>

                    {{-- Summary Chart --}}
                    <div class="h-56 w-full mb-6">
                        <canvas id="chart_summary_{{ $i }}"></canvas>
                    </div>

                    {{-- Summary Table --}}
                    <div class="overflow-x-auto rounded-xl border border-gray-100">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 border-b border-gray-100 uppercase text-[10px] tracking-wider text-gray-400">
                                <tr>
                                    <th class="px-5 py-3 text-center font-bold w-24">Metric</th>
                                    @foreach ($summary['jam'] as $hour => $values)
                                        <th class="px-5 py-3 text-center font-bold whitespace-nowrap">Jam ke-{{ $hour }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-xs">
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-5 py-3 text-center font-bold text-gray-400 bg-gray-50/50">MAX</td>
                                    @foreach ($summary['jam'] as $values)
                                        <td class="px-5 py-3 text-center text-gray-600 font-semibold">{{ $values['max'] == 0 ? '-' : $values['max'] . 's' }}</td>
                                    @endforeach
                                </tr>
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-5 py-3 text-center font-bold text-sky-500 bg-gray-50/50">AVG</td>
                                    @foreach ($summary['jam'] as $values)
                                        <td class="px-5 py-3 text-center text-sky-600 font-bold bg-sky-50/30">{{ $values['avg'] == 0 ? '-' : $values['avg'] . 's' }}</td>
                                    @endforeach
                                </tr>
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-5 py-3 text-center font-bold text-gray-400 bg-gray-50/50">MIN</td>
                                    @foreach ($summary['jam'] as $values)
                                        <td class="px-5 py-3 text-center text-gray-600 font-semibold">{{ $values['min'] == 0 ? '-' : $values['min'] . 's' }}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl border border-dashed border-gray-300 p-12 flex flex-col items-center justify-center text-gray-400">
                    <svg class="w-12 h-12 mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <p class="text-sm font-medium">Belum ada data summary pada hari ini.</p>
                </div>
            @endforelse
        </div>

    </div>
</div>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation@3"></script>
<script>
    const CdnChart = window.Chart;

document.addEventListener('DOMContentLoaded', function () {
    // ─── Chart ──────────────────────────────────────────────────────
    @if(count($realtimeData) > 0)
    const ctx      = document.getElementById('realtimeChart').getContext('2d');
    const labels   = @json(collect($realtimeData)->pluck('sensor_name'));
    const durations = @json(collect($realtimeData)->pluck('duration'));
    const activeScl = {{ $activePattern?->cycle_time ?? 0 }};
    const activeMaxTime = {{ $activePattern?->max_time ?? 0 }};

    new CdnChart(ctx, {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Cycle Time (s)',
                data: durations,
                backgroundColor: durations.map(v => v > activeScl
                    ? 'rgba(239,68,68,0.80)'
                    : 'rgba(34,197,94,0.80)'),
                borderRadius: 8,
                borderWidth: 0,
                barThickness: 'flex',
                maxBarThickness: 48,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: activeMaxTime > 0 ? activeMaxTime + 5 : undefined,
                    grid: { color: '#f3f4f6', drawBorder: false },
                    ticks: { font: { size: 10, weight: 'bold' }, color: '#9ca3af',
                             callback: v => v + 's' },
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 10, weight: '600' }, color: '#4b5563' }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#111827',
                    titleFont: { size: 12, weight: 'bold' },
                    bodyFont:  { size: 12 },
                    padding: 12,
                    cornerRadius: 10,
                    displayColors: false,
                    callbacks: {
                        label: ctx => ` ${ctx.parsed.y.toFixed(2)}s  ${ctx.parsed.y > activeScl ? '⚠ Abnormal' : '✓ Normal'}`
                    }
                },
                annotation: {
                    annotations: {
                        sclLine: {
                            type: 'line',
                            yMin: activeScl,
                            yMax: activeScl,
                            borderColor: 'rgba(239,68,68,0.90)',
                            borderWidth: 2,
                            borderDash: [6, 4],
                            label: {
                                display: true,
                                content: 'SCL ' + activeScl + 's',
                                position: 'end',
                                backgroundColor: 'rgba(239,68,68,0.85)',
                                color: '#fff',
                                font: { size: 10, weight: 'bold' },
                                padding: { x: 8, y: 4 },
                                borderRadius: 6,
                            }
                        }
                    }
                }
            }
        }
    });
    @endif

    // ─── Scatter Chart ───────────────────────────────────────────────
    @if($scatterData->count() > 0)
    const scatterCtx = document.getElementById('scatterChart')?.getContext('2d');
    if (scatterCtx) {
        const scatterRaw   = @json($scatterData);
        const scatterScl   = {{ $activePattern?->cycle_time ?? 0 }};
        const scatterMaxTime = {{ $activePattern?->max_time ?? 0 }};
        const scatterLabels = scatterRaw.map(d => d.x);
        const scatterPoints = scatterRaw.map((d, i) => ({ x: i, y: d.y }));
        const scatterColors = scatterRaw.map(d => d.status == 1
            ? 'rgba(34,197,94,0.85)'
            : 'rgba(239,68,68,0.85)');

        new CdnChart(scatterCtx, {
            type: 'scatter',
            data: {
                datasets: [{
                    label: 'Cycle Time',
                    data: scatterPoints,
                    backgroundColor: scatterColors,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        type: 'linear',
                        ticks: {
                            font: { size: 10 }, color: '#6b7280',
                            callback: v => scatterLabels[v] ?? v,
                            maxTicksLimit: 12,
                        },
                        grid: { color: '#f3f4f6' }
                    },
                    y: {
                        beginAtZero: true,
                        max: scatterMaxTime > 0 ? scatterMaxTime + 5 : undefined,
                        grid: { color: '#f3f4f6', drawBorder: false },
                        ticks: { font: { size: 10, weight: 'bold' }, color: '#9ca3af',
                                 callback: v => v + 's' },
                    }
                },
                plugins: {
                    legend: { display: false },
                    datalabels: { display: false },
                    tooltip: {
                        backgroundColor: '#111827',
                        titleFont: { size: 11, weight: 'bold' },
                        bodyFont: { size: 11 },
                        padding: 10,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            title: items => scatterLabels[items[0].parsed.x] ?? '',
                            label: item => {
                                const d = scatterRaw[item.parsed.x];
                                return ` ${d.sensor} · ${item.parsed.y.toFixed(2)}s  ${item.parsed.y > scatterScl ? '⚠ Abnormal' : '✓ Normal'}`;
                            }
                        }
                    },
                    annotation: {
                        annotations: {
                            sclScatter: {
                                type: 'line',
                                yMin: scatterScl,
                                yMax: scatterScl,
                                borderColor: 'rgba(239,68,68,0.85)',
                                borderWidth: 2,
                                borderDash: [6, 4],
                                label: {
                                    display: true,
                                    content: 'SCL ' + scatterScl + 's',
                                    position: 'end',
                                    backgroundColor: 'rgba(239,68,68,0.85)',
                                    color: '#fff',
                                    font: { size: 10, weight: 'bold' },
                                    padding: { x: 8, y: 4 },
                                    borderRadius: 6,
                                }
                            }
                        }
                    }
                }
            }
        });
    }
    @endif

    // ─── Hourly Summary Charts ─────────────────────────────────────────
    const summaryChartData = @json($summaryData);
    const tactTimeScl = {{ $activePattern?->cycle_time ?? 0 }};
    const summaryMaxTime = {{ $activePattern?->max_time ?? 0 }};

    summaryChartData.forEach((summary, index) => {
        const canvas = document.getElementById(`chart_summary_${index}`);
        if (!canvas) return;
        const ctx = canvas.getContext('2d');

        const summaryLabels = Object.keys(summary.jam).map(j => `Jam ke-${j}`);
        const avgValues = Object.values(summary.jam).map(v => v.avg || 0);

        const barBgColors = avgValues.map(v => v > tactTimeScl ? 'rgba(239, 68, 68, 0.5)' : 'rgba(14, 165, 233, 0.5)');
        const barBdColors = avgValues.map(v => v > tactTimeScl ? 'rgba(239, 68, 68, 1)' : 'rgba(14, 165, 233, 1)');

        new CdnChart(ctx, {
            type: 'bar',
            data: {
                labels: summaryLabels,
                datasets: [{
                    label: 'Avg Cycle Time (s)',
                    data: avgValues,
                    backgroundColor: barBgColors,
                    borderColor: barBdColors,
                    borderWidth: 2,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 10, weight: 'bold' }, color: '#6b7280' }
                    },
                    y: {
                        beginAtZero: true,
                        max: summaryMaxTime > 0 ? summaryMaxTime + 5 : undefined,
                        grid: { color: '#f3f4f6' },
                        ticks: { font: { size: 11 }, callback: v => v + 's' }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#111827',
                        padding: 10,
                        titleFont: { size: 12 },
                        bodyFont: { size: 12, weight: 'bold' },
                        displayColors: false,
                        callbacks: {
                            label: function(item) {
                                return ` Avg: ${item.parsed.y}s`;
                            }
                        }
                    },
                    annotation: {
                        annotations: {
                            sclLine: {
                                type: 'line',
                                yMin: tactTimeScl,
                                yMax: tactTimeScl,
                                borderColor: 'rgba(239,68,68,0.85)',
                                borderWidth: 2,
                                borderDash: [6, 4],
                                label: {
                                    display: true,
                                    content: 'SCL ' + tactTimeScl + 's',
                                    position: 'start',
                                    backgroundColor: 'rgba(239,68,68,0.85)',
                                    color: '#fff',
                                    font: { size: 10, weight: 'bold' },
                                    padding: { x: 6, y: 4 },
                                    borderRadius: 4
                                }
                            }
                        }
                    }
                }
            }
        });
    });

    });
</script>
@endsection
