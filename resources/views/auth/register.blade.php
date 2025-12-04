@extends('layouts.app')

@section('title', 'Register')

@section('content')

<h2 align="center">Register</h2>

<div style="max-width: 400px; margin: 30px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
    
    @if ($errors->any())
        <div style="
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 15px;
            border-left: 4px solid #dc3545;
        ">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div style="
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 15px;
            border-left: 4px solid #28a745;
        ">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('register.process') }}" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #333;">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   style="
                       width: 100%;
                       padding: 10px;
                       border: 2px solid #ddd;
                       border-radius: 4px;
                       font-size: 14px;
                       box-sizing: border-box;
                   "
                   placeholder="Masukkan nama lengkap">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #333;">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   style="
                       width: 100%;
                       padding: 10px;
                       border: 2px solid #ddd;
                       border-radius: 4px;
                       font-size: 14px;
                       box-sizing: border-box;
                   "
                   placeholder="Masukkan email">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #333;">Password</label>
            <input type="password" name="password" required
                   style="
                       width: 100%;
                       padding: 10px;
                       border: 2px solid #ddd;
                       border-radius: 4px;
                       font-size: 14px;
                       box-sizing: border-box;
                   "
                   placeholder="Masukkan password (min 6 karakter)">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; font-weight: 600; color: #333;">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required
                   style="
                       width: 100%;
                       padding: 10px;
                       border: 2px solid #ddd;
                       border-radius: 4px;
                       font-size: 14px;
                       box-sizing: border-box;
                   "
                   placeholder="Ulangi password">
        </div>

        <button type="submit" style="
            width: 100%;
            padding: 10px;
            background: #157347;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        " 
        onmouseover="this.style.background='#0f5a37'" 
        onmouseout="this.style.background='#157347'">Daftar</button>

        <p style="text-align: center; margin-top: 15px; color: #666; font-size: 14px;">
            Sudah punya akun? <a href="{{ route('login') }}" style="color: #157347; font-weight: 600;">Login di sini</a>
        </p>
    </form>

</div>

@endsection