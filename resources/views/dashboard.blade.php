@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@push('styles')
    {{-- Load dashboard-specific CSS from Vite (fallback via layout asset exists) --}}
    @vite(['resources/css/dashboard.css'])
    <style>
        .welcome-card {
            background: linear-gradient(135deg, #157347 0%, #0f5a37 100%);
            color: white;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .welcome-card h4 {
            color: white;
            margin-bottom: 8px;
        }
        .welcome-card p {
            color: rgba(255,255,255,0.9);
            margin: 0;
        }
        .stat-card {
            background: white;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        }
        .stat-card h5 {
            color: #666;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .stat-card h2 {
            color: #157347;
            font-size: 32px;
            font-weight: 700;
            margin: 0;
        }
        .activity-card {
            background: white;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border-radius: 8px;
        }
        .activity-card .card-header {
            background: #f9faf8;
            border: none;
            border-bottom: 2px solid #e0e0e0;
            padding: 15px 20px;
        }
        .activity-card .card-header h5 {
            color: #157347;
            margin: 0;
            font-weight: 600;
        }
        .activity-table {
            margin: 0;
        }
        .activity-table thead th {
            background: #f9faf8;
            color: #157347;
            font-weight: 600;
            border: none;
            padding: 12px;
        }
        .activity-table tbody tr {
            border-bottom: 1px solid #f0f0f0;
        }
        .activity-table tbody tr:hover {
            background: #f9faf8;
        }
        .activity-table tbody td {
            padding: 12px;
            color: #333;
        }
    </style>
@endpush


    <div class="row">

        <!-- Welcome Section -->
        <div class="col-12 mb-4 mt-2">
            <div class="card welcome-card" style="padding: 25px;">
                <h4>Selamat Datang, {{ Auth::user()->name }}</h4>
                <p>Sistem Informasi Manajemen Aset</p>
            </div>
        </div>

<div class="col-md-3 mb-4">
    <div class="stat-card">
        <h5>Total Users</h5>
        <h2>{{ $totalUsers ?? 0 }}</h2>
    </div>
</div>

<div class="col-md-3 mb-4">
    <div class="stat-card">
        <h5>Total Tanah</h5>
        <h2>{{ $totalTanah ?? 0 }}</h2>
    </div>
</div>

<div class="col-md-3 mb-4">
    <div class="stat-card">
        <h5>Total Bangunan</h5>
        <h2>{{ $totalBangunan ?? 0 }}</h2>
    </div>
</div>

<div class="col-md-3 mb-4">
    <div class="stat-card">
        <h5>Total Ruangan</h5>
        <h2>{{ $totalRuangan ?? 0 }}</h2>
    </div>
</div>

<div class="col-md-3 mb-4">
    <div class="stat-card">
        <h5>Total Kategori</h5>
        <h2>{{ $totalKategori ?? 0 }}</h2>
    </div>
</div>

<div class="col-md-3 mb-4">
    <div class="stat-card">
        <h5>Total Barang</h5>
        <h2>{{ $totalBarang ?? 0 }}</h2>
    </div>
        <!-- Users Data -->
        <div class="col-12 mb-4">
            <div class="card activity-card">
                <div class="card-header">
                    <h5>Data Users</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table activity-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Terdaftar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users ?? [] as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td><span style="background: #198754; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px;">{{ $user->role }}</span></td>
                                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center; color: #999; padding: 20px;">Tidak ada data users</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tanah Data -->
        <div class="col-12 mb-4">
            <div class="card activity-card">
                <div class="card-header">
                    <h5>Data Tanah</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table activity-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Tanah</th>
                                    <th>Kode</th>
                                    <th>Luas</th>
                                    <th>Ditambah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tanah ?? [] as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_tanah ?? '-' }}</td>
                                        <td>{{ $item->kode_tanah ?? '-' }}</td>
                                        <td>{{ $item->luas ?? '-' }} m²</td>
                                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center; color: #999; padding: 20px;">Tidak ada data tanah</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bangunan Data -->
        <div class="col-12 mb-4">
            <div class="card activity-card">
                <div class="card-header">
                    <h5>Data Bangunan</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table activity-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Bangunan</th>
                                    <th>Kode</th>
                                    <th>Tanah</th>
                                    <th>Ditambah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bangunan ?? [] as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_bangunan ?? '-' }}</td>
                                        <td>{{ $item->kode_bangunan ?? '-' }}</td>
                                        <td>{{ $item->tanah->nama_tanah ?? '-' }}</td>
                                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center; color: #999; padding: 20px;">Tidak ada data bangunan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ruangan Data -->
        <div class="col-12 mb-4">
            <div class="card activity-card">
                <div class="card-header">
                    <h5>Data Ruangan</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table activity-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Ruangan</th>
                                    <th>Kode</th>
                                    <th>Bangunan</th>
                                    <th>Ditambah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($ruangan ?? [] as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_ruangan ?? '-' }}</td>
                                        <td>{{ $item->kode_ruangan ?? '-' }}</td>
                                        <td>{{ $item->bangunan->nama_bangunan ?? '-' }}</td>
                                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center; color: #999; padding: 20px;">Tidak ada data ruangan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kategori Data -->
        <div class="col-12 mb-4">
            <div class="card activity-card">
                <div class="card-header">
                    <h5>Data Kategori</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table activity-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Jumlah Barang</th>
                                    <th>Ditambah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kategori ?? [] as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_kategori ?? '-' }}</td>
                                        <td><span style="background: #157347; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px;">{{ $item->barang->count() ?? 0 }}</span></td>
                                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" style="text-align: center; color: #999; padding: 20px;">Tidak ada data kategori</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Barang Data -->
        <div class="col-12 mb-4">
            <div class="card activity-card">
                <div class="card-header">
                    <h5>Data Barang</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table activity-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Kode Inventaris</th>
                                    <th>Kategori</th>
                                    <th>Ruangan</th>
                                    <th>Kondisi</th>
                                    <th>Ditambah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($barang ?? [] as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_barang ?? '-' }}</td>
                                        <td>{{ $item->kode_inventaris ?? '-' }}</td>
                                        <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                                        <td>{{ $item->ruangan->nama_ruangan ?? '-' }}</td>
                                        <td>
                                            @if($item->kondisi == 'Baik')
                                                <span style="background: #198754; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px;">{{ $item->kondisi }}</span>
                                            @elseif($item->kondisi == 'Rusak Berat')
                                                <span style="background: #dc3545; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px;">{{ $item->kondisi }}</span>
                                            @else
                                                <span style="background: #ffc107; color: #333; padding: 4px 8px; border-radius: 4px; font-size: 12px;">{{ $item->kondisi }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" style="text-align: center; color: #999; padding: 20px;">Tidak ada data barang</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        
            <div class="card activity-card">
                <div class="card-header">
                    <h5>Aktivitas Terakhir</h5>
                </div>
                <div class="card-body">

                    @if (isset($recentActivities) && count($recentActivities) > 0)
                        <div class="table-responsive">
                            <table class="table activity-table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Aktivitas</th>
                                        <th>User</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentActivities as $activity)
                                        <tr>
                                            <td>{{ $activity->created_at->format('d/m/Y H:i') }}</td>
                                            <td>{{ $activity->description }}</td>

                                            <!-- Tampilkan nama user + role -->
                                            <td>
                                                {{ $activity->user->name }}
                                                <span style="color: #999; font-size: 13px;">
                                                    ({{ $activity->user->role ?? 'Tidak ada role' }})
                                                </span>
                                            </td>

                                            <td>{{ $activity->status }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" style="text-align: center; color: #999; padding: 20px;">
                                                Tidak ada aktivitas terbaru
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p style="text-align: center; color: #999; padding: 20px; margin: 0;">Tidak ada aktivitas terbaru</p>
                    @endif

                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        // Custom JS
    </script>
@endpush