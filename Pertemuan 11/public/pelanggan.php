<?php
include '../config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelanggan - CleanWave Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { overflow-x: hidden; }
        .sidebar { width: 240px; height: 100vh; position: fixed; left: 0; top: 0; background: #0d6efd; color: #fff; padding-top: 1rem; }
        .sidebar a { color: #fff; text-decoration: none; padding: 12px 20px; display: block; font-weight: 500; }
        .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.2); }
        .content { margin-left: 240px; padding: 25px; }
        @media (max-width: 768px) { .sidebar { position: relative; width: 100%; height: auto; } .content { margin-left: 0; } }
    </style>
</head>
<body class="bg-light">

<div class="sidebar">
    <h4 class="text-center fw-bold mb-4">LaundryCraft</h4>
    <a href="index.php">Dashboard</a>
    <a class="active" href="pelanggan.php">Pelanggan</a>
    <a href="packages.php">Paket Laundry</a>
    <a href="transaksi.php">Transaksi</a>
</div>

<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-secondary">Pelanggan</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pelangganModal">
            + Tambah Pelanggan
        </button>
    </div>

    <!-- Tabel Pelanggan -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">Daftar Pelanggan</h5>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">No</th>
                                    <th>Naman</th>
                                    <th>Alamat</th>
                                    <th>No. Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $result = $conn->query("SELECT * FROM pelanggan ORDER BY id_pelanggan ASC");
                                $no = 1;
                                while($row = $result->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td class="fw-bold"><?= htmlspecialchars($row['nama']) ?></td>
                                    <td><?= htmlspecialchars($row['alamat']) ?></td>
                                    <td><?= htmlspecialchars($row['no_hp']) ?></td>
                                    <td>
                                        <a href="edit_pelanggan.php?id=<?= $row['id_pelanggan'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="../controller/hapus_pelanggan.php?id=<?= $row['id_pelanggan'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus pelanggan ini?')">Hapus</a>
                                    </td>
                                </tr>
                                 <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Pelanggan -->
<div class="modal fade" id="pelangganModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../controller/tambah_pelanggan.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" class="form-control" name="telp" required>
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