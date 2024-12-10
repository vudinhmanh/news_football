@if ($paginator->hasPages())
    <nav aria-label="Page navigation" class="flex justify-center">
        <ul class="flex items-center space-x-2">
            {{-- Nút Previous --}}
            @if ($paginator->onFirstPage())
                <li class="disabled">
                    <span class="px-3 py-1 bg-gray-300 text-gray-600 rounded-md cursor-not-allowed flex items-center justify-center w-10 h-10">
                        <!-- Mũi tên trái -->
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </span>
                </li>
            @else
                <li>
                    <a class="px-3 py-1 bg-[#1c84c6] text-white rounded-md flex items-center justify-center w-10 h-10" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <!-- Mũi tên trái -->
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                </li>
            @endif

            {{-- Hiển thị các trang --}}
            @php
                $currentPage = $paginator->currentPage();
                $totalPages = $paginator->lastPage();
                $pageRange = 1; // Số trang hiển thị ở đầu và cuối
            @endphp

            {{-- Trang đầu --}}
            @if ($totalPages > 5 && $currentPage > $pageRange + 1)
                <li>
                    <a class="px-3 py-1 bg-white text-[#1c84c6] rounded-md hover:bg-gray-100 w-10 h-10 flex items-center justify-center" href="{{ $paginator->url(1) }}">1</a>
                </li>
                <li class="disabled">
                    <span class="px-3 py-1 bg-gray-300 text-gray-600 rounded-md cursor-not-allowed w-10 h-10 flex items-center justify-center">...</span>
                </li>
            @endif

            {{-- Các trang gần hiện tại --}}
            @for ($i = max(1, $currentPage - $pageRange); $i <= min($totalPages, $currentPage + $pageRange); $i++)
                @if ($i == $currentPage)
                    <li>
                        <span class="px-3 py-1 bg-[#1c84c6] text-white rounded-md w-10 h-10 flex items-center justify-center">{{ $i }}</span>
                    </li>
                @else
                    <li>
                        <a class="px-3 py-1 bg-white text-[#1c84c6] rounded-md hover:bg-gray-100 w-10 h-10 flex items-center justify-center" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor

            {{-- Trang cuối --}}
            @if ($totalPages > 5 && $currentPage < $totalPages - $pageRange - 1)
                <li class="disabled">
                    <span class="px-3 py-1 bg-gray-300 text-gray-600 rounded-md cursor-not-allowed w-10 h-10 flex items-center justify-center">...</span>
                </li>
                <li>
                    <a class="px-3 py-1 bg-white text-[#1c84c6] rounded-md hover:bg-gray-100 w-10 h-10 flex items-center justify-center" href="{{ $paginator->url($totalPages) }}">{{ $totalPages }}</a>
                </li>
            @endif

            {{-- Nút Next --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a class="px-3 py-1 bg-[#1c84c6] text-white rounded-md  flex items-center justify-center w-10 h-10" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <!-- Mũi tên phải -->
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </li>
            @else
                <li class="disabled">
                    <span class="px-3 py-1 bg-gray-300 text-gray-600 rounded-md cursor-not-allowed flex items-center justify-center w-10 h-10">
                        <!-- Mũi tên phải -->
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif


