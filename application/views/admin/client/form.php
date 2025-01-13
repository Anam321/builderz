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
                        <a href="<?= base_url('admin/client') ?>">Client</a>
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
                                    <h4 class="card-title">All Testimonial Client</h4>
                                    <a class="btn btn-primary btn-round ms-auto"
                                        href="<?= base_url('admin/client/') ?>">
                                        <i class="fa fa-arrow-left"></i>
                                        Back To Client
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="form">

                                    <h6 class="mb-4">Data Client</h6>
                                    <input type="hidden" name="id_projek">
                                    <div class="row mb-3">
                                        <label for="nama_projek" class="col-sm-2 col-form-label">Nama
                                            Projek</label>
                                        <div class="col-sm-4">
                                            <div class="input-group mb-3">
                                                <input disabled type="text" id="nama_projek" name="nama_projek"
                                                    class="form-control" aria-label="Recipient's username"
                                                    aria-describedby="button-addon2">
                                                <button type="button" class="btn btn-primary btn-flat"
                                                    onclick="projek()"><i class="fa fa-search me-2"></i></button>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mb-3">
                                        <label for="nama_client" class="col-sm-2 col-form-label">Nama
                                            Client</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nama_client" class="form-control" id="nama_client">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="nohp" class="col-sm-2 col-form-label">No Telpon</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="nohp" class="form-control" id="nohp">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="email" class="form-control" id="email">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <textarea name="alamat" class="form-control" id="alamat"
                                                style="height:100px;"></textarea>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary me-3" id="kirim">Dapatakn
                                            Testimoni</button>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modaldata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <table id="myTables" class="table table-sm table-striped table-hover" style="width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Projek</th>
                                <th scope="col">Client</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Volume</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cls">Pilih</button>
                    <!-- <button type="button" id="getData" class="btn btn-primary">Pilih</button> -->
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('admin/client/js'); ?>