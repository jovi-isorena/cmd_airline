<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<pre><?php var_dump($data);?></pre>

<div class="container full-h">
    <div class="col-9">
        <div class="row">
            <h1><?php echo $data['title']?></h1>
        </div>
        <div class="row">
            <div class="card w-100">
                <div class="card-header">
                    <h3 class="card-title"> Total to be paid is USD <span class="font-weight-bold"><?php echo $data['total'];?></span> <span class="btn btn-primary">Click here to view details</span></h3>
                </div>
                <div class="card-body">
                    <div class="row" id="billDetail">
                        <ul style="list-style: disc;">
                            <?php foreach($data['flights'] as $flight):?>
                                <li>
                                    <div class="row">
                                        <div class="col">
                                            <h5><?php echo $flight['flightDetail']->flight_no;?></h5>
                                            <ul>
                                                <?php foreach($flight['passengers'] as $passenger):?>
                                                    <li>
                                                        <?php echo $passenger['firstname'] . " " . $passenger['lastname'];?>
                                                    </li>
                                                <?php endforeach;?>
                                            </ul>
                                        </div>
                                        <div class="col text-align-right">
                                            <?php echo $flight['flightFare']->price;?>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
    </div>
</div>

<?php require APPROOT . '/views/includes/foot.php'; ?>