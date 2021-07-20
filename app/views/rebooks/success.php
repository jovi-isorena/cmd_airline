<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<pre>
<?php 
// var_dump($data);
// echo $data['rebookData1'][1]->id;?>
</pre>
<div class="container full-h">
    <ol class="progress custom-ol" style="height:fit-content;">
        <li class="completed">Select Date and Flight</li>
        <li class="completed">Choose Seats</li>
        <li class="completed">Confirm</li>
        <li class="is-active">Complete</li>
    </ol>
    <div class="alert alert-success text-success p-5 m-auto" role="alert">
        <div>
            <h4 class="alert-heading">Congratulations!</h4>
            <p>Your flight has been successfully rebooked. </p><hr>
        </div>
        <a href="<?php echo URLROOT ?>/users/mybookings" class="btn btn-light rounded">View Bookings</a>
        <a href="#" class="btn custom-primary rounded">Print New Tickets</a>
            
        
    </div>
</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>
