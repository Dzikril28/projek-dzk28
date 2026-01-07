@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')

<h2 align="center">Data Barang</h2>

<div style="margin-bottom: 15px;">
    <a href="{{ route('barang.create') }}">Tambah</a>
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Kode Inventaris</th>
            <th>Kategori ID</th>
            <th>Ruangan ID</th>
            <th>Tahun Pengadaan</th>
            <th>Sumber Dana</th>
            <th>Kondisi</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($items as $item)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td align="center">{{ $item->nama_barang }}</td>
            <td align="center">{{ $item->kode_inventaris }}</td>
            <td align="center">{{ $item->kategori_id }}</td>
            <td align="center">{{ $item->ruangan_id }}</td>
            <td align="center">{{ $item->tahun_pengadaan }}</td>
            <td align="center">{{ $item->sumber_dana }}</td>
            <td align="center">{{ $item->kondisi }}</td>
            <td align="center">
                <a href="{{ route('barang.edit', $item->id) }}">Edit</a>

                <form action="{{ route('barang.destroy', $item->id) }}"
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