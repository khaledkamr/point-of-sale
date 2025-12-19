@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex justify-center items-center gap-2 mt-6 direction-ltr">
        <ul class="flex justify-center items-center gap-2 flex-wrap sm:gap-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="flex items-center" aria-disabled="true">
                    <span class="flex items-center justify-center px-4 py-2 mx-0.5 font-semibold text-gray-400 bg-gray-50 border border-gray-200 rounded-lg cursor-not-allowed pointer-events-none min-w-10 h-10">
                        {{ __('السابق') }}
                    </span>
                </li>
            @else
                <li class="flex items-center">
                    <a class="flex items-center justify-center px-4 py-2 mx-0.5 font-semibold text-gray-500 bg-white border border-gray-300 rounded-lg no-underline transition-all duration-200 ease-in-out min-w-10 h-10 hover:text-orange-500 hover:bg-orange-50 hover:border-orange-500 hover:shadow-sm hover:shadow-orange-500/10" 
                       href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        {{ __('السابق') }}
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="flex items-center" aria-disabled="true">
                        <span class="flex items-center justify-center px-3 py-2 mx-0.5 font-medium text-gray-400 bg-gray-50 border border-gray-200 rounded-lg cursor-not-allowed pointer-events-none min-w-10 h-10">
                            {{ $element }}
                        </span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="flex items-center" aria-current="page">
                                <span class="flex items-center justify-center px-3 py-2 mx-0.5 font-medium text-white bg-orange-500 border border-orange-500 rounded-lg shadow-md shadow-orange-500/30 min-w-10 h-10">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li class="flex items-center">
                                <a class="flex items-center justify-center px-3 py-2 mx-0.5 font-medium text-gray-500 bg-white border border-gray-300 rounded-lg no-underline transition-all duration-200 ease-in-out min-w-10 h-10 hover:text-orange-500 hover:bg-orange-50 hover:border-orange-500 hover:shadow-sm hover:shadow-orange-500/10" 
                                   href="{{ $url }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="flex items-center">
                    <a class="flex items-center justify-center px-4 py-2 mx-0.5 font-semibold text-gray-500 bg-white border border-gray-300 rounded-lg no-underline transition-all duration-200 ease-in-out min-w-10 h-10 hover:text-orange-500 hover:bg-orange-50 hover:border-orange-500 hover:shadow-sm hover:shadow-orange-500/10" 
                       href="{{ $paginator->nextPageUrl() }}" rel="next">
                        {{ __('التالي') }}
                    </a>
                </li>
            @else
                <li class="flex items-center" aria-disabled="true">
                    <span class="flex items-center justify-center px-4 py-2 mx-0.5 font-semibold text-gray-400 bg-gray-50 border border-gray-200 rounded-lg cursor-not-allowed pointer-events-none min-w-10 h-10">
                        {{ __('التالي') }}
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif