@props(['name'])
<div>
    <div x-data = "{modelOpen : false }" x-show="modelOpen"
        x-on:open-modal.window = "modelOpen = ($event.detail.name === '{{ $name }}')"
        x-on:close-modal.window = "modelOpen = false" class="fixed inset-0 z-50" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
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
                class="inline-block w-full max-w-3xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                <div class="flex items-center justify-between space-x-4">
                    <h1 class="text-xl font-medium text-gray-800 ">
                        {{ trans('subject-content-modal.attendance_modal.title') }}
                    </h1>

                    <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                </div>

                <div class="description-container mt-2 mb-4 w-full">
                    <p class="text-sm text-gray-500 rtl:text-right break-words whitespace-normal">
                        {!! trans('subject-content-modal.attendance_modal.description') !!}
                    </p>
                    <div class="save-btn-container flex justify-between items-center mt-3">
                        <button wire:click="Promote"
                            class=" text-md bg-green-100 text-green-800 px-6 py-3 rounded-md  hover:bg-green-200 transition-all">{{ trans('subject-content-modal.promote-modal.promote') }}</button>
                    </div>
                </div>
                <hr>


                <div class="flex flex-col gap-3 items-center space-x-4 mt-4 overflow-y-auto ">
                    <div class="flex flex-col w-full" style="max-height: 350px">
                        <div class="-m-1.5 overflow-x-auto">

                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div
                                    class="border rounded-lg shadow overflow-hidden dark:border-neutral-700 dark:shadow-gray-900">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                        <thead class="bg-gray-50 dark:bg-neutral-700">
                                            <tr>
                                                <th scope="col" class="p-4">
                                                    <div class="flex items-center">
                                                        <input wire:model.live="selectAllStudents" type="checkbox"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                        <label for="checkbox-all-search"
                                                            class="sr-only">checkbox</label>
                                                    </div>
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                    Name</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                    email</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                    phone number</th>

                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                            @if (sizeof($this->StudentsPromotionList) > 0)

                                                @foreach ($this->StudentsPromotionList as $single_user)
                                                    <div>
                                                        <tr>
                                                            <td class="w-4 p-4">
                                                                <div class="flex items-center">
                                                                    <input type="checkbox" wire:model="selected_students"
                                                                        value="{{$single_user['id']}}"
                                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                                </div>
                                                            </td>
                                                            <td class="font-bold px-6 py-4">
                                                                {{ $single_user['name'] ?? 'NONE' }}
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                {{ $single_user['email'] ?? 'NONE' }}
                                                            </td>
                                                            <td class="px-6 py-4">
                                                                {{ $single_user['phone_number'] ?? 'NONE' }}
                                                            </td>

                                                        </tr>
                                                    </div>
                                                @endforeach
                                            @else
                                                <td class="px-6 py-4">
                                                    <p>{{ trans('generalTrans.no-students') }} </p>
                                                </td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>
