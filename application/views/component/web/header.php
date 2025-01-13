<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('component/web/meta'); ?>
<?php $this->load->view('component/web/cssfile'); ?>

<?php
$query = $this->db->get('set_plugin')->result();
?>
<?php foreach ($query as $plg): ?>
    <?= $plg->plugin ?>
<?php endforeach ?>