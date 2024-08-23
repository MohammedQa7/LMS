<div>
    <div class="meeting-content">

        @foreach ($this->ZoomMeetings as $single_meeting)
            <div
                class="flex justify-between items-center border border-l border-r-0 border-t-0 border-b-0 border-l-blue-500 mb-5 hover:bg-blue-50 hover:rounded-l-none hover:rounded-md transition-all p-5">
                <div class="quiz-information">
                    <h1 class=" font-bold">{{ $single_meeting->title }}</h1>
                    <div class="flex text-xs gap-2">
                        <p class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6 w-4 h-4 me-1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>

                            Meeting Duration : {{ $single_meeting->duration }} MIN
                        </p>
                        <p>|</p>
                        <p class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 w-4 h-4 me-1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>


                            Starts at : {{ $single_meeting->start_at->format('Y/m/d , h:m:s') }}
                        </p>
                    </div>
                </div>

                @role('teacher|adminstrator')
                    <div class="quiz-start-btn">
                        <a href="{{ $single_meeting->start_url }}"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700  cursor-pointer transition-all">{{ trans('generalTrans.Meeting.Start-Meeting') }}</a>
                    </div>
                @endrole

                @role('student')
                    <div class="quiz-start-btn">
                        <a href="{{ $single_meeting->meeting_url }}"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700  cursor-pointer transition-all">{{ trans('generalTrans.Meeting.Start-Meeting') }}</a>
                    </div>
                @endrole
            </div>
        @endforeach

    </div>
</div>
