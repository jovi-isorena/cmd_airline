<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<pre><?php //var_dump($data);?></pre>

<div class="container full-h">
    <ol class="progress custom-ol" style="height:fit-content;">
        <li class="completed">Select Date</li>
        <li class="completed">Select Flight</li>
        <li class="completed">Passengers</li>
        <li class="completed">Choose Seats</li>
        <li class="completed">Add Extras</li> 
        <li class="is-active">Payment</li>
        <li>Complete</li>
    </ol>
    <div class="col-9">
        <div class="row">
            <h1><?php echo $data['title']?></h1>
        </div>
        <div class="row">
            <div class="card w-100">
                <div class="card-header">
                    <h4 class="card-title align-text-center align-center"> Total to be paid is USD <span class="font-weight-bold"><?php echo number_format($data['total'],2);?></span> <span class="btn btn-primary btn-sm" onclick="showBill()">Click here to view details</span></h4>
                    <p>The system will not allow you change the payment mode after you click CONTINUE. The current transaction will be cancelled and you will be required to start a new transaction if you attempt to change your payment mode. Please select a method of payment.</p>
                </div>
                <div class="card-body p-5">
                    <div class="row border rounded px-4 mb-5 w-75 mx-auto d-none" id="billDetail">
                        <h3>Bill Breakdown</h3>
                        <ul class="w-100 p-0" style="list-style: none;">
                            <?php foreach($data['flights'] as $flight):?>
                                <li>
                                    <div class="row justify-content-between">
                                            <h5><?php echo $flight['flightDetail']->flight_no;?> <span class="small font-italic">(Fare Type: <?php echo $flight['flightFare']->name;?>)</span></h5>
                                            
                                    </div>
                                        <!-- <div class="col-10 w-100"> -->
                                    <ul  style="list-style: none;">
                                        <?php foreach($flight['passengers'] as $passenger):?>
                                            <li>
                                                <div class="row justify-content-between">
                                                    <h6><?php echo $passenger['firstname'] . " " . $passenger['lastname'];?></h6>
                                                    <h6><?php echo $flight['flightFare']->price;?></h6>
                                                </div>
                                                <?php if(isset($passenger['extras'])):?>
                                                    <!-- <span>Extras:</span> -->
                                                    <ul>
                                                        <?php foreach($passenger['extras'] as $extra):?>
                                                            <li>
                                                                <div class="row justify-content-between">
                                                                    <!-- <div class="col-10"> -->
                                                                        <span class="ml-2"><?php echo $extra->name;?></span>
                                                                    <!-- </div> -->
                                                                    <!-- <div class="col-2 p-0 text-right"> -->
                                                                        <h6><?php echo $extra->price;?></h6>
                                                                    <!-- </div> -->
                                                                </div>
                                                            </li>        
                                                        <?php endforeach;?>
                                                    
                                                    </ul>
                                                <?php else:?>
                                                <ul style="list-style: none;">
                                                    <li class="font-italic">-No Extras-</li>
                                                </ul>
                                                <?php endif;?>
                                            </li>
                                        <?php endforeach;?>
                                    </ul>
                                        <!-- </div> -->
                                        <!-- <div class="col-2 text-left p-0"> -->
                                        <!-- </div> -->
                                    
                                </li>
                            <?php endforeach; ?>
                            <li>
                                <div class="row justify-content-between">
                                    <!-- <div class="col-10"> -->
                                        <h5>Fees, Surcharges and Tax</h5>
                                    <!-- </div> -->
                                    <!-- <div class="col-2 p-0 text-left"> -->
                                        <h5><?php echo number_format($data['fees'],2);?></h5>
                                    <!-- </div> -->
                                </div>
                            </li>
                            <li>
                                <div class="row justify-content-between">
                                <!-- <div class="col-10"> -->
                                    <h4>Total</h4>
                                <!-- </div> -->
                                <!-- <div class="col-2 p-0 text-left"> -->
                                    <h4><?php echo number_format($data['total'],2);?></h4>
                                <!-- </div> -->
                                </div>
                            </li>
                        </ul>
                        
                    
                    </div>
                    <div class="row" id="paymentMethod">
                        <div class="nav nav-pills h-100" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="pay-creditcard-tab" data-toggle="pill" href="#pay-creditcard" role="tab" aria-controls="pay-creditcard" aria-selected="true">Credit Card</a>
                            <a class="nav-link" id="pay-cash-tab" data-toggle="pill" href="#pay-cash" role="tab" aria-controls="pay-cash" aria-selected="false">Cash via Payment Center</a>
                            <a class="nav-link" id="pay-paypal-tab" data-toggle="pill" href="#pay-paypal" role="tab" aria-controls="pay-paypal" aria-selected="false">Paypal</a>
                        </div>
                        <div class="tab-content h-100 p-4" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="pay-creditcard" role="tabpanel" aria-labelledby="pay-creditcard-tab">
                                <div class="">
                                    <p>
                                        American Express, Diners, Discover, JCB, MasterCard, UATP and Visa credit and debit cards used online for international tickets will be quoted in the currency of the country of departure. All domestic fares are quoted and charged in PHP while International tickets originating from the Philippines and Vietnam will be quoted and billed in USD. Conversion to another currency is available. Billing and payment currency shall be based on the cardholders agreement with the card issuer. Transactions made online are considered purchases in the Philippines. Certain banks may charge foreign transaction fees if the credit card used online is issued outside the Philippines. You may refer to your credit card policy statement if foreign transaction fee will apply to purchases made at www.philippineairlines.com. By clicking CONTINUE, you agree to the payment terms and conditions of American Express Safekey, Diners/Discover ProtectBuy, J/Secure, Mastercard Secure Code, Verified by Visa, Multi-Currency Pricing and your credit/debit card and/or ATM card issuer. Please select a type of credit card
                                    </p>
                                    <div>
                                        <div class="row">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
                                                <label class="form-check-label" for="inlineRadio1"><img src="<?php echo URLROOT;?>/public/img/icons8-mastercard-48.png" alt="" class="ccthumbnail"></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                <label class="form-check-label" for="inlineRadio2"><img src="<?php echo URLROOT;?>/public/img/icons8-visa-144.png" alt="" class="ccthumbnail"></label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                                                <label class="form-check-label" for="inlineRadio3"><img src="<?php echo URLROOT;?>/public/img/icons8-american-express-squared-48.png" alt="" class="ccthumbnail"></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="ccnumber">Credit Card Number</label>
                                                    <span style="color: red;">* <?php ?></span>
                                                    <input type="text" class="form-control" id="ccnumber" name="ccnumber"  value="<?php ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="seccode">Security Code</label>
                                                    <span style="color: red;">* <?php ?></span>
                                                    <input type="text" class="form-control" id="seccode" name="seccode"  value="<?php ?>" placeholder="e.g. 1234">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <label for="month">Expiry</label>
                                                <span style="color: red;">* <?php ?></span>
                                                <select name="month" id="month" class="custom-select form-control ">
                                                    <option <?php ?> value="">Month</option>
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option>
                                                    <option value="04">04</option>
                                                    <option value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option>
                                                    <option value="08">08</option>
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label for="year"> &nbsp;</label>
                                                <span style="color: red;"><?php ?></span>
                                                <select name="year" id="year" class="custom-select form-control ">
                                                    <option <?php ?> value="">Year</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>
                                                    <option value="2023">2023</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2025">2025</option>
                                                    <option value="2026">2026</option>
                                                    <option value="2027">2027</option>
                                                    <option value="2028">2028</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="cardname">Name on Card</label>
                                                    <span style="color: red;">* <?php ?></span>
                                                    <input type="text" class="form-control" id="cardname" name="cardname"  value="<?php ?>" placeholder="Enter the name on card">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div>
                                            <h2>Credit card billing address</h2>
                                            <span style="font-weight: 600;">(for verification purposes)</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="address1">Street address, P.O. box, company name</label>
                                                    <span style="color: red;">* <?php ?></span>
                                                    <input type="text" class="form-control" id="address1" name="address1"  value="<?php ?>" placeholder="Enter address details">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="address2">Apartment, suite, unit, building, floor, etc</label>
                                                    <span style="color: red;">* <?php ?></span>
                                                    <input type="text" class="form-control" id="address2" name="address2"  value="<?php ?>" placeholder="Enter address details">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="postal">Postal</label>
                                                    <span style="color: red;">* <?php ?></span>
                                                    <input type="text" class="form-control" id="postal" name="postal"  value="<?php ?>" placeholder="Enter postal code">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="city">City</label>
                                                    <span style="color: red;">* <?php ?></span>
                                                    <input type="text" class="form-control" id="city" name="city"  value="<?php ?>" placeholder="Enter city name">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="country">Country</label>
                                                    <span style="color: red;">* <?php ?></span>
                                                    <input type="text" class="form-control" id="country" name="country"  value="<?php ?>" placeholder="Enter country name">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pay-cash" role="tabpanel" aria-labelledby="pay-cash-tab">
                                
                                <p>Please be advised that reference number is only valid within 24hours after successful booking. </p>
                                <p>Use the reference code below to make payment on our credited payment centers.</p>
                                <hr>
                                <h6>Reference number:</h6>
                                <h1>
                                    <?php 
                                    function generateRandomString($length = 8) {
                                        return substr(str_shuffle(str_repeat($x='123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
                                    }
                                    echo generateRandomString();
                                    ?>
                                </h1>
                            </div>
                            <div class="tab-pane fade" id="pay-paypal" role="tabpanel" aria-labelledby="pay-paypal-tab">
                                <p>PayPal is a safe, easy way to pay through credit cards, bank accounts and balances.</p>
                            </div>
                        </div>
                        <form action="<?php echo URLROOT;?>/reservations/payment" method="post">
                            
                            <div class="row justify-content-end my-5 mx-0 pr-5">
                                <button type="submit" class="btn" style="background-color: #001e60;color:white;" name="continue">CONTINUE <i class="fas fa-caret-right"></i></button>
                            </div>                      
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- <div class="row">
            terms
            <p>I have read and understood, and agree to the Online Booking Terms & Conditions, Data Privacy Policy, PAL Travel Insurance, Conditions of Carriage, and Fare Rules and Refund Policy relating to the selected fare(s)/premium, where applicable. I hereby give my consent to the collection, use, monitoring, disclosure, or transfer of my Personal Information in accordance with PAL Data Privacy Policy. I attest that I have the authority to disclose the Personal Information of my co-passengers, purchase their tickets, and give consent in their behalf. I have reviewed my flight itinerary and/or travel insurance details completely and hereby accept the same as final. I confirm that I have read and understood, and agree to the Online Booking Terms & Conditions, Data Privacy, Travel Insurance, Conditions of Carriage, and Fare Rules and Refund Policy relating to the selected fare(s)/premium, where applicable. purchase conditions and the Hazardous materials conditions.*</p>
        </div> -->
    </div>
    <div class="col-3">
    </div>
</div>

<?php require APPROOT . '/views/includes/foot.php'; ?>
<script>
    function showBill(){
        document.getElementById("billDetail").classList.toggle("d-none");
        console.log("hey");
    }
</script>