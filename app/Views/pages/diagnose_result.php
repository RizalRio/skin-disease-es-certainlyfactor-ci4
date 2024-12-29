<?= $this->extend('core') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Hasil Analisis</h3>
        </div>
        <div class="card-body">
            <?php if (!empty($diagnoses)): ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Penyakit</th>
                            <th>Deskripsi</th>
                            <th>Nilai CF (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($diagnoses as $index => $diagnosis): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $diagnosis['name'] ?></td>
                                <td><?= $diagnosis['description'] ?></td>
                                <td><?= round($diagnosis['cf_value'] * 100, 2) ?>%</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-warning" role="alert">
                    Tidak ada penyakit yang terdeteksi berdasarkan gejala yang dipilih.
                </div>
            <?php endif; ?>
        </div>
        <div class="card-footer">
            <a href="/diagnose" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>