<div>
    @role('teacher|adminstrator')
        <div x-data="{ modelOpen: false }" class="px-5 flex  justify-end">
            <button @click="modelOpen =!modelOpen" wire:click="deletedFiles"
                class="flex items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide text-red-700 capitalize transition-colors duration-200 transform border   rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-100 hover:bg-indigo-100 focus:outline-none  focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 13.5H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                </svg>


                <span>Deleted Files</span>
            </button>
            <x-dashboard.deleted-files-modal :deleted_files="$this->deleted_files"></x-dashboard.deleted-files-modal>
        </div>
    @endrole
    @if (sizeof($this->Materials) > 0)
        @foreach ($this->Materials as $single_material)
            <div class="grid grid-cols-2">
                <div>
                    @if (sizeof($single_material->files) > 0)
                        <p class="text-md text-gray-500 rtl:text-right">
                            {{ $single_material->name }}
                        </p>
                        <x-dashboard.file-ui :material="$single_material"></x-dashboard.file-ui>
                        <hr class="w-full h-1 mx-auto my-4 bg-gray-100 border-0 rounded md:my-5 dark:bg-gray-700">
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <p class="text-lg text-gray-500 rtl:text-right">
            No Files Were Found
        </p>


    @endif
</div>
