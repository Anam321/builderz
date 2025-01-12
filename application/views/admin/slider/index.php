<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Nice Pages</h4>
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
                    <a href="javascript:void()">Slider</a>
                </li>

            </ul>
        </div>
        <div class="page-category">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Slider</h4>

                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="table-responsive">
                                <table id="myTables" class="table table-sm table-hover" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 300px;">#</th>
                                            <th scope="col">Images</th>
                                            <th scope="col">Judul</th>
                                            <th scope="col">Paragraf</th>
                                            <th scope="col">Link</th>
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
<div class="modal fade" id="modaldata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Slide</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form">
                <div class="modal-body">

                    <form id="form">
                        <input type="hidden" name="id">

                        <div class="row mb-3">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control" id="title">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="desk" class="col-sm-2 col-form-label">Paragraf</label>
                            <div class="col-sm-10">
                                <textarea name="desk" class="form-control" id="desk" style="height:100px;"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gambar" class="col-sm-2 col-form-label">Images</label>
                            <div class="col-sm-10">
                                <input type="file" name="gambar" class="form-control" id="gambar">
                                <input type="hidden" name="old_gambar" class="form-control" id="gambar">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="link" class="col-sm-2 col-form-label">Link</label>
                            <div class="col-sm-10">
                                <select name="link" class="form-control" id="link">
                                    <option></option>
                                    <?php foreach ($service as $row) : ?>
                                        <option value="<?= $row->slug ?>"><?= $row->title ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary me-3" id="save">Simpan</button>
                        </div>
                    </form>

                </div>

            </form>
        </div>
    </div>
</div>
<?php $this->load->view('admin/slider/js'); ?>