<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Kelola Pesanan</h3>
                    <h6 class="font-weight-normal mb-0">JeWePe Wedding Organizer</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="card-title">Data Pesanan Paket Pernikahan</h4>
                        </div>
                        <div class="col-lg-12">
                            <?= $this->session->flashdata('message'); ?>
                        </div>
                    </div>

                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                                <th class="text-center">No</th>
                                <th class="text-center">Gambar</th>
                                <th class="text-center">Nama Katalog</th>
                                <th class="text-center">Nama Pemesan</th>
                                <th class="text-center">Email Pemesan</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($getAllPesanan as $row) :
                                ?>
                                    <tr>
                                        <td class="text-center">
                                            <?= $no++; ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= base_url('assets/files/katalog/') . $row->gambar; ?>" target="_blank">
                                                <img src="<?= base_url('assets/files/katalog/') . $row->gambar; ?>" class="img-fluid" style="border-radius:10%;width:60px;height:60px" alt="">
                                            </a>
                                        </td>
                                        <td><?= $row->judul_katalog; ?></td>
                                        <td class="text-center"><?= $row->nama_pemesan; ?></td>
                                        <td class="text-center"><?= $row->email; ?></td>
                                        <td class="text-center">
                                            <?php if ($row->status_pesanan == 'requested') {
                                                echo '<div class="badge badge-primary">Menunggu konfirmasi</div>';
                                            } else {
                                                echo '<div class="badge badge-success">Pesanan diterima</div>';
                                            } ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($row->status_pesanan == 'requested') { ?>
                                                <a class="btn btn-sm btn-info" href="<?= base_url('admin/Pesanan/updateStatus?status_pesanan=approved&id=') . $row->id_pesanan ?>" title="Terima">Terima</a>
                                            <?php } else { ?>
                                                <a class="btn btn-sm btn-warning" href="<?= base_url('admin/Pesanan/updateStatus?status_pesanan=requested&id=') . $row->id_pesanan ?>" title="Batalkan">Batalkan</a>
                                            <?php } ?>
                                            <a class="btn btn-sm btn-danger" href="<?= base_url('admin/Pesanan/delete?id=') . $row->id_pesanan ?>" title="Hapus" 
                                                onclick="if (!confirm('Apakah Anda yakin akan menghapus pesanan ini??')) { return false; }">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>