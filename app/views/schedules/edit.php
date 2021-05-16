<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
    var_dump($data);
?>


<div class="container pt-5">
    <h1>Update Schedule</h1>
    <?php if(!empty($data['successMessage'])):?>
    <span class="alert-success text-success px-2  align-content-center">
        <?php echo $data['successMessage'];?>
    </span>
    <?php endif;?>
    <form method="post" action="<?php echo URLROOT . '/schedules/edit/' . $data['schedule']->schedule_id; ?>">
        <div class="form-group">
            <label for="airportCode">Flight Number</label>
            <span style="color: red;">* <?php echo $data['flightNumberError'];?></span>
            <select name="flightNumber" id="flightNumber" class="form-control custom-select">
                <?php foreach($data['flights'] as $flight):?> 
                    <option value="<?php echo $flight->flight_no?>"
                        <?php 
                            if(isset($data['flightNumber'])){
                                if($data['flightNumber']==$flight->flight_no){
                                    echo 'selected';
                                }
                            }elseif($data['schedule']->flight_no==$$flight->flight_no){
                                echo 'selected';
                            }
                        ?>
                    >
                        <?php echo $flight->flight_no . '(' . $flight->airport_origin . '-' . $flight->airport_destination . ')';?>
                    </option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label for="time">Departure Time</label>
            <span style="color: red;">* <?php echo $data['timeError'];?></span>
            <input type="time" class="form-control" id="time" name="time"  value="<?php echo !empty($data['time'])?$data['time']:$data['schedule']->departure_time;?>">
        </div>
        <div class="form-group">
            <label for="address">Departure Date</label> <?php echo $data['date'];?>
            <span style="color: red;">* <?php echo $data['dateError'];?></span>
            <input type="date" class="form-control" id="date" name="date"  value="<?php echo !empty($data['date'])?$data['date']:$data['schedule']->departure_date;?>">
        </div>
        <div class="form-group">
            <label for="address">Gate</label>
            <span style="color: red;">* <?php echo $data['gateError'];?></span>
            <input type="text" class="form-control" id="gate" name="gate"  value="<?php echo !empty($data['gate'])?$data['gate']:$data['schedule']->gate;?>">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <span style="color: red;">* <?php echo $data['statusError'];?></span>
            <select name="status" id="status" class="form-control custom-select">
                <option 
                    value="Scheduled" 
                    <?php 
                        if(!empty($data['status'])){
                            if($data['status'] == 'Scheduled'){
                                echo 'selected';
                            }
                        }elseif($data['schedule']->schedule_status == 'Scheduled'){
                            echo 'selected';
                        }
                    ?>
                >
                    Scheduled
                </option>
                <option 
                    value="Delayed" 
                    <?php 
                        if(!empty($data['status'])){
                            if($data['status'] == 'Delayed'){
                                echo 'selected';
                            }
                        }elseif($data['schedule']->schedule_status == 'Delayed'){
                            echo 'selected';
                        }
                    ?>
                >
                    Delayed
                </option>
                <option 
                    value="Departed" 
                    <?php 
                        if(!empty($data['status'])){
                            if($data['status'] == 'Departed'){
                                echo 'selected';
                            }
                        }elseif($data['schedule']->schedule_status == 'Departed'){
                            echo 'selected';
                        }
                    ?>
                >
                    Departed
                </option>
                <option 
                    value="Arrived" 
                    <?php 
                        if(!empty($data['status'])){
                            if($data['status'] == 'Arrived'){
                                echo 'selected';
                            }
                        }elseif($data['schedule']->schedule_status == 'Arrived'){
                            echo 'selected';
                        }
                    ?>
                >
                    Arrived
                </option>
                <option 
                    value="Cancelled" 
                    <?php 
                        if(!empty($data['status'])){
                            if($data['status'] == 'Cancelled'){
                                echo 'selected';
                            }
                        }elseif($data['schedule']->schedule_status == 'Cancelled'){
                            echo 'selected';
                        }
                    ?>
                >
                    Cancelled
                </option>

            </select>
        </div>

        <div class="btn-group w-100" role="group">
            <button type="submit" class="btn btn-outline-primary w-100" name="submit">Update</button>
            <a href="<?php echo URLROOT;?>/schedules" class="btn btn-outline-secondary w-100">Cancel</a>
        </div>
    </form>
</div>