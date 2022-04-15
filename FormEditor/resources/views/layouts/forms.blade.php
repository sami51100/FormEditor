<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('FormEditor') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/auth.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    @yield('groupeCSS')
    <link href="{{ asset('dist/dragula.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/builder.css') }}" rel="stylesheet">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href=" {{ asset('img/FormEditor.png') }} "/>
    <link rel="shortcut icon" type="image/x-icon" href=" {{ asset('favicon.ico') }} "/>

    <!-- Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

</head>

    <body class="font-sans antialiased">

    <!-- ErrorMessageBanner -->
    @yield('error')
    @yield('ShowMessage')


<div class="app-container">
    <div class="app-header">
      <div class="app-header-left">
        <img src=" {{asset('img/FormEditor.png')}} " style="width: 35px">
        <p class="app-name"><a class="text-decoration-none text-reset" href="{{url('forms')}}"> {{ __('FormEditor') }} </a></p>
      </div>
      <div class="app-header-right">
        @auth
          @if (Auth::user()->role_id ==1 || Auth::user()->role_id ==2)
              <a href="{{ url('admin') }}" id="admin">{{ Auth::user()->role->role_nom }}</a>
          @endif
        @endauth
        <button class="mode-switch" title="Switch Theme">
          <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
            <defs></defs>
            <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
          </svg>
        </button>

        {{-- <button class="add-btn" title="Add New Project">
          <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
            <line x1="12" y1="5" x2="12" y2="19" />
            <line x1="5" y1="12" x2="19" y2="12" />
          </svg>
        </button>
        <button class="notification-btn">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
            <path d="M13.73 21a2 2 0 0 1-3.46 0" />
          </svg>
        </button> --}}

        <button class="profile-btn">
          @auth
          @if (Auth::user()->profile_photo_path == NULL)
          <img src="{{ asset(array_rand(['img/defaut1.png'=>0, 'img/defaut2.png'=>1], 1)) }}" />
          @else
          <img src=" {{ Auth::user()->profile_photo_path }} " />
          @endif
          @endauth
          <!-- Right Side Of Navbar -->
          <ul class="navbar navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-reset" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span> {{ __('Accès à un Compte') }} </span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if (Route::has('login'))
                                      <a class="dropdown-item" href="{{ route('login') }}">
                                        <i class="bi bi-box-arrow-in-right"></i>
                                        {{ __("Se Connecter") }}
                                      </a>
                                    @endif
                                    @if (Route::has('register'))
                                      <a class="dropdown-item" href="{{ route('register') }}">
                                        <i class="bi bi-plus-square"></i>
                                        {{ __("S'Inscrire") }}
                                      </a>
                                    @endif
                                </div>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-reset" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span> {{ Auth::user()->firstname }} </span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                  
                                  <a class="dropdown-item" style="background-color: {{Auth::user()->role->role_couleur.'8a'}}">
                                  <i class="bi bi-patch-check"></i>
                                  {{ Auth::user()->role->role_nom }}
                                  </a>

                                  <a class="dropdown-item" href="#">
                                  <i class="bi bi-gear"></i>
                                  {{ __("Paramètre") }}
                                  </a>
                                
                                  <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-in-right"></i>
                                        {{ __('Déconnexion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    <!-- ou bien entre les balises blade : url('/logout') dans la méthode action du form -->
                                </div>
                            </li>
                        @endguest
                    </ul>
        </button>
      </div>
      <button class="messages-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle">
          <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
        </svg>
      </button>
    </div>
    <div class="app-content">
      <div class="app-sidebar">
        <a href=" {{url('forms')}} " class="app-sidebar-link mon-shadow ">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
            <polyline points="9 22 9 12 15 12 15 22"></polyline>
          </svg>
        </a>
        <a href=" {{ url('groupes') }} " class="app-sidebar-link mon-shadow {{ str_contains(request()->url(), 'groupes') ? 'active' : '' }}">
          <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
 width="24" height="24" viewBox="0 0 550.000000 550.000000"
 preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">

<g transform="translate(0.000000,550.000000) scale(0.100000,-0.100000)"
fill="currentColor" stroke="none">
<path d="M2642 4759 c-233 -34 -440 -187 -548 -404 -53 -108 -74 -197 -74
-326 0 -327 206 -599 530 -700 107 -34 292 -34 400 0 262 81 446 273 512 533
17 69 20 101 15 203 -6 135 -24 203 -81 312 -109 207 -314 349 -550 382 -87
12 -115 12 -204 0z"/>
<path d="M1284 4211 c-138 -22 -259 -85 -360 -185 -204 -204 -247 -502 -111
-761 42 -80 164 -202 247 -248 221 -121 477 -108 678 33 73 51 162 148 189
206 16 32 16 33 -24 81 -101 122 -179 276 -220 430 -20 81 -25 123 -27 240
l-1 142 -32 15 c-84 40 -243 62 -339 47z"/>
<path d="M4015 4206 c-38 -7 -92 -23 -120 -35 l-50 -21 3 -91 c9 -253 -83
-519 -252 -723 l-40 -48 23 -43 c35 -67 115 -149 196 -203 197 -132 443 -143
660 -29 80 42 202 164 248 247 110 200 110 430 0 630 -46 83 -168 205 -248
247 -131 68 -288 94 -420 69z"/>
<path d="M2553 2915 c-335 -61 -632 -284 -787 -592 -91 -182 -116 -318 -116
-630 l0 -223 464 0 463 0 7 53 c11 81 52 238 92 345 118 318 358 614 648 800
l78 50 -45 31 c-109 74 -268 139 -410 166 -96 18 -294 18 -394 0z"/>
<path d="M1259 2560 c-229 -27 -444 -134 -604 -301 -99 -103 -134 -154 -190
-272 -64 -135 -86 -228 -92 -384 l-6 -133 455 0 455 0 6 268 c5 209 10 288 26
363 26 126 71 261 125 369 l44 88 -37 6 c-44 7 -94 6 -182 -4z"/>
<path d="M4075 2560 c-313 -36 -636 -207 -833 -442 -339 -406 -403 -949 -167
-1418 62 -122 135 -222 240 -325 508 -506 1324 -497 1823 19 191 198 306 431
347 706 101 665 -349 1305 -1013 1439 -117 24 -289 33 -397 21z m800 -764 c69
-53 92 -144 56 -221 -13 -27 -151 -171 -412 -432 -349 -346 -399 -393 -437
-403 -46 -12 -90 -7 -132 15 -14 8 -120 109 -237 227 -180 181 -213 219 -223
256 -35 134 88 257 222 221 35 -9 68 -36 181 -147 l137 -136 313 311 c171 171
326 318 342 327 49 26 143 17 190 -18z"/>
</g>
</svg>
        </a>
        <a href="#" class="app-sidebar-link mon-shadow">
          <svg class="link-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
            <defs></defs>
            <circle cx="12" cy="12" r="3"></circle>
            <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z"></path>
          </svg>
        </a>
      </div>

    <main class="@yield('main')">

        @yield('content')

    </main>
    
    </div>
  </div>

  <script type="text/javascript">
   document.addEventListener("DOMContentLoaded", function () {
    var modeSwitch = document.querySelector(".mode-switch");

    modeSwitch.addEventListener("click", function () {
      document.documentElement.classList.toggle("dark");
      modeSwitch.classList.toggle("active");
    });

    var listView = document.querySelector(".list-view");
    var gridView = document.querySelector(".grid-view");
    var projectsList = document.querySelector(".project-boxes");

    listView.addEventListener("click", function () {
      gridView.classList.remove("active");
      listView.classList.add("active");
      projectsList.classList.remove("jsGridView");
      projectsList.classList.add("jsListView");
    });

    gridView.addEventListener("click", function () {
      gridView.classList.add("active");
      listView.classList.remove("active");
      projectsList.classList.remove("jsListView");
      projectsList.classList.add("jsGridView");
    });

    document
    .querySelector(".messages-btn")
    .addEventListener("click", function () {
      document.querySelector(".messages-section").classList.add("show");
    });

    document
    .querySelector(".messages-close")
    .addEventListener("click", function () {
      document.querySelector(".messages-section").classList.remove("show");
    });
  });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
{{--    <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>--}}
<script src="{{ asset('dist/dragula.min.js')}}"></script>
<script src="{{asset('dist/jspdf.umd.min.js')}}"></script>
<script src="{{asset('html2canvas.min.js')}}"></script>
<script src="{{asset('js/builder.js')}}"></script>
</body>
</html>