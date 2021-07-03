<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<pre><?php //var_dump($data);?></pre>
<?php
    $deptFares = [];
    $retFares = [];
    foreach($data['fareMatrix']['departureFlights'] as $fl){
        $deptFares = array_merge($deptFares, array_values($fl));
    }
    $minDeptFare = min($deptFares);
    if($data['flightType'] == "roundTrip"){
        foreach($data['fareMatrix']['returnFlights'] as $fl){
            $retFares = array_merge($retFares, array_values($fl));
        }
        $minRetFare = min($retFares);
    }
?> 
<div class="container full-h">

    <div class="row">
        <div class="col-9">
        </div>
        <div class="col-3">
        </div>
    </div>
    <div class="row w-100 p-0">
        <form action="<?php echo URLROOT;?>/reservations/select" method="post" class="w-100" id="myForm">
            <input type="hidden" name="passenger" value="<?php echo $data['passenger'];?>">
            <input type="hidden" name="cabinClass" value="<?php echo $data['cabinClass'];?>">
            <input type="hidden" name="flightType" value="<?php echo $data['flightType'];?>">
            <input type="hidden" name="selectedDeptDate" id="selectedDeptDate" value="<?php echo $data['dept']->format('Y-m-d');?>">
            <input type="hidden" name="selectedRetDate" id="selectedRetDate" value="<?php echo $data['ret']->format('Y-m-d');?>">
            <input type="hidden" name="deptOrigin" value="<?php echo $data['deptOrigin']->airport_code;?>">
            <input type="hidden" name="deptDestination" value="<?php echo $data['deptDestination']->airport_code;?>">
            <input type="hidden" name="selectedDeptFlight" id="selectedDeptFlight" value="<?php echo $data['deptFlight']?>">
            <input type="hidden" name="selectedRetFlight" id="selectedRetFlight" value="<?php echo $data['retFlight']?>">
            <input type="hidden" name="selectedDeptFare" id="selectedDeptFare" value="<?php echo $data['deptFare']?>">
            <input type="hidden" name="selectedRetFare" id="selectedRetFare" value="<?php echo $data['retFare']?>">
            <div class="date-row text-center mb-3" style="background-color: lightgray;">
                <h5>
                    <?php 
                        
                        // $date = new DateTime($data['ret']);
                        echo $data['dept']->format('F Y');
                        ?>
                </h5>
                <ul class="nav nav-tabs justify-content-around" >
                <?php foreach($data['resultDept'] as $result):?>
                    <?php 
                        $key = array_search($result, $data['resultDept']);
                        $date = new DateTime($key);
                        ?>
                    <li class="nav-item">
                        <?php $isSameDate = $date->format('Y-m-d') == $data['dept']->format('Y-m-d');?>
                        <button 
                        type="submit" 
                        name="deptDate" 
                        class="nav-link h-100 px-4 pt-2 m-0 <?php echo $isSameDate?'active':''; 
                            echo ($result->minimum_price == null || $isSameDate)?'':'dateResult';?>" 
                            value="<?php echo $date->format('Y-m-d');?>" 
                            <?php echo ($result->minimum_price == null || $isSameDate)?'disabled':'';?>>
                            <span class="text-uppercase font-weight-bold"><?php echo $date->format('D d');?></span>
                            <?php //echo $data['dept']->format('Y-m-d'); echo $date->format('Y-m-d');?>
                            <hr class="m-0">
                            
                            <?php echo ($result->minimum_price == null)?'Not<br>Available':'from USD<br>'.$result->minimum_price;?>

                        </button>
                    </li>
                <?php endforeach;?>
                    
                </ul>

            </div>
            <div class="row">
                <h3>Select Departure Flight</h3>
                <span class="text-danger">* <?php echo $data['deptFlightError'];?></span>
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
                <?php foreach($data['deptFareList'] as $fare):?>
                    <div class="col px-0 py-3 text-center border border-dark">
                        <?php echo $fare;?>
                    </div>
                <?php endforeach;?>
            </div>
            <div class="row p-0 m-0 justify-content-center" id="deptFlightResult">
                <?php foreach($data['deptFlights'] as $flight):?>
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
                        <?php foreach($data['deptFareList'] as $fare):?>
                            <div class="col px-2">
                                <label for="<?php echo $flight->schedule_id.$fare;?>" 
                                class="text-center rounded w-100 h-100 fare <?php echo ($data['deptFlight']==$flight->schedule_id) && ($data['deptFare']==$fare)?'selectedFareBox ' :''; echo $data['fareMatrix']["departureFlights"][$flight->schedule_id][$fare] === "Not Available"?' disabledFareBox':'fareBox';?>">
                                    <input class="d-none" type="radio" <?php echo $data['fareMatrix']["departureFlights"][$flight->schedule_id][$fare] === "Not Available"?'':'name="deptFareMatrix"';?> id="<?php echo $flight->schedule_id.$fare;?>" data-flight="<?php echo $flight->schedule_id;?>" data-fare="<?php echo $flight->fares[array_search($fare, array_column($flight->fares, "name"))]->id;?>" <?php echo $data['fareMatrix']["departureFlights"][$flight->schedule_id][$fare] === "Not Available"?'disabled':'';?>>
                                    
                                    <div class="col pt-5">
                                        <?php if($data['fareMatrix']["departureFlights"][$flight->schedule_id][$fare] === $minDeptFare):?>
                                            <i class="fas fa-tag text-danger" style="transform: rotate(90deg); "></i>
                                        <?php endif;?>
                                        <?php echo $data['fareMatrix']["departureFlights"][$flight->schedule_id][$fare];?>
                                    </div>
                                </label>
                            </div>
                        <?php endforeach;?>
                    </div>
                <?php endforeach;?>
            </div>
            <div class="row w-100 justify-content-end mb-5">
                <!-- <button class="btn btn-primary rounded">SAVE FARE</button> -->
            </div>
            <?php if($data['flightType'] == 'roundTrip'):?>
                <div class="date-row text-center mb-3" style="background-color: lightgray;">
                    <h5>
                        <?php 
                            
                            // $date = new DateTime($data['ret']);
                            echo $data['ret']->format('F Y');
                            ?>
                    </h5>
                    <ul class="nav nav-tabs justify-content-around">
                    <?php foreach($data['resultRet'] as $result):?>
                        <?php 
                            $key = array_search($result, $data['resultRet']);
                            $date = new DateTime($key);
                            ?>
                        <li class="nav-item">
                        <?php $isSameDate = $date->format('Y-m-d') == $data['ret']->format('Y-m-d');?>
                        <button 
                        type="submit" 
                        name="retDate" 
                        class="nav-link h-100 px-4 pt-2 m-0 <?php echo $isSameDate?'active':''; 
                            echo ($result->minimum_price == null || $isSameDate)?'':'dateResult';?>" 
                            value="<?php echo $date->format('Y-m-d');?>" 
                            <?php echo ($result->minimum_price == null || $isSameDate)?'disabled':'';?>>
                            <span class="text-uppercase font-weight-bold"><?php echo $date->format('D d');?></span>
                            <?php //echo $data['dept']->format('Y-m-d'); echo $date->format('Y-m-d');?>
                            <hr class="m-0">
                            
                            <?php echo ($result->minimum_price == null)?'Not<br>Available':'from USD<br>'.$result->minimum_price;?>

                        </button>
                    </li>
                    <?php endforeach;?>
                        
                    </ul>

                </div>
                <div class="row">
                    <h3>Select Return Flight</h3>
                    <span class="text-danger">* <?php echo $data['retFlightError'];?></span>
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
                <?php foreach($data['retFareList'] as $fare):?>
                    <div class="col px-0 py-3 text-center border border-dark">
                        <?php echo $fare;?>
                    </div>
                <?php endforeach;?>
            </div>
            <div class="row p-0 m-0 justify-content-center" id="retFlightResult">
                <?php foreach($data['retFlights'] as $flight):?>
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
                        <?php foreach($data['retFareList'] as $fare):?>
                            <div class="col px-2">
                                <label for="<?php echo $flight->schedule_id.$fare;?>" class="text-center rounded w-100 h-100 fare <?php echo ($data['retFlight']==$flight->schedule_id) && ($data['retFare']==$fare)?'selectedFareBox ':'';echo $data['fareMatrix']["returnFlights"][$flight->schedule_id][$fare] === "Not Available"?' disabledFareBox':'fareBox';?>">
                                    <input class="d-none" type="radio" <?php echo $data['fareMatrix']["returnFlights"][$flight->schedule_id][$fare] === "Not Available"?'':'name="retFareMatrix"';?> id="<?php echo $flight->schedule_id.$fare;?>" data-flight="<?php echo $flight->schedule_id;?>" data-fare="<?php echo $flight->fares[array_search($fare, array_column($flight->fares, "name"))]->id;;?>" <?php echo $data['fareMatrix']["returnFlights"][$flight->schedule_id][$fare] === "Not Available"?'disabled':'';?>>
                                    
                                    <div class="col pt-5">
                                        <?php if($data['fareMatrix']["returnFlights"][$flight->schedule_id][$fare] == $minRetFare):?>
                                            <i class="fas fa-tag text-danger justify-self-start" style="transform: rotate(90deg); "></i>
                                        <?php endif;?>
                                        <?php echo $data['fareMatrix']["returnFlights"][$flight->schedule_id][$fare];?>
                                    </div>
                                </label>
                            </div>
                        <?php endforeach;?>
                    </div>
                <?php endforeach;?>
            </div>
            <div class="row w-100 justify-content-end mb-5">
                <!-- <button class="btn btn-primary rounded">SAVE FARE</button> -->
            </div>
            <?php endif;?>
            <div class="row justify-content-end">
                <button type="submit" class="btn" style="background-color: #001e60;color:white;" name="continue">CONTINUE <i class="fas fa-caret-right"></i></button>
            </div>    
        </form>
    </div>
</div>

<?php require APPROOT . '/views/includes/foot.php'; ?>
<!-- <script src="<?php //echo URLROOT . "/public/js/";?>date-selection.js"></script> -->
<script src="<?php echo URLROOT . "/public/js/";?>date-selection2.js"></script>