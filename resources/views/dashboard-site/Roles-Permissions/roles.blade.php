<x-app-layout>
    <div class="creation-header flex items-center mb-4">
        <h2 class="text-4xl font-extrabold dark:text-white ">{{ trans('generalTrans.PageTitle.roles-header') }}</h2>
    </div>

    @livewire('RolesAndPermissions.RolesListComponent')
</x-app-layout>
