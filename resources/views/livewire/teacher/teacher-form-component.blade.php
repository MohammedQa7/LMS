<div>

    {{-- <div
        class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <h3 class="mb-4 text-xl font-semibold dark:text-white">General information</h3>
        <form action="#">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="full-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full
                        Name (Arabic)</label>
                    <input type="text" name="first-name" id="first-name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Bonnie" required>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="full-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full
                        Name (Enlgish)</label>
                    <input type="text" name="first-name" id="first-name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Bonnie" required>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="email"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" name="email" id="email"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="example@company.com" required>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="phone-number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                        Number</label>
                    <input type="number" name="phone-number" id="phone-number"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="e.g. +(12)3456 789" required>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <div class="py-2" x-data="{ show: true }">
                        <span class="px-1 text-sm text-gray-600">Password</span>
                        <div class="relative">
                            <input placeholder="*****" :type="show ? 'password' : 'text'"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                <svg @click="show =!show" :class="{ 'hidden': !show, 'block': show }"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <svg @click="show=!show" :class="{ 'hidden': show, 'block': !show }"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="phone-number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date
                        Of Birth</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input id="datepicker-autohide" datepicker datepicker-autohide type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Select date">
                    </div>

                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="last-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender
                        (Arabic)
                    </label>
                    <select type="text" name="last-name" id="last-name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Male" required>
                        <option value="" selected>Select your gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="last-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender
                        (English)
                    </label>
                    <select type="text" name="last-name" id="last-name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Male" required>
                        <option value="" selected>Select your gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City
                        (Arabic)</label>
                    <input type="text" name="city" id="city"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="e.g. San Francisco" required>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City
                        (Enlgish)</label>
                    <input type="text" name="city" id="city"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="e.g. San Francisco" required>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address
                        (Arabic)</label>
                    <input type="text" name="address" id="address"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="e.g. California" required>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address
                        (English)</label>
                    <input type="text" name="address" id="address"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="e.g. California" required>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="organization" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID
                        number</label>
                    <input type="text" name="organization" id="organization"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="99999999" required>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="organization"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Associated Level</label>
                    <div class=" flex flex-wrap gap-2">
                        <div class="border shadow-md rounded-lg p-2 flex  items-center mt-2 mb-2">
                            <button" class="me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 text-red-600">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>

                                </button>
                        </div>
                    </div>
                    </label>
                    <div wire:ignore>
                        <select wire:model="selected_level" style="width:100%;"
                            class="level-selection shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            name="state" multiple="multiple">

                        </select>
                    </div>

                </div>
            </div>
            <div class="col-span-6 sm:col-span-3">
                <label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Desired
                    Subjects</label>
                <select style="width:100%;"
                    class="
                        subject-selection shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    name="state" multiple="multiple">
                    <option value="AL">Math</option>
                    ...
                    <option value="WY">Arabic</option>
                </select>
            </div>
            <div class="col-span-6 sm:col-full">
                <button
                    class="text-black border bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-gray-100 dark:text-black dark:bg-white dark:hover:bg-gray-100"
                    type="submit">Save all</button>
            </div>
        </form>
    </div> --}}

    <div>
        <div
            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="mb-4 text-xl font-semibold dark:text-white">General information</h3>
            <form wire:submit="create">
                {{ $this->form }}

                <div class="col-span-6 sm:col-full">
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
