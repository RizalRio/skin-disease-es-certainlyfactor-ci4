<?= $this->extend('core') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Rules</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addRules">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="rulesTable" class="display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Diseases</th>
                        <th>Symptom</th>
                        <th>CF Value</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addRules" tabindex="-1" role="dialog" aria-labelledby="addRulesId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Rules</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= current_url() ?>/create" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="selectDisease">Pilih Penyakit:</label>
                        <select name="selectDisease" id="selectDisease" class="form-select2 selectDiseases" style="width: 100%;"></select>
                    </div>
                    <div class="form-group">
                        <label for="selectSymptoms">Pilih Gejala:</label>
                        <select name="selectSymptom" id="selectSymptom" class="form-select2 selectSymptoms" style="width: 100%;"></select>
                    </div>
                    <div class="form-group">
                        <label for="inputCF">CF Value</label>
                        <input type="text" name="inputCF" id="inputCF" class="form-control" placeholder="Ex. 0.5" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editDiseases" tabindex="-1" role="dialog" aria-labelledby="editDiseasesId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Penyakit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= current_url() ?>/edit" method="post">
                <input type="text" name="id" id="editId" value="" hidden>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="selectDisease">Pilih Penyakit:</label>
                        <select name="selectEditDisease" id="selectEditDiseases" class="form-select2 selectDiseases" style="width: 100%;"></select>
                    </div>
                    <div class="form-group">
                        <label for="selectSymptoms">Pilih Gejala:</label>
                        <select name="selectEditSymptom" id="selectEditSymptoms" class="form-select2 selectSymptoms" style="width: 100%;"></select>
                    </div>
                    <div class="form-group">
                        <label for="inputCF">CF Value</label>
                        <input type="text" name="inputEditCF" id="inputEditCF" class="form-control" placeholder="Ex. 0.5" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteDiseases" tabindex="-1" role="dialog" aria-labelledby="deleteDiseasesId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Penyakit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= current_url() ?>/delete" method="post">
                <div class="modal-body">
                    <input type="text" name="idDelete" id="idDelete" value="" hidden>
                    <p>Apakah anda ingin menghapus data ini ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        $('#rulesTable').DataTable({
            serverSide: true,
            processing: true,
            ajax: '<?= base_url('rules/getData') ?>',
            columns: [{
                    data: 'id',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'disease',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'symptom',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'cf_value',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'actions',
                    orderable: false,
                    searchable: false
                }
            ],
            initComplete: function(settings, json) {
                console.log('Configuration applied: ', settings);
            }
        });
    });

    $('.selectDiseases').select2({
        placeholder: "Pilih Penyakit",
        ajax: {
            url: '<?= base_url('diseases/getDiseases') ?>',
            dataType: 'json',
            processResults: function(data) {
                return {
                    results: data
                };
            }
        }
    });

    $('.selectSymptoms').select2({
        placeholder: "Pilih Gejala",
        ajax: {
            url: '<?= base_url('symptoms/getSymptoms') ?>',
            dataType: 'json',
            processResults: function(data) {
                return {
                    results: data
                };
            }
        }
    });

    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();

        let dataId = $(this).data('id');

        console.log('Tombol hapus diklik! ID:', dataId);

        $('#idDelete').val(dataId);
    });

    $(document).on('click', '.btn-edit', function(e) {
        e.preventDefault();

        let dataId = $(this).data('id');

        $.ajax({
            url: '<?= base_url('rules/edit') ?>',
            type: 'GET',
            data: {
                id: dataId
            },
            success: function(response) {
                $('#editId').val(dataId);

                var newOptionDisease = new Option(response.receivedData.disease, response.receivedData.disease_id, true, true);
                $('#selectEditDiseases').append(newOptionDisease).trigger('change');

                var newOptionSymptom = new Option(response.receivedData.symptom, response.receivedData.symptom_id, true, true);
                $('#selectEditSymptoms').append(newOptionSymptom).trigger('change');

                $('#inputEditCF').val(response.receivedData.cf_value);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
</script>
<?= $this->endSection() ?>