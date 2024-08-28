@props(['name'])
<div class="absolute z-50 right-0 px-20" x-data="{ visable: false, name: '{{ $name }}' }" x-show="visable"
    x-on:open-modal.window = "visable = ($event.detail.name === name)" x-on:close-modal.window = "visable = false"
    x-on:keydown.escape.window = "visable = false" style="display: none" @click.outside="visable = false">

    <div class=" min-w-96  overflow-hidden text-base list-none bg-white divide-y divide-gray-100 rounded shadow-lg dark:divide-gray-600 dark:bg-gray-700"
        id="notification-dropdown">
        <div
            class="block px-4 py-2 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            Notifications
        </div>
        <div>
            @if (sizeof(Auth::user()->notifications->where('notification_type', !null)) > 0)
                @foreach (Auth::user()->notifications->where('notification_type', !null)->take(10) as $notify)
                    <a href="#calendar-section"
                        x-on:click="$dispatch('NavigateToEvent' , {notification_id:'{{ $notify['data']['event_id'] }}'})"
                        class="flex px-4 py-3 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                        <div class="flex-shrink-0 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                            </svg>
                        </div>
                        <div class="w-full pl-3">
                            <div
                                class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400  whitespace-normal break-words max-w-60">
                                {{ $notify['data']['message'] }}</div>
                            <div class="text-xs font-medium text-primary-700 dark:text-primary-400">
                                {{ $notify['created_at']->diffForHumans() }}</div>
                        </div>
                    </a>
                @endforeach
            @else
                <div
                    class="block px-10 py-8 text-base font-medium text-center text-gray-700  dark:bg-gray-400 dark:text-gray-400">
                    No Notifications
                </div>
            @endif
        </div>
        <a href="#"
            class="block py-2 text-base font-normal text-center text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:text-white dark:hover:underline">
            <div class="inline-flex items-center ">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                    <path fill-rule="evenodd"
                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                        clip-rule="evenodd"></path>
                </svg>
                View all
            </div>
        </a>
    </div>
</div>
