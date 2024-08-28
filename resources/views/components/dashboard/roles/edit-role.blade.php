@props(['role_id', 'permissions', 'name'])
<div>
    @if ($permissions && $role_id)
        <div x-show="modelOpen" x-on:open-modal.window = "modelOpen = ($event.detail.name === '{{ $name }}')"
            x-on:close-modal.window = "modelOpen = false" class="fixed inset-0 z-50 overflow-y-auto"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 text-center ">
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
                    class="inline-block w-full max-w-3xl p-8 my-20 text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                    <div class="flex items-center justify-between space-x-4">
                        <h1 class="text-xl font-medium text-gray-800 ">
                            Edit Permissions
                        </h1>
                        <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>


                    </div>
                    <form wire:submit="submit" class="mt-5 rtl:text-start">
                        <div class="grid sm:grid-cols-4 md:grid-cols-4 grid-cols-4 gap-5">
                            @foreach ($permissions as $single_permission)
                                <div class=" col-span-3 grid sm:grid-cols-2 md:grid-cols-2 grid-cols-2 gap-5">
                                    <!-- Selected Permissions  -->
                                    <div class="old-permission-container">
                                        @if ($loop->index == 0)
                                            <h1 class="mb-3">Current Permissions</h1>
                                        @endif
                                        <div class="flex justify-center items-center gap-1">
                                            <div
                                                class="permissions-data shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 whitespace-normal break-words">

                                                <h1>{{ $single_permission->name }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- New Permission  -->
                                    <div class="">
                                        @if ($loop->index == 0)
                                            <h1 class="mb-3">New Permissions</h1>
                                        @endif
                                        <select type="text" name="last-name" id="last-name"
                                            class="mb-3 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="" required>
                                            <option value="">Select</option>
                                            @if ($this->all_permissions)
                                                @foreach ($this->all_permissions as $permission)
                                                    <option value="{{ $permission->id }}">
                                                        {{ $permission->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div x-data="{ modelOpen: false }" class="flex items-center">
                                    <div class="revoke-btn-container flex justify-between items-center">
                                        <button @click.prevent="modelOpen =!modelOpen"
                                            class=" text-md bg-red-100 text-red-800 px-3 py-3 rounded-md  hover:bg-red-200 transition-all">Revoke</button>
                                    </div>
                                    <x-DeleteModal :role='$role_id' :permission='$single_permission->id'></x-DeleteModal>
                                </div>
                            @endforeach
                        </div>
                    </form>




                </div>

            </div>

        </div>
</div>
@endif
</div>
