@extends('layouts.app')

@section('title', 'Data Bangunan')

@section('content')

<h2 align="center">Data Bangunan</h2>

<div style="margin-bottom: 15px;">
    <a href="{{ route('bangunan.create') }}">Tambah</a>
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Bangunan</th>
            <th>Kode Bangunan</th>
            <th>Tanah ID</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($items as $item)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td align="center">{{ $item->nama_bangunan }}</td>
            <td align="center">{{ $item->kode_bangunan }}</td>
            <td align="center">{{ $item->tanah_id }}</td>
            <td align="center">
                <a href="{{ route('bangunan.edit', $item->id) }}">Edit</a>

                <form action="{{ route('bangunan.destroy', $item->id) }}"
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