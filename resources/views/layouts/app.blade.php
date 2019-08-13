<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials._head')
</head>

<body class="bg-gray-200 text-gray-900 font-sans antialiased">
    <div id="app">

        @include('partials._navbar')

        <main class="py-4 container">
            @yield('content')
        </main>
    </div>

    @include('partials._scripts')
</body>

</html>
