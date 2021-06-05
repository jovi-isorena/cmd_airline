<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<pre><?php //var_dump($data);?></pre>
<div class="container full-h">
    <div class="row pb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header alert-primary">
                    <h3>Flight Details</h3>
                </div>
                <div class="card-body">
                    <p class="card-text">Flight No.: <?php echo $data['flight']->flight_no?></p>
                    <p class="card-text">Origin: <?php echo $data['flight']->airport_origin?></p>
                    <p class="card-text">Destination: <?php echo $data['flight']->airport_destination?></p>
                    <p class="card-text">Departure Time: <?php echo $data['schedule']->departure_time?></p>

                </div>
            </div>
        </div>
    </div>
    <div class="row pb-5">
        <div class="form-group">
            <input type="checkbox" name="useForAll" id="useForAll" >
            <label for="useForAll">Use one (1) aircraft for all schedule.</label>
        </div>
    </div>
    <?php if($data['schedule']->monday):?>
        <div class="row pb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header alert-primary">
                        <h3>Choose Aircraft for Monday</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="aircrafts-monday">Select an Aircraft: </label>
                                    <select name="aircrafts-monday" id="aircrafts-monday" class="custom-select aircraftSelector" link-to="layouts-monday">
                                        <option value="0">Select One</option>
                                        <?php foreach($data['aircrafts'] as $aircraft):?>
                                            <option value="<?php echo $aircraft->id?>"><?php echo $aircraft->name;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="layouts-monday">Select a Layout: </label>
                                    <select name="layouts-monday" id="layouts-monday" class="custom-select layoutSelector" link-to="seatgrid-monday">
                                        <option value="0">Select One</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-8">
                                <div class="col border h-100" id="seatgrid-monday">
                                    <div class="row">

                                    </div>
                                    <div class="row">
                                        <div class="" style="width: 1.5rem;" style="width:fit-content">
                                            
                                        </div>
                                        <div class="ml-3">
                                            <!-- <div class="seatgrid" id="seatgrid">
                        
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>    
    <?php if($data['schedule']->tuesday):?>
        <div class="row pb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header alert-primary">
                        <h3>Choose Aircraft for Tuesday</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="aircrafts-tuesday">Select an Aircraft: </label>
                                    <select name="aircrafts-tuesday" id="aircrafts-tuesday" class="custom-select aircraftSelector" link-to="layouts-tuesday">
                                        <option value="0">Select One</option>
                                        <?php foreach($data['aircrafts'] as $aircraft):?>
                                            <option value="<?php echo $aircraft->id?>"><?php echo $aircraft->name;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="layouts-tuesday">Select a Layout: </label>
                                    <select name="layouts-tuesday" id="layouts-tuesday" class="custom-select layoutSelector" link-to="seatgrid-tuesday">
                                        <option value="0">Select One</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-8">
                                <div class="col border h-100" id="seatgrid-tuesday">
                                    <div class="row">

                                    </div>
                                    <div class="row">
                                        <div class="" style="width: 1.5rem;" style="width:fit-content">
                                            
                                        </div>
                                        <div class="ml-3">
                                            <!-- <div class="seatgrid" id="seatgrid">
                        
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>    
    <?php if($data['schedule']->wednesday):?>
        <div class="row pb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header alert-primary">
                        <h3>Choose Aircraft for Wednesday</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="aircrafts-wednesday">Select an Aircraft: </label>
                                    <select name="aircrafts-wednesday" id="aircrafts-wednesday" class="custom-select aircraftSelector" link-to="layouts-wednesday">
                                        <option value="0">Select One</option>
                                        <?php foreach($data['aircrafts'] as $aircraft):?>
                                            <option value="<?php echo $aircraft->id?>"><?php echo $aircraft->name;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="layouts-wednesday">Select a Layout: </label>
                                    <select name="layouts-wednesday" id="layouts-wednesday" class="custom-select layoutSelector" link-to="seatgrid-wednesday">
                                        <option value="0">Select One</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-8">
                                <div class="col border h-100" id="seatgrid-wednesday">
                                    <div class="row">

                                    </div>
                                    <div class="row">
                                        <div class="" style="width: 1.5rem;" style="width:fit-content">
                                            
                                        </div>
                                        <div class="ml-3">
                                            <!-- <div class="seatgrid" id="seatgrid">
                        
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>    
    <?php if($data['schedule']->thursday):?>
        <div class="row pb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header alert-primary">
                        <h3>Choose Aircraft for Thursday</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="aircrafts-thursday">Select an Aircraft: </label>
                                    <select name="aircrafts-thursday" id="aircrafts-thursday" class="custom-select aircraftSelector" link-to="layouts-thursday">
                                        <option value="0">Select One</option>
                                        <?php foreach($data['aircrafts'] as $aircraft):?>
                                            <option value="<?php echo $aircraft->id?>"><?php echo $aircraft->name;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="layouts-thursday">Select a Layout: </label>
                                    <select name="layouts-thursday" id="layouts-thursday" class="custom-select layoutSelector" link-to="seatgrid-thursday">
                                        <option value="0">Select One</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-8">
                                <div class="col border h-100" id="seatgrid-thursday">
                                    <div class="row">

                                    </div>
                                    <div class="row">
                                        <div class="" style="width: 1.5rem;" style="width:fit-content">
                                            
                                        </div>
                                        <div class="ml-3">
                                            <!-- <div class="seatgrid" id="seatgrid">
                        
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>    
    <?php if($data['schedule']->friday):?>
        <div class="row pb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header alert-primary">
                        <h3>Choose Aircraft for Friday</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="aircrafts-friday">Select an Aircraft: </label>
                                    <select name="aircrafts-friday" id="aircrafts-friday" class="custom-select aircraftSelector" link-to="layouts-friday">
                                        <option value="0">Select One</option>
                                        <?php foreach($data['aircrafts'] as $aircraft):?>
                                            <option value="<?php echo $aircraft->id?>"><?php echo $aircraft->name;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="layouts-friday">Select a Layout: </label>
                                    <select name="layouts-friday" id="layouts-friday" class="custom-select layoutSelector" link-to="seatgrid-friday">
                                        <option value="0">Select One</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-8">
                                <div class="col border h-100" id="seatgrid-friday">
                                    <div class="row">

                                    </div>
                                    <div class="row">
                                        <div class="" style="width: 1.5rem;" style="width:fit-content">
                                            
                                        </div>
                                        <div class="ml-3">
                                            <!-- <div class="seatgrid" id="seatgrid">
                        
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>    
    <?php if($data['schedule']->saturday):?>
        <div class="row pb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header alert-primary">
                        <h3>Choose Aircraft for Saturday</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="aircrafts-saturday">Select an Aircraft: </label>
                                    <select name="aircrafts-saturday" id="aircrafts-saturday" class="custom-select aircraftSelector" link-to="layouts-saturday">
                                        <option value="0">Select One</option>
                                        <?php foreach($data['aircrafts'] as $aircraft):?>
                                            <option value="<?php echo $aircraft->id?>"><?php echo $aircraft->name;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="layouts-saturday">Select a Layout: </label>
                                    <select name="layouts-saturday" id="layouts-saturday" class="custom-select layoutSelector" link-to="seatgrid-saturday">
                                        <option value="0">Select One</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-8">
                                <div class="col border h-100" id="seatgrid-saturday">
                                    <div class="row">

                                    </div>
                                    <div class="row">
                                        <div class="" style="width: 1.5rem;" style="width:fit-content">
                                            
                                        </div>
                                        <div class="ml-3">
                                            <!-- <div class="seatgrid" id="seatgrid">
                        
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>    
    <?php if($data['schedule']->sunday):?>
        <div class="row pb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header alert-primary">
                        <h3>Choose Aircraft for Sunday</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="aircrafts-sunday">Select an Aircraft: </label>
                                    <select name="aircrafts-sunday" id="aircrafts-sunday" class="custom-select aircraftSelector" link-to="layouts-sunday">
                                        <option value="0">Select One</option>
                                        <?php foreach($data['aircrafts'] as $aircraft):?>
                                            <option value="<?php echo $aircraft->id?>"><?php echo $aircraft->name;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="layouts-sunday">Select a Layout: </label>
                                    <select name="layouts-sunday" id="layouts-sunday" class="custom-select layoutSelector" link-to="seatgrid-sunday">
                                        <option value="0">Select One</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-8">
                                <div class="col border h-100" id="seatgrid-sunday">
                                    <div class="row">

                                    </div>
                                    <div class="row">
                                        <div class="" style="width: 1.5rem;" style="width:fit-content">
                                            
                                        </div>
                                        <div class="ml-3">
                                            <!-- <div class="seatgrid" id="seatgrid">
                        
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>    
        
      
</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>
<script src="<?php echo URLROOT . "/public/js/aircraft-schedule.js?>";?>"></script>