<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <meta
    name="description"
    content="{{ config('app.name', 'Laravel') }}"
  >

  <link
    rel="icon"
    href="{{ asset('favicon.svg') }}"
  >

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script
    defer
    src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"
  ></script>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Styles -->
  @livewireStyles

  <link
    href="{{ asset('css/app.css') }}"
    rel="stylesheet"
  >
</head>
<body class="font-sans antialiased">
  <x-jet-banner/>

  <div class="min-h-screen bg-gray-100">
    @livewire('components.navigation')

    <!-- Page Heading -->
    @if (isset($header))
      <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          {{ $header }}
        </div>
      </header>
    @endif

    <!-- Page Content -->
    <main>
      {{ $slot }}
    </main>
  </div>

  @stack('modals')

  <x-footer/>

  @livewireScripts
</body>
</html>
