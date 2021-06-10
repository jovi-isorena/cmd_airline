<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

?>
<div class="container text-center full-h">
    <div class="row">
        <a href="<?php echo URLROOT;?>/aircrafts/create" class="btn btn-outline-success mt-5"><i class="far fa-plus-square mr-2"></i>Add Aircraft</a>
    </div>
    <table class="table mt-5">
        <thead class="thead-dark ">
            <tr>
                
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Model</th>
                <th scope="col">Passenger Capacity</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data['aircrafts'] as $aircraft):?>
            <tr>
                <th scope="row"><?php echo $aircraft->id;?></th>
                <td><?php echo $aircraft->name;?></td>
                <td><?php echo $aircraft->model;?></td>
                <td><?php echo $aircraft->passenger_capacity;?></td>
                
                <td>   
                    <div class="btn-group" role="group">
                        <a href="<?php echo URLROOT . "/aircrafts/seatplan/" . $aircraft->id?>" class="btn btn-outline-warning"  data-toggle="tooltip" data-placement="top" title="Manage Seat"><i class="fas fa-th"></i>Manage Seats</a>
                        <a href="<?php echo URLROOT . "/aircrafts/edit/" . $aircraft->id?>" class="btn btn-outline-primary"  data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i>Edit</a>
                        <a href="<?php echo URLROOT . "/aircrafts/delete/" . $aircraft->id?>" class="btn btn-outline-danger"  data-toggle="tooltip" data-placement="top" title="Delete"><i class="far fa-trash-alt"></i>Delete</a>
                    </div>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>