<!DOCTYPE html>
<html>
    <head>
        <title>GlowUP</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body>
    @include('base.header')
    @include('base.sidebar')
    <main id="main-content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </main>
    @include('base.footer')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('sidebar');
            const main = document.getElementById('main-content');
            const header = document.getElementById('app-header');

            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('sidebar-closed');
                main.classList.toggle('main-expanded');
                header.classList.toggle('header-expanded');
            });
        });
    </script>
</body>
</html>