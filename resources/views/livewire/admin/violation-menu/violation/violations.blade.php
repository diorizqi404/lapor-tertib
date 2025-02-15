    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold mb-6">Violation Dashboard</h2>

        <!-- Table -->
        @include('livewire.admin.violation-menu.violation.components.table')
        <!-- End Table -->

        

        {{-- @if (!empty($selectedStudent))
            {{ $selectedStudent['id'] }}
        @endif --}}
    </div>
