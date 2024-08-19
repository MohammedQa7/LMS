<div>
    <div class="relative sm:rounded-lg pt-5">
        <div class=" mb-4 bg-white dark:bg-gray-900 flex justify-between items-center">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="table-search"
                    class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for items">
            </div>

            <div x-data="{ modelOpen: false }" class="create-btn">
                <a @click="modelOpen =!modelOpen"
                    class="border text-black inline-flex items-center px-3 py-2 text-sm font-medium text-center  rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:text-white dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 hover:bg-gray-100 cursor-pointer">
                    <svg class="w-6 h-6 me-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>

                    New Promotions
                </a>
                <x-dashboard.promotions.modals.promotionModal></x-dashboard.promotions.modals.promotionModal>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border rounded-lg shadow overflow-hidden dark:border-neutral-700 dark:shadow-gray-900">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        student name</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-red-500 uppercase dark:text-neutral-400">
                                        From Level</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-red-500 uppercase dark:text-neutral-400">
                                        From Section</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-red-500 uppercase dark:text-neutral-400">
                                        From Class</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-green-500 uppercase dark:text-neutral-400">
                                        To Level</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-green-500 uppercase dark:text-neutral-400">
                                        To Section</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-green-500 uppercase dark:text-neutral-400">
                                        To Class</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-green-500 uppercase dark:text-neutral-400">
                                        promotions year</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @if (sizeof($this->PromotedStudents))
                                    @foreach ($this->PromotedStudents as $single_promotion)
                                        <tr class="hover:bg-gray-100">
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                {{ $single_promotion->student->name }}</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                {{ $single_promotion->fromLevel->name }}</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                {{ $single_promotion->fromSection->name }}</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                {{ $single_promotion->fromClass->name }}</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                {{ $single_promotion->toLevel->name }}</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                {{ $single_promotion->toSection->name }}</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                {{ $single_promotion->toClass->name }}</th>

                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                {{ $single_promotion->promotion_year }}</th>


                                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">

                                                <button type="button"
                                                    class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-yellow-600 hover:text-yellow-800 focus:outline-none focus:text-yellow-800 disabled:opacity-50 disabled:pointer-events-none dark:text-yellow-500 dark:hover:text-yellow-400 dark:focus:text-yellow-400">Revert</button>
                                                <x-loading-indecator :loading_action="'delete'"></x-loading-indecator>
                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            No Meetings Were Found</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="paginators mt-3">
                        1,2,3
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
