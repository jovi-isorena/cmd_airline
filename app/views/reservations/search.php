<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<div class="container full-h">
    <h1><?php echo $data['title'];?></h1>
    <div class="row justify-content-start pl-5 ">
        <div class="p-5 rounded" style="background-color: #001e60;color:white;">
            <form action="<?php echo URLROOT . "/reservations/search";?>" method="post">
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
                    <input type="text" name="origin" id="origin" value="<?php echo $data['origin']->airport_code;?>">

                </div>
                <div class="form-group">
                    <label for="destination">Destination</label>
                    <input type="text" name="destination" id="destination" value="<?php echo $data['destination']->airport_code;?>">
                </div>
                <div class="form-group">
                    <label for="departure">Departure</label>
                    <input type="date" name="departure" id="departure" value="<?php echo $data['dept']->format('Y-m-d');?>">
                </div>
                <div class="form-group">
                    <label for="return">Return</label>
                    <input type="date" name="return" id="return">
                </div>
                <div class="form-group">
                    <label for="passenger">Passenger</label>
                    <input type="number" name="passenger" id="passenger" class="form-control" value="<?php echo $data['passenger'];?>">
                </div>
                <div class="form-group">
                    <label for="cabinClass">Cabin Class</label>
                    <select name="cabinClass" id="cabinClass" class="form-control custom-select">
                        <option value="0" <?php echo $data['cabinClass']=='0'?'selected':'';?>>Select a Class</option>
                        <option value="economy" <?php echo $data['cabinClass']=='economy'?'selected':'';?>>Economy</option>
                        <option value="premium economy" <?php echo $data['cabinClass']=='premium economy'?'selected':'';?>>Premium Economy</option>
                        <option value="business" <?php echo $data['cabinClass']=='business'?'selected':'';?>>Business</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">SEARCH FLIGHT</button>
            </form>
        </div>
    </div>

    <div id="result">
        <div class="row">
            <div class="col-4">
                <?php echo $data['origin']->address . ' ' . $data['origin']->name;?>
            </div>
            <div class="col-4">
                <h2>TO</h2>
            </div>
            <div class="col-4">
                <?php echo $data['destination']->address . ' ' . $data['destination']->name;?>
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
                    Lowest Fares
                </span>
                <span class="col-4">
                    Selection
                </span>
                <span class="col-4">
                    Overlapping Date
                </span>
            </div>
        </div>
        <pre><?php var_dump($data['result']);?></pre>
        <div class="row">
            <?php 
                function minFare($carry, $item){
                    $carry = min($carry,intval($item->minimum_price));
                    return $carry;
                }
                $minFare = array_reduce($data['result'], "minFare", 0);
                echo $minFare;
            ?>
            <?php foreach($data['result'] as $result):?>
                <div class="card m-2" style='width: 120px;'>
                    <div class="card-header text-center p-1">
                        <?php echo $result->day; ?>
                    </div>
                    <div class="card-body p-2">
                        <p class="card-title mb-1"><?php echo $result->date->format('d'); ?></p>
                        <p class="card-title text-uppercase"><?php echo $result->date->format('M'); ?></p>
                        <?php if($result->minimum_price == null): ?>
                            <p class="card-text font-italic">
                                Not Available
                            </p>    
                        <?php else:?>
                            <div class="text-right">
                                <?php if($result->minimum_price == $minFare) echo 'min';?>
                                From <br> USD <br>
                                <?php echo $result->minimum_price;?>  
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<?php require APPROOT . '/views/includes/foot.php'; ?>