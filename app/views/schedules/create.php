<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
    var_dump($data);
?>


<div class="container pt-5">
    <a href="<?php echo URLROOT;?>/schedules" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i> Back To List</a>
    <h1>Create Schedule</h1>
    <?php if(!empty($data['successMessage'])):?>
    <span class="alert-success text-success px-2  align-content-center">
        <?php echo $data['successMessage'];?>
    </span>
    <?php endif;?>
    <form method="post" action="<?php echo URLROOT; ?>/schedules/create">
        <div class="form-group">
            <label for="airportCode">Flight Number</label>
            <span style="color: red;">* <?php echo $data['flightNumberError'];?></span>
            <select name="flightNumber" id="flightNumber" class="form-control custom-select">
                <option value='' <?php echo empty($data['flight_no'])?'selected':'';?>>Select a Flight</option>
                <?php foreach($data['flights'] as $flight):?> 
                    <option value="<?php echo $flight->flight_no?>"
                        <?php echo $data['flightNumber']==$flight->flight_no?'selected':'';?>
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
                    <input class="form-check-input" type="checkbox" value="monday" id="monday" name="monday" <?php echo $data['monday']?'checked':''?>>
                    <label class="form-check-label" for="monday">
                        Monday
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="tuesday" id="tuesday" name="tuesday" <?php echo $data['tuesday']?'checked':''?>>
                    <label class="form-check-label" for="tuesday">
                        Tuesday
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="wednesday" id="wednesday" name="wednesday" <?php echo $data['wednesday']?'checked':''?>>
                    <label class="form-check-label" for="wednesday">
                        Wednesday
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="thursday" id="thursday" name="thursday" <?php echo $data['thursday']?'checked':''?>>
                    <label class="form-check-label" for="thursday">
                        Thursday
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="friday" id="friday" name="friday" <?php echo $data['friday']?'checked':''?>>
                    <label class="form-check-label" for="friday">
                        Friday
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="saturday" id="saturday" name="saturday" <?php echo $data['saturday']?'checked':''?>>
                    <label class="form-check-label" for="saturday">
                        Saturday
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="sunday" id="sunday" name="sunday" <?php echo $data['sunday']?'checked':''?>>
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
        <button type="submit" class="btn btn-primary btn-block" name="submit">Create</button>
    </form>
</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>