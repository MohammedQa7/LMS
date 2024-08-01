<div>

    <div>
        <div
            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="mb-4 text-xl font-semibold dark:text-white">General information</h3>
            <form wire:submit="submit">
                {{ $this->form }}

                <div class="grid grid-cols-6 gap-6 mt-20">
                    @foreach ($this->existing_courses as $key => $single_course)
                        <div class="col-span-2 sm:col-3  ">
                            <label for="section-name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Previous level
                            </label>

                            <select wire:model.live="selected_courses.{{ $key }}.level" type="text"
                                name="last-name" id="last-name"
                                class="mb-3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="" required>
                                <option value="">Select</option>
                                @foreach ($this->levels as $level)
                                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                            @error('selected_courses.' . $key . '.level')
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
                            <select wire:model.live="selected_courses.{{ $key }}.class" type="text"
                                name="last-name" id="last-name"
                                class="mb-3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Select new option</option>
                                @foreach ($this->classes as $class)
                                    @if ($class->sections->level->id == $selected_courses[$key]['level'])
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endif
                                @endforeach
                            </select>


                            @error('selected_courses.' . $key . '.class')
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                    role="alert">
                                    <span class="font-medium">{{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-3  ">
                            <label for="section-name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Previous subject
                            </label>
                            <select wire:model.live="selected_courses.{{ $key }}.subject" type="text"
                                name="last-name" id="last-name"
                                class="mb-3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Select new option</option>
                                @foreach ($this->subjects as $subject)
                                    @if ($subject->level)
                                        @foreach ($subject->level as $single_subject_level)
                                            @if ($single_subject_level->id == $selected_courses[$key]['level'])
                                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>


                            @error('selected_courses.' . $key . '.subject')
                                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                                    role="alert">
                                    <span class="font-medium">{{ $message }}
                                </div>
                            @enderror
                        </div>
                    @endforeach

                </div>
                <button
                    class="text-black border bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-gray-100 dark:text-black dark:bg-white dark:hover:bg-gray-100"
                    type="submit">Save all</button>
        </div>
        </form>
        <x-filament-actions::modals />



    </div>


    @push('script')
        <script>
            document.addEventListener('livewire:load', function() {
                // Initialize Filament components if needed
                // For example:
                Filament.init();
            });
        </script>
    @endpush
</div>
