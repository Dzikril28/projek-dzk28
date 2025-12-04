<nav>
    <style>
        nav {
            background: #157347;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav a, nav button {
            color: white;
            font-weight: bold;
            margin-right: 15px;
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
            padding: 5px 10px;
            transition: all 0.3s;
        }

        nav a:hover, nav button:hover {
            opacity: 0.8;
            background: rgba(255,255,255,0.1);
            border-radius: 4px;
        }

        .nav-links {
            display: flex;
            align-items: center;
        }

        .nav-logout {
            background: #dc3545;
            padding: 8px 15px;
            border-radius: 4px;
            margin-left: auto;
        }

        .nav-logout:hover {
            background: #c82333;
        }
    </style>

    <div class="nav-links">
        {{-- @guest --}}
            <a href="{{ route('login') }}">Login</a>   
            <a href="{{ route('register') }}">Register</a>   
        {{-- @endguest
        @auth --}}
            <a href="{{ route('users.index') }}">Users</a>
            <a href="{{ route('tanah.index') }}">Tanah</a>
            <a href="{{ route('bangunan.index') }}">Bangunan</a>
            <a href="{{ route('ruangan.index') }}">Ruangan</a>
            <a href="{{ route('kategori.index') }}">Kategori</a>
            <a href="{{ route('barang.index') }}">Barang</a>
        {{-- @endauth --}}
    </div>

    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
        @csrf
        <button type="submit" class="nav-logout">Logout</button>
    </form>
</nav>
