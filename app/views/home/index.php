<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<div class="section-landing full-h">
<!-- <iframe src="http://www.staggeringbeauty.com/" style="border: 1px inset #ddd" width="100%" height="598"></iframe> -->
    <div class="row justify-content-center mt-5">
        <div class="p-5 mt-5 rounded" style="background-color: #001e60;color:white;">
            <form action="<?php echo URLROOT . "/reservations/search";?>" method="post">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="flightType" id="oneWay" >
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
                    <input type="text" name="origin" id="origin" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="destination">Destination</label>
                    <input type="text" name="destination" id="destination" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="departure">Departure</label>
                    <input type="date" name="departure" id="departure" class="form-control">
                </div>
                <div class="form-group">
                    <label for="arrival">Arrival</label>
                    <input type="date" name="arrival" id="arrival" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary btn-block">SEARCH FLIGHT</button>
            </form>
        </div>
    </div>

</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>