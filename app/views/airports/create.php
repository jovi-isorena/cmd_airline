<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>

<div class="container pt-5">
    <a href="<?php echo URLROOT;?>/airports" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i> Back To List</a>
    <h1>Add Airport</h1>
    <?php if(!empty($data['successMessage'])):?>
    <span class="alert-success text-success px-2  align-content-center">
        <?php echo $data['successMessage'];?>
    </span>
    <?php endif;?>
    <form method="post" action="<?php echo URLROOT; ?>/airports/create">
        <div class="form-group">
            <label for="airportCode">Airport Code</label>
            <span style="color: red;">* <?php echo $data['airportCodeError'];?></span>
            <input type="text" class="form-control" id="airportCode" name="airportCode"  value="<?php echo $data['airportCode'];?>">
        </div>
        <div class="form-group">
            <label for="name">Airport Name</label>
            <span style="color: red;">* <?php echo $data['nameError'];?></span>
            <input type="text" class="form-control" id="name" name="name"  value="<?php echo $data['name'];?>">
        </div>
        <div class="form-group">
            <label for="address">Airport Address</label>
            <span style="color: red;">* <?php echo $data['addressError'];?></span>
            <input type="text" class="form-control" id="address" name="address"  value="<?php echo $data['address'];?>">
        </div>
        <div class="form-group">
            <label for="type">Airport Type</label>
            <span style="color: red;">* <?php echo $data['typeError'];?></span>
            <select name="type" id="type" class="custom-select form-control ">
                <option <?php echo empty($data['type'])?'selected':'';?> value="">Select One</option>
                <option value="Local" <?php echo $data['type']=='Local'?'selected':'';?>>Local</option>
                <option value="International" <?php echo $data['type']=='International'?'selected':'';?>>International</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block" name="submit">Add</button>
    </form>
</div>