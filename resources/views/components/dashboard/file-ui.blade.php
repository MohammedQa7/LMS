@props(['material'])
<div>
    <!-- Item -->
    @foreach ($material->files as $single_file)
        <div class="p-3 mb-3.5 border border-gray-200 dark:border-gray-700 rounded-lg mt-2">
            @role('teacher|adminstrator')
                {{-- File Status --}}
                <div class="text-end mb-2">
                    @if ($single_file->status)
                        <span
                            class="text-end bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ trans('subject-content-modal.visable') }}</span>
                    @else
                        <span
                            class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{ trans('subject-content-modal.not-visable') }}</span>
                    @endif
                </div>
            @endrole

            {{-- File Details --}}
            <div class="flex ju items-center">
                <div class="flex items-center justify-center w-10 h-10 mr-3 bg-teal-100 rounded-lg dark:bg-teal-900">
                    <svg class="w-5 h-5 text-teal-600 lg:w-6 lg:h-6 dark:text-teal-300" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path
                            d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z">
                        </path>
                    </svg>
                </div>

                <div class="mr-4">
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                        {{ $single_file->original_file_name }}"
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $single_file->type }},
                        {{ $single_file->file_size }}</p>
                </div>
                <div class="flex items-center ml-auto rtl:mr-auto rtl:ml-0">
                    <a href="{{ route('download_file', ['file_id' => $single_file->id, 'file_name' => $single_file->original_file_name]) }}"
                        type="button" class="p-2 rounded hover:bg-gray-100 cursor-pointer">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M12 2.25a.75.75 0 01.75.75v11.69l3.22-3.22a.75.75 0 111.06 1.06l-4.5 4.5a.75.75 0 01-1.06 0l-4.5-4.5a.75.75 0 111.06-1.06l3.22 3.22V3a.75.75 0 01.75-.75zm-9 13.5a.75.75 0 01.75.75v2.25a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5V16.5a.75.75 0 011.5 0v2.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V16.5a.75.75 0 01.75-.75z">
                            </path>
                        </svg>
                        <span class="sr-only">Download</span>
                    </a>

                    @role('teacher|adminstrator')
                        <div class="files-dropdown-menu">
                            {{-- dropdown button --}}
                            <button type="button"
                                class="p-2 rounded hover:bg-gray-100 "id="dropdownMenuIconButton-{{ $single_file->id }}"
                                data-dropdown-toggle="dropdownDots-{{ $single_file->id }}">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path
                                        d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                                    </path>
                                </svg>
                                <span class="sr-only">Actions</span>
                            </button>

                            <!-- Dropdown menu -->
                            <div id="dropdownDots-{{ $single_file->id }}"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownMenuIconButton-{{ $single_file->id }}">

                                    {{-- Deleting File --}}
                                    <li>
                                        <a wire:click.prevent="delete({{ $single_file->id }})"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-red-500 text-red-500 cursor-pointer">Delete</a>
                                    </li>

                                    {{-- status for material --}}
                                    <li>

                                        <div>
                                            <div class="px-4 py-2">
                                                <label class="flex items-center justify-between cursor-pointer">
                                                    <div>
                                                        <span
                                                            class="me-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ trans('subject-content-modal.visable') }}</span>
                                                    </div>

                                                    <div>
                                                        <input wire:model.live="status.{{ $single_file->id }}"
                                                            type="checkbox" value=""
                                                            {{ $single_file->status ? 'checked' : '' }}
                                                            class="sr-only peer">
                                                        <div
                                                            class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600">
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                            @error('status')
                                                <x-dashboard.validation-error-message
                                                    :message="$message"></x-dashboard.validation-error-message>
                                            @enderror
                                        </div>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endrole

                </div>
            </div>
        </div>
    @endforeach



</div>
