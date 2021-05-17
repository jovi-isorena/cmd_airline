<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

?>
<div class="container text-center">
    <div class="row">
        <a href="<?php echo URLROOT;?>/airports/create" class="btn btn-outline-success mt-5"><i class="far fa-plus-square mr-2"></i>Add Airport</a>
    </div>
    <table class="table mt-5">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Airport Code</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Type</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data['airports'] as $airport):?>
            <tr>
                <th scope="row"><?php echo $airport->airport_code;?></th>
                <td><?php echo $airport->name;?></td>
                <td><?php echo $airport->address;?></td>
                <td><p class="text-capitalize"><?php echo $airport->type;?></p></td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="<?php echo URLROOT . "/airports/edit/" . $airport->airport_code?>" class="btn btn-outline-primary"><i class="far fa-edit"></i></a>
                        <a href="<?php echo URLROOT . "/airports/delete/" . $airport->airport_code?>" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></a>
                    </div>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>