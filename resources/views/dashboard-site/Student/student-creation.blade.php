<x-app-layout>
    <x-dashboard.breadcrump-data></x-dashboard.breadcrump-data> 
    <div class="creation-header flex items-center mb-4">
        <a class="me-3 border p-3 shadow-sm rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-700 transition-all" href="{{ URL('/student') }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </a>
        <h2 class="text-4xl font-extrabold dark:text-white ">New Student</h2>
    </div>

    @livewire('students.StudentFormComponent',['isEditable' =>$isEditable ?? false,'student'=>$student ?? null])
    

    {{-- @push('script')
        <script>
            // In your Javascript (external .js resource or <script> tag)
            $(document).ready(function() {
                $('.level-selection').select2();
            });
            // In your Javascript (external .js resource or <script> tag)
            $(document).ready(function() {
                $('.subject-selection').select2();
            });
        </script>
    @endpush --}}
</x-app-layout>
