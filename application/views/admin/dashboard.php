<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!-- Sale & Revenue Start -->

<style>
    .kotak {
        width: 200px;
        height: 60px;
        background-color: #009CFF;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 0 10px rgba(13, 110, 253, 0.2);
    }

    .clock {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .time {
        font-size: 36px;
        color: #ffff;
        font-family: 'Arial', sans-serif;
        letter-spacing: 2px;
        text-shadow: 0 0 10px rgba(0, 240, 255, 0.8);
        transition: all 0.5s cubic-bezier(0.6, 0.2, 0.1, 2);
    }
</style>




<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
                <h6 class="op-7 mb-2">Statistic Data <?= $app['nama_web'] ?></h6>
            </div>

        </div>
        <div class="row">

            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-sm-8">
                                <div class="kotak">
                                    <div class="clock">
                                        <div id="time" class="time"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <h6 class="mb-0"><?= longdate_indo(date('Y-m-d')) ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Visitors</p>
                                    <h4 class="card-title" id="jlmvisit"></h4>
                                </div>
                                <div class="numbers ms-5">
                                    <p class="card-category">Online</p>
                                    <h4 class="card-title" id="online"></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-warning bubble-shadow-small">
                                    <i class="fab fa-telegram-plane"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Post</p>
                                    <h4 class="card-title"><?= $jmlblog ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fab fa-whatsapp"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Klik Whatsapp</p>
                                    <h4 class="card-title" id="klik"></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        <div class="row">
            <div class="col-md-6">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Project Statistics</div>
                            <div class="card-tools">
                                <select id="yearSelect" class="form-control" style="width: 200px;">
                                    <?php
                                    for ($i = date('Y'); $i >= date('Y') - 32; $i -= 1) {
                                        echo "<option value='$i'> $i </option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="min-height: 375px">
                            <canvas id="myBar"></canvas>
                        </div>
                        <!-- <div id="myChartLegend"></div> -->
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">User Statistics</div>
                            <div class="card-tools">
                                <select id="select_blnVisit" class="form-control" style="width: 200px;">
                                    <?php $now = new \DateTime('now');
                                    $bln1 = $now->format('m');
                                    for ($m = 1; $m <= 12; ++$m) {
                                        if ($bln1 == $m) {
                                            echo '<option selected value=' . $m . '>' . date('F', mktime(0, 0, 0, $m, 1)) . '</option>' . "\n";
                                        } else {
                                            echo '<option  value=' . $m . '>' . date('F', mktime(0, 0, 0, $m, 1)) . '</option>' . "\n";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="min-height: 375px">
                            <canvas id="myChart"></canvas>
                        </div>
                        <!-- <div id="myChartLegend"></div> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card card-round">
                    <div class="card-body">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Post Populer</div>

                        </div>
                        <div class="card-list py-4">
                            <?php foreach ($populerblog as $populer) : ?>
                                <div class="item-list">
                                    <div class="avatar">
                                        <img style="width: 40px; height: 40px;"
                                            src="<?= base_url('assets/upload/post/') . $populer->images ?>"
                                            alt="<?= $populer->images ?>" class="avatar-img " />
                                    </div>
                                    <div class="info-user ms-3">
                                        <div class="username"><?= $populer->title ?></div>
                                        <div class="status"><?= $populer->visitor ?> Pengunjung</div>
                                    </div>
                                    <a target="_blank" href="<?= base_url('blog/') ?><?= $populer->slug ?>" class="btn btn-icon btn-link op-8 me-1">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>

                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Location Company</div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">

                        <iframe src="<?= $app['map'] ?>" width="600" height="450" style="border: 0; width: 100%"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<!-- Widgets End -->
<script src="<?= base_url() ?>assets/admin/lib/chart/chart.min.js"></script>

<script>
    function updateClock() {
        const date = new Date();
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        const seconds = String(date.getSeconds()).padStart(2, '0');

        const timeElement = document.getElementById("time");
        timeElement.textContent = `${hours}:${minutes}:${seconds}`;
    }
    setInterval(updateClock, 1000);

    function activityUsers() {
        $.ajax({
            url: "<?php echo site_url('admin/dashboard/activityUsers/') ?>",
            type: "POST",
            dataType: "JSON",

            success: function(data) {

                $('#jlmvisit').text(data.jlmvisit);
                $('#online').text(data.online);
                $('#klik').text(data.klik);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }
    // setInterval(activityUsers, 1000);
    $(document).ready(function() {
        activityUsers();
    });

    var myChart = null;
    var mybar = null;
    $(document).ready(function() {

        $('#select_blnVisit').change(function() {
            var bulanvisit = $(this).val();
            // var tahunvisit = $(this).val();
            $.ajax({
                url: "<?php echo base_url('admin/dashboard/get_visitorscahrt'); ?>",
                type: "POST",
                data: {
                    // tahunvisit: tahunvisit,
                    bulanvisit: bulanvisit
                },
                dataType: "json",
                success: function(data) {
                    var date = [];
                    var hits = [];
                    for (var i in data) {
                        date.push(data[i].date);
                        hits.push(data[i].hits);
                    }
                    var dataChart = {
                        labels: date,
                        datasets: [{
                            label: 'Pengunjung',
                            backgroundColor: 'rgba(0, 123, 255, 0.75)',
                            borderColor: 'rgba(0, 123, 255, 1)',
                            data: hits,
                        }]
                    };

                    var ctx2 = document.getElementById('myChart').getContext('2d');
                    if (myChart) {
                        myChart.destroy();
                    }
                    myChart = new Chart(ctx2, {
                        type: 'line',
                        data: dataChart
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    toastr.error('error code.....')
                }
            });
        });
        $('#select_blnVisit').trigger('change');


        $('#yearSelect').change(function() {
            var year = $(this).val();
            $.ajax({
                url: "<?php echo base_url('admin/dashboard/get_data'); ?>",
                type: "POST",
                data: {
                    year: year
                },
                dataType: "json",
                success: function(data) {
                    var bulan = [];
                    var jmlprj = [];
                    for (var i in data) {
                        bulan.push(data[i].bulan);
                        jmlprj.push(data[i].jmlprj);
                    }
                    var chartData = {
                        labels: bulan,
                        datasets: [{
                            label: 'Projek Tahun ' + year + '',
                            backgroundColor: 'rgba(0, 123, 255, 0.75)',
                            borderColor: 'rgba(0, 123, 255, 1)',
                            data: jmlprj,
                        }]
                    };

                    var ctx = document.getElementById('myBar').getContext('2d');
                    if (mybar) {
                        mybar.destroy();
                    }
                    mybar = new Chart(ctx, {
                        type: 'bar',
                        data: chartData
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    toastr.error('error code.....')
                }
            });
        });
        $('#yearSelect').trigger('change');

    });
</script>