<?php
    require APPROOT . '/views/includes/head.php';
?>
<div class="section-landing">
    <?php
        require APPROOT . '/views/includes/navigation.php';
    ?>

    <h1><?php echo $data['title']; ?></h1>
    <?php var_dump($_SESSION); ?>
</div>