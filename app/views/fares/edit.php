<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
    
?>
<!-- <div class="alert-warning text-warning border border-warning text-center">
    <p>This page is under construction.</p>
</div> -->

<div class="container full-h py-5">
    <a href="<?php echo URLROOT;?>/fares" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i> Back To List</a>
    <h1><?php echo $data['title'];?></h1>
    <?php if(!empty($data['successMessage'])):?>
        <span class="alert-success text-success px-2  align-content-center">
            <?php echo $data['successMessage'];?>
        </span>
    <?php endif;?>
    <form method="post" action="<?php echo URLROOT . '/fares/edit/' . $data['fare']->id;?>">
        <div class="form-group">
            <label for="name">Name</label>
            <span style="color: red;">* <?php echo $data['nameError'];?></span>
            <input type="text" class="form-control" id="name" name="name"  value="<?php echo $data['name'];?>">
        </div>
        <div class="form-group">
            <label for="class">Class</label>
            <span style="color: red;">* <?php echo $data['classError'];?></span>
            <select name="class" id="class" class="form-control custom-select">
                <option value="Economy" <?php echo $data['class']=="Economy"?"selected":"";?>>Economy</option>
                <option value="Premium Economy" <?php echo $data['class']=="Premium Economy"?"selected":"";?>>Premium Economy</option>
                <option value="Business" <?php echo $data['class']=="Business"?"selected":"";?>>Business</option>
                <option value="First Class" <?php echo $data['class']=="First Class"?"selected":"";?>>First Class</option>
            </select>
        </div>
        <div class="form-group">
            <label for="baggage">Checked Baggage</label>
            <span style="color: red;">* <?php echo $data['baggageError'];?></span>
            <input type="text" class="form-control" list="options" name="baggage" id="baggage" value="<?php echo $data['baggage'];?>"/>
            <datalist id="options" style="width:100%; background-color: white;">
                <option value="&#10005;">&#10005;</option>
                <option value="&#10003;">&#10003;</option>
                <option value="&#10003; with a FEE">&#10003; with a FEE</option>
                <option value="*No charge">*No charge</option>
                
            </datalist>
        </div>
        <div class="form-group">
            <label for="dateChange">Flight Date Change</label>
            <span style="color: red;">* <?php echo $data['dateChangeError'];?></span>
            <select class="form-control custom-select" name="dateChange" id="dateChange" value="<?php echo $data['dateChange'];?>">
                <option value="&#10005;" <?php echo $data['dateChange']=='&#10005;'?'selected':'';?>>&#10005;</option>
                <option value="&#10003;" <?php echo $data['dateChange']=='&#10003;'?'selected':'';?>>&#10003;</option>
                <option value="&#10003; with a FEE" <?php echo $data['dateChange']=='&#10003; with a FEE'?'selected':'';?>>&#10003; with a FEE</option>
                <option value="*No charge" <?php echo $data['dateChange']=='*No charge'?'selected':'';?>>*No charge</option>
            </select>
        </div>
        <div class="form-group">
            <label for="cancelFee">Cancellation Before Departure</label>
            <span style="color: red;">* <?php echo $data['cancelFeeError'];?></span>
            <select class="form-control custom-select" name="cancelFee" id="cancelFee">
                <option value="&#10005;">&#10005;</option>
                <option value="&#10003;">&#10003;</option>
                <option value="&#10003; with a FEE">&#10003; with a FEE</option>
                <option value="*No charge">*No charge</option>
            </select>
        </div>
        <div class="form-group">
            <label for="noShowFee">No Show Fee</label>
            <span style="color: red;">* <?php echo $data['noShowFeeError'];?></span>
            <select class="form-control custom-select" name="noShowFee" id="noShowFee">
                <option value="&#10005;">&#10005;</option>
                <option value="&#10003;">&#10003;</option>
                <option value="&#10003; with a FEE">&#10003; with a FEE</option>
                <option value="*No charge">*No charge</option>
            </select>
            
        </div>
        <!-- SELECT `id`, `name`, `class`, `checked_baggage`, `flight_date_change`, `cancellation_before_depart`, `no_show_fee`, `mileage_accrual`, `fare_status` FROM `fare` WHERE 1 -->
        <div class="form-group">
            <label for="accrual">Mileage Accrual</label>
            <span style="color: red;">* <?php echo $data['accrualError'];?></span>
            <input type="number" class="form-control" id="accrual" name="accrual"  value="<?php echo $data['accrual'];?>">
        </div>
        
        <button type="submit" class="btn btn-primary btn-block" name="submit">Update</button>
    </form>
</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>
