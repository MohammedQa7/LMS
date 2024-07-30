@props(['actionType', 'class'])
<div>
    <div
        class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <h3 class="mb-4 text-xl font-semibold dark:text-white">Class information</h3>
        <form wire:submit.prevent="{{$actionType == 'edit' ? 'update' : 'save'}}">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="full-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Class
                        Name (Arabic)</label>
                    <input wire:model.live.debounce.250ms="name_ar" type="text" name="first-name" id="first-name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Bonnie" required>
                    <blockquote style="direction: rtl">
                        <p class="text-xs  text-gray-900 dark:text-white">"مثل : عاشر / ١"</p>
                    </blockquote>
                    @error('name_ar')
                        <x-dashboard.validation-error-message :message="$message"></x-dashboard.validation-error-message>
                    @enderror

                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="full-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Class
                        Name (English)</label>
                    <input wire:model.live.debounce.250ms="name_en" type="text" name="first-name" id="first-name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Bonnie" required>
                    <p class="text-xs  text-gray-900 dark:text-white">"E.g. grade 10 / 1 , 10 / 2"</p>
                    @error('name_en')
                        <x-dashboard.validation-error-message :message="$message"></x-dashboard.validation-error-message>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="full-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Level
                        Slug (Arabic)</label>
                    <input wire:model.live.debounce.250ms="slug_ar" type="text" name="first-name" id="first-name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg  focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 disabled:bg-gray-200"
                        placeholder="Bonnie" disabled>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="full-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Level
                        Slug (Enlgish)</label>
                    <input wire:model.live.debounce.250ms="slug_en" type="text" name="first-name" id="first-name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 disabled:bg-gray-200"
                        placeholder="Bonnie" disabled>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="section-name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section (Arabic)
                    </label>
                    <select wire:model="selected_section"  type="text" name="last-name" id="last-name"
                        class="mb-3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="" required>
                        <option selected>Select Section</option>
                        @foreach ($this->all_sections as $single_section)
                            <option value="{{ $single_section->id }}">{{ $single_section->name }}</option>
                        @endforeach
                    </select>
                    @error('selected_section')
                        <x-dashboard.validation-error-message  :message="$message"></x-dashboard.validation-error-message>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-full">
                    <button
                        class="text-black border bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-gray-100 dark:text-black dark:bg-white dark:hover:bg-gray-100"
                        type="submit">Save all</button>
                </div>
            </div>
        </form>
    </div>
</div>
