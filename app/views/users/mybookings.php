<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<pre><?php //var_dump($data);?></pre>
<div class="container full-h">
    <div class="row">
        <h1><?php echo $data['title'];?></h1>
    </div>
    <div class="row">
        <div class="col">
        <?php if(sizeof($data['bookings']) <= 0):?>
            <h5>No bookings made :(</h5>
        <?php endif;?>
        <?php foreach($data['bookings'] as $booking):?>
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-6">
                            <h2>
                                <?php
                                    $newId = "0000" . $booking->reservation_id;
                                    $newId = "CMD".substr($newId, strlen($newId) - 5, 5);
                                    echo $newId;
                                    ?>
                            </h2>
                            <span class="small text-muted">
                                Created on: <?php 
                                    //$created = new DateTime($booking['creation_date']);            
                                    echo $booking->creation_date->format('M j Y g:i a');?>
                            </span>
                        
                        </div>
                        <div class="col-6 justify-content-end">
                            <div class="btn btn-primary" data-link="<?php echo $booking->reservation_id;?>" name="viewDetail">View Details</div>
                            <div class="btn btn-info">Rebook</div>
                            <div class="btn btn-danger">Cancel Booking</div>
                        </div>
                    </div>
                </div>
                <div class="card-body d-none" id="<?php echo $booking->reservation_id;?>">
                    
                    <?php foreach($booking->flights as $flight):?>
                    <div class="hover-lightblue">
                        <h5><?php echo $flight->flight_detail->airport_origin . " TO " . $flight->flight_detail->airport_destination;?></h5>
                        <p>Flight Number: <?php echo $flight->flight_detail->flight_no;?></p>
                        <p>Flight Date: <?php echo $flight->flight_date->format('M j Y');?></p>
                        <p>Departure Time: <?php echo $flight->schedule_detail->departure_time->format('g:i a');?></p>
                        <p>Passenger(s):</p>
                        
                        <?php foreach($flight->passengers as $passenger):?>
                            <p>Name: <?php echo $passenger->firstname . " " . $passenger->lastname?></p>
                            <p></p>    
                        <?php endforeach;?>
                    </div> 
                    <?php endforeach;?>
                    <div class="row">
                        <div class="btn btn-sm custom-primary">
                            Print Ticket
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
        </div>
    </div>
</div>


<?php require APPROOT . '/views/includes/foot.php'; ?>

<script type="text/javascript">
    const details = document.getElementsByName("viewDetail");

    for(const btn of details){
        btn.onclick = ()=>{
            document.getElementById(btn.getAttribute("data-link")).classList.toggle("d-none");
        }
    }
</script>