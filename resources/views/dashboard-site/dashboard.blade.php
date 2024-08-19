<x-app-layout>
    <div class="">
        <div class="px-4 pt-6">
            <div class="grid gap-4 xl:grid-cols-2 2xl:grid-cols-3">
                {{-- NumberStatistics --}}
                <x-dashboard.number-statistics></x-dashboard.number-statistics>

                {{-- monthly statistics --}}
                <x-dashboard.monthly-statistics></x-dashboard.monthly-statistics>
                <div class="flex w-full flex-col gap-4 text-slate-700 dark:text-slate-300">
                    <div x-data="{ isExpanded: false }"
                        class="divide-y divide-slate-300 overflow-hidden rounded-xl border border-slate-200 bg-slate-100/40 dark:divide-slate-700 dark:border-slate-700 dark:bg-slate-800/50">
                        <button id="controlsAccordionItemOne" type="button"
                            class="flex w-full items-center justify-between gap-2 bg-white p-4 text-left underline-offset-2 hover:bg-gray-50 focus-visible:bg-slate-100/75 focus-visible:underline focus-visible:outline-none dark:bg-slate-800 dark:hover:bg-slate-800/75 dark:focus-visible:bg-slate-800/75"
                            aria-controls="accordionItemOne" @click="isExpanded = ! isExpanded"
                            :class="isExpanded ? 'text-onSurfaceStrong dark:text-onSurfaceDarkStrong font-bold' :
                                'text-onSurface dark:text-onSurfaceDark font-medium'"
                            :aria-expanded="isExpanded ? 'true' : 'false'">
                            What browsers are supported?
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2"
                                stroke="currentColor" class="size-5 shrink-0 transition" aria-hidden="true"
                                :class="isExpanded ? 'rotate-180' : ''">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div x-cloak x-show="isExpanded" id="accordionItemOne" role="region"
                            aria-labelledby="controlsAccordionItemOne" x-collapse.duration.500ms>
                            <div class="p-4 text-sm sm:text-base ">
                                Our website is optimized for the latest versions of Chrome, Firefox, Safari, and Edge.
                                Check our <a href="#"
                                    class="underline underline-offset-2 text-blue-700 dark:text-blue-600">documentation</a>
                                for additional information.
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
