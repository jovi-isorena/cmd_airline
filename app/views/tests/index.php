<?php
require APPROOT . '/views/includes/head.php';

?>
<div class="form-group">
    <label for="origin">Origin</label><br>
    <input class="airportInput" type="text" name="origin" id="origin" placeholder="Origin" data-link="originOptions" autocomplete="false" >
    <div class="w-50 ">
        <div class="list-group" id="originOptions">
            
        </div>
    </div>

</div>
<div class="form-group">
    <label for="origin">Destination</label><br>
    <input class="airportInput" type="text" name="destination" id="destination" placeholder="Destination" data-link="destinationOptions" autocomplete="false">
    <div class="w-50 ">
        <div class="list-group" id="destinationOptions">
            
        </div>
    </div>
</div>



<script src="<?php echo URLROOT;?>/public/js/test.js"></script>