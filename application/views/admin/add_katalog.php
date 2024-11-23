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
                    <h4 class="card-title">Tambah Data Katalog</h4>
                    <form action="<?= base_url('admin/Katalog/addData'); ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="exampleInputNamel">Nama Katalog</label>
                                    <input type="text" class="form-control" id="exampleInputName1" name="package_name" placeholder="Nama Katalog" required>
                                </div>
                                <div class="form-group">
                                    <div class="editor-container">
                                        <label for="exampleAddress1">Deskripsi</label>
                                        <textarea class="form-control" id="editor" name="description" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Gambar Header</label>
                                    <input type="file" name="gambar" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Harga (Rp)</label>
                                    <input type="text" class="form-control" id="exampleInputNamel" name="price" placeholder="Harga" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectStatusPublish">Status Publish</label>
                                    <select class="form-control" name="status publish" id="exampleSelectStatusPublish">
                                        <option value="publish">Publish</options>
                                        <option value="draft">Draft</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 text-right">
                                <a href="<?= base_url('admin/Katalog'); ?>" class="btn btn-secondary mr-2">Kembali</a>
                                <button type="submit" class="btn btn-primary mr-2">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>