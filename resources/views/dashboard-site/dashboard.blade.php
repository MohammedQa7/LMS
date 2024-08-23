<x-app-layout>
    <div class="">

        <div class="px-4 pt-6">
            <div class="grid gap-4 xl:grid-cols-2 2xl:grid-cols-3">
                {{-- NumberStatistics --}}
                <x-dashboard.number-statistics></x-dashboard.number-statistics>

                {{-- monthly statistics --}}
                <x-dashboard.monthly-statistics></x-dashboard.monthly-statistics>

            </div>
        </div>
        @livewire('calendar')
    </div>
</x-app-layout>
