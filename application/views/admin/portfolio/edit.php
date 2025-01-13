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
                        <a href="<?= base_url('admin/portfolio') ?>">Portfolio</a>
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
                                    <h4 class="card-title">Edit Portfolio</h4>
                                    <a class="btn btn-primary btn-round ms-auto"
                                        href="<?= base_url('admin/portfolio/') ?>">
                                        <i class="fa fa-arrow-left"></i>
                                        Back To Post
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Modal -->
                                <form id="form_update">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="mb-4">Meta / Seo Pages</h6>
                                            <input type="hidden" name="id" value="<?= $filed['id'] ?>">
                                            <div class="row mb-3">
                                                <label for="title" class="col-sm-2 col-form-label">Judul</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="title" class="form-control" id="title"
                                                        value="<?= $filed['title'] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="meta_keyword" class="col-sm-2 col-form-label">Meta
                                                    Keyword</label>
                                                <div class="col-sm-10">
                                                    <textarea name="keyword" class="form-control" id="meta_keyword"
                                                        style="height:100px;"><?= $filed['keyword'] ?></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <h6 class="mb-4">Body</h6>
                                            <div class="row mb-3">
                                                <label for="projek" class="col-sm-2 col-form-label">Projek</label>
                                                <div class="col-sm-10">
                                                    <select name="id_projek" class="form-control" id="projek" disabled>
                                                        <option>choose</option>
                                                        <?php foreach ($projek as $pr) : ?>
                                                        <option <?php if ($filed['id_projek'] == $pr->id_projek) {
                                                                        echo 'selected';
                                                                    } ?> value="<?= $pr->id_projek ?>">
                                                            <?= $pr->nama_projek ?> | <?= $pr->nama_client ?> |
                                                            <?= $pr->alamat ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="video" class="col-sm-2 col-form-label">Video</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="video" class="form-control" id="video"
                                                        placeholder="Link Video Youtube" value="<?= $filed['video'] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="images" class="col-sm-2 col-form-label">Images</label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="images" class="form-control" id="images">
                                                    <input type="hidden" name="old_images" class="form-control"
                                                        id="images" value="<?= $filed['images'] ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="desk" class="col-sm-2 col-form-label">Deskripsi</label>
                                                <div class="col-sm-10">
                                                    <textarea name="desk" class="form-control" id="desk"
                                                        style="height:100px;"><?= $filed['desk'] ?></textarea>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary me-3" id="update">Post
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
    <?php $this->load->view('admin/portfolio/js'); ?>