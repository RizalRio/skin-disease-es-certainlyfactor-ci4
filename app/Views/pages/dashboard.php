<?= $this->extend('core') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?= $data['totalDisease'] ?></h3>

                    <p>Penyakit</p>
                </div>
                <div class="icon">
                    <i class="fas fa-disease"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?= $data['totalSymptom'] ?></h3>

                    <p>Gejala</p>
                </div>
                <div class="icon">
                    <i class="fas fa-star-of-life"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3><?= $data['totalRules'] ?></h3>

                    <p>Rules</p>
                </div>
                <div class="icon">
                    <i class="fas fa-balance-scale"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>