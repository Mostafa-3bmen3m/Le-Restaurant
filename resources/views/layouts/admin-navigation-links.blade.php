@php
    $navLinks = [
        ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
        ['route' => 'admin.categories.index', 'label' => 'Categories', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
        ['route' => 'admin.meals.index', 'label' => 'Meals', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
    ];
@endphp

@foreach($navLinks as $link)
    <li>
        <a href="{{ route($link['route']) }}"
            class="{{ request()->routeIs($link['route'] . '*') ? 'bg-gray-700 text-purple-400' : 'text-gray-300 hover:text-purple-400 hover:bg-gray-700' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200">
            <svg class="{{ request()->routeIs($link['route'] . '*') ? 'text-purple-400' : 'text-gray-400 group-hover:text-purple-400' }} h-6 w-6 shrink-0"
                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $link['icon'] }}" />
            </svg>
            {{ $link['label'] }}
        </a>
    </li>
@endforeach