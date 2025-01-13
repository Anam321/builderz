<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Pages</h4>
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
                    <a href="javascript:void()">Portfolio</a>
                </li>

            </ul>
        </div>
        <div class="page-category">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">All Portfolio</h4>
                                <a class="btn btn-primary btn-round ms-auto"
                                    href="<?= base_url('admin/portfolio/form/') ?>">
                                    <i class="fa fa-plus"></i>
                                    Add Portfolio
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
                                            <th scope="col">Images</th>
                                            <th scope="col">Portfolio</th>
                                            <th scope="col">Nama Client</th>
                                            <th scope="col">Alamat</th>
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
<?php $this->load->view('admin/portfolio/js'); ?>