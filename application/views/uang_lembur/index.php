<main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Uang Lembur</h1>
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
        </div>
        <div class="col-lg-5">
            <form action="" method="post" autocomplete="off">
                <div class="input-group">
                    <input type="text" name="keyword1" class="form-control" placeholder="nip">
                    <input type="text" name="keyword2" class="form-control" placeholder="tahun">
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
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Kdsatker</th>
                            <th>Kdanak</th>
                            <th>NIP</th>
                            <th>Gol</th>
                            <th>Jkerja</th>
                            <th>Jlibur</th>
                            <th>Jmakan</th>
                            <th>Lembur</th>
                            <th>Makan</th>
                            <th>Pph</th>
                            <th>Bruto</th>
                            <th>Netto</th>
                            <th>Uraian_keterangan_kerja_lembur_bulanan_unit_kerja</th>
                            <th colspan="31">Rincian</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = $page + 1;
                        foreach ($uang_lembur as $r) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $r['bulan']; ?></td>
                                <td><?= $r['tahun']; ?></td>
                                <td><?= $r['kdsatker']; ?></td>
                                <td><?= $r['kdanak']; ?></td>
                                <td><?= $r['nip']; ?></td>
                                <td><?= $r['gol']; ?></td>
                                <td><?= $r['jkerja']; ?></td>
                                <td><?= $r['jlibur']; ?></td>
                                <td><?= $r['jmakan']; ?></td>
                                <td><?= $r['lembur']; ?></td>
                                <td><?= $r['makan']; ?></td>
                                <td><?= $r['pph']; ?></td>
                                <td><?= $r['bruto']; ?></td>
                                <td><?= $r['netto']; ?></td>
                                <td><?= $r['keterangan']; ?></td>
                                <td><?= $r['jhari1']; ?></td>
                                <td><?= $r['jhari2']; ?></td>
                                <td><?= $r['jhari3']; ?></td>
                                <td><?= $r['jhari4']; ?></td>
                                <td><?= $r['jhari5']; ?></td>
                                <td><?= $r['jhari6']; ?></td>
                                <td><?= $r['jhari7']; ?></td>
                                <td><?= $r['jhari8']; ?></td>
                                <td><?= $r['jhari9']; ?></td>
                                <td><?= $r['jhari10']; ?></td>
                                <td><?= $r['jhari11']; ?></td>
                                <td><?= $r['jhari12']; ?></td>
                                <td><?= $r['jhari13']; ?></td>
                                <td><?= $r['jhari14']; ?></td>
                                <td><?= $r['jhari15']; ?></td>
                                <td><?= $r['jhari16']; ?></td>
                                <td><?= $r['jhari17']; ?></td>
                                <td><?= $r['jhari18']; ?></td>
                                <td><?= $r['jhari19']; ?></td>
                                <td><?= $r['jhari20']; ?></td>
                                <td><?= $r['jhari21']; ?></td>
                                <td><?= $r['jhari22']; ?></td>
                                <td><?= $r['jhari23']; ?></td>
                                <td><?= $r['jhari24']; ?></td>
                                <td><?= $r['jhari25']; ?></td>
                                <td><?= $r['jhari26']; ?></td>
                                <td><?= $r['jhari27']; ?></td>
                                <td><?= $r['jhari28']; ?></td>
                                <td><?= $r['jhari29']; ?></td>
                                <td><?= $r['jhari30']; ?></td>
                                <td><?= $r['jhari31']; ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="<?= base_url('uang-lembur/delete/') . $r['id']; ?>" class="btn btn-sm btn-outline-secondary pt-0 pb-0" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?');">Hapus</a>
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