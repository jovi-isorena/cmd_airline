<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>

<div class="container full-h">
    <div class="row justify-content-between">
        <div class="col-3 p-3">
            <div class="dashboard-card bg-success">
                <h1><?php echo $data['dailyFlight'];?></h1>
                <p>Scheduled Flights Today</p>
            </div>
        </div>

        <div class="col-3 p-3">
            <div class="dashboard-card bg-info">
                <h1><?php echo $data['dailyReservation'];?></h1>
                <p>Total reservations today</p>
            </div>

        </div>
        <div class="col-3 p-3">
            <div class="dashboard-card bg-warning">
                <h1><?php echo $data['dailyRebook'];?></h1>
                <p>Total rebooks today</p>

            </div>
        </div>
        <div class="col-3 p-3">
            <div class=" dashboard-card bg-danger">
                <h1><?php echo $data['dailyCancel'];?></h1>
                <p>Total cancellations today</p>

            </div>
        </div>

    </div>

</div>



<?php require APPROOT . '/views/includes/foot.php'; ?>