@props(['attendance_students'])
<div>

    <div x-show="modelOpen" x-on:close-modal.window = "modelOpen = false" class="fixed inset-0 z-50 overflow-y-auto"
        aria-labelledby="modal-title" role="dialog" aria-modal="true">
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
                class="inline-block w-full max-w-4xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
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
                        <h1 class="text-lg">{{ trans('generalTrans.Today') }} : <span class="font-bold text-md">{{  Carbon\Carbon::now()->dayName . ' , ' . Carbon\Carbon::now()->format('d/m/Y') }}</span></h1>
                        <button wire:click="saveAttendance"
                            class=" text-md bg-green-100 text-green-800 px-6 py-3 rounded-md  hover:bg-green-200 transition-all">{{ trans('subject-content-modal.attendance_modal.save') }}</button>
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
                                                <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                    Name</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                    DOB</th>

                                                <th scope="col"
                                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                    Action</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                            @if ($this->attendance_students)
                                                @foreach ($attendance_students as $single_student)
                                                    <tr>
                                                        <td
                                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 rtl:text-right">
                                                            {{ $single_student->name }}</td>
                                                        <td
                                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200 rtl:text-right">
                                                            {{ $single_student->date_of_birth }}</td>
                                                        <td
                                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center flex justify-center">
                                                            @if (sizeof($single_student->attendances) > 0)
                                                                <span
                                                                    class="{{ App\Helpers\globalFunctionsHelper::classNameRelatedToAttendanceStatus($single_student->attendances[0]->status) }} text-md font-medium  px-5 py-1 rounded dark:bg-gray-700 dark:text-gray-300">{{ $single_student->attendances[0]->status }}</span>
                                                            @else
                                                                <ul class="flex flex-col justify-center sm:flex-row">
                                                                    <li
                                                                        class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ms-px sm:mt-0 sm:first:rounded-se-none sm:first:rounded-es-lg sm:last:rounded-es-none sm:last:rounded-se-lg dark:bg-neutral-800 dark:border-neutral-700 dark:text-white">
                                                                        <div class="relative flex items-start w-full">
                                                                            <div class="flex items-center h-5">
                                                                                <input
                                                                                    wire:model="attendance_values.{{ $single_student->id }}"
                                                                                    value="presence"
                                                                                    name="hs-horizontal-list-group-item-radio1-{{ $loop->index }}"
                                                                                    type="radio"
                                                                                    class="border-gray-200 rounded-full disabled:opacity-50 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                                                    checked="">
                                                                            </div>
                                                                            <label
                                                                                for="hs-horizontal-list-group-item-radio-{{ $loop->index }}"
                                                                                class="ms-3 block w-full text-sm text-green-800 dark:text-neutral-500">
                                                                                {{ trans('generalTrans.Presence') }}
                                                                            </label>
                                                                        </div>
                                                                    </li>

                                                                    <li
                                                                        class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium  bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ms-px sm:mt-0 sm:first:rounded-se-none sm:first:rounded-es-lg sm:last:rounded-es-none sm:last:rounded-se-lg dark:bg-neutral-800 dark:border-neutral-700 dark:text-white">
                                                                        <div class="relative flex items-start w-full">
                                                                            <div class="flex items-center h-5">
                                                                                <input
                                                                                    wire:model="attendance_values.{{ $single_student->id }}"
                                                                                    value="absent"
                                                                                    name="hs-horizontal-list-group-item-radio1-{{ $loop->index }}"
                                                                                    type="radio"
                                                                                    class="border-gray-200 rounded-full disabled:opacity-50 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                                            </div>
                                                                            <label
                                                                                for="hs-horizontal-list-group-item-radio-{{ $loop->index }}"
                                                                                class="ms-3 block w-full text-sm text-red-800 dark:text-neutral-500">
                                                                                {{ trans('generalTrans.Absent') }}
                                                                            </label>
                                                                        </div>
                                                                    </li>

                                                                    <li
                                                                        class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ms-px sm:mt-0 sm:first:rounded-se-none sm:first:rounded-es-lg sm:last:rounded-es-none sm:last:rounded-se-lg dark:bg-neutral-800 dark:border-neutral-700 dark:text-white">
                                                                        <div class="relative flex items-start w-full">
                                                                            <div class="flex items-center h-5">
                                                                                <input
                                                                                    wire:model="attendance_values.{{ $single_student->id }}"
                                                                                    value="late"
                                                                                    name="hs-horizontal-list-group-item-radio1-{{ $loop->index }}"
                                                                                    type="radio"
                                                                                    class="border-gray-200 rounded-full disabled:opacity-50 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                                            </div>
                                                                            <label
                                                                                for="hs-horizontal-list-group-item-radio1-{{ $loop->index }}"
                                                                                class="ms-3 block w-full text-sm text-yellow-800 dark:text-neutral-500">
                                                                                {{ trans('generalTrans.Late') }}
                                                                            </label>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach

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
