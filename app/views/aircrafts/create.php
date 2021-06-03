<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>


<div class="container pt-5 full-h">
    <a href="<?php echo URLROOT;?>/aircrafts" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i> Back To List</a>
    <h1><?php echo $data['title'];?></h1>
    <?php if(!empty($data['successMessage'])):?>
        <span class="alert-success text-success px-2  align-content-center">
            <?php echo $data['successMessage'];?>
        </span>
    <?php endif;?>
    <form method="post" action="<?php echo URLROOT; ?>/aircrafts/create">
        <div class="form-group">
            <label for="name">Name</label>
            <span style="color: red;">* <?php echo $data['nameError'];?></span>
            <input type="text" class="form-control" id="name" name="name"  value="<?php echo $data['name'];?>">
        </div>
        
        
        <button type="submit" class="btn btn-primary btn-block" name="submit">Add</button>
    </form>
</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>