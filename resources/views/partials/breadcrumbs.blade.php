@unless ($breadcrumbs->isEmpty())

    <div class="breadcrumb flex items-center mb-5">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!is_null($breadcrumb->url) && !$loop->last)
                <a class="text-black dark:text-white" href="{{ $breadcrumb->url }}"> {{ $breadcrumb->title }} 
                </a>
                <svg class="w-4 h-4 me-2 ms-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                  </svg>
                  
            @else
                <p class="breadcrumb-item text-indigo-600">{{ $breadcrumb->title }}</p>
            @endif
        @endforeach

    </div>

@endunless
