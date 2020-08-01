@auth
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/">Raihcita</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/">Rc</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item {{ (request()->is('home*')) ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Home</span></a>
            </li>
        </ul>
    </aside>
</div>
@endauth
