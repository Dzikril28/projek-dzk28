@extends('layouts.app')

@section('title', 'Data Tanah')

@section('content')

<h2 align="center">Data Tanah</h2>

<div style="margin-bottom: 15px;">
    <a href="{{ route('tanah.create') }}">Tambah</a>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Tanah</th>
            <th>Kode Tanah</th>
            <th>Luas</th>
            <th>No Sertifikat</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($items as $item)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td align="center">{{ $item->nama_tanah }}</td>
            <td align="center">{{ $item->kode_tanah }}</td>
            <td align="center">{{ $item->luas }}</td>
            <td align="center">{{ $item->no_sertifikat }}</td>
            <td align="center">
                <a href="{{ route('tanah.edit', $item->id) }}">Edit</a>

                <form action="{{ route('tanah.destroy', $item->id) }}"
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