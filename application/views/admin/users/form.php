    <?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Users</h4>
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
                        <a href="<?= base_url('admin/users/') ?>">Users</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void()">Form</a>
                    </li>
                </ul>
            </div>
            <div class="page-category">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Form Users</h4>
                                    <a class="btn btn-primary btn-round ms-auto" href="<?= base_url('app-admin/users/') ?>">
                                        <i class="fa fa-arrow-left"></i>
                                        Back To List
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="form">
                                    <div class="card">
                                        <div class="card-body">


                                            <div class="row mb-3">
                                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="nama" class="form-control" id="nama">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                                                <div class="col-sm-10">
                                                    <select name="jabatan" class="form-control">
                                                        <option value="0"></option>
                                                        <?php foreach ($jabatan as $j): ?>
                                                            <option value="<?= $j->slug ?>"><?= $j->jabatan ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                                <div class="col-sm-10">
                                                    <select name="jk" class="form-control">
                                                        <option value="0"></option>
                                                        <option value="LAKI-LAKI">LAKI-LAKI</option>
                                                        <option value="PEREMPUAN">PEREMPUAN</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" name="email" class="form-control" id="email">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="nohp" class="col-sm-2 col-form-label">No Telpon</label>
                                                <div class="col-sm-10">
                                                    <input type="number" name="nohp" class="form-control" id="nohp">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" name="alamat" id="alamat"
                                                        height="150"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <h6 class="mb-4">Change Akun</h6>
                                            <div class="row mb-3">
                                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="username" class="form-control"
                                                        id="username">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="role_id" class="col-sm-2 col-form-label">Role</label>
                                                <div class="col-sm-10">
                                                    <select name="role_id" class="form-control" id="role_id">
                                                        <option></option>
                                                        <?php foreach ($role as $field) : ?>
                                                            <option value="<?= $field->role_id ?>"><?= $field->role ?>
                                                            </option>
                                                        <?php endforeach ?>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" name="password" class="form-control"
                                                        id="password">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="password2" class="col-sm-2 col-form-label">Konfirmasi
                                                    Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" name="password2" class="form-control"
                                                        id="password2">
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary me-3" id="save">Post
                                                    Data</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('admin/users/js'); ?>