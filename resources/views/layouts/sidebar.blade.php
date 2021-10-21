
<div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-menu-trigger">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em
                    class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em
                    class="icon ni ni-menu"></em></a>
        </div>
        <div class="nk-sidebar-brand">
            <a href="html/index.html" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                <img class="logo-dark logo-img" src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x"
                    alt="logo-dark">
            </a>
        </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element nk-sidebar-body">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Menus</h6>
                    </li><!-- .nk-menu-item -->

                    {{-- admin --}}
                @if( auth()->user())

                <li class="nk-menu-item has-sub">

                    <?php $sidemenu = \App\Models\aqs::getSideMenu(); ?>
                    @foreach($sidemenu as $parent)
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="{{ $parent->class }}"></em></span>
                                <span class="nk-menu-text">{{ ucfirst($parent->name) }}</span>
                            </a>
                            <ul class="nk-menu-sub">

                                @foreach(\App\Models\aqs::getChild( $parent->parent_id ?? $parent->id ) as $child)
                                <li class="nk-menu-item">
                                    <a href="{{ URL( $child->url ) }}" class="nk-menu-link"><span class="nk-menu-text">{{ $child->name }}</span></a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </li><!-- .nk-menu-item -->





            @endif



                    {{-- admin --}}
                @if( auth()->user())
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Admin Area</h6>
                    </li>

                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                            <span class="nk-menu-text">User Management</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{route("roles")}}" class="nk-menu-link"><span class="nk-menu-text">Roles &
                                        Permissions</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('users')}}" class="nk-menu-link"><span
                                        class="nk-menu-text">Users</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->



                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                            <span class="nk-menu-text">Menu Management</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{route('menu-routes')}}" class="nk-menu-link"><span class="nk-menu-text">Menu
                                        Routes</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('menus')}}" class="nk-menu-link"><span class="nk-menu-text">Menu
                                        Managment</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->

                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                            <span class="nk-menu-text">Gernal Settings</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{route('email-setting')}}" class="nk-menu-link"><span
                                        class="nk-menu-text">Email Settings</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('company-info')}}" class="nk-menu-link"><span
                                        class="nk-menu-text">Bussiness Information</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('login-settings')}}" class="nk-menu-link"><span
                                        class="nk-menu-text">Application Settings</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->

                    {{-- logs --}}
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                            <span class="nk-menu-text">Activity logs</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{route('user-logs')}}" class="nk-menu-link"><span
                                        class="nk-menu-text">User Activity logs </span></a>
                            </li>

                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->




                    @endif
                    {{--end of admin --}}


                </ul><!-- .nk-menu -->
            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div><!-- .nk-sidebar-element -->
</div>
