<div>
    <div class="taps">
        <div class="flex items-center justify-center ">
            <div
                class="flex  bg-gray-200 hover:bg-gray-200 rounded-lg transition p-1 dark:bg-neutral-700 dark:hover:bg-neutral-600  overflow-x-auto">
                <nav class="flex gap-x-1 w-full" aria-label="Tabs" role="tablist">
                    @foreach ($this->Levels as $single_level)
                        <button wire:click.prevent="SelectTab('{{ $single_level->name }}')"
                            class="{{ $single_level->name == $this->selected_tab ? 'bg-white ' : 'hover:bg-indigo-100' }} text-gray-700  dark:bg-neutral-800 dark:text-neutral-400 py-3 px-4 inline-flex items-center gap-x-2  text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg  disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white "
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
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border rounded-lg shadow overflow-hidden dark:border-neutral-700 dark:shadow-gray-900">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        Name</th>
                                    <th scope="col"
                                        class=" px-6 py-3 text-start  text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        Created in</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y  divide-gray-200 dark:divide-neutral-700">
                                @if (sizeof($this->Levels) > 0)
                                    @foreach ($this->Levels as $single_level)
                                        <tr class="hover:bg-gray-100">
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                {{ $single_level->name }}</td>
                                            <td
                                                class="px-6 py-4  whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                {{ $single_level->created_at->diffForHumans() }}</td>

                                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                <a wire:navigate
                                                    href="{{ URL('/level/' . $single_level->slug . '/edit') }}"
                                                    type="button"
                                                    class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">Edit</a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                
                                                <button wire:click="delete('{{ $single_level->slug }}')" type="button"
                                                    class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">Delete</button>
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
