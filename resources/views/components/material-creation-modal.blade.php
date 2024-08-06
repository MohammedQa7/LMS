@props(['current_level'])
<div>
    @if ($current_level)
        <div x-show="modelOpen" x-on:close-modal.window = "modelOpen = false" class="fixed inset-0 z-50 overflow-y-auto"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                    x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"></div>

                <div x-cloak x-show="true" x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                    <div class="flex items-center justify-between space-x-4">
                        <h1 class="text-xl font-medium text-gray-800 ">{{ trans('subject-content-modal.modal_title') }}
                            <span class="font-bold">({{ $current_level->class->name }} -
                                {{ $current_level->subject->name }})</span>
                        </h1>

                        <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>

                    <p class="mt-2 text-sm text-gray-500 rtl:text-right">
                        {{ trans('subject-content-modal.modal_title_description') }}
                    </p>

                    <form class="mt-5 rtl:text-start">
                        <div class="grid grid-cols-2 gap-5">
                            <div class="title_fields">
                                <label for="title"
                                    class="block text-sm text-gray-700 capitalize dark:text-gray-200 ">{{ trans('subject-content-modal.field_title_ar') }}</label>
                                <input wire:model="name_ar"
                                    placeholder="{{ trans('subject-content-modal.field_title_placeholder') }}"
                                    type="text"
                                    class="block w-full px-3 py-2 mt-2 mb-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                @error('name_ar')
                                    <x-dashboard.validation-error-message
                                        :message="$message"></x-dashboard.validation-error-message>
                                @enderror
                            </div>

                            <div class="title_fields">
                                <label for="title"
                                    class="block text-sm text-gray-700 capitalize dark:text-gray-200 ">{{ trans('subject-content-modal.field_title_en') }}
                                </label>
                                <input wire:model="name_en"
                                    placeholder="{{ trans('subject-content-modal.field_title_placeholder') }}"
                                    type="text"
                                    class="block w-full px-3 py-2 mt-2 mb-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                @error('name_en')
                                    <x-dashboard.validation-error-message
                                        :message="$message"></x-dashboard.validation-error-message>
                                @enderror
                            </div>

                        </div>

                        <div class="mt-4">
                            <label
                                class="block text-sm text-gray-700 capitalize dark:text-gray-200">{{ trans('subject-content-modal.field_type') }}</label>
                            <select wire:model="selected_file_type" name="file_type"
                                class="block w-full px-3 py-2 mt-2 mb-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                <option selected> Select file type</option>
                                @if ($this->file_types)
                                    @foreach ($this->file_types as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                @endif

                            </select>
                            @error('selected_file_type')
                                <x-dashboard.validation-error-message
                                    :message="$message"></x-dashboard.validation-error-message>
                            @enderror
                        </div>

                        {{-- file uploader --}}
                        <x-filepond::upload class="mt-5" wire:model="subject_content_files" multiple="true"
                            id="filepond" />
                        @error('subject_content_files')
                            <x-dashboard.validation-error-message :message="$message"></x-dashboard.validation-error-message>
                        @enderror

                        <div class="mt-4">
                            <h1 class="text-xs font-medium text-gray-400 uppercase">Status</h1>

                            <div class="mt-4 space-y-5">

                                <label class="inline-flex items-center cursor-pointer">
                                    <input wire:model="status" type="checkbox" value="" class="sr-only peer"
                                        checked>
                                    <div
                                        class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600">
                                    </div>
                                    <span
                                        class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ trans('subject-content-modal.visable') }}</span>
                                </label>
                            </div>
                            @error('status')
                                <x-dashboard.validation-error-message
                                    :message="$message"></x-dashboard.validation-error-message>
                            @enderror
                        </div>


                        <div class="flex justify-end mt-6">
                            <button
                                wire:click.prevent="saveSubjectContent({{ $current_level->class->id }}  , {{ $current_level->subject->id }})"
                                class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                                Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

</div>
