<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
    
?>
<pre><?php var_dump($data);?></pre>

<div class="container pt-5 full-h">
    <a href="<?php echo URLROOT . '/flightFares/manage_fare/' . $data['flightFare']->flight_no;?>" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i> Back To Flight Fares</a>
    <h1><?php echo $data['title'];?></h1>
    <?php if(!empty($data['successMessage'])):?>
        <span class="alert-success text-success px-2 align-content-center">
            <?php echo $data['successMessage'];?>
        </span>
    <?php endif;?>
    <form method="post" action="<?php echo URLROOT . '/flightFares/edit/' . $data['flightFare']->id; ?>">
        <div class="form-group">
            <label for="flight">Flight Number</label>
            <input type="hidden" name="flight" id="flight" value=<?php echo $data['flightFare']->flight_no;?>>
            <p><?php echo $data['flightFare']->flight_no;?></p>
        </div>
        <div class="form-group">
            <label for="fare">Fare Type</label>
            <p><?php echo $data['flightFare']->name;?></p>
        </div>
        <div class="form-group">
            <label for="slots">Available Slots</label>
            <span style="color: red;">* <?php echo $data['slotError'];?></span>
            <input type="number" class="form-control" id="slots" name="slots"  value="<?php echo $data['slots'];?>">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <span style="color: red;">* <?php echo $data['priceError'];?></span>
            <input type="number" class="form-control" id="price" name="price"  value="<?php echo $data['price'];?>">
        </div>
        
        
        <button type="submit" class="btn btn-primary btn-block" name="submit">Update</button>
    </form>
</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>