<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!--   Core JS Files   -->
<script src="<?= base_url() ?>assets/admin/js/core/jquery-3.7.1.min.js"></script>
<script src="<?= base_url() ?>assets/admin/js/core/popper.min.js"></script>
<script src="<?= base_url() ?>assets/admin/js/core/bootstrap.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="<?= base_url() ?>assets/admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

<!-- Chart JS -->
<script src="<?= base_url() ?>assets/admin/js/plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="<?= base_url() ?>assets/admin/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="<?= base_url() ?>assets/admin/js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="<?= base_url() ?>assets/admin/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="<?= base_url() ?>assets/admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- jQuery Vector Maps -->
<script src="<?= base_url() ?>assets/admin/js/plugin/jsvectormap/jsvectormap.min.js"></script>
<script src="<?= base_url() ?>assets/admin/js/plugin/jsvectormap/world.js"></script>

<!-- Sweet Alert -->
<script src="<?= base_url() ?>assets/admin/js/plugin/sweetalert/sweetalert.min.js"></script>
<script src="<?= base_url() ?>assets/admin/lib/summernote/summernote-lite.min.js"></script>
<!-- Kaiadmin JS -->
<script src="<?= base_url() ?>assets/admin/js/kaiadmin.min.js"></script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="<?= base_url() ?>assets/admin/js/setting-demo.js"></script>
<!--<script src="<?= base_url() ?>assets/admin/js/demo.js"></script>-->
<!--<script>-->

<script>
    function colorheadlogo(color) {

        $.ajax({
            url: "<?php echo site_url('admin/navigasi/colorheadlogo/') ?>" + color,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if (data.status == '00') {
                    window.location.reload();
                } else {
                    window.location.reload();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error data switch');
            }
        });

    }

    function colornav(color) {

        $.ajax({
            url: "<?php echo site_url('admin/navigasi/colornav/') ?>" + color,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if (data.status == '00') {
                    window.location.reload();
                } else {
                    window.location.reload();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error data switch');
            }
        });

    }

    function colorside(color) {

        $.ajax({
            url: "<?php echo site_url('admin/navigasi/colorside/') ?>" + color,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if (data.status == '00') {
                    window.location.reload();
                } else {
                    window.location.reload();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error data switch');
            }
        });

    }
</script>