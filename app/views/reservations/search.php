<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<div class="container full-h">
    <div class="row">
        <div class="col-9">
            <h1><?php echo $data['title'];?></h1>
            <pre><?php //var_dump($data);?></pre>
            
            <form action="<?php echo URLROOT;?>/reservations/select" method="POST">
                <input type="hidden" name="passenger" value="<?php echo $data['passenger'];?>">
                <input type="hidden" name="cabinClass" value="<?php echo $data['cabinClass'];?>">
                <input type="hidden" name="flightType" value="<?php echo $data['flightType'];?>">

                <div id="deptResult">
                    <div class="row">
                        <div class="col-4">
                            <?php echo $data['deptOrigin']->address . '<br>' . $data['deptOrigin']->name;?>
                            <input type="hidden" name="deptOrigin" value="<?php echo $data['deptOrigin']->airport_code;?>">
                        </div>
                        <div class="col-4">
                            <h2>TO</h2>
                        </div>
                        <div class="col-4">
                            <?php echo $data['deptDestination']->address . '<br>' . $data['deptDestination']->name;?>
                            <input type="hidden" name="deptDestination" value="<?php echo $data['deptDestination']->airport_code;?>">
                        </div>
                    </div>
                    <div class="row">
                        <span id="deptDate">
                            <?php echo $data['dept']->format('l d M') ;?>
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <span>
                                Please select departure date
                            </span>
                        </div>
                        
                        <div class="col-7">
                            <span class="col-4">
                                <i class="fas fa-tag text-danger" style="transform: rotate(90deg); "></i> Lowest Fares
                            </span>
                            <span class="col-4">
                                <img src="<?php echo URLROOT . '/public/img/baseline_check_circle_outline_black_18dp.png'?>"/> Selection
                            </span>
                            <span class="col-4">
                                Overlapping Date
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
                                <label for="<?php echo $result->minimum_price == null?'':'dept'.$key;?>" class="card <?php echo $result->minimum_price == null?'':'dateResult';?>" style='width: 110px;'>
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
                                            <div class="col-4 p-0">
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
                <?php if($data['flightType'] == "roundTrip"):?>
                    <div id="retResult">
                        <div class="row">
                            <div class="col-4">
                                <?php echo $data['retOrigin']->address . '<br>' . $data['retOrigin']->name;?>
                            </div>
                            <div class="col-4">
                                <h2>TO</h2>
                            </div>
                            <div class="col-4">
                                <?php echo $data['retDestination']->address . '<br>' . $data['retDestination']->name;?>
                            </div>
                        </div>
                        <div class="row">
                            <span id="retDate">
                                <?php echo $data['ret']->format('l d M') ;?>
                            </span>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <span>
                                    Please select return date
                                </span>
                            </div>
                            
                            <div class="col-7">
                                <span class="col-4">
                                    <i class="fas fa-tag text-danger" style="transform: rotate(90deg); "></i> Lowest Fares
                                </span>
                                <span class="col-4">
                                    <img src="<?php echo URLROOT . '/public/img/baseline_check_circle_outline_black_18dp.png'?>"/> Selection
                                </span>
                                <span class="col-4">
                                    Overlapping Date
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
                                    <label for="<?php echo $result->minimum_price == null?'':'ret'.$key;?>" class="card <?php echo $result->minimum_price == null?'':'dateResult';?>" style='width: 110px;'>
                                        <input class="d-none" type="radio" name="selectedRetDate" id="<?php echo 'ret'.$key;?>" value="<?php echo $key;?>">
                                        <div class="card-header text-center p-1">
                                            <?php echo $result->day; ?>
                                        </div>
                                        <div class="card-body p-2">
                                            <div class="row justify-content-between">
                                                <div class="col-6">
                                                    <p class="card-title mb-1 font-weight-bold"><?php echo $date->format('d'); ?></p>
                                                    <p class="card-title text-uppercase font-weight-bold"><?php echo $date->format('M'); ?></p>
                    
                                                </div>
                                                <div class="col-4 p-0">
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
                <?php endif;?>
                <div class="row justify-content-end">
                    <div class="col-3 justify-content-end">
                        <button type="submit" class="btn" style="background-color: #001e60;color:white;">CONTINUE <i class="fas fa-caret-right"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-3">
            <div class="w-100"  style="background-color:#001e60;">
                Hey
            </div>
        </div>
    </div>
</div>


<?php require APPROOT . '/views/includes/foot.php'; ?>
<script src="<?php echo URLROOT . "/public/js/";?>airport-auto-suggest.js"></script>
<script src="<?php echo URLROOT . "/public/js/";?>date-selection.js"></script>
