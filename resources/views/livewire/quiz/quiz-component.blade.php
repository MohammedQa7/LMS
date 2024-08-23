<div class="grid grid-cols-4 h-full gap-4 justify-center items-center  mx-10">
    <div class="left-side-quiz-info flex justify-center items-center w-full h-full ">
        <div
            class=" text-gray-600 m-2 w-full overflow-y-hidden tablet:grid-rows-1 border border-gray-300  rounded-lg p-4 ">
            <div class="tester-info flex items-center gap-1">
                <div class="avatar w-12 h-12 bg-gray-300 rounded-full mr-3">
                    <img src="" alt="User Avatar" class="w-12 h-12 rounded-full">
                </div>
                <div class="public-info">
                    <h1>{{ Auth::user()->name }}</h1>
                </div>
            </div>
            

            <div class="questsion-navigator mt-5">
                <h1 class="font-bold text-lg mb-1 ">Questions</h1>
                <div class="grid grid-cols-4 gap-3">
                    @foreach ($questions as $key => $single_question)
                        <a wire:click.prevent="{{ $this->current_page == $key ? '' : "submit('$key')" }}">
                            <div
                                class="flex justify-center items-center rounded-lg bg-gray-100 w-full h-12  hover:bg-gray-200 transition-all cursor-pointer
                            {{ $this->current_page == $key ? 'bg-gray-500 text-white pointer-events-none' : '' }}                        
                            ">
                                <p>{{ $key }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="main-quiz-quesitons col-span-3 ">

        <div class=" text-gray-600 w-full   overflow-y-hidden tablet:grid-rows-1">

            <div class="mt-5">
                <div class="quiz-header-info flex  justify-between items-center mb-2">
                    <div>
                        <p class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 me-1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>


                            {{ $this->current_page }} / {{ $this->quiz->total_score }}
                        </p>
                    </div>
                    <div>
                        <p class="flex items-center ">
                            120 score
                        </p>
                    </div>
                    <div class="flex flex-row-reverse items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 ms-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <p x-data="countdownTimer()" x-init="startCountdown" x-text="formattedTime" class="font-bold">

                        </p>
                    </div>

                </div>
                <hr class="w-full h-1 bg-gray-900 border-0 rounded  dark:bg-white">
                <div class="min-h-full items-center justify-center py-4 rounded-lg flex flex-col">
                    <div
                        class="border-4 border-gray-400 p-3 w-full rounded-lg shadow-xl flex items-center justify-center md:p-5 mb-3">
                        <h1 class="text-center font-medium md:text-lg">
                            {{ $questions[$this->current_page]['question_text'] }}</h1>
                    </div>
                    @error('selected_answer')
                        <span class="font-medium dark:text-red-400">hi</span>
                    @enderror
                </div>

            </div>
            <div class="mt-3">
                <ul class="grid w-full gap-6 md:grid-cols-2">
                    @foreach ($questions[$this->current_page]['answers'] as $single_answer)
                        <li>
                            <input wire:model.live="selected_answers" id="option-{{ $single_answer['id'] }}"
                                type="radio" name="options" value="{{ $single_answer['id'] ?? null }}"
                                class="hidden peer" required />
                            <label for="option-{{ $single_answer['id'] }}"
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="block">
                                    <div class="w-full">{{ $single_answer['answer_text'] }}</div>
                                </div>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="flex items-center justify-center">
                @if ($this->current_page == count($this->current_question))
                    <button wire:click.prevent="submit({{ $this->current_page }})"
                        class="px-12 py-4 bg-gray-600 text-white text-lg rounded-lg hover:bg-gray-700 transition w-full md:w-1/3 mt-5">
                        Submit Quiz
                    </button>
                @else
                    <button wire:click.prevent="submit({{ $this->current_page }})"
                        class="px-12 py-4 bg-gray-600 text-white text-lg rounded-lg hover:bg-gray-700 transition w-full md:w-1/3 mt-5">
                        Next
                    </button>
                @endif
            </div>

        </div>
    </div>

    @push('script')
        <script>
            function countdownTimer() {

                return {
                    time: {{ $this->remaining_timer }},
                    interval: null,

                    startCountdown() {
                        this.interval = setInterval(() => {
                            if (this.time <= 0) {
                                clearInterval(this.interval);
                                Livewire.dispatch("forceQuit");
                                this.$el.innerText = "Time's up!";
                            } else {
                                this.time--;
                            }
                        }, 1000);
                    },

                    formattedTime() {
                        let minutes = Math.floor(this.time / 60);
                        let seconds = this.time % 60;
                        return `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                    }
                };
            }
        </script>
    @endpush
</div>
