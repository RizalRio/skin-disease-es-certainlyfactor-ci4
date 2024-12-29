<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('dashboard') ?>" class="brand-link">
        <img src="<?= base_url('plugins/adminlte') ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('plugins/adminlte') ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?= base_url('dashboard') ?>" class="d-block"><?php echo session()->get('username'); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('diagnose') ?>" class="nav-link">
                        <i class="nav-icon fas fa-notes-medical"></i>
                        <p>
                            Diagnose
                        </p>
                    </a>
                </li>

                <?php if (session()->get('role') === 'admin'): ?>
                <li class="nav-item">
                    <a href="<?= base_url('diseases') ?>" class="nav-link">
                        <i class="nav-icon fas fa-disease"></i>
                        <p>
                            Penyakit
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('symptoms') ?>" class="nav-link">
                        <i class="nav-icon fas fa-star-of-life"></i>
                        <p>
                            Gejala
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('rules') ?>" class="nav-link">
                        <i class="nav-icon fas fa-balance-scale"></i>
                        <p>
                            Rules
                        </p>
                    </a>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="<?= base_url('logout') ?>" class="nav-link">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
                <!-- <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Starter Pages
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Active Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inactive Page</p>
                            </a>
                        </li>
                    </ul>
                </li> -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>