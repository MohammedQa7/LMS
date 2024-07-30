<div>
    <form wire:submit.prevent="{{ $actionType == 'edit' ? 'update' : 'save' }}">
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-3">
                <label for="full-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject
                    Name (Arabic)</label>
                <input wire:model.live.debounce.250ms="name_ar" type="text" name="first-name" id="first-name"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Bonnie" required>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="full-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject
                    Name (Enlgish)</label>
                <input wire:model.live.debounce.250ms="name_en" type="text" name="first-name" id="first-name"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Bonnie" required>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="full-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject
                    Slug (Arabic)</label>
                <input wire:model.live.debounce.250ms="slug_ar" type="text" name="first-name" id="first-name"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 disabled:bg-gray-200"
                    placeholder="Bonnie" disabled>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="full-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject
                    Slug (Enlgish)</label>
                <input wire:model.live.debounce.250ms="slug_en" type="text" name="first-name" id="first-name"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 disabled:bg-gray-200"
                    placeholder="Bonnie" disabled>
            </div>



            <div class="col-span-6 sm:col-span-3">
                @if ($this->subject)
                    <label for="section-name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section
                        <div class=" flex flex-wrap gap-2">
                            @foreach ($this->subject->level as $old_level)
                                <div class="border shadow-md rounded-lg p-2 flex  items-center mt-2 mb-2">
                                    <button wire:click.prevent="removeSelectedLevel({{ $old_level->id }})"
                                        class="me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6 text-red-600">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>

                                    </button>
                                    <p>{{ $old_level->name }}</p>
                                </div>
                            @endforeach
                        </div>
                    </label>
                @endif
                <div wire:ignore>
                    <select wire:model="selected_level" style="width:100%;"
                        class="level-selection shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        name="state" multiple="multiple">
                        @if ($this->actionType == 'edit')
                            <option></option>
                        @endif
                        @foreach ($this->all_levels as $single_level)
                            <option value='{{ "$single_level->id" }}'>
                                {{ $single_level->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="col-span-6 sm:col-full">
                <button
                    class="text-black border bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-gray-100 dark:text-black dark:bg-white dark:hover:bg-gray-100"
                    type="submit">Save all</button>
            </div>
        </div>
    </form>

    @push('script')
        @script
            <script>
                // In your Javascript (external .js resource or <script> tag)
                $(document).ready(function() {
                    $('.level-selection').select2({
                        placeholder: "Select level",
                        allowClear: true,
                        closeOnSelect: false
                    });
                    $('.level-selection').on('change', function() {
                        let selectValue = $(this).val();
                        console.log(selectValue);
                        $wire.set('selected_level', selectValue);
                        // })
                    });
                });
            </script>
        @endscript
    @endpush

</div>
