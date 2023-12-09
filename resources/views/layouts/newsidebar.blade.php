<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo justify-content-center">
        <!-- <a href="{{ url('/') }}"> -->
            <span class="app-brand-logo demo">
                <img class="normal-img" src="{{ asset('assets/img/logo.svg') }}"/>
                <!-- <img class="active-img" src="{{ asset('assets/img/Syntiri_icon.svg') }}"/> -->
            </span>
        <!-- </a> -->
        <!-- <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a> -->
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <!-- <li class="menu-item {{ request()->is('home') ? 'active' : '' }}">
            <a href="{{ url('/home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li> -->

        <!-- My Wishlist -->
        <li class="menu-item {{ request()->is('my-wishlist*') ? 'active' : '' }}">
            <a href="{{ url('/my-wishlist') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-heart-circle"></i>
                <div data-i18n="Analytics">My Wishlist</div>
            </a>
        </li>

        <!-- Group -->
        <li class="menu-item {{ request()->is('group*') ? 'active' : '' }}">
            <a href="{{ url('/group') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="Analytics">Group</div>
            </a>
        </li>

    </ul>
</aside>