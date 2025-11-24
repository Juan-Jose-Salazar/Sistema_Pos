<!DOCTYPE html>
<html lang="es">
<head>
    @include('layouts.head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #f3f5ff 0%, #e7ecff 100%);
            font-family: 'Instrument Sans', sans-serif;
            min-height: 100vh;
            margin: 0;
        }
        nav {
             background: white;
            color: #0f172a;
            padding: 14px 28px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.07);
            position: sticky;
            top: 0;
            z-index: 10;
        }
        nav .nav-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
        }
        nav .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 1.1rem;
            color: #2563eb;
        }
        nav .brand span {
            color: #0f172a;
            font-weight: 800;
        }
        nav .nav-links {
            display: flex;
            align-items: center;
            gap: 18px;
        }
        nav a {
            color: #0f172a;
             text-decoration: none;
                font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 10px;
            transition: all 0.2s ease;
        }
        nav a:hover {
              background: #e0e7ff;
            color: #1d4ed8;
        }
        .content-box {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(15, 23, 42, 0.10);
            padding: 30px;
            margin: 40px auto;
              max-width: 1200px;
            width: 92%;
        }
        h1 {  
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 18px;
            color: #0f172a;
        }
         .subtitle {
            color: #475569;
            margin-bottom: 24px;
            font-size: 1rem;
        }
        .btn-primary {
            background-color: #2563eb;
            color: white !important;
            padding: 10px 20px;
            border: none;
             border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
             box-shadow: 0 10px 25px rgba(37, 99, 235, 0.28);
            transition: background-color 0.2s, transform 0.1s, box-shadow 0.2s ease;

        }
        .btn-primary:hover {
            background-color: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 12px 30px rgba(37, 99, 235, 0.35);
        }
        .btn-primary:active {
            transform: translatey(0);
        }
        .grid {
            display: grid;
            gap: 18px;
        }
        .grid-cols-3 {
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        }
        .card {
            background: linear-gradient(145deg, #ffffff, #f8fbff);
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 18px;
            box-shadow: 0 14px 35px rgba(15, 23, 42, 0.08);
            transition: transform 0.15s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.12);
            border-color: #cbd5e1;
        }
        .card .label {
            font-size: 0.9rem;
            color: #475569;
            margin-bottom: 6px;
        }
        .card .value {
            font-size: 1.9rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 10px;
        }
        .pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: #e0f2fe;
            color: #0369a1;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.85rem;
        }
        .card-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }
        .secondary-link {
            color: #2563eb;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .secondary-link:hover {
            color: #1d4ed8;
        }
        .section-title {
            font-weight: 800;
            font-size: 1.25rem;
            color: #0f172a;
            margin-bottom: 12px;
        }
        .section-description {
            color: #475569;
            margin-bottom: 20px;
        }
          </style>
</head>

<body>
    {{-- Barra superior global --}}
    <nav>
        <div class="nav-container">
            <a class="brand" href="{{ url('/') }}">
                <i class="fa-solid fa-cash-register"></i>
                <span>POS</span>Vista
            </a>
            <div class="nav-links">
                <a href="{{ url('/') }}"><i class="fa-solid fa-house"></i>Inicio</a>
                <a href="{{ route('orders.index') }}"><i class="fa-solid fa-receipt"></i>Órdenes</a>
                <a href="{{ route('invoices.index') }}"><i class="fa-solid fa-file-invoice-dollar"></i>Facturas</a>
                <a href="{{ route('products.index') }}"><i class="fa-solid fa-box"></i>Productos</a>
                <a href="{{ route('productscategorys.index') }}"><i class="fa-solid fa-sitemap"></i>Categorías</a>
                <a href="{{ route('clients.index') }}"><i class="fa-solid fa-users"></i>Clientes</a>
                <a href="{{ route('users.index') }}"><i class="fa-solid fa-user"></i>Usuarios</a>
                <a href="{{ route('rols.index') }}"><i class="fa-solid fa-id-card"></i>Roles</a>
            </div>
        </div>
    </nav>


    {{-- Contenedor principal de cada vista --}}
    <div class="content-box">
        @yield('content')
    </div>
</body>
</html>