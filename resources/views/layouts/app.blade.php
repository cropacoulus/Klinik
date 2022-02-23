<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

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

        @livewireScripts
        <script>
            function checkAll(element) {
                let rows = element.parentElement.parentElement.parentElement.nextElementSibling.children;
                for (var i = 0; i < rows.length; i++) {
                    if (element.checked) {
                        rows[i].classList.add("bg-gray-100");
                        rows[i].classList.add("dark:bg-gray-700");
                        let checkbox = rows[i].getElementsByTagName("input")[0];
                        if (checkbox) {
                            checkbox.checked = true;
                        }
                    } else {
                        rows[i].classList.remove("bg-gray-100");
                        rows[i].classList.remove("dark:bg-gray-700");
                        let checkbox = rows[i].getElementsByTagName("input")[0];
                        if (checkbox) {
                            checkbox.checked = false;
                        }
                    }
                }
            }
        </script>
    </body>
</html>
