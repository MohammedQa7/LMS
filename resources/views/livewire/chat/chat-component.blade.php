<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <div class="w-1/4 bg-white border-r border-gray-300">
        <!-- Sidebar Header -->
        <header x-data="{ modelOpen: false }"
            class="p-4 border-b border-gray-300 flex justify-between items-center bg-white text-black ">

            <h1 class="text-2xl font-semibold">Chats</h1>

            <x-dashboard.chat.modal.new-contact-modal></x-dashboard.chat.modal.new-contact-modal>
            <button @click="modelOpen =!modelOpen"
                class="flex items-center px-3 py-1 border border-indigo-400 rounded-lg hover:bg-indigo-100 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 w-5 h-5 me-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                New Contact</button>

        </header>

        <!-- Contact List -->
        <x-dashboard.chat.contact-list />
        {{ $this->selected_chat }}
    </div>

    <!-- Main Chat Area -->

    <div class="flex-1">
        @if ($this->all_messages)
            <x-dashboard.chat.main-chat />
        @else
            <div class="h-screen overflow-y-auto p-4 pb-36 bg-slate-100">
            </div>
        @endif
    </div>
</div>
