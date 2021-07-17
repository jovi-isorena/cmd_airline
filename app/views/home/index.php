<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation-sp.php';
?>
<div class="section-landing">
    
</div>
    <div class="container full-h">
    <!-- <iframe src="http://www.staggeringbeauty.com/" style="border: 1px inset #ddd" width="100%" height="598"></iframe> -->
        <div class="row justify-content-left mt-5">
            <div class="col-6">
                <div class="frosted p-5 mt-5 " style="border-radius: 20px;">
                <!-- style="background-color: rgba(210,210,210,0.7);color:#001e60;" -->
                    <form action="<?php echo URLROOT . "/reservations/search";?>" method="post">
                    <div class="row">
    
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="flightType" id="roundTrip" value="roundTrip" checked>
                            <label class="form-check-label" for="roundTrip">Round Trip</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="flightType" id="oneWay" value="oneWay">
                            <label class="form-check-label" for="oneWay">One Way</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="origin">Origin</label>
                                <input type="text" name="origin" id="origin" class="form-control" autocomplete="off" value="mnl">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="destination">Destination</label>
                                <input type="text" name="destination" id="destination" class="form-control" autocomplete="off" value="lax">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="departure">Departure</label>
                                <input type="date" name="departure" id="departure" class="form-control" value="<?php echo getDate();?>">
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
                        <button type="submit" class="btn custom-primary btn-block">SEARCH FLIGHT</button>
                    </form>
                </div>
            </div>
            <div class="col-6 align-items-center">
                <div class="justify-content-right text-right text-light">

                    <p  style="font-size: 50px; font-family: 'Bauhaus 93';color: white;">
                        Travel.
                        <br>
                        Live.
                        <br>
                        Siomai.
                    </p>
                    <p style="margin-top: 100px;">
                        Come and take the flight of your life.
                        <br><span class="btn btn-outline-light">Learn More</span>
                    </p>
                </div>
            </div>
        </div>

    </div>
<?php require APPROOT . '/views/includes/foot.php'; ?>
<script src="<?php echo URLROOT . "/public/js/";?>search-flight.js"></script>
