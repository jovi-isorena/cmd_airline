<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<div class="container full-h">
    <h1><?php echo $data['title'];?></h1>
    <div class="row justify-content-start pl-5 ">
        <!-- <div class="p-5 rounded" style="background-color: #001e60;color:white;">
            <form action="<?php //echo URLROOT . "/reservations/search";?>" method="post">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="flightType" id="oneWay">
                    <label class="form-check-label" for="oneWay">One Way</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="flightType" id="roundTrip">
                    <label class="form-check-label" for="roundTrip">Round Trip</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="flightType" id="stopOver">
                    <label class="form-check-label" for="roundTrip">Stop Over/Multi City</label>
                </div>
                <div class="form-group">
                    <label for="origin">Origin ap</label>
                    <input type="text" name="origin" id="origin" value="<?php //echo $data['origin']->airport_code;?>">
                    <input type="hidden" name="originText" id="originText">
                </div>
                <div class="form-group">
                    <label for="destination">Destination</label>
                    <input type="text" name="destination" id="destination" value="<?php //echo $data['destination']->airport_code;?>">
                </div>
                <div class="form-group">
                    <label for="departure">Departure</label>
                    <input type="date" name="departure" id="departure" value="<?php //echo $data['dept']->format('Y-m-d');?>">
                </div>
                <div class="form-group">
                    <label for="return">Return</label>
                    <input type="date" name="return" id="return">
                </div>
                <div class="form-group">
                    <label for="passenger">Passenger</label>
                    <input type="number" name="passenger" id="passenger" class="form-control" value="<?php //echo $data['passenger'];?>">
                </div>
                <div class="form-group">
                    <label for="cabinClass">Cabin Class</label>
                    <select name="cabinClass" id="cabinClass" class="form-control custom-select">
                        <option value="0" <?php //echo $data['cabinClass']=='0'?'selected':'';?>>Select a Class</option>
                        <option value="economy" <?php //echo $data['cabinClass']=='economy'?'selected':'';?>>Economy</option>
                        <option value="premium economy" <?php //echo $data['cabinClass']=='premium economy'?'selected':'';?>>Premium Economy</option>
                        <option value="business" <?php //echo $data['cabinClass']=='business'?'selected':'';?>>Business</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">SEARCH FLIGHT</button>
            </form>
        </div> -->
    </div>

    <div id="result">
        <div class="row">
            <div class="col-4">
                <?php echo $data['origin']->address . '<br>' . $data['origin']->name;?>
            </div>
            <div class="col-4">
                <h2>TO</h2>
            </div>
            <div class="col-4">
                <?php echo $data['destination']->address . '<br>' . $data['destination']->name;?>
            </div>
        </div>
        <div class="row">
            <span id="deptDate">
                <?php echo $data['dept']->format('l d M') ;?>
            </span>
        </div>
        <div class="row">
            <div class="col">
                <span>
                    Please select departure date
                </span>
            </div>
            
            <div class="col">
                <span class="col-4">
                    <i class="fas fa-tag text-danger" style="transform: rotate(90deg); "></i> Lowest Fares
                </span>
                <span class="col-4">
                    <img src="<?php echo URLROOT . '/public/img/baseline_check_circle_outline_white_24dp.png'?>"/> Selection
                </span>
                <span class="col-4">
                    Overlapping Date
                </span>
            </div>
        </div>
        <pre><?php //var_dump($data['result']);?></pre>
        <div class="row justify-content-around">
            <?php 
                function minFare($carry, $item){
                    $val = intval($item->minimum_price);
                    if($val > 0)
                        $carry = min($carry,$val);
                    return $carry;
                }
                $minFare = array_reduce($data['result'], "minFare", 999999);
            
            ?>
            <?php foreach($data['result'] as $result):?>
                <?php 
                    $key = array_search($result, $data['result']);
                    $date = new DateTime($key);
                ?>
                    <label for="<?php echo $result->minimum_price == null?'':$key;?>" class="card m-2 <?php echo $result->minimum_price == null?'':'dateResult';?>" style='width: 140px;'>
                        <input class="d-none" type="radio" name="selectedDeptDate" id="<?php echo $key;?>" value="<?php echo $key;?>">
                        <div class="card-header text-center p-1">
                            <?php echo $result->day; ?>
                        </div>
                        <div class="card-body p-2">
                            <div class="row justify-content-between">
                                <div class="col-6">
                                    <p class="card-title mb-1 font-weight-bold"><?php echo $date->format('d'); ?></p>
                                    <p class="card-title text-uppercase font-weight-bold"><?php echo $date->format('M'); ?></p>
    
                                </div>
                                <div class="col-4">
                                    <?php if($result->minimum_price == $minFare) echo '<i class="fas fa-tag text-danger" style="transform: rotate(90deg); "></i>';?>
    
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
    <div class="row justify-content-end">
        <div class="col-3 justify-content-end">
            <button type="submit" class="btn" style="background-color: #001e60;color:white;">CONTINUE <i class="fas fa-caret-right"></i></button>
        </div>
    </div>
</div>


<?php require APPROOT . '/views/includes/foot.php'; ?>
<script src="<?php echo URLROOT . "/public/js/";?>airport-auto-suggest.js"></script>
<script src="<?php echo URLROOT . "/public/js/";?>date-selection.js"></script>
<script src="<?php echo URLROOT . "/public/js/";?>search-flight.js"></script>
