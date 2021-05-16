<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

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
            <label for="time">Departure Time</label>
            <span style="color: red;">* <?php echo $data['timeError'];?></span>
            <input type="time" class="form-control" id="time" name="time"  value="<?php echo $data['time'];?>">
        </div>
        <div class="form-group">
            <label for="address">Departure Date</label>
            <span style="color: red;">* <?php echo $data['dateError'];?></span>
            <input type="date" class="form-control" id="date" name="date"  value="<?php echo $data['date'];?>">
        </div>
        <div class="form-group">
            <label for="address">Gate</label>
            <span style="color: red;">* <?php echo $data['gateError'];?></span>
            <input type="text" class="form-control" id="gate" name="gate"  value="<?php echo $data['gate'];?>">
        </div>
        
        <button type="submit" class="btn btn-primary btn-block" name="submit">Create</button>
    </form>
</div>