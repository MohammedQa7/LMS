@props(['single_lecture'])
<div class=" absolute">
    @if ($single_lecture)
        <div x-cloak x-show="videoModalIsOpen" x-transition.opacity.duration.200ms
            x-trap.inert.noscroll="videoModalIsOpen" @keydown.esc.window="videoModalIsOpen = false, $refs.video.pause()"
            @click.self="videoModalIsOpen = false, $refs.video.pause()"
            class="fixed inset-0 z-40 flex items-center justify-center bg-black/20 p-4 backdrop-blur-md lg:p-8"
            role="dialog" aria-modal="true" aria-labelledby="videoModalTitle">
            <!-- Modal Dialog -->
            <div x-show="videoModalIsOpen" x-transition:enter="transition ease-out duration-300 delay-200"
                x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0"
                class="max-w-2xl w-full relative">
                <!-- Close Button -->
                <button type="button" x-show="videoModalIsOpen" @click="videoModalIsOpen = false, $refs.video.pause()"
                    x-transition:enter="transition ease-out duration-200 delay-500"
                    x-transition:enter-start="opacity-0 scale-0" x-transition:enter-end="opacity-100 scale-100"
                    class="absolute -top-12 right-0 flex items-center justify-center rounded-full bg-slate-100 p-1.5 text-black hover:opacity-75 active:opacity-100 dark:bg-slate-800 dark:text-white"
                    aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
                        fill="none" stroke-width="1.4" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <!-- Video -->
                <video x-ref="video" class="w-full max-w-2xl rounded-xl aspect-video" controls x-init="$watch('videoModalIsOpen', value => { if (value) { $refs.video.play(); } })">
                    <track default kind="captions" srclang="en" src="path to your .vtt file" />
                    <source src="{{  asset('storage/' . $single_lecture->video_file) }}" type="video/mp4">
                    Your browser does not support HTML video.
                </video>
            </div>
        </div>
    @endif
</div>
