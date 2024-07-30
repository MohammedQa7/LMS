@props(['actionType', 'section'])
<div>

    <form wire:submit.prevent="{{ $actionType == 'edit' ? 'update' : 'save' }}">
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-3">
                <label for="full-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section
                    Name (Arabic)</label>
                <input wire:model.live.debounce.250ms="name_ar" type="text" name="first-name" id="first-name"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Bonnie" required>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="full-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section
                    Name (Enlgish)</label>
                <input wire:model.live.debounce.250ms="name_en" type="text" name="first-name" id="first-name"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Bonnie" required>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="full-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sectoin
                    Slug (Arabic)</label>
                <input wire:model.live.debounce.250ms="slug_ar" type="text" name="first-name" id="first-name"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 disabled:bg-gray-200"
                    placeholder="Bonnie" disabled>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="full-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section
                    Slug (Enlgish)</label>
                <input wire:model.live.debounce.250ms="slug_en" type="text" name="first-name" id="first-name"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 disabled:bg-gray-200"
                    placeholder="Bonnie" disabled>
            </div>


            <div class="col-span-6 sm:col-span-3">
                <label for="last-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender
                    (Arabic)
                </label>
                <select wire:model="selected_level" type="text"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required>
                    @foreach ($this->all_levels as $single_level)
                        <option value="{{ $single_level->id }}">
                            {{ $single_level->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="col-span-6 sm:col-full">
                <button
                    class="text-black border bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-gray-100 dark:text-black dark:bg-white dark:hover:bg-gray-100"
                    type="submit">Save all</button>
            </div>
        </div>
    </form>
</div>
