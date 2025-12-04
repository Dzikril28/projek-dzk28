<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background: #f8fdfb;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #157347;
            padding: 20px;
            text-align: center;
            color: white;
        }

        h1 {
            margin: 0;
            font-weight: 600;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            border-left: 6px solid #157347;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.07);
        }

        a {
            font-weight: 600;
            color: #157347;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        p {
            font-size: 18px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Home {{ $name }}!</h1>
    </header>

    <div class="container">
        <p>
            SELAMAT DATANG DI WEB BUATAN DZIKRIL DENGAN JERIH PAYAHNYA (AI).  
            SILAKAN KLIK LINK DI BAWAH UNTUK LOGIN:
            <br><br>
            👉 <a href="http://127.0.0.1:8000/login">MASUK</a>
        </p>
    </div>

</body>

</html>