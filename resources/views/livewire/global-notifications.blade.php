<div class="">
    <button wire:click.prevent="ToggleNotifications" 
        class="relative p-2 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700">
        <span class="sr-only">View notifications</span>
        <!-- Bell icon -->
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
            </path>
        </svg>
        <div id="notification_counter"
            class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">
            {{ Auth::user()->notifications->where('notification_type', !null)->count() }}
        </div>
    </button>
    <x-notifications-component name="notificationModal"></x-notifications-component>
   
</div>
{{-- 
@props(['name'])
<div x-data="{ visable: false, name: '{{ $name }}' }" x-show="visable" x-on:open-modal.window = "visable = ($event.detail.name === name)"
    x-on:close-modal.window = "visable = false" x-on:keydown.escape.window = "visable = false" style="display: none"
    x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.outside="isProfileMenuOpen = false"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">
    <div class="  z-50 max-w-sm my-4 overflow-hidden text-base list-none bg-white divide-y divide-gray-100 rounded shadow-lg dark:divide-gray-600 dark:bg-gray-700"
        id="notification-dropdown">
        <div
            class="block px-4 py-2 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            Notifications
        </div>
        <div>
            <a class="flex px-4 py-3 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                <div class="flex-shrink-0">
                    <div
                        class="absolute flex items-center justify-center w-5 h-5 ml-6 -mt-5 border border-white rounded-full bg-primary-700 dark:border-gray-700">
                    </div>
                </div>
                <div class="w-full pl-3">
                    <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">
                        asd</div>
                    <div class="text-xs font-medium text-primary-700 dark:text-primary-400">a
                        few
                        moments ago</div>
                </div>
            </a>
        </div>
        <a
            class="block py-2 text-base font-normal text-center text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:text-white dark:hover:underline">
            <div class="inline-flex items-center ">

                View all
            </div>
        </a>
    </div>
</div> --}}
