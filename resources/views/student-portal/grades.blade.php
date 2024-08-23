<x-app-layout>
    <div class="">
        <div class="px-4 pt-3   ">
            <div class="subjects-container">
                <div class="grid gap-4 xl:grid-cols-2 2xl:grid-cols-3">
                    <h1
                        class="mb-4 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-xl lg:text-xl dark:text-white">
                        {{ trans('generalTrans.Quiz.Grades') }}</h1>
                </div>

                @foreach ($user_grades as $single_grade)
                    <div class="grade-containre">
                        <div class="flex justify-between items-center  border border-indigo-500 py-3 px-2 rounded-lg">
                            <div class="quiz-info">
                                <h1 class=" font-bold">{{ $single_grade->quiz->title }}
                                    <span>( {{ $single_grade->quiz->description }} )</span>
                                </h1>
                                <p class="text-sm"> {{ trans('generalTrans.Quiz.Attempted') }}
                                    {{ \Carbon\Carbon::parse($single_grade->started_at)->format('h:m:s A  ,  Y/m/d') }}
                                </p>

                            </div>
                            <div class="grade-info text-white border bg-indigo-500 p-4 rounded-lg" dir="ltr">
                                <h1>{{$single_grade->score}} / {{$single_grade->quiz->total_score}}</h1>
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>

</x-app-layout>
