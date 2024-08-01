<div>
    <div class="taps">
        <div class="flex items-center justify-center ">
            <div
                class="flex  bg-gray-200 hover:bg-gray-200 rounded-lg transition p-1 dark:bg-neutral-700 dark:hover:bg-neutral-600  overflow-x-auto">
                <nav class="flex gap-x-1 w-full" aria-label="Tabs" role="tablist">
                    @foreach ($this->LevelTabs as $single_level)
                        <button wire:click.prevent="SelectTab('{{ $single_level->id }}')"
                            class="{{ $single_level->id == $this->selected_tab ? 'bg-white ' : 'hover:bg-indigo-100' }} text-gray-700  dark:bg-neutral-800 dark:text-neutral-400 py-3 px-4 inline-flex items-center gap-x-2  text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg  disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white "
                            id="segment-item-{{ $loop->index }}" role="tab">
                            {{ $single_level->name }}
                        </button>
                    @endforeach


                </nav>
            </div>
        </div>
    </div>

    <div class="relative sm:rounded-lg pt-5">
        <div class=" mb-4 bg-white dark:bg-gray-900 flex justify-between items-center">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="table-search"
                    class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for items">
            </div>

        </div>
        <div class="flex flex-col">
            <x-livewire-filepond wire:model="featuredImage" />
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border rounded-lg shadow overflow-hidden dark:border-neutral-700 dark:shadow-gray-900">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        Class Name</th>
                                    <th scope="col"
                                        class=" px-6 py-3 text-start  text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        Subject</th>

                                    <th scope="col"
                                        class=" px-6 py-3 text-start  text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        Assigned In</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y  divide-gray-200 dark:divide-neutral-700">
                                @if (sizeof($this->TeacherLevels) > 0)
                                    @foreach ($this->TeacherLevels as $single_level)
                                        <tr class="hover:bg-gray-100">
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                {{ $single_level->class->name }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                {{ $single_level->subject->name }}</td>
                                            <td
                                                class="px-6 py-4  whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                {{ $single_level->created_at->diffForHumans() }}</td>

                                            <td
                                                class="px-6 py-4  whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                <button class=" text-gray-700 border border-indigo-500 rounded-lg px-4 py-1 hover:bg-indigo-100 transition-all"> 
                                                    Add Educational Content
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            No Levels Were Found</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
