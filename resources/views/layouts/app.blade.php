<!DOCTYPE html>
<html dir="{{ app()->getLocale() == 'ar' ? 'rtl' : '' }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    {{-- Font --}}
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    {{-- phone number package --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css" rel="stylesheet" />
    {{-- Animation --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    {{-- Flowbite --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.phoenix.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- File upload --}}
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('Assets/dashboard-style/style.css') }}">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    @filamentStyles
</head>


<body>
    @if (\Route::current()->getName() == 'chat.index' || \Route::current()->getName() == 'start-quiz')
        <div class="chat-container h-screen">
            @livewire('notifications')
            {{-- Chat WEBPAGE --}}
            {{ $slot }}
            {{-- QUIZ WEBPAGE --}}
        </div>
    @else
        <div class="p-4 sm:ml-64 rtl:sm:mr-64 rtl:sm:ml-0">
            <x-dashboard.navbar></x-dashboard.navbar>
            <x-dashboard.Sidebar></x-dashboard.Sidebar>

            <div class="mt-8">
                @livewire('notifications')
                {{ $slot }}

            </div>


        </div>
    @endif
    @filepondScripts
    @livewireScripts
    @filamentScripts
    @filepondScripts
    <!-- Alpine Plugins -->
    <script src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- Flowbite --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
    {{-- Charts --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {{-- File upload --}}
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

    @stack('script')
    @stack('live-chat-script')


    <script type="module">
        // real-time notificaion counter
        Echo.private("liveNotification.{{ Auth::user()->id }}")
            .listen('liveNotifications', (event) => {
                var result = Object.keys(event).map((key) => [key, event[key]]);

                // Livewire.dispatch('highlighted_message', result[1][1].chat_id);
                Livewire.dispatch("hightlight", {
                    "id": event.chat.chat_id
                });

                var counter = document.getElementById('notification_counter');
                if (counter) {
                    // converting the text into an int so we can increment the notification by one
                    let counter_number = parseInt(counter.innerText);
                    counter.innerText = counter_number + 1;
                    let path = "{{ asset('Assets/sounds/bill.mp3') }}";
                    const audio = new Audio(path);
                    audio.play();
                }
            });
    </script>
</body>

</html>
