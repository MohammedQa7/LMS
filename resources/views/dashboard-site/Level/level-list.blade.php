<x-app-layout >
    <!-- component -->
    <x-dashboard.breadcrump-data></x-dashboard.breadcrump-data> 
    <h2 class="text-4xl font-extrabold dark:text-white mb-4">Levels</h2>

    @role('administrator')
    @livewire('Level.LevelListViewComponent')
    @endrole

    
    @role('teacher')
    @livewire('Level.TeacherLevelListComponent')
    @endrole
    

</x-app-layout>
