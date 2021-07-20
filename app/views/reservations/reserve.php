<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
    
?>

<pre><?php 
// var_dump($data);
//var_dump($_SESSION['reservation']['step7']);
?></pre>
<div class="done-Bg">
    
</div>
<div class="container full-h">
    <ol class="progress custom-ol" style="height:fit-content;">
        <li class="completed">Select Date</li>
        <li class="completed">Select Flight</li>
        <li class="completed">Passengers</li>
        <li class="completed">Choose Seats</li>
        <li class="completed">Add Extras</li> 
        <li class="completed">Payment</li>
        <li class="is-active">Complete</li>
    </ol>
    <div class="alert alert-success text-success p-5 m-auto" role="alert">
        <div>
            <h4 class="alert-heading">Congratulations!</h4>
            <p>Your flight has been successfully booked. </p><hr>
        </div>
        <a href="<?php echo URLROOT ?>/users/mybookings" class="btn btn-light rounded">View Bookings</a>
        <a href="#" class="btn custom-primary rounded">Print Tickets</a>
            
        
    </div>
</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>