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
                <!-- <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="javascript:void()">Post</a>
                </li> -->

            </ul>
        </div>
        <div class="page-category">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">

                                <a class="btn btn-primary btn-sm me-2" href="<?= base_url('admin/project/form/') ?>">
                                    <i class="fa fa-plus me-2"></i>
                                    Add Data
                                </a>
                                <a target="_blank" class="btn btn-success btn-sm me-2"
                                    href="<?= base_url('admin/project/print_project') ?>">
                                    <i class="fa fa-print me-2"></i>
                                    Print
                                </a>
                                <a target="_blank" class="btn btn-danger btn-sm me-2"
                                    href="<?= base_url('admin/project/exportProject_pdf') ?>">
                                    <i class="fa fa-file-pdf me-2"></i>
                                    Export PDF
                                </a>

                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="table-responsive">
                                <table id="myTables" class="table table-sm table-bordered" style="width: 100%;">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th scope="col" style="text-align: center; vertical-align: middle;">#</th>
                                            <th scope="col" style="text-align: center; vertical-align: middle;">Nama
                                                Project</th>
                                            <th scope="col" style="text-align: center; vertical-align: middle;">Client
                                            </th>
                                            <th scope="col" style="text-align: center; vertical-align: middle;">Alamat
                                            </th>
                                            <th scope="col" style="text-align: center; vertical-align: middle;">Volum
                                            </th>
                                            <th scope="col" style="text-align: center; vertical-align: middle;">Anggaran
                                            </th>
                                            <th scope="col" style="text-align: center; vertical-align: middle;">Timeline
                                            </th>
                                            <th scope="col" style="text-align: center; vertical-align: middle;">Tanggal
                                                Mulai</th>
                                            <th scope="col" style="text-align: center; vertical-align: middle;">Tanggal
                                                Akhir</th>
                                            <th scope="col" style="text-align: center; vertical-align: middle;">Status
                                            </th>
                                            <th scope="col" style="text-align: center; vertical-align: middle;">Aksi
                                            </th>

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

<?php $this->load->view('admin/project/js'); ?>