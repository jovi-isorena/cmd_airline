<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<div class="section-landing full-h">
<!-- <iframe src="http://www.staggeringbeauty.com/" style="border: 1px inset #ddd" width="100%" height="598"></iframe> -->
    <div>
        <form action="<?php echo URLROOT . "/reservations/search";?>" method="post">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="flightType" id="oneWay">
                <label class="form-check-label" for="oneWay">One Way</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="flightType" id="roundTrip">
                <label class="form-check-label" for="roundTrip">Round Trip</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="flightType" id="stopOver">
                <label class="form-check-label" for="roundTrip">Stop Over/Multi City</label>
            </div>
            <div class="form-group">
                <label for="origin">Origin</label>
                <input type="text" name="origin" id="origin" value="<?php echo $data['origin']?>">
            </div>
            <div class="form-group">
                <label for="destination">Destination</label>
                <input type="text" name="destination" id="destination" value="<?php echo $data['destination']?>">
            </div>
            <div class="form-group">
                <label for="departure">Departure</label>
                <input type="date" name="departure" id="departure" value="<?php echo $data['date']?>">
            </div>
            <div class="form-group">
                <label for="arrival">Arrival</label>
                <input type="date" name="arrival" id="arrival">
            </div>
            <button type="submit" class="btn btn-primary">SEARCH FLIGHT</button>
        </form>
    </div>

    <div>
        <pre><?php var_dump($data['result']); var_dump($data['entered']);?></pre>
    </div>
</div>


<?php require APPROOT . '/views/includes/foot.php'; ?>