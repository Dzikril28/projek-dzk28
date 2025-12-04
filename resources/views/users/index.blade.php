@extends('layouts.app')

@section('title', 'Data Users')

@section('content')

<h2 align="center">Data Users</h2>

<div style="margin-bottom: 15px;">
    <p style="color: #666; font-size: 14px;">Total Users: <strong>{{ count($items) }}</strong></p>
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Terdaftar</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($items as $item)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td align="center">{{ $item->name }}</td>
            <td align="center">{{ $item->email }}</td>
            <td align="center">
                <span style="
                    padding: 4px 8px;
                    border-radius: 4px;
                    font-size: 12px;
                    font-weight: 600;
                    color: white;
                    background: {{ $item->role === 'admin' ? '#dc3545' : '#198754' }};
                ">
                    {{ ucfirst($item->role) }}
                </span>
            </td>
            <td align="center">{{ $item->created_at->format('d M Y') }}</td>
            <td align="center">
                <form action="{{ route('users.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="
                        background: #dc3545;
                        color: white;
                        padding: 5px 10px;
                        border: none;
                        border-radius: 4px;
                        cursor: pointer;
                        font-size: 12px;
                    " onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" align="center">Tidak ada data user</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
