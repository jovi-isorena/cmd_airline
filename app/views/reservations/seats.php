<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<pre><?php var_dump($data);?></pre>

<div class="container full-h">
    <div class="row">
        <div class="col-9">
            <div id="wrapper">
                <form action="<?php echo URLROOT . "/reservations/extras"?>" method="post">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <div class="nav-link active flightTab" data-toggle="deptFlight"><?php echo $data['selectedDepartureFlight']->airport_origin . " - " . $data['selectedDepartureFlight']->airport_destination;?></div>
                        </li>
                        <?php if($data['flightType']=="roundTrip"):?>
                        <li class="nav-item">
                            <div class="nav-link flightTab" data-toggle="retFlight"><?php echo $data['selectedReturnFlight']->airport_origin . " - " . $data['selectedReturnFlight']->airport_destination;?></div>
                        </li>
                        <?php endif;?>
                    </ul>
                    <div class="content">
                        <!-- DEPARTURE FLIGHT -->
                        <div id="deptFlight" class="border  p-3">
                            <div class="row">
                                <div class="passenger-list col">
                                    <p>Select seats for </p>
                                    <p><?php echo $data['selectedDepartureFlight']->airport_origin . " to " . $data['selectedDepartureFlight']->airport_destination;?></p>
                                    <p>Just tap on a passenger below.</p>
                                    <h3>List of Passengers</h3>
                                    <ul class="list-group">
                                        <?php foreach($data['passengers'] as $key => $passenger):?>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="radio" name="deptPassenger" value=<?php echo $key;?> id="deptPass<?php echo $key;?>">
                                                    <label for="deptPass<?php echo $key;?>"><?php echo $passenger['firstname'] . " " . $passenger['lastname'];?></label>
                                                </div>
                                                <div class="col">
                                                    <input type="hidden" name="deptSeat[<?php echo $key;?>]" id="deptSeat[<?php echo $key;?>]">
                                                    <label for="deptSeat[<?php echo $key;?>]">No Seat Selected</label>
                                                </div>
                                            </div>
                                        </li>
                                        <?php endforeach;?>
                                    </ul>
                                    
                                    <div>
                                        <h3>Legends:</h3>
                                        <ul style="list-style-type:none;">
                                            <li> 
                                                <div class="row align-items-center">
                                                    <div class='box2 seat'></div>
                                                    - Available Seat
                                                </div>
                                            </li>
                                            <li> 
                                                <div class="row align-items-center">
                                                    <div class='box2 taken'></div>
                                                    - Taken/Unavailable Seat
                                                </div>
                                            </li>
                                            <li> 
                                                <div class="row align-items-center">
                                                    <div class='box2 seat selectedSeat'></div>
                                                    - Selected Seat
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="aircraft-layout col">
                                    <div>
                                        <h3><?php echo $data['selectedDepartureFlight']->flight_no . " " . $data['departureAircraft']->name;?></h3>
                                        <p class="mark">Selecting seat for: <span id="activeDeptPassenger"></span></p>
                                    </div>
                                    
                                    <div class="row justify-content-center">
                                        <div class="seatgrid">
                                            <div class="row">
                                                <span class="labelBox2"></span>
                                                <?php $colSize = sizeof($data['departureAircraft']->colHeader);  
                                                    for($i=0;$i<$colSize;$i++):?>
                                                        <span class="labelBox2"><?php echo $data['departureAircraft']->colHeader[$i];?></span>
                                                <?php endfor; ?>
                                                <span class="labelBox2"></span>
                                            </div>
                                            <?php $decoded = $data['departureAircraft']->layout; 

                                            foreach($decoded as $keyRow=>$row):?>
                                                <div class="row m-0">
                                                    <div class="labelBox">
                                                        <?php echo $data['departureAircraft']->rowHeader[$keyRow];?>
                                                    </div>
                                                    <?php foreach($row as $keyCol=>$seat):
                                                        $class='';
                                                        if($seat != 0){
                                                            if(($data['cabinClass'] == "economy") && ($seat == 1)){
                                                                $class = 'seat';
                                                            }elseif(($data['cabinClass'] == "premium economy") && ($seat == 2)){
                                                                $class = 'seat';
                                                            }elseif(($data['cabinClass'] == "business") && ($seat == 3)){
                                                                $class = 'seat';
                                                            }else{
                                                                $class = 'taken';

                                                            }
                                                        }
                                                        ?>
                                                        <div class="box2 <?php echo $class;?>" 
                                                        data-value="<?php echo $data['departureAircraft']->colHeader[$keyCol].$data['departureAircraft']->rowHeader[$keyRow]?>"  
                                                        data-source-for="deptPassenger">
                                                        </div>
                                                    <?php endforeach; ?>
                                                    <div class="labelBox2">
                                                        <?php echo $data['departureAircraft']->rowHeader[$keyRow];?>
                                                    </div>
                                                </div>
                                            <?php endforeach;?>
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
                        <!-- RETURN FLIGHT -->
                        <div id="retFlight" class="border p-3 d-none">
                            <div class="row">
                                <div class="passenger-list col">
                                    <p>Select seats for </p>
                                    <p><?php echo $data['selectedReturnFlight']->airport_origin . " to " . $data['selectedReturnFlight']->airport_destination;?></p>
                                    <p>Just tap on a passenger below.</p>
                                    <h3>List of Passengers</h3>
                                    <ul class="list-group">
                                        <?php foreach($data['passengers'] as $key => $passenger):?>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="radio" name="retPassenger" value=<?php echo $key;?> id="retPass<?php echo $key;?>">
                                                    <label for="retPass<?php echo $key;?>"><?php echo $passenger['firstname'] . " " . $passenger['lastname'];?></label>
                                                </div>
                                                <div class="col">
                                                    <input type="hidden" name="retSeat[<?php echo $key;?>]" id="retSeat[<?php echo $key;?>]">
                                                    <label for="retSeat[<?php echo $key;?>]">No Seat Selected</label>
                                                </div>
                                            </div>
                                        </li>
                                        <?php endforeach;?>
                                    </ul>
                                    
                                    <div>
                                        <h3>Legends:</h3>
                                        <ul style="list-style-type:none;">
                                            <li> 
                                                <div class="row align-items-center">
                                                    <div class='box seat'></div>
                                                    - Available Seat
                                                </div>
                                            </li>
                                            <li> 
                                                <div class="row align-items-center">
                                                    <div class='box taken'></div>
                                                    - Taken/Unavailable Seat
                                                </div>
                                            </li>
                                            <li> 
                                                <div class="row align-items-center">
                                                    <div class='box seat selectedSeat'></div>
                                                    - Selected Seat
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="aircraft-layout col">
                                    <div>
                                        <h3><?php echo $data['selectedReturnFlight']->flight_no . " " . $data['returnAircraft']->name;?></h3>
                                        <p class="mark">Selecting seat for: <span id="activeRetPassenger"></span></p>
                                    </div>
                                    
                                    <div class="row justify-content-center">
                                        <div class="seatgrid">
                                            <div class="row">
                                                <span class="labelBox2"></span>
                                                <?php $colSize = sizeof($data['returnAircraft']->colHeader);  
                                                    for($i=0;$i<$colSize;$i++):?>
                                                        <span class="labelBox2"><?php echo $data['returnAircraft']->colHeader[$i];?></span>
                                                <?php endfor; ?>
                                                <span class="labelBox2"></span>
                                            </div>
                                            <?php $decoded = $data['returnAircraft']->layout; 

                                            foreach($decoded as $keyRow=>$row):?>
                                                <div class="row">
                                                    <div class="labelBox">
                                                        <?php echo $data['returnAircraft']->rowHeader[$keyRow];?>
                                                    </div>
                                                    <?php foreach($row as $keyCol=>$seat):
                                                        $class='';
                                                        if($seat != 0){
                                                            if(($data['cabinClass'] == "economy") && ($seat == 1)){
                                                                $class = 'seat';
                                                            }elseif(($data['cabinClass'] == "premium economy") && ($seat == 2)){
                                                                $class = 'seat';
                                                            }elseif(($data['cabinClass'] == "business") && ($seat == 3)){
                                                                $class = 'seat';
                                                            }else{
                                                                $class = 'taken';

                                                            }
                                                        }
                                                        ?>
                                                        <div class="box2 <?php echo $class;?>" 
                                                        data-value="<?php echo $data['returnAircraft']->colHeader[$keyCol].$data['returnAircraft']->rowHeader[$keyRow]?>"
                                                        data-source-for="retPassenger">
                                                        </div>
                                                    <?php endforeach; ?>
                                                    <div class="labelBox2">
                                                        <?php echo $data['returnAircraft']->rowHeader[$keyRow];?>
                                                    </div>
                                                </div>
                                            <?php endforeach;?>
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row justify-content-end mt-5">
                        <button type="submit" class="btn" style="background-color: #001e60;color:white;" name="continue">CONTINUE <i class="fas fa-caret-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-3">
            test
            <?php $hey = 'A'; echo ++$hey; echo $hey;?>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>
<script src="<?php echo URLROOT . "/public/js/";?>seat-selection.js"></script>
