<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<pre><?php //var_dump($data);?></pre>
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
            <div class="date-row text-center" style="background-color: lightgray;">
                <h5>
                    <?php 
                        
                        // $date = new DateTime($data['ret']);
                        echo $data['dept']->format('F Y');
                        ?>
                </h5>
                <ul class="nav nav-tabs justify-content-around">
                <?php foreach($data['resultDept'] as $result):?>
                    <?php 
                        $key = array_search($result, $data['resultDept']);
                        $date = new DateTime($key);
                        ?>
                    <li class="nav-item" style="width:auto;">
                        <?php $isSameDate = $date->format('Y-m-d') == $data['dept']->format('Y-m-d');?>
                        <button type="submit" name="selectedDeptDate" class="nav-link h-100 px-4 pt-2 <?php echo $isSameDate?'active':''; echo ($result->minimum_price == null || $isSameDate)?'':' dateResult';?>" value="<?php echo $date->format('Y-m-d');?>" <?php echo $isSameDate?'disabled':'';?>>
                            <span class="text-uppercase font-weight-bold"><?php echo $date->format('D d');?></span>
                            <?php //echo $data['dept']->format('Y-m-d'); echo $date->format('Y-m-d');?>
                            <hr class="m-0">
                            
                            <?php echo ($result->minimum_price == null)?'Not<br>Available':'from USD<br>'.$result->minimum_price;?>

                        </button>
                    </li>
                <?php endforeach;?>
                    
                </ul>

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
                <div class="col-4 p-0">
                </div>
                <div class="col-4 p-0">
                </div>
            </div>
            <div class="row p-0 m-0 justify-content-center" id="deptFlightResult">
                <?php foreach($data['deptFlights'] as $flight):?>
                    <div class="flightDetail row w-100 justify-content-center  my-3">
                        <div class="col-4 p-0">
                            <div>
                                <span class="font-weight-bold"><?php echo $flight->departure_time;?></span>
                                <span><?php echo $flight->origin_name;?></span>
                                <span>(<?php echo $flight->airport_origin;?>)</span>
                            </div>
                            <div>
                                <span class="w-100 text-center">TO</span>
                            </div>
                            <div>
                                <span class="font-weight-bold"><?php echo $flight->departure_time;?></span>
                                <span><?php echo $flight->destination_name;?></span>
                                <span>(<?php echo $flight->airport_destination;?>)</span>
                            </div>
                            <div>
                                <span>Duration:</span>
                                <span class="font-weight-bold"><?php echo $flight->duration_minutes;?></span>
                            </div>
                            <div>
                                <span> Flight Number:</span>
                                <span class="font-weight-bold"><?php echo $flight->flight_no;?></span>
                            </div>
                        </div>
                        <div class="col-4 px-2 ">
                            <div class="text-center w-100 h-100" style="box-shadow: 5px 2px 2px gray;background-color: lightgray;">
                                <span>PHP 5800</span>
                            </div>
                        </div>
                        <div class="col-4 px-2">
                            <div class="text-center w-100 h-100" style="box-shadow: 5px 2px 2px gray;background-color: lightgray;">
                                <span>PHP 5800</span>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
            <?php if($data['flightType'] == 'roundTrip'):?>
                <div class="date-row text-center" style="background-color: lightgray;">
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
                        <li class="nav-item" style="width:auto;">
                            <?php $isSameDate = $date->format('Y-m-d') == $data['ret']->format('Y-m-d');?>
                            <button type="submit" name="selectedRetDate" class="nav-link h-100 px-4 pt-2 <?php echo $isSameDate?'active':''; echo ($result->minimum_price == null || $isSameDate)?'':' dateResult';?>" value="<?php echo $date->format('Y-m-d');?>" <?php echo $isSameDate?'disabled':'';?>>
                                <span class="text-uppercase font-weight-bold"><?php echo $date->format('D d');?></span>
                                <?php //echo $data['dept']->format('Y-m-d'); echo $date->format('Y-m-d');?>
                                <hr class="m-0">
                                
                                <?php echo ($result->minimum_price == null)?'Not<br>Available':'from USD<br>'.$result->minimum_price;?>

                            </button>
                        </li>
                    <?php endforeach;?>
                        
                    </ul>

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
                <div class="col-4 p-0">
                </div>
                <div class="col-4 p-0">
                </div>
            </div>
            <div class="row p-0 m-0 justify-content-center" id="deptFlightResult">
                <?php foreach($data['retFlights'] as $flight):?>
                    <div class="flightDetail row w-100 justify-content-center  my-3">
                        <div class="col-4 p-0">
                            <div>
                                <span class="font-weight-bold"><?php echo $flight->departure_time;?></span>
                                <span><?php echo $flight->origin_name;?></span>
                                <span>(<?php echo $flight->airport_origin;?>)</span>
                            </div>
                            <div>
                                <span class="w-100 text-center">TO</span>
                            </div>
                            <div>
                                <span class="font-weight-bold"><?php echo $flight->departure_time;?></span>
                                <span><?php echo $flight->destination_name;?></span>
                                <span>(<?php echo $flight->airport_destination;?>)</span>
                            </div>
                            <div>
                                <span>Duration:</span>
                                <span class="font-weight-bold"><?php echo $flight->duration_minutes;?></span>
                            </div>
                            <div>
                                <span> Flight Number:</span>
                                <span class="font-weight-bold"><?php echo $flight->flight_no;?></span>
                            </div>
                        </div>
                        <div class="col-4 px-2 ">
                            <div class="text-center w-100 h-100" style="box-shadow: 5px 2px 2px gray;background-color: lightgray;">
                                <span>PHP 5800</span>
                            </div>
                        </div>
                        <div class="col-4 px-2">
                            <div class="text-center w-100 h-100" style="box-shadow: 5px 2px 2px gray;background-color: lightgray;">
                                <span>PHP 5800</span>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
            <?php endif;?>    
        </form>
    </div>
</div>

<?php require APPROOT . '/views/includes/foot.php'; ?>
<script src="<?php echo URLROOT . "/public/js/";?>date-selection.js"></script>