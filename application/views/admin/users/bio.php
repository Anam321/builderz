<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$user = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
?>
<style>
    .profile-card {
        background-color: #fff;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        border-radius: 24px;
        padding: 2.5rem;
        width: 36rem;
        position: relative;
        z-index: 3;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .profile-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        height: 15rem;
        width: 100%;
        border-radius: 24px 24px 0 0;
        background-color: #4070f4;
    }

    .profile-card .image {
        border-radius: 50%;
        background-color: #4070f4;
        height: 15rem;
        margin-bottom: 2rem;
        padding: 0.3rem;
        width: 15rem;
        position: relative;
        z-index: 3;
    }

    .image img {
        border: 3px solid #fff;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 0.1rem;
        height: 100%;
        width: 100%;
    }

    .profile-card .text-data {
        text-align: center;
    }

    .text-data h2 {
        font-size: 2.2rem;
        font-weight: 500;
    }

    .text-data p {
        font-size: 1rem;
        font-weight: 400;
    }


    /* .buttons {
        margin-top: 1.5rem;
    }

    .buttons button {
        background-color: #4070f4;
        border-radius: 2.4rem;
        border: none;
        cursor: pointer;
        color: #fff;
        font-size: 1.2rem;
        font-weight: 400;
        padding: 0.8rem 2.4rem;
        margin-inline: 1.2rem;
    }

    .buttons button:hover {
        background-color: #152551;
    } */

    .profile-card .analytics {
        margin-top: 2.5rem;
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: space-evenly;
    }

    .analytics .data {
        color: #333;
        padding: 0.2rem;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
    }

    .data i {
        font-size: 1.8rem;
        margin-right: 0.3rem;
    }

    .data p {
        font-size: 2rem;
    }

    /* media queries  */
    @media (width <=390px) {
        html {
            font-size: 56.25%;
        }
    }

    @media (width <=370px) {
        html {
            font-size: 50%;
        }
    }
</style>
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Users</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="javascript:void()">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('app-admin/users') ?>">Users</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="javascript:void()">Profile Bio</a>
                </li>
            </ul>
        </div>
        <div class="page-category">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body d-flex justify-content-center">
                            <?php if ($bio['foto'] == false) {
                                $f_user = 'userdefault.png';
                            } else {
                                $f_user = $bio['foto'];
                            } ?>

                            <section class="profile-card">
                                <div class="image">
                                    <img src="<?= base_url() ?>assets/upload/img/<?= $f_user ?>" alt="user image">
                                </div>
                                <div class="text-data">
                                    <h2><?= $bio['nama'] ?></h2>
                                    <p><?= jabatan($bio['jabatan']) ?></p>
                                    <p><?= $bio['jk'] ?></p>
                                    <p><?= $bio['email'] ?></p>
                                    <p><?= $bio['notlp'] ?></p>
                                    <p><?= $bio['alamat'] ?></p>
                                </div>


                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>