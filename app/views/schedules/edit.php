<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
    // var_dump($data);
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
            <label for="frequency">Frequency</label>
            <span style="color: red;">* <?php echo $data['frequencyError'];?></span>
            <div class="pl-5">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="monday" id="monday" name="monday" 
                    <?php 
                        if($data['monday']){
                           echo 'checked'; 
                        }
                    ?>>
                    <label class="form-check-label" for="monday">
                        Monday
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="tuesday" id="tuesday" name="tuesday" 
                    <?php 
                        if($data['tuesday']){
                            echo 'checked';
                        }
                    ?>>
                    <label class="form-check-label" for="tuesday">
                        Tuesday
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="wednesday" id="wednesday" name="wednesday" 
                    <?php 
                        if($data['wednesday']){
                            echo 'checked';
                        }
                    ?>>
                    <label class="form-check-label" for="wednesday">
                        Wednesday
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="thursday" id="thursday" name="thursday" 
                    <?php 
                        if($data['thursday']){
                            echo 'checked';
                        }
                    ?>>
                    <label class="form-check-label" for="thursday">
                        Thursday
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="friday" id="friday" name="friday" 
                    <?php 
                        if($data['friday']){
                            echo 'checked';
                        }
                    ?>>
                    <label class="form-check-label" for="friday">
                        Friday
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="saturday" id="saturday" name="saturday" 
                    <?php 
                        if($data['saturday']){
                            echo 'checked';
                        }
                    ?>>
                    <label class="form-check-label" for="saturday">
                        Saturday
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="sunday" id="sunday" name="sunday" 
                    <?php 
                        if($data['sunday']){
                            echo 'checked';
                        }
                    ?>>
                    <label class="form-check-label" for="sunday">
                        Sunday
                    </label>
                </div>
            </div>
            
        </div>
        <div class="form-group">
            <label for="time">Departure Time</label>
            <span style="color: red;">* <?php echo $data['timeError'];?></span>
            <input type="time" class="form-control" id="time" name="time"  value="<?php echo $data['time'];?>">
        </div>
        <div class="form-group">
            <label for="address">Gate</label>
            <span style="color: red;">* <?php echo $data['gateError'];?></span>
            <input type="text" class="form-control" id="gate" name="gate"  value="<?php echo $data['gate'];?>">
        </div>
        <div class="form-group">
            <label for="startDate">Effective Start Date</label>
            <span style="color: red;">* <?php echo $data['startDateError'];?></span>
            <input type="date" class="form-control" id="startDate" name="startDate"  value="<?php echo $data['startDate'];?>">
        </div>
        <div class="form-group">
            <label for="endDate">Effective End Date</label>
            <span style="color: red;"><?php echo $data['endDateError'];?></span>
            <input type="date" class="form-control" id="endDate" name="endDate"  value="<?php echo $data['endDate'];?>">
        </div>


        <div class="form-group">
            <label for="status">Status</label>
            <span style="color: red;">* <?php echo $data['statusError'];?></span>
            <select name="status" id="status" class="form-control custom-select">
                <option 
                    value="Scheduled" 
                    <?php 
                        if($data['status'] == 'Scheduled'){
                                echo 'selected';
                        }
                    ?>
                >
                    Scheduled
                </option>
                <option 
                    value="Delayed" 
                    <?php 
                        if($data['status'] == 'Delayed'){
                            echo 'selected';
                        }
                    ?>
                >
                    Delayed
                </option>
                <option 
                    value="Departed" 
                    <?php 
                        if($data['status'] == 'Departed'){
                            echo 'selected';
                        }
                    ?>
                >
                    Departed
                </option>
                <option 
                    value="Arrived" 
                    <?php 
                        if($data['status'] == 'Arrived'){
                            echo 'selected';
                        }
                    ?>
                >
                    Arrived
                </option>
                <option 
                    value="Cancelled" 
                    <?php 
                        if($data['status'] == 'Cancelled'){
                            echo 'selected';
                        }
                    ?>
                >
                    Cancelled
                </option>
                <option 
                    value="Inactive" 
                    <?php 
                        if($data['status'] == 'Inactive'){
                            echo 'selected';
                        }
                    ?>
                >
                    Inactive
                </option>

            </select>
        </div>

        <div class="btn-group w-100" role="group">
            <button type="submit" class="btn btn-outline-primary w-100" name="submit">Update</button>
            <a href="<?php echo URLROOT;?>/schedules" class="btn btn-outline-secondary w-100">Cancel</a>
        </div>
    </form>
</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>