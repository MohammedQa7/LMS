<x-app-layout>
    <div class="">
        <div class="px-4 pt-3   ">
            <div class="subjects-container border border-gray-400 rounded-md p-5">
                <div class="grid gap-4 xl:grid-cols-2 2xl:grid-cols-3">
                    <h1
                        class="mb-4 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-xl lg:text-xl dark:text-white">
                        {{ trans('generalTrans.Subjects') }}</h1>
                </div>
                @foreach ($all_subjects as $single_subject)
                    <div class="flex justify-between">
                        <a href="{{route('specific-subject-material' ,['class_slug' => $user->studentLevelWithClasses->class->slug , 'subject_slug' => $single_subject->slug])}}"
                            class="text-md text-blue-600 underline dark:text-blue-500 hover:no-underline">{{ $single_subject->name }}</a>
                        <a href="#">{{ trans('generalTrans.Teacher') }}:
                            <span
                                class="text-md text-blue-600 underline dark:text-blue-500 hover:no-underline">{{ $single_subject->teacher->user->name ?? trans('generalTrans.Unknown-Teacher') }}</span></a>
                    </div>
                    <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
