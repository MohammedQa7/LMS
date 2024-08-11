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

                                            <td x-data="{ modelOpen: false }"
                                                class="px-6 py-4  whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">

                                                <button @click="modelOpen =!modelOpen"
                                                    class="flex items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>

                                                    <span>Add Educational Content</span>
                                                </button>
                                                <x-material-creation-modal :current_level="$single_level">
                                                </x-material-creation-modal>
                                            </td>

                                            <td x-data="{ modelOpen: false }"
                                                class="px-6 py-4  whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">

                                                <button wire:click="StudnetAttendance({{ $single_level->class->id }})"
                                                    @click="modelOpen =!modelOpen"
                                                    class="flex items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6 w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                                    </svg>


                                                    <span>Take Attendance</span>
                                                </button>
                                                <x-dashboard.attendence-modal
                                                    :attendance_students="$this->attendance_students"></x-dashboard.attendence-modal>
                                            </td>


                                            <td>
                                                <a href="{{ route('specific-subject-material', ['class_slug' => $single_level->class->slug, 'subject_slug' => $single_level->subject->slug]) }}"
                                                    class="inline-block items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide text-gray-700 capitalize transition-colors duration-200 transform border border-indigo-500 rounded-md dark:bg-white dark:hover:bg-indigo-700  hover:bg-indigo-200 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-50 cursor-pointer">
                                                    <div class="flex items-center justify-center space-x-2 ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M7.5 3.75H6A2.25 2.25 0 0 0 3.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0 1 20.25 6v1.5m0 9V18A2.25 2.25 0 0 1 18 20.25h-1.5m-9 0H6A2.25 2.25 0 0 1 3.75 18v-1.5M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                        </svg>

                                                        <span>View Educational Content</span>
                                                    </div>
                                                </a>
                                            </td>

                                            <td>


                                                <button id="dropdownLeftButton-{{ $single_level->id }}"
                                                    data-dropdown-toggle="dropdownLeft-{{ $single_level->id }}"
                                                    data-dropdown-placement="left"
                                                    class="mb-3 md:mb-0 text-white border border-indigo-500 shadow-md  bg-white hover:bg-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                    type="button"><svg class="w-2.5 h-2.5 text-black"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 6 10">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                                                    </svg></button>

                                                <!-- Dropdown menu -->
                                                <div id="dropdownLeft-{{ $single_level->id }}"
                                                    class="z-10 hidden bg-white  divide-y divide-gray-100 rounded-lg border border-gray-200 shadow-2xl w-56 p-5 dark:bg-gray-700">
                                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                                        aria-labelledby="dropdownLeftButton-{{ $single_level->id }}">
                                                        <li class="mb-4">
                                                            <a href="{{ route('specific-subject-material', ['class_slug' => $single_level->class->slug, 'subject_slug' => $single_level->subject->slug]) }}"
                                                                class="inline-block items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide text-gray-700 capitalize transition-colors duration-200 transform border border-indigo-500 rounded-md dark:bg-white dark:hover:bg-indigo-700  hover:bg-indigo-200 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-50 cursor-pointer">
                                                                <div
                                                                    class="flex items-center justify-center space-x-2 ">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 24 24"
                                                                        stroke-width="1.5" stroke="currentColor"
                                                                        class="size-6">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M7.5 3.75H6A2.25 2.25 0 0 0 3.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0 1 20.25 6v1.5m0 9V18A2.25 2.25 0 0 1 18 20.25h-1.5m-9 0H6A2.25 2.25 0 0 1 3.75 18v-1.5M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                                    </svg>

                                                                    <span>View Educational Content</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('specific-subject-material', ['class_slug' => $single_level->class->slug, 'subject_slug' => $single_level->subject->slug]) }}"
                                                                class="inline-block items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide text-gray-700 capitalize transition-colors duration-200 transform border border-indigo-500 rounded-md dark:bg-white dark:hover:bg-indigo-700  hover:bg-indigo-200 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-50 cursor-pointer">
                                                                <div
                                                                    class="flex items-center justify-center space-x-2 ">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 24 24"
                                                                        stroke-width="1.5" stroke="currentColor"
                                                                        class="size-6">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M7.5 3.75H6A2.25 2.25 0 0 0 3.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0 1 20.25 6v1.5m0 9V18A2.25 2.25 0 0 1 18 20.25h-1.5m-9 0H6A2.25 2.25 0 0 1 3.75 18v-1.5M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                                    </svg>

                                                                    <span>View Educational Content</span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>

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
