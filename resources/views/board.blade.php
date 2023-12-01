<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Andreas Wyss">
    <meta name="generator" content="socialthink 0.1.1">
    <title>monitoR</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src='https://unpkg.com/@turf/turf@6/turf.min.js'></script>
    <style>
    .leaflet-container {
    height: 400px;
    width: 100%;
    }
    </style>


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }
      .bd-mode-toggle {
        z-index: 1500;
      }
    </style>


    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sticky-footer-navbar.css') }}" rel="stylesheet">

  </head>
  <body class="d-flex flex-column h-100">


    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="/">monitoR</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            @if(Auth::user() && (Auth::user()->role==='admin' || Auth::user()->role==='superadmin' || Auth::user()->role==='user'))
            <ul class="navbar-nav me-auto mb-2 mb-md-0">

              <li class="nav-item">
                <a class="nav-link{{ (request()->is('/*')) ? ' active' : '' }}" href="{{  url('') }}">Dashboard</a>
              </li>

              @if(env('MODUL_BEOBACHTUNGEN')===true)
              <li class="nav-item">
                <a class="nav-link{{ (request()->is('beobachtung*')) ? ' active' : '' }}" href="{{  url('') }}/beobachtung">Beobachtung</a>
              </li>
              @endif

              @if(env('MODUL_ERFASSUNG')===true)
              <li class="nav-item">
                <a class="nav-link{{ (request()->is('erfassung*')) ? ' active' : '' }}" href="{{  url('') }}/erfassung">Erfassung</a>
              </li>
              @endif

              @if(env('MODUL_PLANUNG')===true)
              <li class="nav-item">
                <a class="nav-link{{ (request()->is('planung*')) ? ' active' : '' }}" href="{{  url('') }}/planung">1. Planung</a>
              </li>

              <li class="nav-item">
                <a class="nav-link{{ (request()->is('update*')) ? ' active' : '' }}" href="{{  url('') }}/update">2. Update</a>
              </li>

              <li class="nav-item">
                <a class="nav-link{{ (request()->is('abschluss*')) ? ' active' : '' }}" href="{{  url('') }}/abschluss">3. Abschluss</a>
              </li>
              @endif

            </ul>
            @endif


            <ul class="navbar-nav ms-auto mb-2 mb-md-0">
              @if(Auth::check() && Auth::user()->role==='superadmin')
              <li class="nav-item">
                <a class="nav-link{{ (request()->is('apisetting*')) ? ' active' : '' }}" href="{{  url('') }}/apisetting">API</a>
              </li>
              @endif

              @if(Auth::check() && (Auth::user()->role==='admin' || Auth::user()->role==='superadmin'))
              <li class="nav-item">
                <a class="nav-link{{ (request()->is('team*')) ? ' active' : '' }}" href="{{  url('') }}/team">Team</a>
              </li>

              <li class="nav-item">
                <a class="nav-link{{ (request()->is('usermanagement*')) ? ' active' : '' }}" href="{{  url('') }}/usermanagement">Benutzer*innen</a>
              </li>
            @endif

            </ul>


            @if(Auth::user())
            <form class="d-flex" action="{{ route('logout' )}}" method="post">
              @csrf
              <button class="btn btn-outline-warning" type="submit">Logout</button>
            </form>
            @endif
          </div>
        </div>
      </nav>
    </header>

<!-- Begin page content -->
<main class="flex-shrink-0">


@yield('inhalt')


</main>

<footer class="footer mt-auto py-3 bg-body-tertiary">
  <div class="container">
    <div class="fuss">
    <span style="float:left; color: blue;">&copy; 2023 <a href="https://socialthink.ch" style="color: blue;">socialthink.ch</a></span>
    <br><span style="float:left; color: blue;">&hearts; Open Data & Science | <a href="https://kindheit-jugend.ch" style="color: blue;">kindheit-jugend.ch</a></span>
  </div>
  </div>
</footer>
<script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/d3.v7.min.js') }}"></script>
    </body>
</html>
