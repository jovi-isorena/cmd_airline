<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>


<div class="container full-h py-5">
    <a href="<?php echo URLROOT;?>/fares" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i> Back To List</a>
    <h1><?php echo $data['title'];?></h1>
    <?php if(!empty($data['successMessage'])):?>
        <span class="alert-success text-success px-2  align-content-center">
            <?php echo $data['successMessage'];?>
        </span>
    <?php endif;?>
    <form method="post" action="<?php echo URLROOT; ?>/fares/create">
        <div class="form-group">
            <label for="name">Name</label>
            <span style="color: red;">* <?php echo $data['nameError'];?></span>
            <input type="text" class="form-control" id="name" name="name"  value="<?php echo $data['name'];?>">
        </div>
        <div class="form-group">
            <label for="class">Class</label>
            <span style="color: red;">* <?php echo $data['classError'];?></span>
            <select name="class" id="class" class="form-control custom-select">
                <option value='' <?php echo empty($data['class'])?'selected':'';?>>Select a Class</option>
                <option value="Economy" <?php echo $data['class']=="Economy"?"selected":"";?>>Economy</option>
                <option value="Premium Economy" <?php echo $data['class']=="Premium Economy"?"selected":"";?>>Premium Economy</option>
                <option value="Business" <?php echo $data['class']=="Business"?"selected":"";?>>Business</option>
                <option value="First Class" <?php echo $data['class']=="First Class"?"selected":"";?>>First Class</option>
            </select>
        </div>
        <div class="form-group">
            <label for="baggage">Checked Baggage</label>
            <span style="color: red;">* <?php echo $data['baggageError'];?></span>
            <input type="text" class="form-control" id="baggage" name="baggage"  value="<?php echo $data['baggage'];?>">
        </div>
        <div class="form-group">
            <label for="baggage">Flight Date Change</label>
            <span style="color: red;">* <?php echo $data['dateChangeError'];?></span>
            <input type="text" class="form-control" id="dateChange" name="dateChange"  value="<?php echo $data['dateChange'];?>">
        </div>
        <div class="form-group">
            <label for="cancelFee">Cancellation Before Departure</label>
            <span style="color: red;">* <?php echo $data['cancelFeeError'];?></span>
            <input type="text" class="form-control" id="cancelFee" name="cancelFee"  value="<?php echo $data['cancelFee'];?>">
        </div>
        <div class="form-group">
            <label for="noShowFee">No Show Fee</label>
            <span style="color: red;">* <?php echo $data['noShowFeeError'];?></span>
            <input type="text" class="form-control" id="noShowFee" name="noShowFee"  value="<?php echo $data['noShowFee'];?>">
        </div>
        <!-- SELECT `id`, `name`, `class`, `checked_baggage`, `flight_date_change`, `cancellation_before_depart`, `no_show_fee`, `mileage_accrual`, `fare_status` FROM `fare` WHERE 1 -->
        <div class="form-group">
            <label for="accrual">Mileage Accrual</label>
            <span style="color: red;">* <?php echo $data['accrualError'];?></span>
            <input type="number" class="form-control" id="accrual" name="accrual"  value="<?php echo $data['accrual'];?>">
        </div>
        
        <button type="submit" class="btn btn-primary btn-block" name="submit">Create</button>
    </form>
</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>