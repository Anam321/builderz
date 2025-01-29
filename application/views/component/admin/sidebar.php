 <?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    $app = $this->db->get_where('set_app', ['id' => 1])->row_array();
    $user = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
    $role = $this->db->get_where('users_role', ['role_id' => $user['role_id']])->row_array();
    $colorheadlogo = $this->db->get_where('template_color', ['id' => 1])->row_array();
    $colorside = $this->db->get_where('template_color', ['id' => 3])->row_array();
    ?>
 <div class="wrapper">
     <!-- Sidebar -->
     <div class="sidebar" data-background-color="<?= $colorside['color'] ?>">
         <div class="sidebar-logo">
             <!-- Logo Header -->
             <div class="logo-header" data-background-color="<?= $colorheadlogo['color'] ?>">
                 <a href="index.html" class="logo">

                     <?php if ($user['foto'] == false) {
                            $f_user = 'userdefault.png';
                        } else {
                            $f_user = $user['foto'];
                        } ?>

                     <img src="<?= base_url() ?>assets/upload/img/<?= $app['logo'] ?>" alt="navbar brand"
                         class="navbar-brand" height="40" />
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
         <div class="sidebar-wrapper scrollbar scrollbar-inner">
             <div class="sidebar-content">
                 <ul class="nav nav-secondary">

                     <li class="nav-item  <?php if ($this->uri->segment(2) == 'dashboard') {
                                                echo 'active';
                                            } ?>">
                         <a href="<?= base_url('admin/dashboard') ?>" class="collapsed" aria-expanded="false">
                             <i class="fas fa-home"></i>
                             <p>Dashboard</p>
                         </a>

                     </li>

                     <li class="nav-section">
                         <span class="sidebar-mini-icon">
                             <i class="fa fa-ellipsis-h"></i>
                         </span>
                         <h4 class="text-section">Web</h4>
                     </li>

                     <li class="nav-item <?php if ($this->uri->segment(2) == 'post') {
                                                echo 'active';
                                            }  ?>">
                         <a data-bs-toggle="collapse" href="#post">
                             <i class="fab fa-telegram-plane"></i>
                             <p>Post</p>
                             <span class="caret"></span>
                         </a>
                         <div class="collapse" id="post">
                             <ul class="nav nav-collapse">
                                 <li class="<?php if ($this->uri->segment(3) == 'list') {
                                                echo 'active';
                                            } ?>">
                                     <a href="<?= base_url('app-admin/post/post_list') ?>">
                                         <span class="sub-item">List Post</span>
                                     </a>
                                 </li>
                                 <!-- <li class="<?php if ($this->uri->segment(3) == 'comment') {
                                                        echo 'active';
                                                    } ?>">
                                     <a href="<?= base_url('admin/post/comment/') ?>">
                                         <span class="sub-item">Comment</span>
                                     </a>
                                 </li> -->
                                 <li class="<?php if ($this->uri->segment(3) == 'kategori') {
                                                echo 'active';
                                            } ?>">
                                     <a href="<?= base_url('admin/post/kategori/') ?>">
                                         <span class="sub-item">Kategori</span>
                                     </a>
                                 </li>
                             </ul>
                         </div>
                     </li>

                     <!-- <li class="nav-item <?php if ($this->uri->segment(2) == 'catalog') {
                                                    echo 'active';
                                                } elseif ($this->uri->segment(2) == 'categori') ?>">
                         <a data-bs-toggle="collapse" href="#katalog">
                             <i class="fas fa-image"></i>
                             <p>Katalog</p>
                             <span class="caret"></span>
                         </a>
                         <div class="collapse" id="katalog">
                             <ul class="nav nav-collapse">
                                 <li class="<?php if ($this->uri->segment(2) == 'katalog/list') {
                                                echo 'active';
                                            } ?>">
                                     <a href="<?= base_url('admin/catalog/list') ?>">
                                         <span class="sub-item">Katalog</span>
                                     </a>
                                 </li>
                                 <li class="<?php if ($this->uri->segment(3) == 'category') {
                                                echo 'active';
                                            } ?>">
                                     <a href="<?= base_url('admin/catalog/category/') ?>">
                                         <span class="sub-item">kategori</span>
                                     </a>
                                 </li>

                             </ul>
                         </div>
                     </li> -->


                     <li class="nav-item  <?php if ($this->uri->segment(2) == 'about') {
                                                echo 'active';
                                            } elseif ($this->uri->segment(2) == 'service') {
                                                echo 'active';
                                            } elseif ($this->uri->segment(2) == 'portfolio') {
                                                echo 'active';
                                            } elseif ($this->uri->segment(2) == 'client') {
                                                echo 'active';
                                            } ?>">
                         <a data-bs-toggle="collapse" href="#pages">
                             <i class="far fa-clone"></i>
                             <p>Pages</p>
                             <span class="caret"></span>
                         </a>
                         <div class="collapse" id="pages">
                             <ul class="nav nav-collapse">
                                 <li class="<?php if ($this->uri->segment(2) == 'about') {
                                                echo 'active';
                                            } ?>">
                                     <a href="<?= base_url('app-admin/about/') ?>">
                                         <span class="sub-item">About</span>
                                     </a>
                                 </li>

                                 <li class="<?php if ($this->uri->segment(2) == 'service') {
                                                echo 'active';
                                            } ?>">
                                     <a href="<?= base_url('app-admin/service/') ?>">
                                         <span class="sub-item">Service</span>
                                     </a>
                                 </li>

                                 <li class="<?php if ($this->uri->segment(2) == 'portfolio') {
                                                echo 'active';
                                            } ?>">
                                     <a href="<?= base_url('app-admin/portfolio/') ?>">
                                         <span class="sub-item">Portfolio</span>
                                     </a>
                                 </li>
                                 <li class="<?php if ($this->uri->segment(2) == 'client') {
                                                echo 'active';
                                            } ?>">
                                     <a href="<?= base_url('app-admin/client/') ?>">
                                         <span class="sub-item">Client</span>
                                     </a>
                                 </li>
                                 <li class="<?php if ($this->uri->segment(2) == 'features') {
                                                echo 'active';
                                            } ?>">
                                     <a href="<?= base_url('app-admin/features/') ?>">
                                         <span class="sub-item">Features</span>
                                     </a>
                                 </li>
                             </ul>
                         </div>
                     </li>


                     <li class="nav-item <?php if ($this->uri->segment(2) == 'pages_seo') {
                                                echo 'active';
                                            } ?>">
                         <a href="<?= base_url('app-admin/pages_seo/') ?>">
                             <i class="fas fa-layer-group"></i>
                             <p>Pages Seo</p>
                         </a>

                     </li>
                     <li class="nav-item <?php if ($this->uri->segment(2) == 'whatsnav') {
                                                echo 'active';
                                            } ?>">
                         <a href="<?= base_url('app-admin/whatsnav/') ?>">
                             <i class="fab fa-whatsapp"></i>
                             <p>Whatsapp Navigasi</p>
                         </a>

                     </li>
                     <li class="nav-item <?php if ($this->uri->segment(2) == 'slider') {
                                                echo 'active';
                                            } ?>">
                         <a href="<?= base_url('app-admin/slider/') ?>">
                             <i class="fas fa-exchange-alt"></i>
                             <p>Slide</p>
                         </a>

                     </li>

                     <li class="nav-item <?php if ($this->uri->segment(2) == 'message') {
                                                echo 'active';
                                            } ?>">
                         <a href="<?= base_url('app-admin/message/') ?>">
                             <i class="fa fa-envelope"></i>
                             <p>Message</p>
                         </a>
                     </li>

                     <li class="nav-item <?php if ($this->uri->segment(2) == 'quote') {
                                                echo 'active';
                                            } ?>">
                         <a href="<?= base_url('app-admin/quote/') ?>">
                             <i class="fa fa-handshake"></i>
                             <p>Patner</p>
                         </a>
                     </li>

                     <li class="nav-item <?php if ($this->uri->segment(2) == 'request') {
                                                echo 'active';
                                            } ?>">
                         <a href="<?= base_url('app-admin/request/') ?>">
                             <i class="fa fa-briefcase"></i>
                             <p>Request</p>
                         </a>
                     </li>









                     <li class="nav-section">
                         <span class="sidebar-mini-icon">
                             <i class="fa fa-ellipsis-h"></i>
                         </span>
                         <h4 class="text-section">Administrasi</h4>
                     </li>
                     <?php if ($user['role_id'] == 1) : ?>
                         <li class="nav-item <?php if ($this->uri->segment(2) == 'project') {
                                                    echo 'active';
                                                } ?>">
                             <a href="<?= base_url('admin/project/') ?>">
                                 <i class="fas fa-clipboard"></i>
                                 <p>Project</p>
                             </a>
                         </li>


                         <li class="nav-item <?php if ($this->uri->segment(2) == 'stock') {
                                                    echo 'active';
                                                } ?>">
                             <a data-bs-toggle="collapse" href="#stkb">
                                 <i class="fas fa-shopping-basket"></i>
                                 <p>Mangment Stock</p>
                                 <span class="caret"></span>
                             </a>
                             <div class="collapse" id="stkb">
                                 <ul class="nav nav-collapse">
                                     <li class="<?php if ($this->uri->segment(3) == 'data_barang') {
                                                    echo 'active';
                                                } ?>">
                                         <a href="<?= base_url('app-admin/stock/data_barang') ?>">
                                             <span class="sub-item">Stock Barang</span>
                                         </a>
                                     </li>
                                     <li class="<?php if ($this->uri->segment(3) == 'in_stock') {
                                                    echo 'active';
                                                } ?>">
                                         <a href="<?= base_url('app-admin/stock/in_stock') ?>">
                                             <span class="sub-item">In Stock</span>
                                         </a>
                                     </li>
                                     <li class="<?php if ($this->uri->segment(3) == 'out_stock') {
                                                    echo 'active';
                                                } ?>">
                                         <a href="<?= base_url('app-admin/stock/out_stock') ?>">
                                             <span class="sub-item">Out Stock</span>
                                         </a>
                                     </li>
                                 </ul>
                             </div>
                         </li>
                     <?php endif ?>




                     <?php if ($user['role_id'] == 1) : ?>
                         <li class="nav-item <?php if ($this->uri->segment(2) == 'app') {
                                                    echo 'active';
                                                } elseif ($this->uri->segment(2) == 'app_medsos') {
                                                    echo 'active';
                                                } elseif ($this->uri->segment(2) == 'users') {
                                                    echo 'active';
                                                } elseif ($this->uri->segment(2) == 'kategori') {
                                                    echo 'active';
                                                } ?>">
                             <a data-bs-toggle="collapse" href="#set">
                                 <i class="fas fa-fw fa-cog"></i>
                                 <p>Setting</p>
                                 <span class="caret"></span>
                             </a>
                             <div class="collapse" id="set">
                                 <ul class="nav nav-collapse">
                                     <li class="<?php if ($this->uri->segment(2) == 'app') {
                                                    echo 'active';
                                                }  ?>">
                                         <a href="<?= base_url('app-admin/app/') ?>">
                                             <span class="sub-item">App</span>
                                         </a>
                                     </li>
                                     <li class="<?php if ($this->uri->segment(2) == 'app_medsos') {
                                                    echo 'active';
                                                } ?>">
                                         <a href="<?= base_url('app-admin/app_medsos/') ?>">
                                             <span class="sub-item">App Medsos</span>
                                         </a>
                                     </li>
                                     <li class=" <?php if ($this->uri->segment(2) == 'users') {
                                                        echo 'active';
                                                    } ?>">
                                         <a href="<?= base_url('app-admin/users/') ?>">
                                             <span class="sub-item">Users</span>
                                         </a>
                                     </li>


                                     <li class="<?php if ($this->uri->segment(2) == 'plugin') {
                                                    echo 'active';
                                                } ?>">
                                         <a href="<?= base_url('admin/plugin/') ?>">
                                             <span class="sub-item">Plugin</span>
                                         </a>
                                     </li>

                                 </ul>
                             </div>
                         </li>
                     <?php endif ?>

                 </ul>
             </div>
         </div>
     </div>