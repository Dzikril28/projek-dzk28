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

        <!-- Quick Stats -->
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
        <h5>Total Barang</h5>
        <h2>{{ $totalBarang ?? 0 }}</h2>
    </div>
</div>
        <!-- Recent Activity -->
        <div class="col-12">
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