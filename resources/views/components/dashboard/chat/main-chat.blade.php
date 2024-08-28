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
    <div id="chat_view" class=" h-svh overflow-y-auto p-4 pb-36">
        @if (sizeof($this->all_messages->message) && isset($this->all_messages->message))
            @foreach ($this->all_messages->message as $single_message)
                @if ($single_message->sender_id != Auth::user()->id)
                    <!-- Incoming Message -->
                    <div id="income-message" class="flex mb-4 ">
                        <div id="messages_parent" class="flex flex-col max-w-96  bg-slate-100 shadow-md rounded-lg p-3 gap-3">
                            <p class="text-gray-700">{{ $single_message->message }}</p>
                            <div class="flex items-start gap-2.5">
                                <div class="flex flex-col gap-1">
                                    <div
                                        class="flex flex-col w-96 max-w-[326px] leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                                                <div class="grid gap-4 grid-cols-2 my-2.5">
                                                    <div class="group relative">
                                                        <div
                                                            class="absolute w-full h-full bg-gray-900/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg flex items-center justify-center">
                                                            <button data-tooltip-target="download-image-1"
                                                                class="inline-flex items-center justify-center rounded-full h-8 w-8 bg-white/30 hover:bg-white/50 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50">
                                                                <svg class="w-4 h-4 text-white" aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 16 18">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3" />
                                                                </svg>
                                                            </button>
                                                            <div id="download-image-1" role="tooltip"
                                                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                                Download image
                                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                                            </div>
                                                        </div>
                                                        <img src="/docs/images/blog/image-1.jpg" class="rounded-lg" />
                                                    </div>
                                                    <div class="group relative">
                                                        <div
                                                            class="absolute w-full h-full bg-gray-900/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg flex items-center justify-center">
                                                            <button data-tooltip-target="download-image-2"
                                                                class="inline-flex items-center justify-center rounded-full h-8 w-8 bg-white/30 hover:bg-white/50 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50">
                                                                <svg class="w-4 h-4 text-white" aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 16 18">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3" />
                                                                </svg>
                                                            </button>
                                                            <div id="download-image-2" role="tooltip"
                                                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                                Download image
                                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                                            </div>
                                                        </div>
                                                        <img src="/docs/images/blog/image-2.jpg" class="rounded-lg" />
                                                    </div>
                                                    <div class="group relative">
                                                        <div
                                                            class="absolute w-full h-full bg-gray-900/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg flex items-center justify-center">
                                                            <button data-tooltip-target="download-image-3"
                                                                class="inline-flex items-center justify-center rounded-full h-8 w-8 bg-white/30 hover:bg-white/50 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50">
                                                                <svg class="w-4 h-4 text-white" aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 16 18">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3" />
                                                                </svg>
                                                            </button>
                                                            <div id="download-image-3" role="tooltip"
                                                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                                Download image
                                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                                            </div>
                                                        </div>
                                                        <img src="/docs/images/blog/image-3.jpg" class="rounded-lg" />
                                                    </div>
                                                    <div class="group relative">
                                                        <button
                                                            class="absolute w-full h-full bg-gray-900/90 hover:bg-gray-900/50 transition-all duration-300 rounded-lg flex items-center justify-center">
                                                            <span class="text-xl font-medium text-white">+7</span>
                                                            <div id="download-image" role="tooltip"
                                                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                                Download image
                                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                                            </div>
                                                        </button>
                                                        <img src="/docs/images/blog/image-1.jpg" class="rounded-lg" />
                                                    </div>
                                                </div>
                                                <div class="flex justify-end items-center">
                                                    <button
                                                        class="text-sm text-blue-700 dark:text-blue-500 font-medium inline-flex items-center hover:underline">
                                                        <svg class="w-3 h-3 me-1.5" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 16 18">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3" />
                                                        </svg>
                                                        Save all</button>
                                                </div>
                                    </div>
                                </div>
                            </div>

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
        @endif
    </div>

    <!-- Chat Input -->
    <footer class="bg-white border-t border-gray-300 p-4 absolute bottom-0 w-3/4">
        <!-- This is an example component -->
        <div class="w-full">

            <form class="">
                <label for="chat" class="sr-only">Your message</label>
                <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg dark:bg-gray-700">
                    <button type="button"
                        class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <button type="button"
                        class="p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
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
                <div wire:ignore>
                    <x-filepond::upload wire:model.live="LivewireTempFiles" dropOnPage=true dropOnElement=false
                        multiple=true maxFileSize="128MB" allowBrowse=false id="filepond_chat"
                        class="filepond-chat max-h-96 h-0 overflow-y-auto" />
                </div>

            </form>
        </div>
    </footer>

    {{-- Filepond script and controlling the visiblity of the file upload section --}}
    @push('script')
        <script>
            let addedFiles = 0;
            let proccedFiles = 0;
            let onGoingUploads = 0;
            const fileIDs = [];
            const chatViewContainer = document.getElementById('chat_view');
            const filepond = document.querySelector('.filepond-chat');

            // this happens before the file processing and after file dropping.
            // filepond.addEventListener('FilePond:addfile', (event) => {

            // });
            filepond.addEventListener('FilePond:addfilestart', (event) => {

                const removeButton = document.querySelectorAll('.filepond--action-remove-item');
                if (removeButton) {
                    removeButton.forEach(button => {
                        button.disabled = true;
                    });
                }
                if (event) {
                    const {
                        pond,
                        file
                    } = event.detail;
                    // pushing all file id into an array and then re use that array on the processing funciton

                    fileIDs.push(file.id)
                    addedFiles++;
                    onGoingUploads++;
                }
            });

            filepond.addEventListener('FilePond:processfile', (event) => {

                proccedFiles++;
                onGoingUploads--;

                if (onGoingUploads == 0) {
                    const removeButton = document.querySelectorAll('.filepond--action-remove-item');
                    if (removeButton) {
                        removeButton.forEach(button => {
                            button.disabled = false;
                        });
                    }
                }
                // after processing all the files , sending an event to livewire , to add external value to the temporaryFileArray which is id 
                // so we can compare that id when the user deletes a file from filepond 
                CheckForUploadedFiles();
            });
            // Attach the event listener globally to all FilePond instances
            filepond.addEventListener('FilePond:removefile', (event) => {
                const {
                    pond,
                    file
                } = event.detail;


                let file_id = fileIDs.findIndex((element) => element == file.id)
                fileIDs.splice(file_id, 1);
                // dispathing an event to delete the specific file from the UploadedFiles Variable
                Livewire.dispatch('deletedFile', {
                    'deleted_file_id': file.id
                })
                // listening for an event to make sure that there is data after deleting thing single file


                Livewire.on('IsThereFiles', function(files) {
                    if (files.files.length == 0 && onGoingUploads == 0) {
                        filepond.classList.remove("h-80");
                    }
                })

                addedFiles--;
                proccedFiles--;
            });

            // On Paste Show the filed
            chatViewContainer.addEventListener('paste', function() {
                const items = event.clipboardData.items;
                for (let i = 0; i < items.length; i++) {
                    const item = items[i];
                    if (item.kind === 'file') {
                        filepond.classList.add("h-80");
                    }
                }
            })

            // On Drop Show the filed
            chatViewContainer.addEventListener('drop', function() {
                filepond.classList.add("mystyle");
                const items = event.dataTransfer.items;
                for (let i = 0; i < items.length; i++) {
                    const item = items[i];
                    if (item.kind === 'file') {
                        filepond.classList.add("h-80");
                    }
                }
            })

            function CheckForUploadedFiles() {
                // console.log(proccedFiles , addedFiles);

                if (proccedFiles == addedFiles) {
                    Livewire.dispatch('addID_toFiles', {
                        'id': fileIDs
                    })
                }
            }
        </script>
    @endpush

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
