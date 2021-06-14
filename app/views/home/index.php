<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<div class="section-landing full-h">
<!-- <iframe src="http://www.staggeringbeauty.com/" style="border: 1px inset #ddd" width="100%" height="598"></iframe> -->
    <div class="row justify-content-center mt-5">
        <div class="p-5 mt-5 rounded" style="background-color: #001e60;color:white;">
            <form action="<?php echo URLROOT . "/reservations/search";?>" method="post">
            <div class="row">

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="flightType" id="oneWay" >
                    <label class="form-check-label" for="oneWay">One Way</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="flightType" id="roundTrip">
                    <label class="form-check-label" for="roundTrip">Round Trip</label>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="origin">Origin</label>
                        <input type="text" name="origin" id="origin" class="form-control" autocomplete="off">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="destination">Destination</label>
                        <input type="text" name="destination" id="destination" class="form-control" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="departure">Departure</label>
                        <input type="date" name="departure" id="departure" class="form-control">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group" id="returnGroup">
                        <label for="return">Return</label>
                        <input type="date" name="return" id="return" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="passenger">Passenger</label>
                        <input type="number" name="passenger" id="passenger" class="form-control">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="cabinClass">Cabin Class</label>
                        <select name="cabinClass" id="cabinClass" class="form-control custom-select">
                            <option value="0">Select a Class</option>
                            <option value="economy">Economy</option>
                            <option value="premium economy">Premium Economy</option>
                            <option value="business">Business</option>
                        </select>
                    </div>
                </div>
            </div>
                <button type="submit" class="btn btn-primary btn-block">SEARCH FLIGHT</button>
            </form>
        </div>
    </div>

</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>
<script src="<?php echo URLROOT . "/public/js/";?>search-flight.js"></script>
