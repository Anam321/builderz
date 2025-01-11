<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$app = $this->db->get_where('set_app', ['id' => 1])->row_array();
?>

<footer class="footer">
    <div class="container-fluid d-flex justify-content-between">

        <div class="copyright">
            2024,<i class="fa fa-heart heart text-danger"></i> by
            <a href="<?= $app['site'] ?>"><?= $app['nama_web'] ?></a>
        </div>
        <div>
            Distributed by
            <a target="_blank" href="https://saepulanam.my.id">Vortex</a>.
        </div>
    </div>
</footer>
</div>

</div>
<?php $this->load->View('component/admin/jsfile'); ?>