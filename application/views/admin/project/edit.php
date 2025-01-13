    <?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Project</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/project') ?>">Project</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void()">Edit</a>
                    </li>

                </ul>
            </div>
            <div class="page-category">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Edit Project</h4>
                                    <a class="btn btn-primary btn-round ms-auto"
                                        href="<?= base_url('admin/project/') ?>">
                                        <i class="fa fa-arrow-left"></i>
                                        Back To List
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Modal -->
                                <form id="form_update">

                                    <input type="hidden" name="id_projek" value="<?= $field['id_projek'] ?>">
                                    <div class="row mb-3">
                                        <label for="nama_project" class="col-sm-2 col-form-label">Nama
                                            Project</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nama_projek" class="form-control" id="nama_project"
                                                value="<?= $field['nama_projek'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="nama_client" class="col-sm-2 col-form-label">Nama
                                            Client</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nama_client" class="form-control" id="nama_client"
                                                value="<?= $field['nama_client'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" name="email" class="form-control" id="email"
                                                value="<?= $field['email'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="nohp" class="col-sm-2 col-form-label">No HP</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="nohp" class="form-control" id="nohp"
                                                value="<?= $field['nohp'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                                        <div class="col-sm-10">
                                            <select name="kategori" id="kategori" class="form-control">
                                                <option></option>
                                                <?php foreach ($kategori as $kat) : ?>
                                                    <option <?php if ($field['id'] == $kat->id) {
                                                                echo 'selected';
                                                            } ?> value="<?= $kat->id ?>"><?= $kat->category ?>
                                                    </option>
                                                <?php endforeach ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="tgl_mulai" class="col-sm-2 col-form-label">Tanggal
                                            Mulai</label>
                                        <div class="col-sm-10">
                                            <input type="date" name="tgl_mulai" class="form-control" id="tgl_mulai"
                                                value="<?= $field['tgl_mulai'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="tgl_akhir" class="col-sm-2 col-form-label">Tanggal
                                            Akhir</label>
                                        <div class="col-sm-10">
                                            <input type="date" name="tgl_akhir" class="form-control" id="tgl_akhir"
                                                value="<?= $field['tgl_akhir'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="volume" class="col-sm-2 col-form-label">Volume</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="volume" class="form-control" id="volume"
                                                value="<?= $field['volume'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <textarea name="alamat" class="form-control" id="alamat"
                                                style="height:100px;"><?= $field['alamat'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                        <div class="col-sm-10">
                                            <textarea name="keterangan" class="form-control" id="keterangan"
                                                style="height:200px;"><?= $field['keterangan'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary me-3" id="update">Post
                                            Data</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('admin/project/js'); ?>