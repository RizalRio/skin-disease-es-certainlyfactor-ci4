<?= $this->extend('core') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <form action="<?= base_url('diagnose/diagnose') ?>" method="post">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Diagnosis</h3>
                <div class="card-tools">
                    <button type="submit" class="btn btn-primary">Diagnosa</button>
                </div>
            </div>
            <div class="card-body">
                <?= csrf_field() ?>

                <?php foreach ($symptoms as $symptom): ?>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="symptoms[<?= $symptom['id'] ?>]" value="1">
                            <?= $symptom['description'] ?> :
                        </label>
                        <select name="values[<?= $symptom['id'] ?>]" class="form-control form-control-sm" style="width: 200px; display: inline-block;">
                            <option value="1.0">Sangat Yakin</option>
                            <option value="0.8">Yakin</option>
                            <option value="0.6">Cukup Yakin</option>
                            <option value="0.4">Kurang Yakin</option>
                            <option value="0.2">Tidak Tahu</option>
                            <option value="0">Tidak Yakin</option>
                        </select>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>