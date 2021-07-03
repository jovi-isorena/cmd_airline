<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<pre><?php //var_dump($data);?></pre>


<div class="container full-h">
    <div class="row">
        <div class="col-9 p-0">
            <div class="row">
                <h1><?php echo $data['title'];?></h1>
            </div>
            <div class="card  border rounded">
                <form action="<?php echo URLROOT;?>/reservations/payment" method="post">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <div class="nav-link active flightTab" data-toggle="deptFlight"><?php echo $data['selectedDepartureFlight']->airport_origin . " - " . $data['selectedDepartureFlight']->airport_destination;?></div>
                            </li>
                            <?php if($data['flightType']=="roundTrip"):?>
                            <li class="nav-item">
                                <div class="nav-link flightTab" data-toggle="retFlight"><?php echo $data['selectedReturnFlight']->airport_origin . " - " . $data['selectedReturnFlight']->airport_destination;?></div>
                            </li>
                            <?php endif;?>
                        </ul>
                    </div>
                    <div class="card-body px-5 ">
                        <!-- DEPARTURE FLIGHT -->
                        <div id="deptFlight">
                            <div class="row mb-5">
                                <div class="card w-100 shadow-sm">
                                    <div class="card-header custom-primary">
                                        <h2 class="card-title">Add Baggage</h2>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <?php foreach($data['reservationData']['passengers'] as $key=>$passenger):?>
                                                <div class="col-6">
                                                    <div class="card m-0">
                                                        <div class="card-header">
                                                            <h5>Select Baggage for <?php echo $passenger['firstname'] . " " . $passenger['lastname']; ?></h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <select class="custom-select" name="deptBaggage[<?php echo $key;?>]" id="deptBaggage[<?php echo $key;?>]" >
                                                                <?php if(sizeof($data['deptExtras']['baggage']) > 0):?>
                                                                    <option value="0">--Select One--</option>
                                                                    <?php foreach($data['deptExtras']['baggage'] as $extra):?>
                                                                        <option value="<?php echo $extra->extra_id;?>"><?php echo $extra->name;?></option>
                                                                    <?php endforeach;?>
                                                                <?php else:?>
                                                                    <option value="0">No Available Item</option>
                                                                <?php endif;?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="card w-100 shadow-sm">
                                    <div class="card-header custom-primary">
                                        <h2 class="card-title">Add Meal</h2>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <?php foreach($data['reservationData']['passengers'] as $key=>$passenger):?>
                                                <div class="col-6">
                                                    <div class="card m-0">
                                                        <div class="card-header">
                                                            <h5>Select Meal for <?php echo $passenger['firstname'] . " " . $passenger['lastname']; ?></h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <select class="custom-select" name="deptMeal[<?php echo $key;?>]" id="deptMeal[<?php echo $key;?>]" >
                                                                <?php if(sizeof($data['deptExtras']['meal']) > 0):?>
                                                                    <option value="0">--Select One--</option>
                                                                    <?php foreach($data['deptExtras']['meal'] as $extra):?>
                                                                        <option value="<?php echo $extra->extra_id;?>"><?php echo $extra->name;?></option>
                                                                    <?php endforeach;?>
                                                                <?php else:?>
                                                                    <option value="0">No Available Item</option>
                                                                <?php endif;?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="card w-100 shadow-sm">
                                    <div class="card-header custom-primary">
                                        <h2 class="card-title">Add Roaming Service</h2>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <?php foreach($data['reservationData']['passengers'] as $key=>$passenger):?>
                                                <div class="col-6">
                                                    <div class="card m-0">
                                                        <div class="card-header">
                                                            <h5>Select Roaming Service for <?php echo $passenger['firstname'] . " " . $passenger['lastname']; ?></h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <select class="custom-select" name="deptRoaming[<?php echo $key;?>]" id="deptRoaming[<?php echo $key;?>]">
                                                                <?php if(sizeof($data['deptExtras']['roaming']) > 0):?>
                                                                    <option value="0">--Select One--</option>
                                                                    <?php foreach($data['deptExtras']['roaming'] as $extra):?>
                                                                        <option value="<?php echo $extra->extra_id;?>"><?php echo $extra->name;?></option>
                                                                    <?php endforeach;?>
                                                                <?php else:?>
                                                                    <option value="0">No Available Item</option>
                                                                <?php endif;?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- RETURN FLIGHT -->
                        <?php if($data['flightType']):?>
                            <div id="retFlight" class="d-none">
                                <div class="row mb-5">
                                    <div class="card w-100 shadow-sm">
                                        <div class="card-header custom-primary">
                                            <h2 class="card-title">Add Baggage</h2>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <?php foreach($data['reservationData']['passengers'] as $key=>$passenger):?>
                                                    <div class="col-6">
                                                        <div class="card m-0">
                                                            <div class="card-header">
                                                                <h5>Select Baggage for <?php echo $passenger['firstname'] . " " . $passenger['lastname']; ?></h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <select class="custom-select" name="retBaggage[<?php echo $key;?>]" id="retBaggage[<?php echo $key;?>]" >
                                                                    <?php if(sizeof($data['retExtras']['baggage']) > 0):?>
                                                                        <option value="0">--Select One--</option>
                                                                        <?php foreach($data['retExtras']['baggage'] as $extra):?>
                                                                            <option value="<?php echo $extra->extra_id;?>"><?php echo $extra->name;?></option>
                                                                        <?php endforeach;?>
                                                                    <?php else:?>
                                                                        <option value="0">No Available Item</option>
                                                                    <?php endif;?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="card w-100 shadow-sm">
                                        <div class="card-header custom-primary">
                                            <h2 class="card-title">Add Meal</h2>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <?php foreach($data['reservationData']['passengers'] as $key=>$passenger):?>
                                                    <div class="col-6">
                                                        <div class="card m-0">
                                                            <div class="card-header">
                                                                <h5>Select Meal for <?php echo $passenger['firstname'] . " " . $passenger['lastname']; ?></h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <select class="custom-select" name="retMeal[<?php echo $key;?>]" id="retMeal[<?php echo $key;?>]" >
                                                                    <?php if(sizeof($data['retExtras']['meal']) > 0):?>
                                                                        <option value="0">--Select One--</option>
                                                                        <?php foreach($data['retExtras']['meal'] as $extra):?>
                                                                            <option value="<?php echo $extra->extra_id;?>"><?php echo $extra->name;?></option>
                                                                        <?php endforeach;?>
                                                                    <?php else:?>
                                                                        <option value="0">No Available Item</option>
                                                                    <?php endif;?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="card w-100 shadow-sm">
                                        <div class="card-header custom-primary">
                                            <h2 class="card-title">Add Roaming Service</h2>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <?php foreach($data['reservationData']['passengers'] as $key=>$passenger):?>
                                                    <div class="col-6">
                                                        <div class="card m-0">
                                                            <div class="card-header">
                                                                <h5>Select Roaming Service for <?php echo $passenger['firstname'] . " " . $passenger['lastname']; ?></h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <select class="custom-select" name="retRoaming[<?php echo $key;?>]" id="retRoaming[<?php echo $key;?>]">
                                                                    <?php if(sizeof($data['retExtras']['roaming']) > 0):?>
                                                                        <option value="0">--Select One--</option>
                                                                        <?php foreach($data['retExtras']['roaming'] as $extra):?>
                                                                            <option value="<?php echo $extra->extra_id;?>"><?php echo $extra->name;?></option>
                                                                        <?php endforeach;?>
                                                                    <?php else:?>
                                                                        <option value="0">No Available Item</option>
                                                                    <?php endif;?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif;?>
                    </div>
                    <div class="row justify-content-end my-5 mx-0 pr-5">
                        <button type="submit" class="btn" style="background-color: #001e60;color:white;" name="continue">CONTINUE <i class="fas fa-caret-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-3">
        </div>
    </div>
    
</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>
<script src="<?php echo URLROOT . "/public/js/";?>extras.js"></script>
