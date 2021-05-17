<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

?>
<div class="container text-center">
    <div class="row">
        <a href="<?php echo URLROOT;?>/flights/create" class="btn btn-outline-success mt-5"><i class="far fa-plus-square mr-2"></i>Create Flight</a>
    </div>
    <table class="table mt-5">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Flight Number</th>
                <th scope="col">Duration (in Minutes)</th>
                <th scope="col">Origin</th>
                <th scope="col">Destination</th>
                <th scope="col">Type</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data['flights'] as $flight):?>
            <tr>
                <th scope="row"><?php echo $flight->flight_no;?></th>
                <td><?php echo $flight->duration_minutes;?></td>
                <td><?php echo $flight->airport_origin;?></td>
                <td><?php echo $flight->airport_destination;?></td>
                <td><?php echo $flight->type;?></td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="<?php echo URLROOT . "/flights/manage/" . $flight->flight_no;?>" class="btn btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Manage Flight"><i class="fas fa-cogs"></i></a>
                        <a href="<?php echo URLROOT . "/flights/edit/" . $flight->flight_no?>" class="btn btn-outline-primary"  data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></a>
                        <a href="<?php echo URLROOT . "/flights/delete/" . $flight->flight_no?>" class="btn btn-outline-danger"  data-toggle="tooltip" data-placement="top" title="Delete"><i class="far fa-trash-alt"></i></a>
                    </div>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>