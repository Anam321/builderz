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
            </ul>
        </div>
        <div class="page-category">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">All Users</h4>
                                <a class="btn btn-primary btn-round ms-auto"
                                    href="<?= base_url('admin/users/form/') ?>">
                                    <i class="fa fa-plus"></i>
                                    Add User
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="table-responsive">
                                <table id="myTables" class="table table-sm table-hover" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col"></th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Telpon</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Status Akun</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view('admin/users/js'); ?>