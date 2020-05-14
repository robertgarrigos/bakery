<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Styles -->
    <style>html,body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
      }
      .hero.is-info {
        background: linear-gradient(
            rgba(0, 0, 0, 0.5),
            rgba(0, 0, 0, 0.5)
          ), url('/assets/andrew-wong-59zgPU1aTgY-unsplash.jpg') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
      }
      .hero .nav, .hero.is-success .nav {
        -webkit-box-shadow: none;
        box-shadow: none;
      }
      .hero .subtitle {
        padding: 3rem 0;
        line-height: 1.5;
      }
    </style>
</head>
<body>

    <section class="hero is-info is-fullheight">
        <div class="hero-head">
            <nav class="navbar">
                <div class="container">
                    <div class="navbar-brand">
                        {{-- <a class="navbar-item" href="../">
                            <img src="http://bulma.io/images/bulma-type-white.png" alt="Logo">
                        </a>
                        <span class="navbar-burger burger" data-target="navbarMenu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span> --}}
                    </div>
                    <div id="navbarMenu" class="navbar-menu">
                        <div class="navbar-end">
                            <span class="navbar-item">
                                <a class="button is-white is-outlined is-small" href="admin">
                                    <span>Home</span>
                                </a>
                            </span>
                            {{-- <span class="navbar-item">
                                <a class="button is-white is-outlined" href="#">
                                    <span class="icon">
                                        <i class="fa fa-superpowers"></i>
                                    </span>
                                    <span>Examples</span>
                                </a>
                            </span>
                            <span class="navbar-item">
                                <a class="button is-white is-outlined" href="#">
                                    <span class="icon">
                                        <i class="fa fa-book"></i>
                                    </span>
                                    <span>Documentation</span>
                                </a>
                            </span>
                            <span class="navbar-item">
                                <a class="button is-white is-outlined" href="https://github.com/BulmaTemplates/bulma-templates/blob/master/templates/landing.html">
                                    <span class="icon">
                                        <i class="fa fa-github"></i>
                                    </span>
                                    <span>View Source</span>
                                </a>
                            </span> --}}
                        </div>
                    </div>
                </div>
            </nav>
            </div>

            <div class="hero-body">
                <div class="container has-text-centered">
                    <div class="column is-6 is-offset-3">
                        {{-- <h1 class="title">
                            Coming Soon
                        </h1>
                        <h2 class="subtitle">
                            $this is the best software platform for running an internet business. We handle billions of dollars every year for forward-thinking businesses around the world.
                        </h2> --}}
                        {{-- <div class="box">
                            <div class="field is-grouped">
                                <p class="control is-expanded">
                                    <input class="input" type="text" placeholder="Enter your email">
                                </p>
                                <p class="control">
                                    <a class="button is-info">
                                        Notify Me
                                    </a>
                                </p>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>

    </section>

    <!-- Scripts -->
    <script>
        window.default_locale = "{{ config('app.locale') }}";
        window.fallback_locale = "{{ config('app.fallback_locale') }}";
        window.messages = @json($messages);
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
