<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<pre><?php //var_dump($data);?></pre>

<div class="container full-h">
    <h6>Passenger Count: <?php echo $data['passenger']?></h6>
    <form action="<?php echo URLROOT . "/reservations/passengers";?>" method="post">
        <fieldset>
            <legend>Personal Information</legend>

        </fieldset>
    </form>

</div>

<?php require APPROOT . '/views/includes/foot.php'; ?>