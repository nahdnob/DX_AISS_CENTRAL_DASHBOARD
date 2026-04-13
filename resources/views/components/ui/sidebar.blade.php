@php
    $currentRoute = request()->route()?->getName() ?? '';

    $navItems = [
        ['label' => 'Home',             'route' => '#',                         'match' => '',                    'icon' => 'home'],
        ['label' => 'Best Record',      'route' => route('best-records.index'), 'match' => 'best-records',        'icon' => 'trophy'],
        ['label' => 'Line Performance', 'route' => route('line-performance.index'), 'match' => 'line-performance','icon' => 'chart'],
        ['label' => 'Production',       'route' => route('products.index'),     'match' => 'products',            'icon' => 'box'],
        ['label' => 'Cycle Time',       'icon' => 'clock', 'children' => [
            ['label' => 'Monitoring', 'route' => route('cycletimes.monitoring.index'), 'match' => 'cycletimes.monitoring'],
            ['label' => 'Setting',    'route' => route('cycletimes.setting.index'),    'match' => 'cycletimes.setting'],
        ]],
    ];
@endphp

<style>
    /* ── Sidebar hover-expand ── */
    #top-bar-sidebar {
        width: 56px !important;
        transform: translateX(0) !important;
        transition: width 0.25s cubic-bezier(.4,0,.2,1);
        overflow: hidden;
    }
    #top-bar-sidebar:hover {
        width: 220px !important;
    }
    /* Hide text labels by default, show on hover */
    #top-bar-sidebar .nav-label {
        opacity: 0;
        width: 0;
        overflow: hidden;
        white-space: nowrap;
        transition: opacity 0.18s ease, width 0.25s ease;
        pointer-events: none;
    }
    #top-bar-sidebar:hover .nav-label {
        opacity: 1;
        width: auto;
        pointer-events: auto;
    }
    #top-bar-sidebar:hover .nav-label-block {
        width: 100%;
        opacity: 1;
        pointer-events: auto;
    }
    
    /* Icon always centred when collapsed */
    #top-bar-sidebar .nav-link {
        display: flex;
        align-items: center;
        padding: 8px 10px;
        border-radius: 10px;
        gap: 12px;
        transition: background 0.15s, color 0.15s;
        cursor: pointer;
        text-decoration: none;
    }
    #top-bar-sidebar .nav-link:hover {
        background: rgba(239,68,68,0.08);
        color: #dc2626;
    }
    #top-bar-sidebar .nav-link.active {
        background: rgba(239,68,68,0.12);
        color: #dc2626;
        border-left: 3px solid #dc2626;
        padding-left: 7px;
    }
    #top-bar-sidebar .nav-link .nav-icon {
        flex-shrink: 0;
        width: 20px;
        height: 20px;
    }
</style>

<aside id="top-bar-sidebar"
       class="fixed top-0 left-0 z-40 h-full bg-white border-r border-gray-100 shadow-sm"
       aria-label="Sidebar">

    <!-- Logo area -->
    <div class="flex items-center justify-center h-14 border-b border-gray-100">
        <!-- Icon always visible -->
        <svg class="w-6 h-6 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 3H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V9l-6-6z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v6h6"/>
        </svg>
        <!-- Brand label (hidden when collapsed) -->
        <span class="nav-label ml-2 text-sm font-bold text-gray-800 tracking-wide">DENSO</span>
    </div>

    <!-- Nav items -->
    <nav class="px-2 pt-4 space-y-1">
        @foreach ($navItems as $item)
            @if(isset($item['children']))
                @php
                    $isParentActive = collect($item['children'])->contains(function($child) use ($currentRoute) {
                        return $child['match'] !== '' && str_contains($currentRoute, $child['match']);
                    });
                @endphp
                <div x-data="{ open: {{ $isParentActive ? 'true' : 'false' }} }">
                    <button @click="open = !open"
                            class="nav-link w-full justify-between {{ $isParentActive ? 'text-red-600 font-bold' : 'text-gray-500' }}">
                        <div class="flex items-center gap-[12px]">
                            @if($item['icon'] === 'clock')
                                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            @endif
                            <span class="nav-label text-sm font-semibold">{{ $item['label'] }}</span>
                        </div>
                        <svg class="nav-label w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <!-- Submenu items -->
                    <div x-show="open" 
                         x-collapse
                         class="nav-label nav-label-block overflow-hidden flex flex-col ml-[36px] mt-1 space-y-1">
                        @foreach($item['children'] as $child)
                            @php
                                $isChildActive = $child['match'] !== '' && str_contains($currentRoute, $child['match']);
                            @endphp
                            <a href="{{ $child['route'] }}" class="text-sm py-1.5 px-3 rounded-lg transition-colors {{ $isChildActive ? 'text-red-600 bg-red-50 font-semibold' : 'text-gray-500 hover:text-red-500 hover:bg-gray-50' }}">
                                {{ $child['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                @php
                    $isActive = $item['match'] !== '' && str_contains($currentRoute, $item['match']);
                @endphp
                <a href="{{ $item['route'] }}"
                   class="nav-link {{ $isActive ? 'active' : 'text-gray-500' }}"
                   title="{{ $item['label'] }}">

                    {{-- ── Icons ── --}}
                    @if($item['icon'] === 'home')
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M5 10v9a1 1 0 001 1h4v-5h4v5h4a1 1 0 001-1v-9"/>
                        </svg>
                    @elseif($item['icon'] === 'trophy')
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v5m0 0H9m3 0h3M8 10H5a2 2 0 01-2-2V5h5m0 5h8m0 0h3a2 2 0 002-2V5h-3m-8 5V5h8v5"/>
                        </svg>
                    @elseif($item['icon'] === 'chart')
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    @elseif($item['icon'] === 'box')
                        <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10V6a3 3 0 013-3h0a3 3 0 013 3v4m3-2l.917 11.923A1 1 0 0117.92 21H6.08a1 1 0 01-.997-1.077L6 8h12z"/>
                        </svg>
                    @endif

                    <span class="nav-label text-sm font-semibold">{{ $item['label'] }}</span>
                </a>
            @endif
        @endforeach
    </nav>

    <!-- Back (bottom) -->
    <div class="absolute bottom-4 left-0 right-0 px-2">
        <a href="{{ route('dashboards.index') }}"
           class="nav-link w-full text-gray-400 hover:text-red-500 hover:bg-red-50"
           title="Back to Dashboard">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span class="nav-label text-sm font-semibold">Back</span>
        </a>
    </div>
</aside>