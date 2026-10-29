<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modul Mesin & Peralatan - Sistem Laundry</title>
    <!-- Bootstrap CSS -->
    <link href="https://jsdelivr.net" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://jsdelivr.net">
</head>

<body class="bg-light text-dark py-4">

    <div class="container" style="max-width: 1000px;">

        <header class="p-4 mb-4 bg-primary text-white rounded-3 shadow-sm text-center">
            <h1 class="h3 fw-bold mb-1">Sistem Operasional Laundry</h1>
            <p class="mb-0 text-white-50">Modul Mesin & Peralatan (Individu B)</p>
        </header>

        <!-- FORM TAMBAH / EDIT MESIN -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <h2 class="h5 text-primary pb-2 border-bottom mb-3">
                    {{ $edit_data ? 'Edit Data Mesin' : 'Tambah Mesin Baru' }}
                </h2>

                <form action="{{ route('mesin.simpan') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $edit_data['id'] ?? '' }}">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama / Kode Mesin:</label>
                        <input type="text" name="kode" class="form-control" placeholder="Contoh: Mesin Cuci 01"
                            value="{{ $edit_data['kode'] ?? '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Jenis Mesin:</label>
                        <select name="jenis" class="form-select">
                            @foreach(['Mesin Cuci', 'Mesin Pengering', 'Setrika Uap'] as $j)
                                <option value="{{ $j }}" {{ (isset($edit_data) && $edit_data['jenis'] == $j) ? 'selected' : '' }}>{{ $j }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Merek Mesin:</label>
                        <input type="text" name="merek" class="form-control"
                            placeholder="Contoh: LG, Samsung, Electrolux" value="{{ $edit_data['merek'] ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Kapasitas (Kg):</label>
                        <input type="number" name="kapasitas" class="form-control" placeholder="Contoh: 10"
                            value="{{ $edit_data['kapasitas'] ?? '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Status Operasional:</label>
                        <select name="status" class="form-select">
                            @foreach([
                                    'Ready' => 'Ready (Siap)',
                                    'Sedang Digunakan' => 'Sedang Digunakan',
                                    'Maintenance' => 'Maintenance / Perbaikan'
                                ] as $key => $val)
                                <option value="{{ $key }}" {{ (isset($edit_data) && $edit_data['status'] == $key) ? 'selected' : '' }}>{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success fw-bold px-4">
                            <i class="bi bi-save me-1"></i> Simpan Mesin
                        </button>
                        @if($edit_data)
                            <a href="{{ route('mesin.index') }}" class="btn btn-secondary fw-bold px-3">Batal</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- DAFTAR INVENTARIS MESIN -->
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
                            @if (!empty($data_mesin))
                                @php $no = 1; @endphp
                                @foreach ($data_mesin as $row)
                                    @php $row = (array) $row; @endphp
                                    <tr>
                                        <td class="text-center">{{ $no++ }}</td>
                                        <td class="fw-semibold">{{ $row['kode'] }}</td>
                                        <td>{{ $row['jenis'] }}</td>
                                        <td>{{ $row['merek'] }}</td>
                                        <td>{{ $row['kapasitas'] }} Kg</td>
                                        <td class="text-center">
                                            @if($row['status'] == 'Ready')
                                                <span class="badge bg-success">Ready</span>
                                            @elseif($row['status'] == 'Sedang Digunakan')
                                                <span class="badge bg-warning text-dark">Sedang Digunakan</span>
                                            @else
                                                <span class="badge bg-danger">Maintenance</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('mesin.index', ['edit' => $row['id']]) }}"
                                                class="btn btn-warning btn-sm fw-bold px-2 py-1">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <form action="{{ route('mesin.hapus', $row['id']) }}" method="POST" class="d-inline"
                                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm fw-bold px-2 py-1">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-3">Belum ada data inventaris mesin.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <script src="https://jsdelivr.net"></script>
</body>

</html>