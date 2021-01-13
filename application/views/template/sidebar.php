<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
            <span>Data Server</span>
        </h6>
        <?php
        $menu1 = [
            [
                'name' => 'Gaji Induk',
                'url' => 'gaji'
            ],
            [
                'name' => 'Kekurangan Gaji',
                'url' => 'kekurangan'
            ],
            [
                'name' => 'Uang Makan',
                'url' => 'uang-makan'
            ],
            [
                'name' => 'Uang Lembur',
                'url' => 'uang-lembur'
            ],
            [
                'name' => 'Pegawai',
                'url' => 'pegawai'
            ],
            [
                'name' => 'Keluarga',
                'url' => 'keluarga'
            ],
            [
                'name' => 'Perubahan',
                'url' => 'perubahan'
            ],

        ];
        ?>
        <ul class="nav flex-column">
            <?php foreach ($menu1 as $r) : ?>
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(1) == $r['url'] ? 'active' : ''; ?> pb-1" href="<?= base_url() . $r['url']; ?>">
                        &nbsp; <?= $r['name']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
            <span>Data GPP</span>
        </h6>
        <?php
        $menu2 = [
            [
                'name' => 'M_Gaji',
                'url' => 'm_gaji'
            ],
            [
                'name' => 'M_Kekurangan',
                'url' => 'm_kekurangan'
            ],
            [
                'name' => 'M_Makan',
                'url' => 'm_makan'
            ],
            [
                'name' => 'M_Lembur',
                'url' => 'm_lembur'
            ],
            [
                'name' => 'T_Pegawai',
                'url' => 't_pegawai'
            ],
            [
                'name' => 'T_Keluarga',
                'url' => 't_keluarga'
            ],
            [
                'name' => 'T_Perubahan',
                'url' => 't_perubahan'
            ],
        ];
        ?>
        <ul class="nav flex-column">
            <?php foreach ($menu2 as $r) : ?>
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(1) == $r['url'] ? 'active' : ''; ?> pb-1" href="<?= base_url() . $r['url']; ?>">
                        &nbsp; <?= $r['name']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>