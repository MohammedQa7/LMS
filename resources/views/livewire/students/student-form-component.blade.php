<div>

    <div>
        <div
            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="mb-4 text-xl font-semibold dark:text-white">General information</h3>
            <form wire:submit="submit">
                {{ $this->form }}

                @if ($this->isEditable)
                    <div class="grid grid-cols-6 gap-6 mt-6">
                        <div class="col-span-3 sm:col-3">
                            <label for="section-name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Previous level
                            </label>

                            <select wire:model.live="selected_level" type="text" name="last-name" id="last-name"
                                class="mb-3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="" required>
                                <option value="">Select new option</option>
                                @foreach ($this->levels as $single_level)
                                    <option value="{{ $single_level->id }}">{{ $single_level->name }}</option>
                                @endforeach
                            </select>
                            @error('selected_level')
                                <x-dashboard.validation-error-message
                                    :message="$message"></x-dashboard.validation-error-message>
                            @enderror
                        </div>
                        <div class="col-span-3 sm:col-3">
                            <label for="section-name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Previous Class
                            </label>

                            <select wire:model.live="selected_class" type="text" name="last-name" id="last-name"
                                class="mb-3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="">
                                <option value="">Select new option</option>
                                @foreach ($this->classes as $single_class)
                                    @if ($single_class->sections->level->id == $this->selected_level)
                                        <option value="{{ $single_class->id }}">{{ $single_class->name }}</option>
                                    @endif
                                @endforeach
                            </select>

                            @error('selected_class')
                                <x-dashboard.validation-error-message
                                    :message="$message"></x-dashboard.validation-error-message>
                            @enderror
                        </div>

                        <div class="col-span-3 sm:col-3">
                            <label for="section-name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Previous section
                            </label>

                            <select wire:model.live="selected_section" type="text" name="last-name" id="last-name"
                                class="mb-3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="">
                                <option value="">Select new option</option>
                                @foreach ($this->sections as $single_section)
                                    @if ($single_section->level->id == $this->selected_level)
                                        <option value="{{ $single_section->id }}">{{ $single_section->name }}</option>
                                    @endif
                                @endforeach
                            </select>

                            @error('selected_class')
                                <x-dashboard.validation-error-message
                                    :message="$message"></x-dashboard.validation-error-message>
                            @enderror
                        </div>
                    </div>
                @endif
                <button
                    class="text-black border bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-gray-100 dark:text-black dark:bg-white dark:hover:bg-gray-100 mt-5"
                    type="submit">Save all</button>
        </div>
        </form>

        {{-- FILAMENT MODALS --}}
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
