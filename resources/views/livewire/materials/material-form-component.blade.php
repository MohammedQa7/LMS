<div>
    <div x-data="tabManager()" class="border border-gray-200 rounded-lg">
        <div class="taps border border-l-0 border-t-0 border-r-0 border-b-gray-200">
            <div class="flex items-center justify-center ">
                <nav class="flex gap-x-1 w-full px-4 py-2" aria-label="Tabs" role="tablist">
                    <button @click="changeTab('files')"
                        class=" text-gray-700  py-3 px-2 inline-flex items-center gap-x-2  text-sm hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg  disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white "
                        :class="{ 'bg-gray-100': tab == 'files' }" role="tab">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12-3-3m0 0-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>

                        <p>Files</p>
                    </button>

                    <button @click="changeTab('lectures')"
                        class=" text-gray-700  dark:bg-neutral-800 dark:text-neutral-400  py-3 px-2 inline-flex items-center gap-x-2  text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg  disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white "
                        :class="{ 'bg-gray-100': tab == 'lectures' }" role="tab">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
                        </svg>

                        <p>Lectures</p>
                    </button>

                </nav>
            </div>
        </div>

        <div x-show="tab == 'files'">
            <x-dashboard.material.file-material-form :current_level="$this->current_level"></x-dashboard.material.file-material-form>
        </div>

        {{-- lectures --}}
        <div x-show="tab == 'lectures'">
            <x-dashboard.material.lecture-material-form></x-dashboard.material.lecture-material-form>
        </div>
    </div>


    {{-- AlpineJS --}}
    <script>
        function tabManager() {
            return {
                tab: 'files',
                changeTab(selectedTab) {
                    this.tab = selectedTab;
                    Livewire.dispatch('update_tab', {
                        'activeTab': this.tab
                    })
                },
            }
        }
    </script>
</div>
