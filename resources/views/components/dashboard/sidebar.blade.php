<div>
    <aside id="sidebar-multi-level-sidebar"
        class="fixed top-0 left-0 rtl:right-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 "
        aria-label="Sidebar">
        @role('teacher|administrator')
            @include('includes.PrivateDashboard')
            @else
            @include('includes.PublicDashboard')
        @endrole
    </aside>
</div>
