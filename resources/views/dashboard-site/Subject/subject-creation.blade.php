<x-app-layout>
    <x-dashboard.breadcrump-data></x-dashboard.breadcrump-data> 
    <div class="creation-header flex items-center mb-4">
        <a class="me-3 border p-3 shadow-sm rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-700 transition-all" href="{{ URL('/subject') }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </a>
        <h2 class="text-4xl font-extrabold dark:text-white ">New Subject</h2>
    </div>


    <div
        class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <h3 class="mb-4 text-xl font-semibold dark:text-white">Subject information</h3>
        @livewire('Subject.SubjectFormComponent')
    </div>

</x-app-layout>
