<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style>
    * {
        box-sizing: border-box;
    }



    inbox {
        margin: auto;
    }

    inbox-list {
        display: flex;
        width: 100%;
        flex-direction: column;
    }

    message-item {
        /* width: 100%; */
        padding: 1rem;
        margin-bottom: 0.5rem;
        cursor: pointer;
        position: relative;
        opacity: 0.4;

        &.unread {
            background: lighten($color-8, 8%);
            opacity: 0.8;

            &:hover {
                opacity: 1;
            }

            .subject {
                font-weight: 600;
            }
        }

        &:last-child {
            margin-bottom: 0;
        }

        .checkbox {
            position: absolute;

            top: 1.2rem;
            left: 0.9rem;
        }

        header,
        main {
            margin-left: 2rem;
        }

        header {
            display: flex;
            justify-content: space-between;
            font-size: 1rem;
            color: #001E33;
        }

        .sender-info {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .subject {}

        .from {
            font-size: 0.8rem;
        }

        .time {
            font-weight: normal;
            font-size: 0.8rem;
        }

        main {
            p {
                width: 100%;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                font-size: 0.8rem;
                color: #7e93a4;
                margin-bottom: 0;
            }
        }
    }
</style>
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
                <!-- <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="javascript:void()">Portfolio</a>
                </li> -->

            </ul>
        </div>
        <div class="page-category">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">All Message</h4>

                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div id="listdata">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('admin/message/js'); ?>