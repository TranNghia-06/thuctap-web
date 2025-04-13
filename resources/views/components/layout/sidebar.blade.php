@props([
    'items' => [],
])

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-gradient-to-b from-white to-gray-50 shadow-lg sm:translate-x-0 dark:from-gray-900 dark:to-gray-800 border-r border-gray-200/80 dark:border-gray-700/50"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-6 overflow-y-auto">
        <ul class="space-y-2 font-medium">
            @foreach ($items as $item)
                <li>
                    <a href="{{ route($item['route']) }}"
                        class="relative flex items-center p-3 rounded-xl transition-all duration-300 group
                               {{ Route::is($item['route']) ? 
                                  'bg-gradient-to-r from-blue-500 to-indigo-500 text-white shadow-blue-200 shadow-md dark:shadow-none' : 
                                  'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800/60' }}">
                        
                        <!-- Active item indicator -->
                        @if(Route::is($item['route']))
                            <span class="absolute -left-2 w-1 h-6 bg-white rounded-full"></span>
                        @endif
                        
                        <!-- Icon with cool hover effect -->
                        <div class="{{ Route::is($item['route']) ? 'text-white' : 'text-gray-500 group-hover:text-indigo-500 dark:text-gray-400 dark:group-hover:text-blue-400' }}">
                            <x-common.icon :name="$item['icon']" class="w-5 h-5 transition-transform group-hover:scale-110" />
                        </div>
                        
                        <span class="flex-1 ms-3 whitespace-nowrap font-medium">
                            {{ $item['name'] }}
                        </span>
                        
                        @isset($item['count'])
                            <span class="{{ Route::is($item['route']) ? 
                                       'bg-white/20 text-white' : 
                                       'bg-indigo-100 text-indigo-800 dark:bg-gray-700 dark:text-gray-300' }} 
                                   px-2 py-0.5 text-xs font-semibold rounded-full">
                                {{ $item['count'] }}
                            </span>
                        @endisset
                        
                        <!-- Hover arrow effect -->
                        <svg class="w-4 h-4 ms-2 opacity-0 group-hover:opacity-100 transition-opacity {{ Route::is($item['route']) ? 'text-white' : 'text-indigo-400' }}" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </li>
            @endforeach
        </ul>
        
    </div>
</aside>