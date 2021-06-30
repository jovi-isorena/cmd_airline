<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<pre><?php //var_dump($data);?></pre>

<div class="container full-h">
    <div class="row">
        <div class="col-9">
            <h6>Passenger Count: <?php echo $data['passenger']?></h6>
            <form action="<?php echo URLROOT . "/reservations/seats";?>" method="post">
                <?php for ($i=0; $i < intval($data['passenger']); $i++):?>
                    <div class="passenger-profile card mb-3">
                        <div class="card-header d-flex justify-content-between">
                            <h3>ADULT 1</h3>
                            <div class="btn edit-info d-none" style="background-color: #001e60;color:white;">EDIT INFORMATION</div>
                        </div>
                        <div class="card-body">
                            <fieldset>
                                <legend>Personal Information</legend>
                                
                                <div class="row">
                                    <div class="col form-group">
                                        <label for="firstname[<?php echo $i;?>]">First/Given Name (including Suffix):</label>
                                        <span class="text-danger">* </span>
                                        <input type="text" name="firstname[<?php echo $i;?>]" id="firstname[<?php echo $i;?>]" class="form-control" placeholder="Enter your First/Given name">
                                    </div>
                                    <div class="col form-group">
                                        <label for="lastname[<?php echo $i;?>]">Last Name:</label>
                                        <span class="text-danger">* </span>
                                        <input type="text" name="lastname[<?php echo $i;?>]" id="lastname[<?php echo $i;?>]" class="form-control" placeholder="Enter your Lastname">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col form-group">
                                        <label for="gender[<?php echo $i;?>]">Gender:</label>
                                        <span class="text-danger">* </span>
                                        <select name="gender[<?php echo $i;?>]" id="gender[<?php echo $i;?>]" class="custom-select">
                                            <option value="" class="capitalized" selected disabled>--</option>
                                            <option value="MALE" class="capitalized">MALE</option>
                                            <option value="FEMALE" class="capitalized">FEMALE</option>
                                        </select>
                                    </div>
                                    <div class="col form-group">
                                        <label for="dob[<?php echo $i;?>]">Date of Birth: </label>
                                        <span class="text-danger">* </span>
                                        <input type="date" name="dob[<?php echo $i;?>]" id="dob[<?php echo $i;?>]" class="form-control">
                                    </div>
                                </div>
                            </fieldset>
                            <!-- <fieldset>
                                <legend>Frequent Flyer Details</legend>
                                <div class="row">
                                    <div class="col form-group">
                                        <label for="ffairline">Frequent Flyer Airline:</label>
                                        <span class="text-danger">* </span>
                                        <select name="ffairline" id="ffairline" class="custom-select">
                                            <option value="" class="capitalized" selected disabled>--</option>
                                            <option value="ALL NIPPONG AIRWAYS" class="capitalized">ALL NIPPON AIRWAYS</option>
                                            <option value="PHILIPPINE AIRLINES" class="capitalized">PHILIPPINE AIRLINES</option>
                                        </select>
                                    </div>
                                    <div class="col form-group">
                                        <label for="ffnumber">Frequent Flyer Number:</label>
                                        <span class="text-danger">* </span>
                                        <input type="text" name="ffnumber" id="ffnumber" class="form-control" placeholder="Enter your Number">
                                    </div>
                                </div>
                            </fieldset> -->
                            <fieldset>
                                <legend>Identification Document</legend>
                                <div class="row">
                                    <div class="col form-group">
                                        <label for="doctype[<?php echo $i;?>]">Document Type:</label>
                                        <span class="text-danger">* </span>
                                        <select name="doctype[<?php echo $i;?>]" id="doctype[<?php echo $i;?>]" class="custom-select">
                                            <option value="PASSPORT" class="capitalized">PASSPORT</option>
                                        </select>
                                    </div>
                                    <div class="col form-group">
                                        <label for="docnumber[<?php echo $i;?>]">Document Number:</label>
                                        <span class="text-danger">* </span>
                                        <input type="text" name="docnumber[<?php echo $i;?>]" id="docnumber[<?php echo $i;?>]" class="form-control" placeholder="Enter Document Number">
                                    </div>
                                    
                                </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="issuingcountry[<?php echo $i;?>]">Issuing Country:</label>
                                    <span class="text-danger">* </span>
                                    <select name="issuingcountry[<?php echo $i;?>]" id="issuingcountry[<?php echo $i;?>]" class="custom-select">
                                        <option value="" class="capitalized" selected disabled>--</option>
                                        <option value="ARGENTINA" class="capitalized">ARGENTINA</option>
                                        <option value="EGYPT" class="capitalized">EGYPT</option>
                                        <option value="FINLAND" class="capitalized">FINLAND</option>
                                        <option value="PHILIPPINES" class="capitalized">PHILIPPINES</option>
                                        <option value="UNITED STATES OF AMERICA" class="capitalized">UNITED STATES OF AMERICA</option>
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label for="expiration[<?php echo $i;?>]">Expiration Date: </label>
                                    <span class="text-danger">* </span>
                                    <input type="date" name="expiration[<?php echo $i;?>]" id="expiration[<?php echo $i;?>]" class="form-control">
                                </div>
                            </div>
                        </fieldset>
                        <div class="row justify-content-end mt-3 mr-3">
                            <div class="btn save-info" style="background-color: #001e60;color:white;" data-link="[<?php echo $i;?>]">SAVE INFORMATION</div>
                        </div>
                    </div>
                    
                </div>
                <?php endfor;?>
                <div class="row justify-content-end">
                    <button type="submit" class="btn d-none" style="background-color: #001e60;color:white;" name="continue">CONTINUE <i class="fas fa-caret-right"></i></button>
                </div>
            </form>
        </div>
        <div class="col-3">
        </div>
    </div>
    

</div>

<?php require APPROOT . '/views/includes/foot.php'; ?>
<script src="<?php echo URLROOT . "/public/js/";?>passengers.js"></script>
