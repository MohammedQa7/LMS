<x-app-layout>
    <x-dashboard.breadcrump-data></x-dashboard.breadcrump-data> 
    <div class="creation-header flex items-center mb-4">
        <h2 class="text-4xl font-extrabold dark:text-white ">Edit Subject</h2>
    </div>


    <div
        class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <h3 class="mb-4 text-xl font-semibold dark:text-white">Level information</h3>
        @livewire('Subject.SubjectFormComponent' , ['actionType'=>'edit' , 'subject' => $subject])
    </div>
</x-app-layout>
