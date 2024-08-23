<div>
    <div class="quiz-content">
        @foreach ($this->quizzes as $single_quiz)
            <div
                class="flex justify-between items-center border border-l border-r-0 border-t-0 border-b-0 border-l-indigo-500 mb-5 hover:bg-indigo-50 hover:rounded-l-none hover:rounded-md transition-all p-5">
                <div class="quiz-information">
                    <h1 class=" font-bold">{{ $single_quiz->title }} <span
                            class="">({{ $single_quiz->description }})</span></h1>
                    <div class="flex text-xs gap-2">
                        <p class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6 w-4 h-4 me-1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
                            </svg>

                            Attempts : {{ $single_quiz->attempts }}
                        </p>
                        <p>|</p>
                        <p class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 w-4 h-4 me-1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>


                            Time Limit : {{ $single_quiz->time_limit }}
                        </p>
                        <p>|</p>
                        <p class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>

                        <p> Opens at : {{ Carbon\Carbon::parse($single_quiz->start_date)->format('Y/m/d') }} .
                            {{ Carbon\Carbon::parse($single_quiz->start_date)->format('h:m:s A') }}</p>
                        </p>
                        <p>|</p>
                        <p class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                        <p> Closes at : {{ Carbon\Carbon::parse($single_quiz->end_date)->format('Y/m/d') }} .
                            {{ Carbon\Carbon::parse($single_quiz->end_date)->format('h:m:s A') }}</p>
                        </p>
                    </div>
                </div>
                @role('student')
                <div class="quiz-start-btn">
                    <a href="{{ route('start-quiz', ['quiz_id' => $single_quiz->id]) }}"
                        class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-700  cursor-pointer transition-all">{{ trans('generalTrans.Quiz.Start-Quiz') }}</a>
                </div>
            @endrole
        </div>
    @endforeach

</div>
</div>
