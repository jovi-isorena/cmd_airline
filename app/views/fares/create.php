<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

?>


<div class="container pt-5">
    <a href="<?php echo URLROOT;?>/fares" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i> Back To List</a>
    <h1>Add Extra</h1>
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
                <option value="Baggage" <?php echo $data['class']=="Economy"?"selected":"";?>>Economy</option>
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
            <label for="price">Price</label>
            <span style="color: red;">* <?php echo $data['priceError'];?></span>
            <input type="number" class="form-control" id="price" name="price"  value="<?php echo $data['price'];?>">
        </div>
        
        <button type="submit" class="btn btn-primary btn-block" name="submit">Create</button>
    </form>
</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>