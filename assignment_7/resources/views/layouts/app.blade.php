<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0" />
      <title>{{ config('app.name') }} | @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AlpineJS CDN -->
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link
      rel="preconnect"
      href="https://fonts.googleapis.com" />
    <link
      rel="preconnect"
      href="https://fonts.gstatic.com"
      crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
      rel="stylesheet" />

    <style>
      * {
        font-family: 'Inter', sans-serif;
      }
    </style>
    @stack('style')
  </head>
  <body class="bg-gray-100">
    
    @include('layouts.partials.header')
    @include('sweetalert::alert')
    <main
      class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
  
      @yield('content')

    </main>

    @include('layouts.partials.footer')
    @stack('script')
  </body>
</html>
