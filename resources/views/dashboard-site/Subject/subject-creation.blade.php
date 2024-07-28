<x-app-layout>
    <x-dashboard.breadcrump-data></x-dashboard.breadcrump-data> 
    <div class="creation-header flex items-center mb-4">
        <a class="me-3 border p-3 shadow-sm rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-700 transition-all" href="{{ URL('/subject') }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </a>
        <h2 class="text-4xl font-extrabold dark:text-white ">New Subject</h2>
    </div>


    <div
        class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <h3 class="mb-4 text-xl font-semibold dark:text-white">Class information</h3>
        <form action="#">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="full-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject 
                        Name (Arabic)</label>
                    <input type="text" name="first-name" id="first-name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Bonnie" required>
                        <blockquote style="direction: rtl">
                            <p class="text-xs  text-gray-900 dark:text-white">"مثل : عربي - تاريخ"</p>
                        </blockquote>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="full-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject 
                        Name (English)</label>
                    <input type="text" name="first-name" id="first-name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Bonnie" required>
                        <p class="text-xs  text-gray-900 dark:text-white">"E.g. math - history"</p>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="section-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section (Arabic)
                    </label>
                    <select type="text" name="last-name" id="last-name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Male" required>
                        <option value="" selected>Select  gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="section-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section (English)
                    </label>
                    <select type="text" name="last-name" id="last-name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Male" required>
                        <option value="" selected>Select  section</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
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

    @push('script')
        <script>
            // In your Javascript (external .js resource or <script> tag)
            $(document).ready(function() {
                $('.level-selection').select2();
            });
            // In your Javascript (external .js resource or <script> tag)
            $(document).ready(function() {
                $('.subject-selection').select2();
            });
        </script>
    @endpush
</x-app-layout>
