<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$app = $this->db->get_where('set_app', ['id' => 1])->row_array();
$colorheadlogo = $this->db->get_where('template_color', ['id' => 1])->row_array();
$colornav = $this->db->get_where('template_color', ['id' => 2])->row_array();
$colorside = $this->db->get_where('template_color', ['id' => 3])->row_array();
$color = $this->db->get('color')->result();
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

<div class="custom-template">
    <div class="title">Settings</div>
    <div class="custom-content">
        <div class="switcher">
            <div class="switch-block">
                <h4>Logo Header</h4>
                <div class="btnSwitch">


                    <?php foreach ($color as $c): ?>
                        <button onclick="colorheadlogo('<?= $c->color ?>')" type="button" class="<?php if ($c->color == $colorheadlogo['color']) {
                                                                                                        echo 'selected';
                                                                                                    } ?>" data-color="<?= $c->color ?>"></button>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="switch-block">
                <h4>Navbar Header</h4>
                <div class="btnSwitch">

                    <?php foreach ($color as $c): ?>
                        <button onclick="colornav('<?= $c->color ?>')" type="button" class="<?php if ($c->color == $colornav['color']) {
                                                                                                echo 'selected';
                                                                                            } ?>" data-color="<?= $c->color ?>"></button>
                    <?php endforeach ?>

                </div>
            </div>
            <div class="switch-block">
                <h4>Sidebar</h4>
                <div class="btnSwitch">

                    <button onclick="colorside('white')" type="button" class="<?php if ('white' == $colorside['color']) {
                                                                                    echo 'selected';
                                                                                } ?>" data-color="white"></button>
                    <button onclick="colorside('dark')" type="button" class="<?php if ('dark' == $colorside['color']) {
                                                                                    echo 'selected';
                                                                                } ?>" data-color="dark"></button>
                    <button onclick="colorside('dark2')" type="button" class="<?php if ('dark2' == $colorside['color']) {
                                                                                    echo 'selected';
                                                                                } ?>" data-color="dark2"></button>
                </div>
            </div>
        </div>
    </div>
    <div class="custom-toggle">
        <i class="icon-settings"></i>
    </div>
</div>

</div>
<?php $this->load->View('component/admin/jsfile'); ?>