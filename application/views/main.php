<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view($componen['header']); ?>
</head>

<body>

    <?php $this->load->view($componen['navbar']); ?>
    <?php $this->load->view($conten); ?>

    <?php $this->load->view($componen['footer']); ?>

</body>

</html>