<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Pakar</title>

    <?= view('partials/heads') ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php
        $alertTypes = [
            'success' => 'alert-success',
            'danger'  => 'alert-danger',
            'info'    => 'alert-info',
        ];

        foreach ($alertTypes as $key => $class) {
            if ($message = session()->getFlashData($key)) {
        ?>
                <div class="alert <?= $class ?> alert-dismissible fade show custom-alert" role="alert">
                    <?= $message ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        <?php
            }
        }
        ?>

        <?php
        if (session()->getFlashData('info')) {
        ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <?= session()->getFlashData('info') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php
        }
        ?>

        <?= view('partials/navbar') ?>

        <?= view('partials/sidebar') ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?= $title ?></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <?= $this->renderSection('content') ?>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?= view('partials/control-sidebar') ?>

        <?= view('partials/footer') ?>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <?= view('partials/scripts') ?>
    <?= $this->renderSection('script') ?>
</body>

</html>