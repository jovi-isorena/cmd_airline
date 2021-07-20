<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<pre><?php //var_dump($data);?></pre>
<?php
    $fares = [];
    foreach($data['fareMatrix']['flights'] as $fl){
        $fares = array_merge($fares, array_values($fl));
    }
    $minFare = sizeof($fares) > 0 ?min($fares): 9999;
    
?> 
<div class="container full-h">
    <ol class="progress custom-ol" style="height:fit-content;">
        <li class="is-active">Select Date and Flight</li>
        <li>Choose Seats</li>
        <li>Confirm</li>
        <li>Complete</li>
    </ol>
    <div class="row">
        <h1><?php echo $data['title']?></h1>
    </div>
    <div class="row w-100 p-0">
        <form action="<?php echo URLROOT;?>/rebooks/initiate/<?php echo $data['reservedFlight']->id;?>" method="post" class="w-100" id="myForm">
            <input type="hidden" name="selectedDate" id="selectedDate" value="<?php echo $data['selectedDate']->format('Y-m-d');?>">
            <input type="hidden" name="origin" value="<?php echo $data['reservedFlight']->scheduleDetail->airport_origin;?>">
            <input type="hidden" name="destination" value="<?php echo $data['reservedFlight']->scheduleDetail->airport_destination;?>">
            <input type="hidden" name="selectedFlight" id="selectedFlight" value="<?php echo $data['selectedFlight']?>">
            <input type="hidden" name="selectedFare" id="selectedFare" value="<?php echo $data['selectedFare']?>">
            <input type="hidden" name="currentDate" id="currentDate" value="<?php echo $data['reservedFlight']->flight_date;?>">
            <input type="hidden" name="currentFlight" id="currentFlight" value="<?php echo $data['reservedFlight']->schedule_id;?>">
            <input type="hidden" name="currentFare" id="currentFare" value="<?php echo $data['reservedFlight']->fare_id;?>">

            
            <div class="row mb-5 justify-content-center">
                <div class="form-group col-auto">
                    <label for="newDate" >Select New Date: </label>
                    <input type="date" class="custom-date" name="newDate" id="newDate" min=<?php echo date("Y-m-d");?> value=<?php echo max($data['selectedDate']->format('Y-m-d'),date("Y-m-d")); ?>>
                    <input type="submit" value="Find Flight" class="btn custom-primary" name="btnNewDate">
                </div>
            </div>
            <div class="date-row text-center mb-3" style="background-color: lightgray;">
                <h5>
                    <?php 
                        echo $data['selectedDate']->format('F Y');
                    ?>
                </h5>
                <ul class="nav nav-tabs justify-content-around" >
                <?php foreach($data['result'] as $result):?>
                    <?php 
                        $key = array_search($result, $data['result']);
                        $date = new DateTime($key);
                        ?>
                    <li class="nav-item">
                        <?php $isSameDate = $date->format('Y-m-d') == $data['selectedDate']->format('Y-m-d');?>
                        <button 
                        type="submit" 
                        name="deptDate" 
                        class="nav-link h-100 px-4 pt-2 m-0 <?php echo $isSameDate?'active':''; 
                            echo ($result->minimum_price == null || $isSameDate)?'':'dateResult';?>" 
                            value="<?php echo $date->format('Y-m-d');?>" 
                            <?php echo ($result->minimum_price == null || $isSameDate)?'disabled':'';?>>
                            <span class="text-uppercase font-weight-bold"><?php echo $date->format('D d');?></span>
                            <hr class="m-0">
                            
                            <?php echo ($result->minimum_price == null)?'Not<br>Available':'from USD<br>'.$result->minimum_price;?>

                        </button>
                    </li>
                <?php endforeach;?>
                    
                </ul>

            </div>
            <div class="row">
                <h3>Select Departure Flight</h3>
                <span class="text-danger">* <?php echo $data['flightError'];?></span>
            </div>
            <div class="row p-0 m-0 justify-content-center" >
                <div class="col-4 p-0">
                    <span class="col-6">
                        <i class="fas fa-tag text-danger" style="transform: rotate(90deg); "></i> Lowest Fares
                    </span>
                    <span class="col-6">
                        <img src="<?php echo URLROOT . '/public/img/baseline_check_circle_outline_black_18dp.png'?>"/> Selection
                    </span>
                </div>
                <?php foreach($data['fareList'] as $fare):?>
                    <div class="col px-0 py-3 text-center border border-dark">
                        <?php echo $fare;?>
                    </div>
                <?php endforeach;?>
            </div>
            <div class="row p-0 m-0 justify-content-center" id="deptFlightResult">
                <?php foreach($data['flights'] as $flight):?>
                    <div class="flightDetail row w-100 justify-content-center p-3 my-3">
                        <div class="col-4 p-0">
                            <div>
                                <span class="font-weight-bold">
                                    <?php 
                                        $departureTime = new DateTime($flight->departure_time);

                                        echo $departureTime->format('h:i A');
                                    ?>
                                </span>
                                <span><?php echo $flight->origin_name;?></span>
                                <span>(<?php echo $flight->airport_origin;?>)</span>
                            </div>
                            <div>
                                <span class="w-100 text-center">TO</span>
                            </div>
                            <div>
                                <span class="font-weight-bold">
                                    <?php 
                                        $arrivalTime = new DateTime($flight->departure_time);
                                        $arrivalTime->add(new DateInterval("PT".$flight->duration_minutes."M"));
                                        echo $arrivalTime->format('h:i A');
                                    ?>
                                </span>
                                <span><?php echo $flight->destination_name;?></span>
                                <span>(<?php echo $flight->airport_destination;?>)</span>
                            </div>
                            <div>
                                <span>Duration:</span>
                                <span class="font-weight-bold"><?php echo floor(intval($flight->duration_minutes)/60) . 'H ' . intval($flight->duration_minutes)%60 . 'M';?></span>
                            </div>
                            <div>
                                <span> Flight Number:</span>
                                <span class="font-weight-bold"><?php echo $flight->flight_no;?></span>
                            </div>
                        </div>
                        <?php foreach($data['fareList'] as $fare):?>
                            <div class="col px-2">
                                <label for="<?php echo $flight->schedule_id.$fare;?>" 
                                class="text-center rounded w-100 h-100 fare <?php echo ($data['selectedFlight']==$flight->schedule_id) && ($data['selectedFare']==$fare)?'selectedFareBox ' :''; echo $data['fareMatrix']["flights"][$flight->schedule_id][$fare] === "Not Available"?' disabledFareBox':'fareBox';?>">
                                    <input class="d-none" type="radio" <?php echo $data['fareMatrix']["flights"][$flight->schedule_id][$fare] === "Not Available"?'':'name="deptFareMatrix"';?> id="<?php echo $flight->schedule_id.$fare;?>" data-flight="<?php echo $flight->schedule_id;?>" data-fare="<?php echo $flight->fares[array_search($fare, array_column($flight->fares, "name"))]->id;?>" <?php echo $data['fareMatrix']["flights"][$flight->schedule_id][$fare] === "Not Available"?'disabled':'';?>>
                                    
                                    <div class="col pt-5">
                                        <?php if($data['fareMatrix']["flights"][$flight->schedule_id][$fare] === $minFare):?>
                                            <i class="fas fa-tag text-danger" style="transform: rotate(90deg); "></i>
                                        <?php endif;?>
                                        <?php echo $data['fareMatrix']["flights"][$flight->schedule_id][$fare];
                                            
                                            if( ($data['selectedDate']->format('Y-m-d') == $data['reservedFlight']->flight_date) && 
                                            ($data['reservedFlight']->schedule_id == $flight->schedule_id) &&
                                            ($data['reservedFlight']->fare_id == $flight->fares[array_search($fare, array_column($flight->fares, "name"))]->id)){
                                                echo '<div><span class="font-weight-bold text-danger">(Current Flight)</span></div>';
                                            }
                                        ?>

                                    </div>
                                </label>
                            </div>
                        <?php endforeach;?>
                    </div>
                <?php endforeach;?>
            </div>
            <div class="row w-100 justify-content-end mb-5">
                <input type="submit" name="continue" class="btn custom-primary rounded d-none" id="btnContinue" value="CONTINUE" >
            </div>
               
        </form>
    </div>
</div>

<?php require APPROOT . '/views/includes/foot.php'; ?>
<script src="<?php echo URLROOT . "/public/js/";?>rebook-selection.js"></script>