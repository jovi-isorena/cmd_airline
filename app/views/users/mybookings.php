<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<pre><?php //var_dump($data);?></pre>
<div class="container full-h pb-5">
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
                                    echo $booking->creation_date->format('M j Y g:i a');?>
                            </span>
                            <br>
                            <span class="small text-muted font-weight-bold">
                                Status: <?php 
                                    echo $booking->reservation_status;?>
                            </span>
                        
                        </div>
                        <div class="col-6 justify-content-end">
                            <div class="btn btn-primary" data-link="<?php echo $booking->reservation_id;?>" name="viewDetail">View Details</div>
                            
                            <!-- <div class="btn btn-danger">Cancel Booking</div> -->
                            <button class="btn btn-danger" data-toggle="modal" data-target="#cancelModal<?php echo $booking->reservation_id;?>">Cancel Booking</button>

                            <div class="modal fade" id="cancelModal<?php echo $booking->reservation_id;?>" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="cancelModalLabel<?php echo $flight->id;?>">Notice on Cancellation</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>You are about to cancel a rebooking. Please be aware that this operation may apply additional charges depending on the date of the flight and fare type.</p>
                                            <p> Also, you unable to reactivate the booking once it is cancelled.</p>
                                            <p>Are you sure you want to continue?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="<?php echo URLROOT . "/reservations/cancel/" . $booking->reservation_id;?>" class="btn btn-secondary">Yes</a>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body d-none" id="<?php echo $booking->reservation_id;?>">
                    
                    <div class="row justify-content-around">
                    <?php foreach($booking->flights as $flight):?>
                        
                        <div class="hover-lightblue p-3 col-5 border rounded">
                            <h5><?php echo $flight->flight_detail->airport_origin . " TO " . $flight->flight_detail->airport_destination;?></h5>
                            <p>Flight Number: <?php echo $flight->flight_detail->flight_no;?></p>
                            <p>Flight Date: <?php echo $flight->flight_date->format('M j Y');?></p>
                            <p>Departure Time: <?php echo $flight->schedule_detail->departure_time->format('g:i a');?></p>
                            <p>Passenger(s):</p>
                            
                            <?php foreach($flight->passengers as $passenger):?>
                                <p>Name: <?php echo $passenger->firstname . " " . $passenger->lastname?></p>
                                <p></p>    
                            <?php endforeach;?>
                            <div class="row <?php echo ($booking->reservation_status == 'cancelled')?'d-none':'';?>">
                                
                                <div class="btn-group dropright mx-3">
                                    <a href="<?php echo URLROOT . "/tickets/flightTicket/" . $flight->id?>" target="_blank" class="btn btn-success" style="font-size: 1.3em;">Print Ticket</a>
                                    <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu ">
                                        <a class="dropdown-item" href="#" class="btn btn-success">Open & Print</a>
                                        
                                    </div>
                                </div>
                                <button class="btn btn-info" data-toggle="modal" data-target="#rebookModal<?php echo $flight->id;?>">Rebook</button>
                            </div>
                            <div class="modal fade" id="rebookModal<?php echo $flight->id;?>" tabindex="-1" role="dialog" aria-labelledby="rebookModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel<?php echo $flight->id;?>">Notice on Rebooking</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>You are about to initiate a rebooking. Please be aware that this operation may apply additional charges depending on the date of the flight and fare type.</p>
                                            <p> Also, you can only change the flight number and/or flight date. Fare type is not adjustable.</p>
                                            <p>Are you sure you want to continue?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="<?php echo URLROOT . "/rebooks/initiate/" . $flight->id;?>" class="btn btn-secondary">Yes</a>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div> 
                        
                        <?php endforeach;?>
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