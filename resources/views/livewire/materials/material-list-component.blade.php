<div>

    @role('teacher|adminstrator')
        <div x-data="{ modelOpen: false }" class="px-5 flex  justify-end">
            <button @click="modelOpen =!modelOpen" wire:click="deletedFiles"
                class="flex items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide text-red-700 capitalize transition-colors duration-200 transform border   rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-100 hover:bg-indigo-100 focus:outline-none  focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 13.5H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                </svg>


                <span>Deleted Files</span>
            </button>
            <x-dashboard.deleted-files-modal :deleted_files="$this->deleted_files"></x-dashboard.deleted-files-modal>
        </div>
    @endrole

    {{-- Zoom Meetings --}}
    @if (sizeof($this->ZoomMeetings) > 0 && isset($this->ZoomMeetings))
        <div class="pe-5 py-5 relative w-full ">
            <div class="relative border border-blue-500 rounded-lg p-3 ">
                {{-- Meeting Header Alert --}}
                <div class="quiz-header flex items-center justify-center ">
                    <h1 class="me-2 text-lg text-blue-500 font-extrabold">Meeting Alert
                    </h1>
                    <span class="relative flex h-4 w-4">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-900 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-4 w-4 bg-blue-500"></span>
                    </span>
                </div>
                {{--  --}}


                {{-- Meetings --}}
                <x-dashboard.student-portal.zoom-meeting-component></x-dashboard.student-portal.zoom-meeting-component>
            </div>
        </div>
    @endif
    {{--  --}}

    {{-- Quiz Alert + Quizzes  --}}
    @if (sizeof($this->quizzes) > 0 && isset($this->quizzes))
        <div class="pe-5 py-5 relative w-full ">
            <div class="relative border border-gray-200 rounded-lg p-3 ">
                {{-- Quiz Header Alert --}}
                <div class="quiz-header flex items-center justify-center ">
                    <h1 class="me-2 text-lg text-indigo-500 font-extrabold">Quiz Alert
                    </h1>
                    <span class="relative flex h-4 w-4">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-900 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-4 w-4 bg-indigo-500"></span>
                    </span>
                </div>
                {{--  --}}


                {{-- Quizzes --}}
                <x-dashboard.quizzes-component></x-dashboard.quizzes-component>
            </div>
        </div>
    @endif
    {{--  --}}


    {{-- File Materials --}}
    @if (sizeof($this->Materials) > 0)
        @foreach ($this->Materials as $single_material)
            <div class="grid grid-cols-2">
                <div>
                    @if (sizeof($single_material->files) > 0)
                        <p class="text-md text-gray-500 rtl:text-right">
                            {{ $single_material->name }}
                        </p>
                        <x-dashboard.file-ui :material="$single_material"></x-dashboard.file-ui>
                        <hr class="w-full h-1 mx-auto my-4 bg-gray-100 border-0 rounded md:my-5 dark:bg-gray-700">
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <p class="text-lg text-gray-500 rtl:text-right">
            No Files Were Found
        </p>
    @endif
    {{--  --}}

    {{-- Lecture Videos --}}
    <div class="mt-5">
        <h1 class="mb-4 text-2xl font-extrabold text-gray-900 dark:text-white md:text-4xl lg:text-4xl"><span
                class="text-transparent font-extrabold bg-clip-text bg-gradient-to-r to-purple-600 from-indigo-400">Lectures</span>
        </h1>
        @if (sizeof($this->Lectures) > 0)

            @foreach ($this->Lectures as $single_section)
                <div class="flex w-full flex-col gap-4 text-slate-700 dark:text-slate-300 mb-2">
                    <div x-data="{ isExpanded: false }"
                        class="divide-y divide-slate-300 overflow-hidden rounded-xl border border-slate-200 bg-slate-100/40 dark:divide-slate-700 dark:border-slate-700 dark:bg-slate-800/50">
                        <button id="controlsAccordionItemOne" type="button"
                            class="flex w-full items-center justify-between gap-2 bg-white p-4 text-left underline-offset-2 hover:bg-gray-50 focus-visible:bg-slate-100/75 focus-visible:underline focus-visible:outline-none dark:bg-slate-800 dark:hover:bg-slate-800/75 dark:focus-visible:bg-slate-800/75"
                            aria-controls="accordionItemOne" @click="isExpanded = ! isExpanded"
                            :class="isExpanded ? 'text-onSurfaceStrong dark:text-onSurfaceDarkStrong font-bold' :
                                'text-onSurface dark:text-onSurfaceDark font-medium'"
                            :aria-expanded="isExpanded ? 'true' : 'false'">
                            {{-- Lecture Section name --}}
                            {{ $single_section->name }}
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2"
                                stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true"
                                :class="isExpanded ? 'rotate-180' : ''">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        {{-- Accordion --}}
                        <div x-cloak x-show="isExpanded" id="accordionItemOne" role="region"
                            aria-labelledby="controlsAccordionItemOne" x-collapse.duration.500ms>
                            @if (sizeof($single_section->lectures) > 0 && !is_null($single_section->lectures))
                                @foreach ($single_section->lectures as $single_lecture)
                                    <div x-data="{ videoModalIsOpen: false }" class="p-4 flex justify-between items-center">
                                        <div class="relative lecture-content flex items-center  ">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6 ">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.91 11.672a.375.375 0 0 1 0 .656l-5.603 3.113a.375.375 0 0 1-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112Z" />
                                            </svg>

                                            {{-- Lecture name --}}
                                            <p class="ms-2">{{ $single_lecture->name }}</p>
                                        </div>
                                        <div class="lecture-play-btn">
                                            {{-- Modal Button --}}
                                            @if ($single_lecture->video_url != '' && !is_null($single_lecture->video_url))
                                                <a href="{{ $single_lecture->video_url }}"
                                                    target="_blank"
                                                    class="inline-flex cursor-pointer items-center gap-2 whitespace-nowrap rounded-xl bg-indigo-700 px-3 py-2 text-center text-sm font-medium tracking-wide text-slate-100 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        aria-hidden="true" fill="currentColor" class="w-4 h-4">
                                                        <path fill-rule="evenodd"
                                                            d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Play Video
                                                </a>
                                            @else
                                                <button @click="videoModalIsOpen = true" type="button"
                                                    class="inline-flex cursor-pointer items-center gap-2 whitespace-nowrap rounded-xl bg-indigo-700 px-3 py-2 text-center text-sm font-medium tracking-wide text-slate-100 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        aria-hidden="true" fill="currentColor" class="w-4 h-4">
                                                        <path fill-rule="evenodd"
                                                            d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Play Video
                                                </button>
                                            @endif

                                        </div>
                                        {{-- Video Modal --}}
                                        <x-dashboard.lecture.video-player :single_lecture="$single_lecture"></x-dashboard.lecture.video-player>
                                    </div>
                                    {{-- Seperator --}}
                                    <hr>
                                @endforeach
                            @else
                                <div class="p-4">
                                    <p class="ms-2">No Lectures Were Found</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-lg text-gray-500 rtl:text-right">
                No Lectures Were Found
            </p>
        @endif

    </div>

    {{--  --}}
</div>
