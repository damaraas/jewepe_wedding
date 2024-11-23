<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Settings Profile Website</h3>
                    <h6 class="font-weight-normal mb-0">JeWePe Wedding Organizer</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Settings Profile Website</h4>
                    <?= $this->session->flashdata('message') ?>
                    <form action="<?= base_url('admin/Settings/updateData'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" value="<?= $settings->id; ?>" name="id">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="exampleInputName1">Nama Website</label>
                                    <input type="text" class="form-control" id="exampleInputName1" name="nama_website" placeholder="Nama Website" value="<?= $settings->nama_website; ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputName1">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="exampleInputName1" name="nomor_telepon" placeholder="Nomor Telepon" value="<?= $settings->nomor_telepon; ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputName1">Email</label>
                                    <input type="email" class="form-control" id="exampleInputName1" name="email" placeholder="Email" value="<?= $settings->email; ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleAddress1">Alamat</label>
                                    <textarea class="form-control" id="exampleAddress1" name="alamat" rows="4"><?= $settings->alamat; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleMaps1">Maps</label>
                                    <textarea class="form-control" id="exampleMaps1" name="maps" rows="4"><?= $settings->maps; ?></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputName1">Logo Website</label>
                                    <input type="file" class="form-control" id="exampleInputName1" name="logo" value="">
                                </div>
                                <div class="form-group">
                                    <img src="<?= base_url('assets/files/profil/') . $settings->logo; ?>" class="img-thumbnail" style="max-width: 120px;" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputName1">Facebook</label>
                                    <input type="text" class="form-control" id="exampleInputName1" name="facebook_url" placeholder="Facebook" value="<?= $settings->facebook_url; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Youtube</label>
                                    <input type="text" class="form-control" id="exampleInputName1" name="youtube_url" placeholder="Youtube" value="<?= $settings->youtube_url; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Instagram</label>
                                    <input type="text" class="form-control" id="exampleInputName1" name="instagram_url" placeholder="Instagram" value="<?= $settings->instagram_url; ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleHeaderBusinessHour1">Header Business Hour</label>
                                    <textarea class="form-control" id="exampleHeaderBusinessHour1" name="header_business_hour" rows="4"><?= $settings->header_business_hour; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleTimeBusinessHour1">Time Business Hour</label>
                                    <textarea class="form-control" id="exampleTimeBusinessHour1" name="time_business_hour" rows="4"><?= $settings->time_business_hour; ?></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 text-right">
                                <button type="submit" class="btn btn-primary mr-2">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>