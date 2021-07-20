<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<pre>
<?php //var_dump($data);?>
</pre>

<div class="container full-h">
    <ol class="progress custom-ol" style="height:fit-content;">
        <li class="completed">Select Date and Flight</li>
        <li class="completed">Choose Seats</li>
        <li class="is-active">Confirm</li>
        <li>Complete</li>
    </ol>
    <div class="row">
        <h1><?php echo $data['title']?></h1>
        <p>Please review all details before continuing. Once the change has been applied, there will be no guarantee you will be able to get back the previous booking. </p>
    </div>
    <div class="alert alert-info border border-info rounded w-50">
        <span class="font-weight-bold text-secondary">In gray text: </span> Current values<br>
        <span class="font-weight-bold text-success">In green text: </span> No changes/Same value<br>
        <span class="font-weight-bold text-danger">In red text: </span> New values<br>

    </div>
    <div class="row">
        <?php $oldDate = new DateTime($data['rebookData1'][1]->flight_date); //formatting purpose?>
        <div class="col-4">
            <h3>Current Flight</h3>
            Flight Number: <span class="font-weight-bold text-secondary"><?php echo $data['rebookData1'][1]->scheduleDetail->flight_no?></span><br>
            Departure Date: <span class="font-weight-bold text-secondary"><?php echo $oldDate->format("M d Y");?></span><br>
            Fare Price (per person): <span class="font-weight-bold text-secondary"><?php echo $data['rebookData1'][1]->fareDetail->price;?></span>
            <h5>Passenger's Seat</h5>
            <?php foreach($data['rebookData1'][1]->passengers as $passenger):
                
            ?>
                <div><?php echo $passenger->firstname . " "  . $passenger->lastname . ": ";?><span class="font-weight-bold text-secondary"><?php echo $passenger->seat[0]->seat_number;?></span></div>
            <?php endforeach;?>
        </div>
        <div class="col-2 h-100 " style="padding-top: 40px;">
            <img src="<?php echo URLROOT; ?>/public/img/upward-arrow.png" alt="" style="transform: rotate(90deg)" class="align-self-center m-auto">
        </div>
        <div class="col-4">
            <h3>New Flight</h3>
            Flight Number: <span class="font-weight-bold <?php echo ($data['rebookData1'][1]->scheduleDetail->flight_no==$data['rebookData2']['newFlightDetail']->flight_no)?'text-success':'text-danger';?>"><?php echo $data['rebookData2']['newFlightDetail']->flight_no;?></span><br>
            Departure Date: <span class="font-weight-bold <?php echo ($oldDate->format("M d Y")==$data['rebookData2']['newDate']->format("M d Y"))?'text-success':'text-danger';?>"><?php echo $data['rebookData2']['newDate']->format("M d Y");?></span><br>
            Fare Price (per person): <span class="font-weight-bold <?php echo ($data['rebookData1'][1]->fareDetail->price==$data['rebookData2']['newFareDetail']->price)?'text-success':'text-danger';?>"><?php echo $data['rebookData2']['newFareDetail']->price;?></span>
            <h5>Passenger's Seat</h5>
            <?php foreach($data['rebookData1'][1]->passengers as $key=>$passenger):?>
                <div><?php echo $passenger->firstname . " " . $passenger->lastname . ": ";?><span class="font-weight-bold <?php echo ($passenger->seat[0]->seat_number==$data['rebookData3']['newSeats'][$key])?'text-success':'text-danger';?>"><?php echo $data['rebookData3']['newSeats'][$key];?></span></div>
            <?php endforeach;?>
        </div>
    </div>
    <div class="row justify-content-right w-100">
        <form action="<?php echo URLROOT;?>/rebooks/confirm" method="post" class="w-100">
            <div class="row justify-content-end m-5 w-100">
                <input type="submit" name="continue" class="btn custom-primary rounded ml-auto" id="btnContinue" value="CONTINUE" >
            </div>
                
        </form>
    </div>
</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>
