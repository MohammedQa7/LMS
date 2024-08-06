<x-app-layout>
    <!-- component -->
    <x-dashboard.breadcrump-data></x-dashboard.breadcrump-data>
    <h2 class="text-4xl font-extrabold dark:text-white mb-4">Materials</h2>

    @livewire('materials.MaterialListComponent' , ['class_slug' => $class_slug ,'subject_slug' => $subject_slug])
    

</x-app-layout>
