<main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pegawai</h1>
    </div>
    <div class="row">
        <div class="col">
            <?php if ($this->session->flashdata('pesan')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Selamat!</strong> <?= $this->session->flashdata('pesan'); ?>
                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-7">
            <a href="<?= base_url('pegawai/delete-all'); ?>" class="btn btn-sm btn-outline-secondary mt-1 mb-1" onclick="return confirm('Apakah Anda yakin akan menghapus semua data?');"> Hapus Semua Data</a>
        </div>
        <div class="col-lg-5">
            <form action="" method="post" autocomplete="off">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="nama atau nip">
                    <button class="btn btn-sm btn-outline-secondary" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kdsatker</th>
                            <th>Kdanak</th>
                            <th>Kdsubanak</th>
                            <th>NIP</th>
                            <th>Nmpeg</th>
                            <th>Kdpeg</th>
                            <th>Kdduduk</th>
                            <th>Tempatlhr</th>
                            <th>Tgllhr</th>
                            <th>Kdgol</th>
                            <th>Kdkawin</th>
                            <th>Kdjab</th>
                            <th>Kdgapok</th>
                            <th>Rekening</th>
                            <th>Kdkelamin</th>
                            <th>Alamat</th>
                            <th>Npwp</th>
                            <th>Nm_bank</th>
                            <th>Nmrek</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = $page + 1;
                        foreach ($pegawai as $r) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $r['kdsatker']; ?></td>
                                <td><?= $r['kdanak']; ?></td>
                                <td><?= $r['kdsubanak']; ?></td>
                                <td><?= $r['nip']; ?></td>
                                <td><?= $r['nmpeg']; ?></td>
                                <td><?= $r['kdpeg']; ?></td>
                                <td><?= $r['kdduduk']; ?></td>
                                <td><?= $r['tempatlhr']; ?></td>
                                <td><?= $r['tgllhr']; ?></td>
                                <td><?= $r['kdgol']; ?></td>
                                <td><?= $r['kdkawin']; ?></td>
                                <td><?= $r['kdjab']; ?></td>
                                <td><?= $r['kdgapok']; ?></td>
                                <td><?= $r['rekening']; ?></td>
                                <td><?= $r['kdkelamin']; ?></td>
                                <td><?= $r['alamat']; ?></td>
                                <td><?= $r['npwp']; ?></td>
                                <td><?= $r['nm_bank']; ?></td>
                                <td><?= $r['nmrek']; ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="<?= base_url('pegawai/delete/') . $r['id']; ?>" class="btn btn-sm btn-outline-secondary pt-0 pb-0" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?');">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $keyword == null ? $pagination : ''; ?>
        </div>
    </div>
</main>