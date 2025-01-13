<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Message</h4>
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
                    <a href="javascript:void()">Message View</a>
                </li>

            </ul>
        </div>
        <div class="page-category">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Detail Message</h4>
                                <a class="btn btn-primary btn-round ms-auto" href="<?= base_url('admin/message/') ?>">
                                    <i class="fa fa-arrow-left"></i>
                                    Back To Message
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="px-6 py-5  mb-4 md:mb-8">
                                <div class="flex mb-4">

                                    <div class="flex-grow mr-2">
                                        <header
                                            class="flex md:flex-col xl:flex-row justify-between mr-2 mb-2 leading-snug">
                                            <div class="mb-5">
                                                <h1 class="text-lg font-semibold"><?= $message['nama'] ?></h1>
                                                <table class="table">
                                                    <tr>
                                                        <td> Subject</td>
                                                        <td>:</td>
                                                        <td> <span
                                                                class="text-gray-800"><?= $message['subject'] ?></span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>Email</td>
                                                        <td>:</td>
                                                        <td> <span class="text-gray-800"><?= $message['email'] ?></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Telpon</td>
                                                        <td>:</td>
                                                        <td> <span class="text-gray-800"><?= $message['nohp'] ?></span>
                                                        </td>
                                                    </tr>
                                                </table>

                                            </div>
                                            <time
                                                class="flex flex-col items-end md:items-start xl:items-end text-xs xl:text-sm text-gray-700">
                                                <?= waktu_lalu($message['date']) ?>
                                            </time>
                                        </header>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <?= $message['message'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('admin/message/js'); ?>