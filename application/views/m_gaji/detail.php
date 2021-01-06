<main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail</h1>
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
        <div class="col-lg-8">
        </div>
        <div class="col-lg-4">
            <form action="" method="post" autocomplete="off">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control">
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
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Kdjns</th>
                            <th>Kdsatker</th>
                            <th>Kdanak</th>
                            <th>Kdsubanak</th>
                            <th>Kdkawin</th>
                            <th>Kdgapok</th>
                            <th>Kdjab</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Gapok</th>
                            <th>Tistri</th>
                            <th>Tanak</th>
                            <th>Tumum</th>
                            <th>Ttambumum</th>
                            <th>Tstruktur</th>
                            <th>Tfungsi</th>
                            <th>Bulat</th>
                            <th>Tberas</th>
                            <th>Tpajak</th>
                            <th>Pberas</th>
                            <th>Tpapua</th>
                            <th>Tpencil</th>
                            <th>Tlain</th>
                            <th>Iwp</th>
                            <th>Pph</th>
                            <th>Sewarmh</th>
                            <th>Tunggakan</th>
                            <th>Utanglebih</th>
                            <th>Potlain</th>
                            <th>Taperum</th>
                            <th>Bpjs</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = $page + 1;
                        foreach ($gaji as $r) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $r['nip']; ?></td>
                                <td><?= $r['nmpeg']; ?></td>
                                <td><?= $r['kdjns']; ?></td>
                                <td><?= $r['kdsatker']; ?></td>
                                <td><?= $r['kdanak']; ?></td>
                                <td><?= $r['kdsubanak']; ?></td>
                                <td><?= $r['kdkawin']; ?></td>
                                <td><?= $r['kdgapok']; ?></td>
                                <td><?= $r['kdjab']; ?></td>
                                <td><?= $r['bulan']; ?></td>
                                <td><?= $r['tahun']; ?></td>
                                <td><?= $r['gapok']; ?></td>
                                <td><?= $r['tistri']; ?></td>
                                <td><?= $r['tanak']; ?></td>
                                <td><?= $r['tumum']; ?></td>
                                <td><?= $r['ttambumum']; ?></td>
                                <td><?= $r['tstruktur']; ?></td>
                                <td><?= $r['tfungsi']; ?></td>
                                <td><?= $r['bulat']; ?></td>
                                <td><?= $r['tberas']; ?></td>
                                <td><?= $r['tpajak']; ?></td>
                                <td><?= $r['pberas']; ?></td>
                                <td><?= $r['tpapua']; ?></td>
                                <td><?= $r['tpencil']; ?></td>
                                <td><?= $r['tlain']; ?></td>
                                <td><?= $r['iwp']; ?></td>
                                <td><?= $r['pph']; ?></td>
                                <td><?= $r['sewarmh']; ?></td>
                                <td><?= $r['tunggakan']; ?></td>
                                <td><?= $r['utanglebih']; ?></td>
                                <td><?= $r['potlain']; ?></td>
                                <td><?= $r['taperum']; ?></td>
                                <td><?= $r['bpjs']; ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="<?= base_url('m-gaji/upload-detail/') . $r['nip'] . '/' . $r['bulan'] . '/' . $r['tahun'] . '/' . $r['kdjns'] . '/' . $r['kdsatker'] . '/' . $r['kdanak'] . '/' . substr($r['kdgapok'], 0, 1); ?>" class="btn btn-sm btn-outline-secondary pt-0 pb-0" onclick="return confirm('Apakah Anda yakin akan mengupload data ini?');">Upload</a>
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
        <div class="col">
            <?= $keyword == null ? $pagination : ''; ?>
        </div>
    </div>
</main>