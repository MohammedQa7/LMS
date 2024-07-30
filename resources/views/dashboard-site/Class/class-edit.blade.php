<x-app-layout>
    <x-dashboard.breadcrump-data></x-dashboard.breadcrump-data>
    <div class="creation-header flex items-center mb-4">
        <h2 class="text-4xl font-extrabold dark:text-white ">New Class</h2>
    </div>

    @livewire('class.ClassFormComponent' , ['actionType'=>'edit' ,'class' => $class])

</x-app-layout>
