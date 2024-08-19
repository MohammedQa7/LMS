<div>

    <div>
        <div>
            <h3 class="mb-4 text-xl font-semibold dark:text-white">General information</h3>
            <form wire:submit="submit">
                {{ $this->form }}

                <button
                    class="text-black border bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-5 text-center hover:bg-gray-100 dark:text-black dark:bg-white dark:hover:bg-gray-100"
                    type="submit">Save all</button>
        </div>
        </form>
        {{-- <x-filament-actions::modals /> --}}



    </div>
    @push('script')
        <script>
            document.addEventListener('livewire:load', function() {
                // Initialize Filament components if needed
                // For example:
                Filament.init();
            });
        </script>
    @endpush
</div>
