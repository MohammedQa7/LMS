<div>
    <!-- Chat Header -->
    <header class="bg-white p-4 text-gray-700">
        <h1 class="text-2xl font-semibold">
            {{ Auth::user()->id == $this->all_messages->contact->id
                ? $this->all_messages->user->name
                : $this->all_messages->contact->name }}
        </h1>
    </header>
    <hr>
    <!-- Chat Messages -->
    {{-- {{$this->all_messages->message}} --}}
    @if (sizeof($this->all_messages->message) && isset($this->all_messages->message))
        <div id="container" class=" h-svh overflow-y-auto p-4 pb-36">
            @foreach ($this->all_messages->message as $single_message)
                @if ($single_message->sender_id != Auth::user()->id)
                    <!-- Incoming Message -->
                    <div id="income-message" class="flex mb-4 ">
                        <div id="messages_parent" class="flex max-w-96  bg-slate-100 shadow-md rounded-lg p-3 gap-3">
                            <p class="text-gray-700">{{ $single_message->message }}</p>
                        </div>
                    </div>
                @else
                    <!-- Outgoing Message -->
                    <div class="flex justify-end mb-4 ">

                        <div class="flex max-w-96 bg-indigo-500 text-white rounded-lg p-3 gap-3">
                            <p>{{ $single_message->message }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif

    <!-- Chat Input -->
    <footer class="bg-white border-t border-gray-300 p-4 absolute bottom-0 w-3/4">
        <!-- This is an example component -->
        <div class="w-full">

            <form>
                <label for="chat" class="sr-only">Your message</label>
                <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg dark:bg-gray-700">
                    <button type="button"
                        class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <button type="button"
                        class="p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <textarea wire:model="message" id="chat" rows="1"
                        class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Your message..."></textarea>
                    <button wire:click.prevent="send" type="submit"
                        class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                        <svg class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                            </path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </footer>

    @push('live-chat-script')
        {{-- notification counter --}}
        <script type="module">
            // this is a livewire event that will be dispatched using the chat livewire conponent for real-time messaging
            Livewire.on('ChatUpdated', (chat_id) => {
                if (chat_id) {
                    Echo.private(`liveChat.${chat_id.chat_id}`)
                        .listen('LiveChatEvent', (event) => {
                            // scroll to the last message was send from the sender
                            let container = document.getElementById('container');
                            if (container) {
                                // keep scrolling when reciveing new messages
                                // container.scrollTop = container.scrollHeight;
                            };
                            if (event.sender_data.id != {{ Auth::user()->id }} && event.chat_id == chat_id
                                .chat_id) {
                                // console.log(chat_id.chat_id);
                                // console.log(event.chat_id);

                                let incomeMessageDiv = document.createElement('div');
                                incomeMessageDiv.id = 'income-message';
                                incomeMessageDiv.className = 'flex mb-4';

                                // Create the inner div with id="messages_parent"
                                let messagesParentDiv = document.createElement('div');
                                messagesParentDiv.id = 'messages_parent';
                                messagesParentDiv.className =
                                    'flex max-w-96 bg-slate-100 shadow-md rounded-lg p-3 gap-3';

                                // Create the paragraph element
                                let messageParagraph = document.createElement('p');
                                messageParagraph.className = 'text-gray-700';
                                messageParagraph.textContent = event.sender_data
                                    .message; // Use the data from the event

                                // Append the paragraph to the inner div
                                messagesParentDiv.appendChild(messageParagraph);

                                // Append the inner div to the outer div
                                incomeMessageDiv.appendChild(messagesParentDiv);

                                // scroll to the last message that was recived from the sender
                                let container = document.getElementById('container');
                                container.appendChild(incomeMessageDiv);
                                if (container) {
                                    // keep scrolling when reciveing new messages
                                    container.scrollTop = container.scrollHeight;
                                }
                            }
                        });
                }

            });
        </script>
    @endpush
</div>
