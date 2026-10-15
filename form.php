<?php
$edit_data = null;
if (isset($_GET['edit'])) {
    $id_edit = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM mesin WHERE id = ?");
    $stmt->execute([$id_edit]);
    $edit_data = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-4">
        <h2 class="h5 text-primary pb-2 border-bottom mb-3">
            <?= $edit_data ? 'Edit Data Mesin' : 'Tambah Mesin Baru' ?>
        </h2>
        
        <form action="proses.php" method="POST">
            <input type="hidden" name="id" value="<?= $edit_data['id'] ?? '' ?>">

            <div class="mb-3">
                <label class="form-label fw-bold">Nama / Kode Mesin:</label>
                <input type="text" name="kode" class="form-control" placeholder="Contoh: Mesin Cuci 01" value="<?= $edit_data['kode'] ?? '' ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Jenis Mesin:</label>
                <select name="jenis" class="form-select">
                    <?php 
                    $jenis_opsi = ['Mesin Cuci', 'Mesin Pengering', 'Setrika Uap'];
                    foreach($jenis_opsi as $j) {
                        $selected = (isset($edit_data) && $edit_data['jenis'] == $j) ? 'selected' : '';
                        echo "<option value='$j' $selected>$j</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Merek Mesin:</label>
                <input type="text" name="merek" class="form-control" placeholder="Contoh: LG, Samsung, Electrolux" value="<?= $edit_data['merek'] ?? '' ?>">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Kapasitas (Kg):</label>
                <input type="number" name="kapasitas" class="form-control" placeholder="Contoh: 10" value="<?= $edit_data['kapasitas'] ?? '' ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Status Operasional:</label>
                <select name="status" class="form-select">
                    <?php 
                    $status_opsi = [
                        'Ready' => 'Ready (Siap)', 
                        'Sedang Digunakan' => 'Sedang Digunakan', 
                        'Maintenance' => 'Maintenance / Perbaikan'
                    ];
                    foreach($status_opsi as $key => $val) {
                        $selected = (isset($edit_data) && $edit_data['status'] == $key) ? 'selected' : '';
                        echo "<option value='$key' $selected>$val</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" name="simpan" class="btn btn-success fw-bold px-4">
                    <i class="bi bi-save me-1"></i> Simpan Mesin
                </button>
                <?php if($edit_data): ?>
                    <a href="index.php" class="btn btn-secondary fw-bold px-3">Batal</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>