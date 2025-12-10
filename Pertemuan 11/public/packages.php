<?php
include '../config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Paket Laundry - CleanWave</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { overflow-x: hidden; }
    .sidebar { width: 240px; height: 100vh; position: fixed; left: 0; top: 0; background: #0d6efd; color: #fff; padding-top: 1rem; }
    .sidebar a { color: #fff; text-decoration: none; padding: 12px 20px; display: block; font-weight: 500; }
    .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.2); }
    .content { margin-left: 240px; padding: 25px; }
    .card-layanan { cursor: pointer; transition: transform 0.2s; }
    .card-layanan:hover { transform: scale(1.03); }
    @media (max-width: 768px) { .sidebar { position: relative; width: 100%; height: auto; } .content { margin-left: 0; } }
</style>
</head>
<body class="bg-light">

<div class="sidebar">
        <h4 class="text-center fw-bold mb-4">LaundryCraft</h4>
        <a href="index.php">Dashboard</a>
        <a href="pelanggan.php">Pelanggan</a>
        <a href="#" class="active">Paket Laundry</a>
        <a href="transaksi.php">Transaksi</a>
    </div>

<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-secondary">Paket Laundry</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#packageModal">
            + Tambah Layanan
        </button>
    </div>

    <div class="row g-4">
        <?php
        $result = $conn->query("SELECT * FROM layanan ORDER BY id_layanan DESC");
        if($result->num_rows == 0){
            echo '<div class="col-12 text-center text-muted py-5">Belum ada layanan.</div>';
        } else {
            while($row = $result->fetch_assoc()):
        ?>
        <div class="col-md-4">
            <div class="card shadow-sm card-layanan border-0 h-100">
                <div class="card-body">
                    <h5 class="fw-bold"><?= htmlspecialchars($row['nama_layanan']) ?></h5>
                    <h4 class="text-primary mt-2 mb-0">Rp <?= number_format($row['harga_per_kg'],0,',','.') ?> <small class="text-muted">/ KG</small></h4>
                </div>
                <div class="card-footer bg-white border-0 pb-3">
                    <div class="d-flex gap-2">
                        <a href="../controller/hapus_layanan.php?id=<?= $row['id_layanan'] ?>" class="btn btn-sm btn-outline-danger w-100" onclick="return confirm('Hapus layanan ini?')">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
            endwhile;
        }
        ?>
    </div>
</div>

<!-- Modal Tambah Layanan -->
<div class="modal fade" id="packageModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../controller/tambah_layanan.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Layanan</label>
                        <input type="text" class="form-control" name="nama_layanan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga per KG</label>
                        <input type="number" class="form-control" name="harga_per_kg" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
