<main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">M_Gaji</h1>
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
    <div class="row mb-1">
        <div class="col">
            <?php foreach ($tahun as $t) : ?>
                <a href="<?= base_url('m-gaji/index/') . $t['tahun'] . '/' . $bln . '/' . $kdjns; ?>" class="btn btn-sm btn-outline-secondary <?= $t['tahun'] == $thn ? 'active' : '' ?> ml-1 mt-2 mb-2"><?= $t['tahun']; ?></a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="row mb-1">
        <div class="col">
            <?php foreach ($bulan as $b) : ?>
                <a href="<?= base_url('m-gaji/index/') . $thn . '/' . $b['bulan'] . '/' . $kdjns; ?>" class="btn btn-sm btn-outline-secondary <?= $b['bulan'] == $bln ? 'active' : '' ?> ml-1 mt-2 mb-2"><?= $b['bulan']; ?></a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col">
            <?php foreach ($jenis as $k) : ?>
                <a href="<?= base_url('m-gaji/index/') . $thn . '/' . $bln . '/' . $k['kdjns']; ?>" class="btn btn-sm btn-outline-secondary <?= $k['kdjns'] == $kdjns ? 'active' : '' ?> ml-1 mt-2 mb-2"><?= $k['kdjns']; ?></a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-hover">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Kode Satker</th>
                            <th>Kode Anak</th>
                            <th>Kode Gol</th>
                            <th>Pegawai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($gaji as $r) : ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $r['kdsatker']; ?></td>
                                <td><?= $r['kdanak']; ?></td>
                                <td><?= $r['kdgapok']; ?></td>
                                <td class="text-right"><?= number_format($r['jml'], 0, ',', '.'); ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="<?= base_url('m-gaji/detail/') . $thn . '/' . $bln . '/' . $kdjns . '/' . $r['kdsatker'] . '/' . $r['kdanak'] . '/' . $r['kdgapok']; ?>" class="btn btn-sm btn-outline-secondary pt-0 pb-0">Detail</a>
                                        <a href="<?= base_url('m-gaji/upload/') . $thn . '/' . $bln . '/' . $kdjns . '/' . $r['kdsatker'] . '/' . $r['kdanak'] . '/' . $r['kdgapok']; ?>" class="btn btn-sm btn-outline-secondary pt-0 pb-0" onclick="return confirm('Apakah Anda yakin akan mengupload data ini?');">Upload</a>
                                        <a href="<?= base_url('m-gaji/ekspor/') . $thn . '/' . $bln . '/' . $kdjns . '/' . $r['kdsatker'] . '/' . $r['kdanak'] . '/' . $r['kdgapok']; ?>" class="btn btn-sm btn-outline-secondary pt-0 pb-0">Ekspor</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>