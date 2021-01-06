<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
            <span>Data Server</span>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'gaji' ? 'active' : ''; ?>" href="<?= base_url('gaji'); ?>">
                    &nbsp; Gaji Induk
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'kekurangan' ? 'active' : ''; ?>" href="<?= base_url('kekurangan'); ?>">
                    &nbsp; Kekurangan Gaji
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'uang-makan' ? 'active' : ''; ?>" href="<?= base_url('uang-makan'); ?>">
                    &nbsp; Uang Makan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'uang-lembur' ? 'active' : ''; ?>" href="<?= base_url('uang-lembur'); ?>">
                    &nbsp; Uang Lembur
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'pegawai' ? 'active' : ''; ?>" href="<?= base_url('pegawai'); ?>">
                    &nbsp; Pegawai
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'keluarga' ? 'active' : ''; ?>" href="<?= base_url('keluarga'); ?>">
                    &nbsp; Keluarga
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'perubahan' ? 'active' : ''; ?>" href="<?= base_url('perubahan'); ?>">
                    &nbsp; Perubahan
                </a>
            </li>
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
            <span>Data GPP</span>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'm-gaji' ? 'active' : ''; ?>" href="<?= base_url('m-gaji'); ?>">
                    &nbsp; m_gaji
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'm-kekurangan' ? 'active' : ''; ?>" href="<?= base_url('m-kekurangan'); ?>">
                    &nbsp; m_kekurangan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'm-makan' ? 'active' : ''; ?>" href="<?= base_url('m-makan'); ?>">
                    &nbsp; m_makan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'm-lembur' ? 'active' : ''; ?>" href="<?= base_url('m-lembur'); ?>">
                    &nbsp; m_lembur
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 't-pegawai' ? 'active' : ''; ?>" href="<?= base_url('t-pegawai'); ?>">
                    &nbsp; t_pegawai
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 't-keluarga' ? 'active' : ''; ?>" href="<?= base_url('t-keluarga'); ?>">
                    &nbsp; t_keluarga
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 't-perubahan' ? 'active' : ''; ?>" href="<?= base_url('t-perubahan'); ?>">
                    &nbsp; t_perubahan
                </a>
            </li>
        </ul>
    </div>
</nav>