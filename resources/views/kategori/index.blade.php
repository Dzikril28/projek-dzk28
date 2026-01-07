@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')

<h2 align="center">Data Kategori</h2>

<div style="margin-bottom: 15px;">
    <a href="{{ route('kategori.create') }}">Tambah</a>
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($items as $item)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td align="center">{{ $item->nama_kategori }}</td>
            <td align="center">
                <a href="{{ route('kategori.edit', $item->id) }}">Edit</a>

                <form action="{{ route('kategori.destroy', $item->id) }}"
                      method="POST"
                      style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection