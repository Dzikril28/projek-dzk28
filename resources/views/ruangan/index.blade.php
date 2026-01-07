@extends('layouts.app')

@section('title', 'Data Ruangan')

@section('content')

<h2 align="center">Data Ruangan</h2>

<div style="margin-bottom: 15px;">
    <a href="{{ route('ruangan.create') }}">Tambah</a>
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Ruangan</th>
            <th>Kode Ruangan</th>
            <th>Bangunan ID</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($items as $item)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td align="center">{{ $item->nama_ruangan }}</td>
            <td align="center">{{ $item->kode_ruangan }}</td>
            <td align="center">{{ $item->bangunan_id }}</td>
            <td align="center">
                <a href="{{ route('ruangan.edit', $item->id) }}">Edit</a>

                <form action="{{ route('ruangan.destroy', $item->id) }}"
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