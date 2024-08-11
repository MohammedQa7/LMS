<div>
    <form class="relative p-3 w-full" action="">
        <form class=" items-center max-w-sm mx-auto">
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 text-gray-500 w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>

                </div>
                <input wire:model.live.debounce.250ms="searched_user" type="text" id="simple-search"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search username..." />
            </div>
        </form>

    </form>
    @if (sizeof($this->chats) > 0 && isset($this->chats))
        <div class="overflow-y-auto h-screen p-3 mb-9 pb-20">
            <x-loading-indecator :loading_action="'searched_user'"></x-loading-indecator>
            @foreach ($this->chats as $single_chat)
                <a wire:click="messages({{ $single_chat->id }})">
                    <div
                        class="
                        {{ $this->highlighted_chat[$single_chat->id] ?? null == $single_chat->id ? 'bg-indigo-200  font-bold transition-all' : '' }}
                        
                        flex items-center mb-4 cursor-pointer hover:bg-gray-100  p-2 rounded-md 
                        
                        {{ !is_null($this->all_messages) ? ($this->all_messages->id == $single_chat->id ? 'bg-gray-100' : '') : '' }}">
                        <div class="w-12 h-12 bg-gray-300 rounded-full mr-3">
                            <img src="{{ $single_chat->contact->profile_photo_url }}" alt="User Avatar"
                                class="w-12 h-12 rounded-full">
                        </div>
                        <div class="flex-1">
                            <h2 class="text-lg font-semibold">
                                {{ $single_chat->contact_id == Auth::user()->id ? $single_chat->user->name : $single_chat->contact->name }}
                            </h2>
                        </div>

                        @if ($this->highlighted_chat[$single_chat->id] ?? null == $single_chat->id && !is_null($this->highlighted_chat))
                            <span
                                class="inline-flex items-center justify-center text-white w-3 h-3 ms-2 text-xs font-semibold text-blue-800 bg-indigo-500 rounded-full">
                            </span>
                        @endif
                        @if (!Session::has('highlighted_chat') && isset($this->user_notifcation[$single_chat->id]))
                            <span
                                class="inline-flex items-center justify-center text-white w-4 h-4 ms-2 text-xs font-semibold text-blue-800 bg-indigo-500 rounded-full">
                                {{ count($this->user_notifcation[$single_chat->id ?? null] ?? null) == 0 ? '' : count($this->user_notifcation[$single_chat->id ?? null]) }}
                            </span>
                        @endif


                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="h-screen p-3 mb-9 pb-20">
            <x-loading-indecator :loading_action="'searched_user'"></x-loading-indecator>
            <div class="flex items-center mb-4  p-2 rounded-md">
                <div class="flex-1">
                    <h2 class="text-lg font-semibold">No Contacts</h2>
                </div>
            </div>
        </div>
    @endif
</div>
