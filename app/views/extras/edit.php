<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>

<div class="container pt-5">
    <a href="<?php echo URLROOT;?>/extras" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i> Back To List</a>
    <h1>Add Extra</h1>
    <?php if(!empty($data['successMessage'])):?>
        <span class="alert-success text-success px-2  align-content-center">
            <?php echo $data['successMessage'];?>
        </span>
    <?php endif;?>
    <form method="post" action="<?php echo URLROOT . '/extras/edit/' . $data['extra']->id;?>">
        <div class="form-group">
            <label for="type">Type</label>
            <span style="color: red;">* <?php echo $data['typeError'];?></span>
            <select name="type" id="type" class="form-control custom-select">
                <option value='' <?php echo empty($data['type'])?'selected':'';?>>Select a Type</option>
                <option value="Baggage" <?php echo $data['type']=="Baggage"?"selected":"";?>>Baggage</option>
                <option value="Baggage" <?php echo $data['type']=="Meal"?"selected":"";?>>Meal</option>
                <option value="Baggage" <?php echo $data['type']=="Roaming Service"?"selected":"";?>>Roaming Service</option>
            </select>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <span style="color: red;">* <?php echo $data['nameError'];?></span>
            <input type="text" class="form-control" id="name" name="name"  value="<?php echo $data['name'];?>">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <span style="color: red;">* <?php echo $data['descriptionError'];?></span>
            <input type="text" class="form-control" id="description" name="description"  value="<?php echo $data['description'];?>">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <span style="color: red;">* <?php echo $data['priceError'];?></span>
            <input type="number" class="form-control" id="price" name="price"  value="<?php echo $data['price'];?>">
        </div>
        
        <button type="submit" class="btn btn-primary btn-block" name="submit">Create</button>
    </form>
</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>