<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
@vite(['resources/css/app.css', 'resources/js/app.js'])
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
