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
                <div class="frosted p-4 mt-2 " style="border-radius: 20px;">
                <!-- style="background-color: rgba(210,210,210,0.7);color:#001e60;" -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="booking-tab" data-toggle="tab" href="#booking" role="tab" aria-controls="booking" aria-selected="true">Book a Flight</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="status-tab" data-toggle="tab" href="#status" role="tab" aria-controls="status" aria-selected="false">Flight Status</a>
                        </li>
                        
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade  show active" id="booking" role="tabpanel" aria-labelledby="booking-tab">
                            <form action="<?php echo URLROOT . "/home/index";?>" method="post" class="pt-2">
                                <div class="row pl-4 justify-content-between">
                                    <div class="col pt-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="flightType" id="roundTrip" value="roundTrip" checked>
                                            <label class="form-check-label" for="roundTrip">Round Trip</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="flightType" id="oneWay" value="oneWay">
                                            <label class="form-check-label" for="oneWay">One Way</label>
                                        </div>
                                        
                                    </div>
                                    <div class="col-auto text-right p-1">
                                        <a class="btn btn-outline-light" href="<?php echo URLROOT;?>/home/reservationinsructions" target="_blank"><i class="far fa-question-circle mr-2"></i>Help</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="origin">Origin</label>
                                            <span style="color: red;">* <?php echo $data['originError'];?></span>
                                            <input type="hidden" name="origin" id="origin" value="<?php echo $data['origin'];?>">
                                            <input type="text" name="txtorigin" id="txtorigin" class="form-control airportInput" data-link="originOptions" autocomplete="off" placeholder="<?php echo $data['originPlaceholder'];?>">
                                            <div class="">
                                                <div class="list-group" style="width:500px;position:absolute;z-index:30;" id="originOptions">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="destination">Destination</label>
                                            <span style="color: red;">* <?php echo $data['destinationError'];?></span>
                                            <input type="hidden" name="destination" id="destination" value="<?php echo $data['destination'];?>">
                                            <input type="text" name="txtdestination" id="txtdestination" class="form-control airportInput" data-link="destinationOptions" autocomplete="off" placeholder="<?php echo $data['destinationPlaceholder'];?>">
                                            <div class="" >
                                                <div class="list-group" style="width:500px;position:absolute;z-index:30;" id="destinationOptions">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="departure">Departure</label>
                                            <span style="color: red;">* <?php echo $data['departureError'];?></span>
                                            <input type="date" name="departure" id="departure" class="form-control" value="<?php echo isset($data['departure'])?$data['departure']:getDate();?>">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group" id="returnGroup">
                                            <label for="return">Return</label>
                                            <span style="color: red;">* <?php echo $data['returnError'];?></span>
                                            <input type="date" name="return" id="return" class="form-control" value="<?php echo isset($data['return'])?$data['return']:getDate();?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="passenger">Passenger</label>
                                            <span style="color: red;">* <?php echo $data['passengerError'];?></span>
                                            <input type="number" name="passenger" id="passenger" class="form-control" value="<?php echo empty($data['passenger'])?$data['passenger']:1;?>">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="cabinClass">Cabin Class</label>
                                            <span style="color: red;">* <?php echo $data['cabinClassError'];?></span>
                                            <select name="cabinClass" id="cabinClass" class="form-control custom-select">
                                                <option value="0">Select a Class</option>
                                                <option value="economy" <?php if($data['cabinClass'] == "economy") echo "selected";?>>Economy</option>
                                                <option value="premium economy" <?php if($data['cabinClass'] == "premium economy") echo "selected";?>>Premium Economy</option>
                                                <option value="business" <?php if($data['cabinClass'] == "business") echo "selected";?>>Business</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn custom-primary btn-block">SEARCH FLIGHT</button>
                            </form>
                            
                        </div>
                        <div class="tab-pane fade" id="status" role="tabpanel" aria-labelledby="status-tab">
                        <form action="<?php //echo URLROOT . "/reservations/search";?>" method="post" class="pt-2">
                                
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="form-group">
                                            <label for="origin">Flight Number</label>
                                            <input type="text" name="origin" id="origin" class="form-control" autocomplete="off" value="mnl">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-group">
                                            <label for="destination">Departure Date</label>
                                            <input type="date" name="departure" id="departure" class="form-control" value="<?php echo getDate();?>">
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn custom-primary btn-block">CHECK FLIGHT</button>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-6 align-items-center">
                <div class="justify-content-right text-right text-light">

                    <p  style="font-size: 50px; font-family: 'Bauhaus 93';color: white;">
                        Explore.
                        <br>
                        Travel.
                        <br>
                        Live.
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
