<div x-data="{ eventModal: false }">
    <div x-show="eventModal" x-on:open-event-modal.window = "eventModal = true"
        x-on:close-event-modal.window = "eventModal = false" class="fixed inset-0 z-50 overflow-y-auto"
        aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
            <div x-cloak @click="eventModal = false" x-show="eventModal"
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
                class="inline-block w-full max-w-xl p-8 my-20 text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                <div class="flex items-center justify-between space-x-4">
                    <h1 class="text-xl font-medium text-gray-800 ">
                        New Event
                    </h1>
                    <button @click="eventModal = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>

                </div>
                <form wire:submit="addevent" class="mt-5 rtl:text-start">
                    <label for="title" class="block text-sm text-gray-700 capitalize dark:text-gray-200 ">Event Title
                    </label>

                    <input wire:model.live="event_title" type="text" placeholder="MATH EXAM"
                        class="block w-full px-3 py-2 mt-2 mb-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                    @error('event_title')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">{{ $message }}
                        </div>
                    @enderror

                 

                    <label for="title" class="block text-sm text-gray-700 capitalize dark:text-gray-200 ">Event Short
                        Description
                    </label>
                    <input wire:model="event_description" type="text" placeholder="idk , what ever you want"
                        class="block w-full px-3 py-2 mt-2 mb-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">



                    <label for="time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                        time:</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input wire:model="selected_time" type="time" id="time"
                            class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500" value="00:00"  />
                    </div>

                    @error('selected_time')
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <span class="font-medium">{{ $message }}
                        </div>
                    @enderror

                    <div class="grid grid-cols-6 gap-6 mt-3">
                        <div class="col-span-2 sm:col-3  ">
                            <label for="section-name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Previous level
                            </label>

                            <select wire:model.live="selected_level" type="text" name="last-name" id="last-name"
                                class="mb-3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="" >
                                <option value="">Select</option>
                                @foreach ($this->levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                            @error('selected_level')
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                    role="alert">
                                    <span class="font-medium">{{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-3  ">
                            <label for="section-name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Previous class
                            </label>
                            <select wire:model.live="selected_class" type="text" name="last-name" id="last-name"
                                class="mb-3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Select new option</option>
                                @foreach ($this->classes as $class)
                                    @if ($class->sections->level->id == $this->selected_level)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endif
                                @endforeach
                            </select>


                            @error('selected_class')
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                    role="alert">
                                    <span class="font-medium">{{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-3  ">
                            <label for="section-name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Previous
                                subject
                            </label>
                            <select wire:model.live="selected_subject" type="text" name="last-name"
                                id="last-name"
                                class="mb-3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Select new option</option>
                                @foreach ($this->subjects as $subject)
                                    @if ($subject->level)
                                        @foreach ($subject->level as $single_subject_level)
                                            @if ($single_subject_level->id == $this->selected_level)
                                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>


                            @error('selected_subject')
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                    role="alert">
                                    <span class="font-medium">{{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                    <div class="flex justify-end mt-6">
                        <button
                            class="flex items-center px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                            Add
                            <x-loading-indecator :loading_action="'submit'"></x-loading-indecator>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
