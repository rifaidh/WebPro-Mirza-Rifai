<?php
include '../config.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Transaksi - CleanWave</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { overflow-x: hidden; }
.sidebar { width: 240px; height: 100vh; position: fixed; left: 0; top: 0; background: #0d6efd; color: #fff; padding-top: 1rem; }
.sidebar a { color: #fff; text-decoration: none; padding: 12px 20px; display: block; font-weight: 500; }
.sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.2); }
.content { margin-left: 240px; padding: 25px; }
@media (max-width: 768px) { .sidebar { position: relative; width: 100%; height: auto; } .content { margin-left: 0; } }
.status-badge {
    cursor: pointer; /* ubah kursor jadi pointer */
}
</style>
</head>
<body class="bg-light">

<div class="sidebar">
    <h4 class="text-center fw-bold mb-4">LaundryCraft</h4>
    <a href="index.php">Dashboard</a>
    <a href="pelanggan.php">Pelanggan</a>
    <a href="packages.php">Paket Laundry</a>
    <a class="active" href="#">Transaksi</a>
</div>

<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-secondary">Transaksi</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#transaksiModal">
            + Tambah Transaksi
        </button>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">Daftar Pesanan</h5>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">No.</th>
                                    <th>Pelanggan</th>
                                    <th>Layanan</th>
                                    <th>Berat (KG)</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $sql = "SELECT t.id_transaksi, p.nama AS pelanggan, l.nama_layanan, t.berat, t.total_harga, t.status, t.tanggal_masuk, t.tanggal_selesai
                                        FROM transaksi t
                                        JOIN pelanggan p ON t.id_pelanggan=p.id_pelanggan
                                        JOIN layanan l ON t.id_layanan=l.id_layanan
                                        ORDER BY t.id_transaksi DESC";
                                $result = $conn->query($sql);
                                if($result->num_rows == 0){
                                    echo '<tr><td colspan="9" class="text-center text-muted py-3">Belum ada transaksi.</td></tr>';
                                } else {
                                    $no = 1;
                                    while($row = $result->fetch_assoc()):
                                     $badgeClass = $row['status'] == 'Proses' ? 'bg-warning text-dark' : 'bg-success text-white';
                                ?>

                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['pelanggan']) ?></td>
                                    <td><?= htmlspecialchars($row['nama_layanan']) ?></td>
                                    <td><?= $row['berat'] ?></td>
                                    <td><?= $row['tanggal_masuk'] ?></td>
                                    <td><?= $row['tanggal_selesai'] ?></td>
                                    <td>Rp <?= number_format($row['total_harga'],0,',','.') ?></td>
                                    <td>
                                        <span class="badge <?= $badgeClass ?> status-badge" data-id="<?= $row['id_transaksi'] ?>" onclick="toggleStatus(this)">
                                            <?= $row['status'] ?>
                                        </span>
                                    </td>
                                </tr>
                                 <?php endwhile;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Transaksi -->
<div class="modal fade" id="transaksiModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../controller/tambah_transaksi.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Pelanggan</label>
                        <select class="form-select" name="id_pelanggan" required>
                            <option value="">-- Pilih Pelanggan --</option>
                            <?php
                            $pelanggan = $conn->query("SELECT * FROM pelanggan ORDER BY nama ASC");
                            while($p = $pelanggan->fetch_assoc()):
                            ?>
                            <option value="<?= $p['id_pelanggan'] ?>"><?= htmlspecialchars($p['nama']) ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Layanan</label>
                        <select class="form-select" name="id_layanan" required>
                            <option value="">-- Pilih Layanan --</option>
                            <?php
                            $layanan = $conn->query("SELECT * FROM layanan ORDER BY nama_layanan ASC");
                            while($l = $layanan->fetch_assoc()):
                            ?>
                            <option value="<?= $l['id_layanan'] ?>"><?= htmlspecialchars($l['nama_layanan']) ?> (Rp <?= number_format($l['harga_per_kg'],0,',','.') ?>/KG)</option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Berat (KG)</label>
                        <input type="number" step="0.01" class="form-control" name="berat" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="date" class="form-control" name="tanggal_masuk" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control" name="tanggal_selesai" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status" required>
                            <option value="Proses">Proses</option>
                            <option value="Selesai">Selesai</option>
                        </select>
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
<script>
// AJAX toggle status
function toggleStatus(el){
    const id = el.getAttribute('data-id');
    const current = el.innerText.trim();
    const newStatus = current === 'Proses' ? 'Selesai' : 'Proses';

    fetch('../controller/status.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id_transaksi=' + id + '&status=' + newStatus
    })
    .then(res => res.text())
    .then(data => {
        el.innerText = newStatus;
        el.classList.toggle('bg-warning');
        el.classList.toggle('text-dark');
        el.classList.toggle('bg-success');
    });
}
</script>
</body>
</html>
