<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- needed for web route axios calls --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200, 200i, 400,600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="css/app.css">
  </head>
  <body class="font-sans">
    <div id="app">
      <div class="container mx-auto md:px-12">
        <header class="py-6">
          <h1 class="text-5xl">Events App</h1>
        </header>


        <main class="flex">
          <aside class="w-1/12">
            <section class="mb-8">
              <ul>
                <li class="pb-4"><router-link to="/">Home</router-link></li>
                <li class="pb-4"><router-link to="/events">Events</router-link></li>
              </ul>
            </section>
          </aside>

          <div class="primary w-11/12">
            <router-view></router-view>
          </div>
        </main>
      </div>
    </div>

    <script src="js/app.js"></script>
  </body>
</html>
