<?php
include 'koneksi.php';
$stmt = $pdo->query("SELECT * FROM mesin ORDER BY id DESC");
$data_mesin = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modul Mesin & Peralatan - Sistem Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light text-dark py-4">

    <div class="container" style="max-width: 1000px;">
        
        <header class="p-4 mb-4 bg-primary text-white rounded-3 shadow-sm text-center">
            <h1 class="h3 fw-bold mb-1">Sistem Operasional Laundry</h1>
            <p class="mb-0 text-white-50">Modul Mesin & Peralatan (Individu B)</p>
        </header>

        <?php include 'form.php'; ?>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h2 class="h5 text-primary pb-2 border-bottom mb-3">Daftar Inventaris Mesin</h2>
                
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 50px;">No</th>
                                <th>Kode / Nama</th>
                                <th>Jenis</th>
                                <th>Merek</th>
                                <th>Kapasitas</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data_mesin)): ?>
                                <?php $no = 1; foreach ($data_mesin as $row): ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="fw-semibold"><?= htmlspecialchars($row['kode']) ?></td>
                                        <td><?= htmlspecialchars($row['jenis']) ?></td>
                                        <td><?= htmlspecialchars($row['merek']) ?></td>
                                        <td><?= htmlspecialchars($row['kapasitas']) ?> Kg</td>
                                        <td class="text-center">
                                            <?php 
                                                if($row['status'] == 'Ready') {
                                                    echo '<span class="badge bg-success">Ready</span>';
                                                } elseif($row['status'] == 'Sedang Digunakan') {
                                                    echo '<span class="badge bg-warning text-dark">Sedang Digunakan</span>';
                                                } else {
                                                    echo '<span class="badge bg-danger">Maintenance</span>';
                                                }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="index.php?edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm fw-bold px-2 py-1">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a href="proses.php?hapus=<?= $row['id'] ?>" class="btn btn-danger btn-sm fw-bold px-2 py-1" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-3">Belum ada data inventaris mesin.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>