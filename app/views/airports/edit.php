<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
    
<div class="container full-h pt-5">

<h1>Edit Airport</h1>
<?php if(!empty($data['successMessage'])):?>
    <span class="alert-success text-success px-2  align-content-center">
        <?php echo $data['successMessage'];?>
    </span>
    <?php endif;?>
<form method="post" action="<?php echo URLROOT. "/airports/edit/" . $data['airport']->airport_code;?>">
    <div class="form-group">
        <label for="airportCode">Airport Code</label>
        <div id="airportCode" name="airportCode" class="font-weight-bold"><?php echo $data['airport']->airport_code;?></div>
    </div>
    <div class="form-group">
        <label for="name">Airport Name</label>
        <span style="color: red;">* <?php echo $data['nameError'];?></span>
        <input type="text" class="form-control" id="name" name="name"  value="<?php echo $data['airport']->name;?>">
    </div>
    <div class="form-group">
        <label for="address">Airport Address</label>
        <span style="color: red;">* <?php echo $data['addressError'];?></span>
        <input type="text" class="form-control" id="address" name="address"  value="<?php echo $data['airport']->address;?>">
    </div>
    <div class="form-group">
            <label for="type">Airport Type</label>
            <span style="color: red;">* <?php echo $data['typeError'];?></span>
            <select name="type" id="type" class="custom-select form-control ">
                <option value="Local" <?php echo $data['airport']->type=='Local'?'selected':'';?>>Local</option>
                <option value="International" <?php echo $data['airport']->type=='International'?'selected':'';?>>International</option>
            </select>
        </div>
    <div class="btn-group" role="group">
        <button type="submit" class="btn btn-primary btn-block" name="submit">Update</button>
        <a href="<?php echo URLROOT;?>/airports" class="btn btn-secondary">Cancel</a>
    </div>
</form>
</div>

<?php require APPROOT . '/views/includes/foot.php'; ?>
