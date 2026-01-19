<!-- Menu -->

@php
    function activeMenu($route){
        return request()->routeIs($route) ? 'active' : '';
    }
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <a href="index.html" class="app-brand-link">
        <div class="app-brand demo">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/logo-miniseri.png') }}" alt="Miniseri logo" style="width:24px;height:auto;object-fit:contain;max-width:none;" />
            </span>
            <span class="app-brand-text demo menu-text fw-bold">Miniseri</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
        <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
    </a>
</div>

<div class="menu-inner-shadow"></div>

<ul class="menu-inner py-1">
    <!-- Page -->
    <li class="menu-item {{ activeMenu('admin.dashboard.*') }}">
    <a href="{{ route('admin.dashboard.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-dashboard me-2"></i>
        <div data-i18n="Admin Dashboard">Dashboard</div>
    </a>
    </li>
    <li class="menu-item {{ activeMenu('admin.sineas.*') }}">
    <a href="{{ route('admin.sineas.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-app-window"></i>
        <div data-i18n="Sineas Management">Sineas Management</div>
    </a>
    </li>
    <li class="menu-item {{ activeMenu('admin.folios.*') }}">
    <a href="{{ route('admin.folios.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-briefcase"></i>
        <div data-i18n="Folio Management">Folios Management</div>
    </a>
    </li>
</ul>
</aside>
<!-- / Menu -->

