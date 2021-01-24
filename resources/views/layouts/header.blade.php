<!-- BEGIN: Header-->
<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto">
                            <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                                <i class="ficon feather icon-menu"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav bookmark-icons">
                        <!-- li.nav-item.mobile-menu.d-xl-none.mr-auto-->
                        <!--   a.nav-link.nav-menu-main.menu-toggle.hidden-xs(href='#')-->
                        <!--     i.ficon.feather.icon-menu-->
                    </ul>
                </div>
                <ul class="nav navbar-nav ">

                            <li class="dropdown dropdown-user nav-item float-right">
                                <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                    <div class="user-nav d-sm-flex d-none" style="font-size: 14px;">
                                        <span class="user-name text-bold-600">{{ 12 }}</span>
                                      {{--  <span class="user-status">CODE ECOLE: {{ Auth::user()->settings['code'] }}</span>--}}
                                    </div>
                                    <span>
                                <img class="round" src="{{ asset('login.png') }}"
                                     alt="avatar" height="40" width="40"/>
                                        {{--<img src="{{ asset('app-assets/images/portrait/small/avatar-s-11.png') }}" alt="branding logo" width="100%">--}}
                            </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">
                                        <i class="feather icon-user"></i> Mon Compte
                                    </a>
                                  {{--  @if(auth()->user()->hasRole('Admin'))
                                        <a class="dropdown-item" href="{{route('users.index')}}">
                                            <i class="feather icon-user-plus"></i> Gérer Utilisateur
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="feather icon-shield"></i> Gérer Roles
                                        </a>
                                    @endif--}}
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        <i class="icon icon-login-page icon-fw mr-2 mr-sm-1"></i>{{ __('Déconnexion') }}
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item d-none d-lg-block">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item d-none d-lg-block">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif

                </ul>
            </div>
        </div>
    </div>
</nav>
@section('js')

@endsection
<!-- END: Header-->

