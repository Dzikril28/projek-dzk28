@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@push('styles')
<style>
    /* ===== RESET & BASE ===== */
    .dashboard-container {
        background: linear-gradient(135deg, #f8fdf9 0%, #f0f8f2 100%);
        min-height: 100vh;
        padding: 20px 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* ===== WELCOME SECTION ===== */
    .welcome-section {
        background: linear-gradient(135deg, #157347 0%, #0f5a37 100%);
        color: white;
        border-radius: 20px;
        padding: 40px;
        margin-bottom: 40px;
        box-shadow: 0 10px 30px rgba(21, 131, 71, 0.25);
        position: relative;
        overflow: hidden;
    }

    .welcome-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    .welcome-section::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        animation: float 8s ease-in-out infinite reverse;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    .welcome-section h1 {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 15px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        position: relative;
        z-index: 2;
    }

    .welcome-section p {
        font-size: 1.2rem;
        opacity: 0.95;
        margin: 0;
        font-weight: 300;
        position: relative;
        z-index: 2;
    }

    /* ===== STATISTICS CARDS ===== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 50px;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        border: 2px solid transparent;
        border-image: linear-gradient(135deg, #157347, #0f5a37) 1;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #157347, #0f5a37, #157347);
        background-size: 200% 100%;
        animation: shimmer 3s ease-in-out infinite;
    }

    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    .stat-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 15px 35px rgba(21, 131, 71, 0.2);
    }

    .stat-card .icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #157347, #0f5a37);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: white;
        font-size: 1.8rem;
        font-weight: bold;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(21, 131, 71, 0.3);
    }

    .stat-card:hover .icon {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 6px 20px rgba(21, 131, 71, 0.4);
    }

    .stat-card h3 {
        color: #157347;
        font-size: 2.5rem;
        font-weight: 800;
        margin: 0 0 8px;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        font-family: 'Arial Black', Arial, sans-serif;
    }

    .stat-card p {
        color: #666;
        font-size: 1rem;
        font-weight: 600;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.8;
    }

    /* ===== MAIN CONTENT LAYOUT ===== */
    .dashboard-content {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
        margin-bottom: 40px;
    }

    /* ===== ACTIVITY SECTION ===== */
    .activity-section {
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        overflow: hidden;
        border: 1px solid #e8f5e8;
        height: fit-content;
    }

    .activity-header {
        background: linear-gradient(135deg, #157347, #0f5a37);
        color: white;
        padding: 25px 30px;
        margin: 0;
        font-size: 1.3rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 2px 10px rgba(21, 131, 71, 0.2);
    }

    .activity-header i {
        margin-right: 12px;
        opacity: 0.9;
    }

    .activity-header .count {
        background: rgba(255,255,255,0.2);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 500;
        backdrop-filter: blur(10px);
    }

    .activity-timeline {
        max-height: 500px;
        overflow-y: auto;
        padding: 0;
    }

    .activity-timeline::-webkit-scrollbar {
        width: 8px;
    }

    .activity-timeline::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #157347, #0f5a37);
        border-radius: 10px;
    }

    .activity-timeline::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .activity-item {
        padding: 20px 30px;
        border-bottom: 1px solid #f0f8f0;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        position: relative;
    }

    .activity-item:hover {
        background: linear-gradient(135deg, #f8fdf9, #f0f8f2);
        padding-left: 40px;
        transform: translateX(5px);
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, #157347, #0f5a37);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        margin-right: 20px;
        flex-shrink: 0;
        box-shadow: 0 3px 10px rgba(21, 131, 71, 0.2);
        transition: all 0.3s ease;
    }

    .activity-item:hover .activity-icon {
        transform: scale(1.1);
        box-shadow: 0 5px 15px rgba(21, 131, 71, 0.3);
    }

    .activity-content {
        flex: 1;
    }

    .activity-content .title {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
        font-size: 1rem;
    }

    .activity-content .meta {
        font-size: 0.85rem;
        color: #666;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .activity-time {
        font-size: 0.85rem;
        color: #999;
        flex-shrink: 0;
        font-weight: 500;
    }

    /* ===== SIDEBAR SECTIONS ===== */
    .sidebar-section {
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        margin-bottom: 30px;
        overflow: hidden;
        border: 1px solid #e8f5e8;
    }

    .data-header {
        background: linear-gradient(135deg, #157347, #0f5a37);
        color: white;
        padding: 20px 25px;
        margin: 0;
        font-size: 1.1rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .data-header i {
        margin-right: 10px;
        opacity: 0.9;
    }

    .data-header .count {
        background: rgba(255,255,255,0.2);
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 500;
        backdrop-filter: blur(10px);
    }

    /* ===== TABLES ===== */
    .data-table {
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .data-table thead th {
        background: linear-gradient(135deg, #f8fdf9, #f0f8f2);
        color: #157347;
        font-weight: 700;
        border: none;
        padding: 18px 15px;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: sticky;
        top: 0;
        z-index: 10;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .data-table tbody tr {
        border-bottom: 1px solid #f0f8f0;
        transition: all 0.2s ease;
    }

    .data-table tbody tr:hover {
        background: linear-gradient(135deg, #f8fdf9, #f0f8f2);
        transform: scale(1.01);
    }

    .data-table tbody td {
        padding: 15px;
        color: #333;
        vertical-align: middle;
        border: none;
    }

    /* ===== STATUS BADGES ===== */
    .status-badge {
        padding: 6px 12px;
        border-radius: 25px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
        text-align: center;
        min-width: 70px;
    }

    .status-success {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .status-warning {
        background: linear-gradient(135deg, #fff3cd, #ffeaa7);
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    .status-danger {
        background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .status-info {
        background: linear-gradient(135deg, #d1ecf1, #bee5eb);
        color: #0c5460;
        border: 1px solid #bee5eb;
    }

    /* ===== ACCORDION SECTIONS ===== */
    .accordion-section {
        background: white;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        margin-bottom: 25px;
        overflow: hidden;
        border: 1px solid #e8f5e8;
    }

    .accordion-button {
        background: linear-gradient(135deg, #157347, #0f5a37) !important;
        color: #fff !important;
        box-shadow: none !important;
        border: none !important;
        padding: 20px 30px !important;
        font-size: 1.1rem !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
    }

    .accordion-button:focus {
        box-shadow: none !important;
    }

    .accordion-button:not(.collapsed) {
        background: linear-gradient(135deg, #0f5a37, #157347) !important;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.1) !important;
    }

    .accordion-button::after {
        filter: brightness(0) invert(1) !important;
        margin-left: auto !important;
    }

    .accordion-body {
        padding: 0 !important;
        background: #fafdfa;
    }

    /* ===== EMPTY STATES ===== */
    .empty-state {
        text-align: center;
        color: #999;
        padding: 50px 30px;
        background: linear-gradient(135deg, #fafdfa, #f5fbf6);
        border-top: 2px dashed #e0f2e0;
    }

    .empty-state i {
        font-size: 4rem;
        color: #e8f5e8;
        margin-bottom: 20px;
        opacity: 0.7;
    }

    .empty-state p {
        font-size: 1rem;
        margin: 0;
        font-style: italic;
    }

    /* ===== RESPONSIVE DESIGN ===== */
    @media (max-width: 1200px) {
        .dashboard-content {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .welcome-section h1 {
            font-size: 2.2rem;
        }

        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
    }

    @media (max-width: 768px) {
        .welcome-section {
            padding: 30px 20px;
            margin-bottom: 30px;
        }

        .welcome-section h1 {
            font-size: 1.8rem;
        }

        .welcome-section p {
            font-size: 1rem;
        }

        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .stat-card {
            padding: 20px;
        }

        .stat-card h3 {
            font-size: 2rem;
        }

        .dashboard-content {
            grid-template-columns: 1fr;
        }

        .activity-item {
            padding: 15px 20px;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .activity-icon {
            margin-right: 0;
            margin-bottom: 10px;
        }

        .activity-time {
            align-self: flex-end;
        }
    }

    @media (max-width: 576px) {
        .dashboard-container {
            padding: 10px 0;
        }

        .welcome-section {
            border-radius: 15px;
            padding: 25px 15px;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 15px;
            margin-bottom: 30px;
        }

        .stat-card {
            padding: 20px;
            border-radius: 12px;
        }

        .activity-header,
        .data-header {
            padding: 15px 20px;
            font-size: 1rem;
        }

        .data-table thead th,
        .data-table tbody td {
            padding: 10px 8px;
            font-size: 0.8rem;
        }
    }

    /* ===== ANIMATIONS ===== */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-card,
    .activity-section,
    .sidebar-section,
    .accordion-section {
        animation: fadeInUp 0.6s ease-out;
    }

    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }
    .stat-card:nth-child(5) { animation-delay: 0.5s; }
    .stat-card:nth-child(6) { animation-delay: 0.6s; }

    /* ===== CUSTOM SCROLLBAR ===== */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #157347, #0f5a37);
        border-radius: 10px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* ===== FOCUS STATES ===== */
    .stat-card:focus,
    .accordion-button:focus,
    button:focus {
        outline: 2px solid #157347;
        outline-offset: 2px;
    }
</style>
@endpush

<div class="dashboard-container">
    <div class="container-fluid">

        <!-- Welcome Section -->
        <div class="welcome-section">
            <h1>Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
            <p>Sistem Informasi Manajemen Aset - Pantau dan kelola semua aset Anda dengan mudah</p>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="icon">👥</div>
                <h3>{{ $totalUsers ?? 0 }}</h3>
                <p>Total Users</p>
            </div>

            <div class="stat-card">
                <div class="icon">🏠</div>
                <h3>{{ $totalTanah ?? 0 }}</h3>
                <p>Total Tanah</p>
            </div>

            <div class="stat-card">
                <div class="icon">🏢</div>
                <h3>{{ $totalBangunan ?? 0 }}</h3>
                <p>Total Bangunan</p>
            </div>

            <div class="stat-card">
                <div class="icon">🚪</div>
                <h3>{{ $totalRuangan ?? 0 }}</h3>
                <p>Total Ruangan</p>
            </div>

            <div class="stat-card">
                <div class="icon">📂</div>
                <h3>{{ $totalKategori ?? 0 }}</h3>
                <p>Total Kategori</p>
            </div>

            <div class="stat-card">
                <div class="icon">📦</div>
                <h3>{{ $totalBarang ?? 0 }}</h3>
                <p>Total Barang</p>
            </div>
        </div>

        <!-- Main Content Layout -->
        <div class="dashboard-content">
            <!-- Left Column - Activities -->
            <div>
                <!-- Recent Activities -->
                <div class="activity-section">
                    <h3 class="activity-header">
                        <i class="fas fa-history"></i>
                        Aktivitas Terakhir
                        @if(isset($recentActivities))
                            <span class="count">{{ count($recentActivities) }}</span>
                        @endif
                    </h3>
                    <div class="activity-timeline">
                        @if (isset($recentActivities) && count($recentActivities) > 0)
                            @foreach ($recentActivities as $activity)
                                <div class="activity-item">
                                    <div class="activity-icon">
                                        @if(strpos($activity->description, 'ditambah') !== false)
                                            <i class="fas fa-plus"></i>
                                        @elseif(strpos($activity->description, 'diubah') !== false)
                                            <i class="fas fa-edit"></i>
                                        @elseif(strpos($activity->description, 'dihapus') !== false)
                                            <i class="fas fa-trash"></i>
                                        @else
                                            <i class="fas fa-info"></i>
                                        @endif
                                    </div>
                                    <div class="activity-content">
                                        <div class="title">{{ $activity->description }}</div>
                                        <div class="meta">
                                            {{ $activity->user->name }}
                                            @if($activity->user->role)
                                                <span class="status-badge status-info">{{ $activity->user->role }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="activity-time">
                                        {{ $activity->created_at->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <p>Belum ada aktivitas terbaru</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column - Quick Overview -->
            <div>
                <!-- Users Overview -->
                <div class="sidebar-section">
                    <h3 class="data-header">
                        <i class="fas fa-users"></i>
                        Users Terbaru
                        @if(isset($users))
                            <span class="count">{{ count($users) }}</span>
                        @endif
                    </h3>
                    <table class="table data-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users ?? [] as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td><span class="status-badge status-success">{{ $user->role }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="empty-state">
                                        <i class="fas fa-user-slash"></i>
                                        <p>Tidak ada data users</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Items Overview -->
                <div class="sidebar-section">
                    <h3 class="data-header">
                        <i class="fas fa-boxes"></i>
                        Barang Terbaru
                        @if(isset($barang))
                            <span class="count">{{ count($barang) }}</span>
                        @endif
                    </h3>
                    <table class="table data-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kondisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($barang ?? [] as $item)
                                <tr>
                                    <td>{{ Str::limit($item->nama_barang, 20) }}</td>
                                    <td>
                                        @if($item->kondisi == 'Baik')
                                            <span class="status-badge status-success">{{ $item->kondisi }}</span>
                                        @elseif($item->kondisi == 'Rusak Berat')
                                            <span class="status-badge status-danger">{{ $item->kondisi }}</span>
                                        @else
                                            <span class="status-badge status-warning">{{ $item->kondisi }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="empty-state">
                                        <i class="fas fa-box-open"></i>
                                        <p>Tidak ada data barang</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Detailed Data Sections -->
        <div class="row">
            <div class="col-12">
                <div class="accordion" id="dataAccordion">

                    <!-- Tanah Data -->
                    <div class="accordion-item accordion-section">
                        <h2 class="accordion-header">
                            <button class="accordion-button data-header collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tanahData">
                                <i class="fas fa-home"></i>
                                Data Tanah Lengkap
                                @if(isset($tanah))
                                    <span class="count">{{ count($tanah) }}</span>
                                @endif
                            </button>
                        </h2>
                        <div id="tanahData" class="accordion-collapse collapse" data-bs-parent="#dataAccordion">
                            <div class="accordion-body">
                                <table class="table data-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Tanah</th>
                                            <th>Kode</th>
                                            <th>Luas</th>
                                            <th>No Sertifikat</th>
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
                                                <td>{{ $item->no_sertifikat ?? '-' }}</td>
                                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="empty-state">
                                                    <i class="fas fa-home"></i>
                                                    <p>Tidak ada data tanah</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Bangunan Data -->
                    <div class="accordion-item accordion-section">
                        <h2 class="accordion-header">
                            <button class="accordion-button data-header collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#bangunanData">
                                <i class="fas fa-building"></i>
                                Data Bangunan Lengkap
                                @if(isset($bangunan))
                                    <span class="count">{{ count($bangunan) }}</span>
                                @endif
                            </button>
                        </h2>
                        <div id="bangunanData" class="accordion-collapse collapse" data-bs-parent="#dataAccordion">
                            <div class="accordion-body">
                                <table class="table data-table">
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
                                                <td colspan="5" class="empty-state">
                                                    <i class="fas fa-building"></i>
                                                    <p>Tidak ada data bangunan</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Ruangan Data -->
                    <div class="accordion-item accordion-section">
                        <h2 class="accordion-header">
                            <button class="accordion-button data-header collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ruanganData">
                                <i class="fas fa-door-open"></i>
                                Data Ruangan Lengkap
                                @if(isset($ruangan))
                                    <span class="count">{{ count($ruangan) }}</span>
                                @endif
                            </button>
                        </h2>
                        <div id="ruanganData" class="accordion-collapse collapse" data-bs-parent="#dataAccordion">
                            <div class="accordion-body">
                                <table class="table data-table">
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
                                                <td colspan="5" class="empty-state">
                                                    <i class="fas fa-door-open"></i>
                                                    <p>Tidak ada data ruangan</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Kategori Data -->
                    <div class="accordion-item accordion-section">
                        <h2 class="accordion-header">
                            <button class="accordion-button data-header collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kategoriData">
                                <i class="fas fa-tags"></i>
                                Data Kategori Lengkap
                                @if(isset($kategori))
                                    <span class="count">{{ count($kategori) }}</span>
                                @endif
                            </button>
                        </h2>
                        <div id="kategoriData" class="accordion-collapse collapse" data-bs-parent="#dataAccordion">
                            <div class="accordion-body">
                                <table class="table data-table">
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
                                                <td><span class="status-badge status-info">{{ $item->barang->count() ?? 0 }}</span></td>
                                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="empty-state">
                                                    <i class="fas fa-tags"></i>
                                                    <p>Tidak ada data kategori</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Barang Data -->
                    <div class="accordion-item accordion-section">
                        <h2 class="accordion-header">
                            <button class="accordion-button data-header collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#barangData">
                                <i class="fas fa-box"></i>
                                Data Barang Lengkap
                                @if(isset($barang))
                                    <span class="count">{{ count($barang) }}</span>
                                @endif
                            </button>
                        </h2>
                        <div id="barangData" class="accordion-collapse collapse" data-bs-parent="#dataAccordion">
                            <div class="accordion-body">
                                <table class="table data-table">
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
                                                        <span class="status-badge status-success">{{ $item->kondisi }}</span>
                                                    @elseif($item->kondisi == 'Rusak Berat')
                                                        <span class="status-badge status-danger">{{ $item->kondisi }}</span>
                                                    @else
                                                        <span class="status-badge status-warning">{{ $item->kondisi }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="empty-state">
                                                    <i class="fas fa-box"></i>
                                                    <p>Tidak ada data barang</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
    // Auto-refresh dashboard data every 5 minutes
    setTimeout(function() {
        if (window.location.pathname === '/dashboard') {
            location.reload();
        }
    }, 300000);

    // Add smooth scrolling for accordion
    document.querySelectorAll('.accordion-button').forEach(button => {
        button.addEventListener('click', function() {
            setTimeout(() => {
                this.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 300);
        });
    });

    // Add loading animation for statistics cards
    document.addEventListener('DOMContentLoaded', function() {
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });

    // Add click effect for statistics cards
    document.querySelectorAll('.stat-card').forEach(card => {
        card.addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
</script>
@endpush