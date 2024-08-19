<div>
    <form wire:submit="submit" class="mt-5  px-4 pb-4 rtl:text-start">
        <div class="grid  lg:grid-cols-2 md:grid-cols-2 grid-cols-1  gap-5">
            <div class="title_fields">
                <label for="title"
                    class="block text-sm text-gray-700 capitalize dark:text-gray-200 ">{{ trans('subject-content-modal.lecture_title_ar') }}</label>
                <input wire:model="lecture_name_ar"
                    placeholder="{{ trans('subject-content-modal.lecture_title_placeholder') }}" type="text"
                    class="block w-full px-3 py-2 mt-2 mb-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                @error('lecture_name_ar')
                    <x-dashboard.validation-error-message :message="$message"></x-dashboard.validation-error-message>
                @enderror
            </div>

            <div class="title_fields">
                <label for="title"
                    class="block text-sm text-gray-700 capitalize dark:text-gray-200 ">{{ trans('subject-content-modal.lecture_title_en') }}
                </label>
                <input wire:model="lecture_name_en"
                    placeholder="{{ trans('subject-content-modal.lecture_title_placeholder') }}" type="text"
                    class="block w-full px-3 py-2 mt-2 mb-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                @error('lecture_name_en')
                    <x-dashboard.validation-error-message :message="$message"></x-dashboard.validation-error-message>
                @enderror
            </div>
        </div>
        <div>
            <label for="title" class="block text-sm text-gray-700 capitalize dark:text-gray-200 ">
                {{ trans('subject-content-modal.section_selectin_title') }}
            </label>
            <div x-data="{ modelInnerOpen: false }" class="flex">
                <select wire:model="selected_lecture_section"
                    class="block w-full px-3 py-2 mt-2 mb-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-none rounded-s-lg focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                    @if (!is_null($this->lectureSections))
                        <option value="" selected>Select One Secion</option>
                        @foreach ($this->lectureSections as $single_lecture_section)
                            <option value="{{ $single_lecture_section->id }}">{{ $single_lecture_section->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <a @click="modelInnerOpen =!modelInnerOpen"
                    class="inline-flex items-center  px-3 py-2 mt-2 mb-2 text-sm text-gray-900 bg-white border rounded-s-0 border-gray-200 border-s-0 rounded-e-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 w-4 h-4 text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </a>
                <x-dashboard.modals.lecture-section-modal></x-dashboard.modals.lecture-section-modal>
            </div>


        </div>


        <div class="url mt-3">
            <label for="url"
                class="block text-sm text-gray-700 capitalize dark:text-gray-200 ">{{ trans('subject-content-modal.lecture_video_url') }}
            </label>
            <input {{ $this->videoFiles ? 'disabled' : '' }} wire:model.live="video_url" type="text"
                placeholder="https://www.youtube.com"
                class="block w-full px-3 py-2 mt-2 mb-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40 disabled:bg-gray-200 disabled:cursor-not-allowed">
            @error('video_url')
                <x-dashboard.validation-error-message :message="$message"></x-dashboard.validation-error-message>
            @enderror
        </div>

        {{-- Seperator --}}
        @if (!$this->is_upload_disabled)
            <div class="inline-flex items-center justify-center w-full">
                <hr class="w-64 h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                <span
                    class="absolute px-3 font-medium text-gray-900 -translate-x-1/2 bg-white left-1/2 dark:text-white dark:bg-gray-900">{{ trans('generalTrans.or') }}</span>
            </div>

            <div class="file-upload">
                <label
                    class="block mb-2 text-sm text-gray-700 capitalize dark:text-gray-200 ">{{ trans('subject-content-modal.lecture_upload-file') }}</label>


                <x-filepond::upload wire:model.live="videoFiles" multiple="false" id="filepond" />
                @error('videoFiles')
                    <x-dashboard.validation-error-message :message="$message"></x-dashboard.validation-error-message>
                @enderror
            </div>
        @endif


        <div class="mt-4">
            <h1 class="text-xs font-medium text-gray-400 uppercase">Status</h1>

            <div class="mt-4 space-y-5">

                <label class="inline-flex items-center cursor-pointer">
                    <input wire:model="lecture_status" type="checkbox" value="" class="sr-only peer" checked>
                    <div
                        class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600">
                    </div>
                    <span
                        class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ trans('subject-content-modal.visable') }}</span>
                </label>
            </div>
            @error('lecture_status')
                <x-dashboard.validation-error-message :message="$message"></x-dashboard.validation-error-message>
            @enderror
        </div>


        <div class="flex justify-end mt-6">
            <button wire:click.prevent="submit" type="submit"
                class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                Add
            </button>
        </div>
    </form>
</div>
