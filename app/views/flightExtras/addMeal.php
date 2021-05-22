<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
    
?>
<pre><?php //var_dump($data);?></pre>

<div class="container pt-5 full-h">
    <a href="<?php echo URLROOT . '/flights/manage/' . $data['flightNo'];?>" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i> Back To Flight Management</a>
    <h1><?php echo $data['title'];?></h1>
    <?php if(!empty($data['successMessage'])):?>
        <span class="alert-success text-success px-2 align-content-center">
            <?php echo $data['successMessage'];?>
        </span>
    <?php endif;?>
    <form method="post" action="<?php echo URLROOT . '/flightExtras/addMeal/' . $data['flightNo']; ?>">
        <div class="form-group">
            <label for="flight">Flight Number</label>
            <input type="hidden" name="flight" id="flight" value=<?php echo $data['flightNo'];?>>
            <p><?php echo $data['flightNo'];?></p>
        </div>
        <div class="form-group">
            <label for="extra">Meal Package</label>
            <span style="color: red;">* <?php echo $data['extraError'];?></span>
            <select name="extra" id="extra" class="form-control custom-select">
                <option value='' <?php echo empty($data['extra'])?'selected':'';?>>Select a Meal Package</option>
                <?php foreach($data['meals'] as $meal):?>
                    <option value="<?php echo $meal->id;?>" <?php echo $data['extraId']==$meal->id?'selected':'';?>><?php echo $meal->name . ' - $' . $meal->price;?></option>
                <?php endforeach;?>
            </select>
        </div>
       
        
        <button type="submit" class="btn btn-primary btn-block" name="submit">Add</button>
    </form>
</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>