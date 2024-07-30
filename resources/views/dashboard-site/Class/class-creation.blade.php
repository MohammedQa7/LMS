<x-app-layout>
    <x-dashboard.breadcrump-data></x-dashboard.breadcrump-data>
    <div class="creation-header flex items-center mb-4">
        <h2 class="text-4xl font-extrabold dark:text-white ">New Class</h2>
    </div>

    @livewire('class.ClassFormComponent')



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
