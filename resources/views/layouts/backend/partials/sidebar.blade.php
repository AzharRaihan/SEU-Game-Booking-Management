<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul>
                <li class="has_sub">
                    <a href="{{ route('admin.dashboard') }}" class="{{ Request::is('admin.dashboard') ? 'active' : '' }} waves-effect"><i class="icon-grid"></i><span> Dashboard </span> </a>
                </li>
                <li class="has_sub">
                    <a href="{{ route('admin.user') }}" class="waves-effect"><i class="icon-people"></i><span> Member Approval </span> </a>
                </li>
                <li class="has_sub">
                    <a href="{{ route('admin.game-list') }}" class="waves-effect"><i class="icon-game-controller"></i><span> Games </span> </a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>
    </div>
</div>
