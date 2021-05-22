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
    <form method="post" action="<?php echo URLROOT . '/flightExtras/addRoaming/' . $data['flightNo']; ?>">
        <div class="form-group">
            <label for="flight">Flight Number</label>
            <input type="hidden" name="flight" id="flight" value=<?php echo $data['flightNo'];?>>
            <p><?php echo $data['flightNo'];?></p>
        </div>
        <div class="form-group">
            <label for="extra">Roaming Service Package</label>
            <span style="color: red;">* <?php echo $data['extraError'];?></span>
            <select name="extra" id="extra" class="form-control custom-select">
                <option value='' <?php echo empty($data['extra'])?'selected':'';?>>Select a Roaming Service Package</option>
                <?php foreach($data['roaming'] as $roaming):?>
                    <option value="<?php echo $roaming->id;?>" <?php echo $data['extraId']==$roaming->id?'selected':'';?>><?php echo $roaming->name . ' - $' . $roaming->price;?></option>
                <?php endforeach;?>
            </select>
        </div>
       
        
        <button type="submit" class="btn btn-primary btn-block" name="submit">Add</button>
    </form>
</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>