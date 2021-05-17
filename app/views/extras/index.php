<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
    var_dump($data['selectedType']);
?>
<div class="container text-center">
    <div class="row">
        <a href="<?php echo URLROOT;?>/extras/create" class="btn btn-outline-success mt-5"><i class="far fa-plus-square mr-2"></i>Add Extra</a>
    </div>
    <div class="pt-5">
        <ul class="nav nav-tabs" style="font-size: 24px;">
            
            <li class="nav-item">
                <a class="nav-link <?php echo $data['selectedType']=='%'?'active font-weight-bold':'';?>" href="<?php echo URLROOT . '/extras';?>">All</a>
            </li>
            <?php foreach($data['types'] as $type):?>
                <li class="nav-item">
                    <a class="nav-link <?php echo $data['selectedType']== $type->type? 'active font-weight-bold': '';?>" href="<?php echo URLROOT . '/extras/index/' . str_replace(" ","-",$type->type);?>"> <?php echo $type->type;?></a>
                </li>
            <?php endforeach;?>
        </ul>
    </div>
    <table class="table mt-5">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Type</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price (in $)</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach($data['extras'] as $extra):?>
            <tr>
                <td><?php echo $extra->type;?></td>
                <td><?php echo $extra->name;?></td>
                <td><?php echo $extra->description;?></td>
                <td><?php echo $extra->price;?></td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="<?php echo URLROOT . "/extras/edit/" . $extra->id?>" class="btn btn-outline-primary"><i class="far fa-edit"></i></a>
                        <a href="<?php echo URLROOT . "/extras/delete/" . $extra->id?>" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></a>
                    </div>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>


<?php require APPROOT . '/views/includes/foot.php'; ?>