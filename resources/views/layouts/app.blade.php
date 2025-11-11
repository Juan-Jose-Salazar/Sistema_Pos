<!DOCTYPE html>
<html lang="es">
<head>
    @include('layouts.head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background-color: #ffffffff;
            font-family: 'Instrument Sans', sans-serif;
        }
        nav {
            background: #2563eb;
            color: white;
            padding: 12px 25px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        nav a {
            color: white;
            margin-right: 15px;
            text-decoration: none;
            font-weight: 500;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .content-box {
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
            padding: 25px;
            margin: 40px auto;
            max-width: 90%;
        }
        h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        nav a i {
             margin-right: 6px;
        }
        nav a {
             display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .btn-primary {
            background-color: #2563eb;
            color: white !important;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.2s, transform 0.1s;
            
        }
        .btn-primary:hover {
            background-color: #1d4ed8;
            transform: translateY(-1px);
        }
        .btn-primary:active {
            transform: translateY(1px);
        }
                


    </style>
</head>

<body>
    {{-- Barra superior global --}}
    <nav>
        <a href="{{ url('/') }}"><i class="fa-solid fa-house"></i> Inicio</a>
        <a href="{{ route('rols.index') }}"><i class="fa-solid fa-id-card"></i> Roles</a>
        <a href="{{ route('products.index') }}"><i class="fa-solid fa-box"></i> Productos</a>
        <a href="#"><i class="fa-solid fa-user"></i> Usuarios</a>
    </nav>


    {{-- Contenedor principal de cada vista --}}
    <div class="content-box">
        @yield('content')
    </div>
</body>
</html>
