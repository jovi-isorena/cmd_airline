<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>

<div class="container full-h pt-5">
    <h1>Edit Flight</h1>
    <?php if(!empty($data['successMessage'])):?>
        <span class="alert-success text-success px-2  align-content-center">
            <?php echo $data['successMessage'];?>
        </span>
    <?php endif;?>
    <form method="post" action="<?php echo URLROOT . '/flights/edit/' . $data['flight']->flight_no;?>">
        <div class="form-group">
            <label for="flightNumber">Flight Number</label>
            <div id="flightNumber" name="flightNumber" class="font-weight-bold"><?php echo $data['flight']->flight_no;?></div>
        </div>
        <div class="form-group">
            <label for="duration">Duration in Minutes</label>
            <span style="color: red;">* <?php echo $data['durationError'];?></span>
            <input type="number" class="form-control" id="duration" name="duration"  value="<?php echo $data['flight']->duration_minutes;?>">
        </div>
        <div class="form-group">
            <label for="origin">Airport Origin</label>
            <span style="color: red;">* <?php echo $data['originError'];?></span>
            <select name="origin" id="origin" class="custom-select form-control ">
                <?php foreach($data['airports'] as $airport):?>
                    <option 
                        value="<?php echo $airport->airport_code;?>" 
                        <?php 
                            // echo (isset($data['flight']->airport_origin) && $data['flight']->airport_origin==$airport->airport_code)?'selected':'';
                            if(!empty($data['origin'])){
                                if($data['origin']==$airport->airport_code){
                                    echo 'selected';
                                }
                            }elseif($data['flight']->airport_origin==$airport->airport_code){
                                echo 'selected';
                            }
                        ?>>
                            <?php echo $airport->airport_code . " - " . $airport->name;?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="destination">Airport Destination</label>
            <span style="color: red;">* <?php echo $data['destinationError'];?></span>
            <select name="destination" id="destination" class="custom-select form-control">
                <?php foreach($data['airports'] as $airport):?>
                    <option 
                        value="<?php echo $airport->airport_code;?>" 
                        <?php 
                            if(!empty($data['destination'])){
                                if($data['destination']==$airport->airport_code){
                                    echo 'selected';
                                }
                            }elseif($data['flight']->airport_destination==$airport->airport_code){
                                echo 'selected';
                            }
                        ?>>
                            <?php echo $airport->airport_code . " - " . $airport->name;?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="btn-group w-100" role="group">
            <button type="submit" class="btn btn-outline-primary w-100" name="submit">Update</button>
            <a href="<?php echo URLROOT;?>/flights" class="btn btn-outline-secondary w-100">Cancel</a>
        </div>
    </form>
</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>