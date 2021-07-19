<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<pre>
    <?php //var_dump($data);?>
</pre>
<div class="container full-h">
    <ol class="progress custom-ol" style="height:fit-content">
        <li class="is-active">Select Date</li>
        <li>Select Flight</li>
        <li>Passengers</li>
        <li >Choose Seats</li>
        <li>Add Extras</li>
        <li>Payment</li>
        <li>Complete</li>
    </ol>
    <div class="alert alert-warning">
        <span class="text-warning"><i class="fas fa-exclamation-circle"></i> There are no flights available on your desired date/s. Here are the nearest dates with flights.</span>
    </div>
    <div class="row">
        <div class="col-12">
            <h1><?php echo $data['title'];?></h1>
            <pre><?php //var_dump($data);?></pre>
        </div>
        <div class="col-12">
            <form action="<?php echo URLROOT;?>/reservations/search" method="POST">
                <input type="hidden" name="passenger" value="<?php echo $data['passenger'];?>">
                <input type="hidden" name="cabinClass" value="<?php echo $data['cabinClass'];?>">
                <input type="hidden" name="flightType" value="<?php echo $data['flightType'];?>">
    
                <div id="deptResult">
                    
                    <div class="row">
                        <span id="deptDate">
                            Desired Departure Date: <strong><?php echo $data['dept']->format('l d M') ;?></strong>
                        </span>
                    </div>
                    <div class="row alert alert-info text-dark" >
                        <div class="col-1">
                            <img src="<?php echo URLROOT;?>/public/img/icons8-airplane-take-off-50.png" alt="" style="margin-left: auto;">
                        </div>
                        <div class="col-3">
                            <?php echo $data['deptOrigin']->address . '<br>' . $data['deptOrigin']->name;?>
                            <input type="hidden" name="deptOrigin" value="<?php echo $data['deptOrigin']->airport_code;?>">
                        </div>
                        <div class="col-4 text-center">
                            <h2>TO</h2>
                        </div>
                        <div class="col-1" style="height:100%">
                        <img src="<?php echo URLROOT;?>/public/img/icons8-airplane-landing-50.png" alt="" style="margin-left: auto;">
                        </div>
                        <div class="col-3">
                            <?php echo $data['deptDestination']->address . '<br>' . $data['deptDestination']->name;?>
                            <input type="hidden" name="deptDestination" value="<?php echo $data['deptDestination']->airport_code;?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7">
                            <span>
                                Please select new departure date
                            </span>
                            <span style="color: red;">* <?php echo $data['selectedDeptDateError'];?></span>
                        </div>
                        
                        <div class="col-5">
                            <span class="col-6">
                                <i class="fas fa-tag text-danger" style="transform: rotate(90deg); "></i> Lowest Fares
                            </span>
                            <span class="col-6">
                                <img src="<?php echo URLROOT . '/public/img/baseline_check_circle_outline_black_18dp.png'?>"/> Selection
                            </span>
                        </div>
                    </div>
                    <pre><?php //var_dump($data['resultDept']);?></pre>
                    <div class="row justify-content-between">
                        <?php 
                            function minFare($carry, $item){
                                $val = intval($item->minimum_price);
                                if($val > 0)
                                    $carry = min($carry,$val);
                                return $carry;
                            }
                            $minFare = array_reduce($data['resultDept'], "minFare", 999999);
                        
                        ?>
                        <?php foreach($data['resultDept'] as $result):?>
                            <?php 
                                $key = array_search($result, $data['resultDept']);
                                $date = new DateTime($key);
                            ?>
                                <label for="<?php echo $result->minimum_price == null?'':'dept'.$key;?>" class="card <?php echo $result->minimum_price == null?'':'dateResult';?>" style='min-width: 110px;width: 140px;'>
                                    <input class="d-none" type="radio" name="selectedDeptDate" id="<?php echo 'dept'.$key;?>" value="<?php echo $key;?>">
                                    <div class="card-header text-center p-1">
                                        <?php echo $result->day; ?>
                                    </div>
                                    <div class="card-body p-2">
                                        <div class="row justify-content-between">
                                            <div class="col-8">
                                                <p class="card-title mb-1 font-weight-bold"><?php echo $date->format('d'); ?></p>
                                                <p class="card-title text-uppercase font-weight-bold"><?php echo $date->format('M'); ?></p>
                
                                            </div>
                                            <div class="col-4 pr-3">
                                                <?php if($result->minimum_price == $minFare) echo '<i class="fas fa-tag text-danger" style="transform: rotate(90deg);position: absolute; top: 1.6em; "></i>';?>
                
                                            </div>
    
                                        </div>
                                        <?php if($result->minimum_price == null): ?>
                                            <p class="card-text font-italic">
                                                Not Available
                                            </p>    
                                        <?php else:?>
                                            <div class="text-right">
                                                From <br> USD <br>
                                                <?php echo $result->minimum_price;?>  
                                            </div>
                                        <?php endif;?>
                                    </div>
                                </label>
                            
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php if($data['flightType'] == "roundTrip"):?>
                    <hr">
                    <div id="retResult" class="mt-5">
                    
                        <div class="row">
                                <span id="retDate">
                                    Desired Return Date: <strong><?php echo $data['ret']->format('l d M') ;?></strong>
                                </span>
                            </div>    
                        <div class="row alert alert-info text-dark">
                            <div class="col-1">
                                <img src="<?php echo URLROOT;?>/public/img/icons8-airplane-take-off-50.png" alt="" style="margin-left: auto;">
                            </div>
                            <div class="col-3">
                                <?php echo $data['retOrigin']->address . '<br>' . $data['retOrigin']->name;?>
                            </div>
                            <div class="col-4 text-center">
                                <h2>TO</h2>
                            </div>
                            <div class="col-1">
                                <img src="<?php echo URLROOT;?>/public/img/icons8-airplane-landing-50.png" alt="" style="margin-left: auto;">
                            </div>
                            <div class="col-3">
                                <?php echo $data['retDestination']->address . '<br>' . $data['retDestination']->name;?>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-7">
                                <span>
                                    Please select new return date
                                </span>
                                <span style="color: red;">* <?php echo $data['selectedRetDateError'];?></span>
                            </div>
                            
                            <div class="col-5">
                                <span class="col-6">
                                    <i class="fas fa-tag text-danger" style="transform: rotate(90deg); "></i> Lowest Fares
                                </span>
                                <span class="col-6">
                                    <img src="<?php echo URLROOT . '/public/img/baseline_check_circle_outline_black_18dp.png'?>"/> Selection
                                </span>
                            </div>
                        </div>
                        <pre><?php //var_dump($data['resultRet']);?></pre>
                        <div class="row justify-content-between">
                            <?php 
                                $minFare = array_reduce($data['resultRet'], "minFare", 999999);
                            ?>
                            <?php foreach($data['resultRet'] as $result):?>
                                <?php 
                                    $key = array_search($result, $data['resultRet']);
                                    $date = new DateTime($key);
                                ?>
                                    <label for="<?php echo $result->minimum_price == null?'':'ret'.$key;?>" class="card <?php echo $result->minimum_price == null?'':'dateResult';?>"  style='min-width: 110px;width: 140px;'>
                                        <input class="d-none" type="radio" name="selectedRetDate" id="<?php echo 'ret'.$key;?>" value="<?php echo $key;?>">
                                        <div class="card-header text-center p-1">
                                            <?php echo $result->day; ?>
                                        </div>
                                        <div class="card-body p-2">
                                            <div class="row justify-content-between">
                                                <div class="col-8">
                                                    <p class="card-title mb-1 font-weight-bold"><?php echo $date->format('d'); ?></p>
                                                    <p class="card-title text-uppercase font-weight-bold"><?php echo $date->format('M'); ?></p>
                    
                                                </div>
                                                <div class="col-4 pr-3">
                                                    <?php if($result->minimum_price == $minFare) echo '<i class="fas fa-tag text-danger" style="transform: rotate(90deg);position: absolute; top: 1.6em;"></i>';?>
                    
                                                </div>
    
                                            </div>
                                            <?php if($result->minimum_price == null): ?>
                                                <p class="card-text font-italic">
                                                    Not Available
                                                </p>    
                                            <?php else:?>
                                                <div class="text-right">
                                                    From <br> USD <br>
                                                    <?php echo $result->minimum_price;?>  
                                                </div>
                                            <?php endif;?>
                                        </div>
                                    </label>
                                
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif;?>
                <div class="row justify-content-end m-5">
                    <div class="col-3 justify-content-end">
                        <button type="submit" class="btn" style="background-color: #001e60;color:white;">CONTINUE <i class="fas fa-caret-right"></i></button>
                    </div>
                </div>
            </form>
        </div>


        
    </div>
</div>


<?php require APPROOT . '/views/includes/foot.php'; ?>
<script src="<?php echo URLROOT . "/public/js/";?>airport-auto-suggest.js"></script>
<script src="<?php echo URLROOT . "/public/js/";?>date-selection.js"></script>
