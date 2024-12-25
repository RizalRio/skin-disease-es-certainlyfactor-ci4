<?= $this->extend('core') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Data Penyakit</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addDiseases">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="diseasesTable" class="display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Suggestion</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addDiseases" tabindex="-1" role="dialog" aria-labelledby="addDiseasesId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Penyakit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= current_url() ?>/create" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="code">Kode</label>
                        <input type="text" name="code" id="code" class="form-control" placeholder="Ex. GE1" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Ex. Eksim" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="summernote" name="description" id="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="suggestion">Saran Penanganan</label>
                        <textarea class="summernote" name="suggestion" id="suggestion"></textarea>
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
                        <label for="code">Kode</label>
                        <input type="text" name="code" id="editCode" class="form-control" placeholder="Ex. GE1" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="editName" class="form-control" placeholder="Ex. Eksim" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="summernote" name="description" id="editDescription"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="suggestion">Saran Penanganan</label>
                        <textarea class="summernote" name="suggestion" id="editSuggestion"></textarea>
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
        $('#diseasesTable').DataTable({
            serverSide: true,
            processing: true,
            ajax: '<?= base_url('diseases/getData') ?>',
            columns: [{
                    data: 'id',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'code',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'name',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'description',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'suggestion',
                    orderable: true,
                    searchable: false
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
            url: '<?= base_url('diseases/edit') ?>',
            type: 'GET',
            data: {
                id: dataId
            },
            success: function(response) {
                $('#editId').val(dataId);
                $('#editCode').val(response.receivedData.code);
                $('#editName').val(response.receivedData.name);
                $('#editDescription').summernote("code", response.receivedData.description);
                $('#editSuggestion').summernote("code", response.receivedData.suggestion);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
</script>
<?= $this->endSection() ?>