<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-x1-0">
                    <h3 class="font-weight-bold">Kelola Katalog</h3>
                    <h6 class="font-weight-normal mb-0">JewePe Wedding Organizer</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Data Katalog</h4>
                    <form action="<?= base_url('admin/Katalog/updateData'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" value="<?= $katalog->id_katalog; ?>" name="id">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="exampleInputNamel">Nama Katalog</label>
                                    <input type="text" class="form-control" id="exampleInputName1" name="package_name" placeholder="Nama Katalog" value="<?= $katalog->judul_katalog; ?>" required>
                                </div>
                                <div class="form-group">
                                    <div class="editor-container">
                                        <label for="exampleAddress1">Deskripsi</label>
                                        <textarea class="form-control" id="editor" name="description" rows="4"><?= $katalog->isi_katalog; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Gambar Header</label>
                                    <input type="file" name="gambar" class="form-control" <?= empty($katalog->gambar) ? 'required' : '' ?>>
                                </div>
                                <div class="form-group">
                                    <img src="<?= base_url('assets/files/katalog/') . $katalog->gambar; ?>" class="img-thumbnail" style="max-width:120px" alt="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Harga (Rp)</label>
                                    <input type="text" class="form-control" id="exampleInputNamel" name="price" placeholder="Harga" value="<?= number_format($katalog->harga) ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectStatusPublish">Status Publish</label>
                                    <select class="form-control" name="status publish" id="exampleSelectStatusPublish">
                                        <option value="publish" <?= $katalog->status == 'publish' ? 'selected' : '' ?>>Publish</options>
                                        <option value="draft" <?= $katalog->status == 'draft' ? 'selected' : '' ?>>Draft</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 text-right">
                                <a href="<?= base_url('admin/Katalog'); ?>" class="btn btn-secondary mr-2">Kembali</a>
                                <button type="submit" class="btn btn-primary mr-2">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>