<?php
include '../config.php';

// Total Pelanggan
$pelangganResult = $conn->query("SELECT COUNT(*) AS total FROM pelanggan");
$pelanggan = $pelangganResult->fetch_assoc()['total'];

// Total Layanan
$layananResult = $conn->query("SELECT COUNT(*) AS total FROM layanan");
$layanan = $layananResult->fetch_assoc()['total'];

// Pesanan Aktif (status = 'Proses')
$aktifResult = $conn->query("SELECT COUNT(*) AS total FROM transaksi WHERE status='Proses'");
$aktif = $aktifResult->fetch_assoc()['total'];

// Total Pendapatan (semua transaksi)
$pendapatanResult = $conn->query("SELECT SUM(total_harga) AS total FROM transaksi");
$pendapatan = $pendapatanResult->fetch_assoc()['total'] ?? 0;

// Transaksi terbaru (5 terakhir)
$transaksiResult = $conn->query("
    SELECT t.tanggal_masuk, p.nama AS pelanggan, l.nama_layanan, t.total_harga, t.status
    FROM transaksi t
    JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
    JOIN layanan l ON t.id_layanan = l.id_layanan
    ORDER BY t.tanggal_masuk DESC
    LIMIT 5
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CleanWave Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #0d6efd;
            color: white;
            padding-top: 1rem;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            font-weight: 500;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Content shifts right */
        .content {
            margin-left: 240px;
            padding: 20px;
        }

        /* Cards */
        .card-icon { font-size: 2rem; opacity: 0.8; }
        .bg-gradient-primary { background: linear-gradient(45deg, #0d6efd, #0a58ca); }
        .bg-gradient-success { background: linear-gradient(45deg, #198754, #146c43); }
        .bg-gradient-warning { background: linear-gradient(45deg, #ffc107, #ffca2c); }
        .bg-gradient-info { background: linear-gradient(45deg, #0dcaf0, #3dd5f3); }

        /* Mobile: sidebar collapses */
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body class="bg-light">

    <!-- Sidebar Left -->
    <div class="sidebar">
        <h4 class="text-center fw-bold mb-4">LaundryCraft</h4>
        <a href="#" class="active">Dashboard</a>
        <a href="pelanggan.php">Pelanggan</a>
        <a href="packages.php">Paket Laundry</a>
        <a href="transaksi.php">Transaksi</a>
    </div>

    <!-- Main Content -->
    <div class="content">

        <h2 class="fw-bold text-secondary">Dashboard Overview</h2>
        <p class="text-muted">Selamat datang di sistem manajemen laundry.</p>

        <div class="row g-4">

            <div class="col-md-3">
                <div class="card text-white bg-gradient-info h-100 border-0 shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Total Pelanggan</h6>
                            <h2 class="display-6 fw-bold my-2"><?= $pelanggan?></h2>
                            <small>Orang</small>
                        </div>
                        <div class="card-icon">👥</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-gradient-success h-100 border-0 shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Paket Layanan</h6>
                            <h2 class="display-6 fw-bold my-2"><?= $layanan?></h2>
                            <small>Jenis</small>
                        </div>
                        <div class="card-icon">📦</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-dark bg-gradient-warning h-100 border-0 shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Pesanan Aktif</h6>
                            <h2 class="display-6 fw-bold my-2"><?= $aktif?></h2>
                            <small>Sedang diproses</small>
                        </div>
                        <div class="card-icon">⏳</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-gradient-primary h-100 border-0 shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Total Pendapatan</h6>
                            <h3 class="fw-bold my-2"><?= number_format($pendapatan,0,',','.') ?></h3>
                            <small>Semua Transaksi</small>
                        </div>
                        <div class="card-icon">💰</div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Recent Transactions -->
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="fw-bold mb-0">Transaksi Terbaru</h5>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Tanggal</th>
                                        <th>Pelanggan</th>
                                        <th>Paket</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if($transaksiResult->num_rows == 0){
                                        echo '<tr><td colspan="5" class="text-center text-muted py-3">Belum ada transaksi.</td></tr>';
                                    } else {
                                        while($row = $transaksiResult->fetch_assoc()):
                                            $badgeClass = match($row['status']){
                                                'Proses' => 'bg-info text-dark',
                                                'Selesai' => 'bg-success text-white',
                                                'Baru' => 'bg-primary text-white',
                                                'Diambil' => 'bg-dark text-white',
                                                default => 'bg-secondary text-white'
                                            };
                                    ?>
                                    <tr>
                                        <td class="ps-4"><?= $row['tanggal_masuk'] ?></td>
                                        <td class="fw-bold"><?= htmlspecialchars($row['pelanggan']) ?></td>
                                        <td><?= htmlspecialchars($row['nama_layanan']) ?></td>
                                        <td>Rp <?= number_format($row['total_harga'],0,',','.') ?></td>
                                        <td><span class="badge <?= $badgeClass ?>"><?= $row['status'] ?></span></td>
                                    </tr>
                                    <?php endwhile; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
