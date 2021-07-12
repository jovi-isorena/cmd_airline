<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<pre>
<?php var_dump($data);?>
</pre>
<div class="container full-h">
    <div class="row">
        <div class="col-9 p-0 ">
            <div class="row">
                <h1><?php echo $data['title'];?></h1>
            </div>
            <div id="card  border rounded">
                <form action="<?php echo URLROOT . "/rebooks/seat"?>" method="post">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <div class="nav-link active flightTab" data-toggle="deptFlight"><?php echo $data['rebookData1'][1]->scheduleDetail->airport_origin . " - " . $data['rebookData1'][1]->scheduleDetail->airport_destination;?></div>
                            </li>
                            
                        </ul>
                    </div>
                    <div class="card-body">
                        <!-- DEPARTURE FLIGHT -->
                        <div id="deptFlight" >
                            <div class="row">
                                <div class="passenger-list col">
                                    <p>Select seats for </p>
                                    <p><?php echo $data['rebookData1'][1]->scheduleDetail->airport_origin . " to " . $data['rebookData1'][1]->scheduleDetail->airport_destination;?></p>
                                    <p>Just tap on a passenger below.</p>
                                    <h3>List of Passengers</h3>
                                    <ul class="list-group">
                                        <?php foreach($data['passengers'] as $key => $passenger):?>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="radio" name="deptPassenger" value=<?php echo $key;?> id="deptPass<?php echo $key;?>">
                                                    <label for="deptPass<?php echo $key;?>"><?php echo $passenger->firstname . " " . $passenger->lastname;?></label>
                                                </div>
                                                <div class="col text-center">
                                                    <input type="hidden" class="seatHidden" name="deptSeat[<?php echo $key;?>]" id="deptSeat[<?php echo $key;?>]">
                                                    <h5 class="m-0"><span class="badge badge-danger">No Seat Selected</span></h5>
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
                                        <h3><?php echo $data['selectedFlightDetail']->flight_no . " " . $data['aircraft']->name;?></h3>
                                        <p class="mark">Selecting seat for: <span id="activeDeptPassenger"></span></p>
                                    </div>
                                    
                                    <div class="row justify-content-center">
                                        <div class="seatgrid">
                                            <div class="row">
                                                <span class="labelBox2"></span>
                                                <?php $colSize = sizeof($data['aircraft']->colHeader);  
                                                    for($i=0;$i<$colSize;$i++):?>
                                                        <span class="labelBox2"><?php echo $data['aircraft']->colHeader[$i];?></span>
                                                <?php endfor; ?>
                                                <span class="labelBox2"></span>
                                            </div>
                                            <?php $decoded = $data['aircraft']->layout; 

                                            foreach($decoded as $keyRow=>$row):?>
                                                <div class="row m-0">
                                                    <div class="labelBox">
                                                        <?php echo $data['aircraft']->rowHeader[$keyRow];?>
                                                    </div>
                                                    <?php foreach($row as $keyCol=>$seat):
                                                        $class='';
                                                        if($seat != 0){
                                                            if(($data['rebookData1'][0]->cabin_class == "economy") && ($seat == 1)){
                                                                $class = 'seat';
                                                            }elseif(($data['rebookData1'][0]->cabin_class == "premium economy") && ($seat == 2)){
                                                                $class = 'seat';
                                                            }elseif(($data['rebookData1'][0]->cabin_class == "business") && ($seat == 3)){
                                                                $class = 'seat';
                                                            }else{
                                                                $class = 'taken';

                                                            }
                                                        }
                                                        ?>
                                                        <div class="box2 <?php echo $class;?>" 
                                                        data-value="<?php echo $data['aircraft']->colHeader[$keyCol].$data['aircraft']->rowHeader[$keyRow]?>"  
                                                        data-source-for="deptPassenger">
                                                        </div>
                                                    <?php endforeach; ?>
                                                    <div class="labelBox2">
                                                        <?php echo $data['aircraft']->rowHeader[$keyRow];?>
                                                    </div>
                                                </div>
                                            <?php endforeach;?>
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
                        <!-- RETURN FLIGHT -->
                        
                    </div>
                    <div class="row justify-content-end my-5 mx-0 pr-5">
                        <button type="submit" class="btn custom-primary d-none"  name="continue">CONTINUE <i class="fas fa-caret-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-3">
        </div>
    </div>
</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>
<script src="<?php echo URLROOT . "/public/js/";?>seat-selection.js"></script>

