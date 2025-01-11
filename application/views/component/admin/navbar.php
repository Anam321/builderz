    <?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    function waktu_lalu($timestamp)
    {
        $selisih = time() - strtotime($timestamp);
        $detik = $selisih;
        $menit = round($selisih / 60);
        $jam = round($selisih / 3600);
        $hari = round($selisih / 86400);
        $minggu = round($selisih / 604800);
        $bulan = round($selisih / 2419200);
        $tahun = round($selisih / 29030400);
        if ($detik <= 60) {
            $waktu = $detik . ' detik yang lalu';
        } else if ($menit <= 60) {
            $waktu = $menit . ' menit yang lalu';
        } else if ($jam <= 24) {
            $waktu = $jam . ' jam yang lalu';
        } else if ($hari <= 7) {
            $waktu = $hari . ' hari yang lalu';
        } else if ($minggu <= 4) {
            $waktu = date_indo($timestamp);
        } else if ($bulan <= 12) {
            $waktu = date_indo($timestamp);
        } else {
            $waktu = date_indo($timestamp);
        }
        return $waktu;
    }
    $user = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
    $this->db->where('hit', 1);
    $this->db->order_by('id', 'DESC');
    $messages = $this->db->get('ref_message')->result();
    ?>

    <?php $this->load->View('component/admin/sidebar'); ?>

    <div class="main-panel">
        <div class="main-header">
            <div class="main-header-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="index.html" class="logo">
                        <img src="<?= base_url('assets/admin/') ?>img/kaiadmin/logo_light.svg" alt="navbar brand"
                            class="navbar-brand" height="20" />
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                <div class="container-fluid">


                    <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                        <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                                aria-expanded="false" aria-haspopup="true">
                                <i class="fa fa-search"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-search animated fadeIn">
                                <form class="navbar-left navbar-form nav-search">
                                    <div class="input-group">
                                        <input type="text" placeholder="Search ..." class="form-control" />
                                    </div>
                                </form>
                            </ul>
                        </li>

                        <?php $jmlmsg = $this->db->get_where('ref_message', ['hit' => 1])->num_rows(); ?>

                        <li class="nav-item topbar-icon dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-envelope"></i>
                                <?php if ($jmlmsg > 0) : ?> <span
                                        class="notification"><?= $jmlmsg ?></span><?php endif ?></i>
                            </a>
                            <ul class="dropdown-menu messages-notif-box animated fadeIn"
                                aria-labelledby="messageDropdown">
                                <li>
                                    <div class="dropdown-title d-flex justify-content-between align-items-center">
                                        Messages
                                    </div>
                                </li>
                                <li>
                                    <div class="message-notif-scroll scrollbar-outer">
                                        <div class="notif-center">
                                            <?php foreach ($messages as $mess) : ?>
                                                <a href="<?= base_url('admin/message/detail/') . $mess->id ?>">
                                                    <div class="notif-img">
                                                        <img src="<?= base_url() ?>assets/upload/img/userdefault.png"
                                                            alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject"><?= $mess->nama ?></span>
                                                        <span class="block"> <?= $mess->subject ?> </span>
                                                        <span class="time"><?= waktu_lalu($mess->date) ?></span>
                                                    </div>
                                                </a>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a class="see-all" href="<?= base_url('admin/message/') ?>">See all messages<i
                                            class="fa fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <?php if ($user['foto'] == false) {
                            $f_user = 'userdefault.png';
                        } else {
                            $f_user = $user['foto'];
                        } ?>

                        <li class="nav-item topbar-user dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                                aria-expanded="false">
                                <div class="avatar-sm">
                                    <img src="<?= base_url() ?>assets/upload/img/<?= $f_user ?>" alt=""
                                        class="avatar-img rounded-circle" />
                                </div>
                                <span class="profile-username">
                                    <span class="op-7">Hi,</span>
                                    <span class="fw-bold"><?= $user['nama'] ?></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg">
                                                <img src="<?= base_url() ?>assets/upload/img/<?= $f_user ?>"
                                                    alt="image profile" class="avatar-img rounded" />
                                            </div>
                                            <div class="u-text">
                                                <h4><?= $user['nama'] ?></h4>
                                                <p class="text-muted"><?= $user['username'] ?></p>
                                                <!-- <a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View
                                                     Profile</a> -->
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                        <!-- <a class="dropdown-item" href="#">My Profile</a> -->
                                        <a class="dropdown-item" href="<?= base_url('auth/logout') ?>">Logout</a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>