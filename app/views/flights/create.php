<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>

<div class="container pt-5">
    <a href="<?php echo URLROOT;?>/flights" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i> Back To List</a>
    <h1>Create Flight</h1>
    <?php if(!empty($data['successMessage'])):?>
        <span class="alert-success text-success px-2  align-content-center">
            <?php echo $data['successMessage'];?>
        </span>
    <?php endif;?>
    <form method="post" action="<?php echo URLROOT; ?>/flights/create">
        <div class="form-group">
            <label for="flightNumber">Flight Number</label>
            <span style="color: red;">* <?php echo $data['flightNumberError'];?></span>
            <input type="text" class="form-control" id="flightNumber" name="flightNumber"  value="<?php echo $data['flightNumber'];?>">
        </div>
        <div class="form-group">
            <label for="duration">Duration in Minutes</label>
            <span style="color: red;">* <?php echo $data['durationError'];?></span>
            <input type="number" class="form-control" id="duration" name="duration"  value="<?php echo $data['duration'];?>" >
        </div>
        <div class="form-group">
            <label for="origin">Airport Origin</label>
            <span style="color: red;">* <?php echo $data['originError'];?></span>
            <select name="origin" id="origin" class="custom-select form-control ">
                <option <?php echo empty($data['origin'])?'selected':'';?> value="">Select an airport</option>
                <?php foreach($data['airports'] as $airport):?>
                    <option value="<?php echo $airport->airport_code;?>" <?php echo (isset($data['origin']) && $data['origin']==$airport->airport_code)?'selected':'';?>><?php echo $airport->airport_code . " - " . $airport->name;?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="destination">Airport Destination</label>
            <span style="color: red;">* <?php echo $data['destinationError'];?></span>
            <select name="destination" id="destination" class="custom-select form-control">
                <option <?php echo empty($data['destination'])?'selected':'';?> value="">Select an airport</option>
                <?php foreach($data['airports'] as $airport):?>
                    <option value="<?php echo $airport->airport_code;?>" <?php echo (isset($data['destination']) && $data['destination']==$airport->airport_code)?'selected':'';?>><?php echo $airport->airport_code . " - " . $airport->name;?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block" name="submit">Add</button>
    </form>
</div>