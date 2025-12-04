<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Custom Green Theme -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f2f9f4;
            font-family: "Instrument Sans", sans-serif;
            color: #333;
        }

        header,
        nav {
            color: #fff;
            padding: 12px 20px;
        }

        a {
            color: #157347;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        a:hover {
            color: #0f5a37;
            text-decoration: underline;
        }

        .container-fluid {
            padding: 25px;
        }

        /* Alert Messages */
        .alert {
            padding: 15px 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            border-left: 4px solid;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-left-color: #28a745;
        }

        .alert-error,
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-left-color: #dc3545;
        }

        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
            border-left-color: #17a2b8;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 8px rgba(0, 0, 0, .1);
        }

        table thead {
            background: #157347;
            color: #fff;
        }

        table th,
        table td {
            padding: 12px 15px;
            border-bottom: 1px solid #e6e6e6;
            text-align: left;
        }

        table tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-primary {
            background: #157347;
            color: white;
        }

        .btn-primary:hover {
            background: #0f5a37;
        }

        .btn-success {
            background: #198754;
            color: white;
        }

        .btn-success:hover {
            background: #06522e;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }

        .btn-add {
            background: #198754;
            padding: 8px 14px;
            border-radius: 6px;
            color: white !important;
        }

        .btn-add:hover {
            background: #06522e;
        }

        /* Card */
        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, .1);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .card-header {
            background: #157347;
            color: #fff;
            padding: 15px 20px;
            border-bottom: 2px solid #0f5a37;
        }

        .card-title {
            margin: 0;
            font-size: 20px;
        }

        .card-body {
            padding: 20px;
        }

        /* Badges */
        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }

        .bg-danger {
            background: #dc3545;
            color: white;
        }

        .bg-success {
            background: #198754;
            color: white;
        }

        .bg-info {
            background: #17a2b8;
            color: white;
        }

        /* Utilities */
        .text-center {
            text-align: center;
        }

        .text-muted {
            color: #6c757d;
        }

        .m-4 {
            margin: 20px;
        }

        .my-2 {
            margin: 10px 0;
        }

        .col {
            flex: 1;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f8f9fa;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    @include('layouts.nav')

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

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container-fluid">
        @yield('content')
    </div>
</body>

</html>