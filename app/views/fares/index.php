<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

?>
<div class="container text-center">
    <div class="row">
        <a href="<?php echo URLROOT;?>/fares/create" class="btn btn-outline-success mt-5"><i class="far fa-plus-square mr-2"></i>Add Fare</a>
    </div>
    <table class="table mt-5">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Class</th>
                <th scope="col">Checked Baggage</th>
                <th scope="col">Flight Date Change</th>
                <th scope="col">Cancellation Before Departure</th>
                <th scope="col">No Show Fee</th>
                <th scope="col">Mileage Accrual</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data['fares'] as $fare):?>
            <tr>
                <th><?php echo $fare->name;?></th>
                <td><?php echo $fare->class;?></td>
                <td><?php echo $fare->checked_baggage;?></td>
                <td><?php echo $fare->flight_date_change;?></td>
                <td><?php echo $fare->cancellation_before_depart;?></td>
                <td><?php echo $fare->no_show_fee;?></td>
                <td><?php echo $fare->mileage_accrual;?></td>
                <td>   
                    <div class="btn-group" role="group">
                        <a href="<?php echo URLROOT . "/fares/edit/" . $fare->id?>" class="btn btn-outline-primary"  data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit"></i></a>
                        <a href="<?php echo URLROOT . "/fares/delete/" . $fare->id?>" class="btn btn-outline-danger"  data-toggle="tooltip" data-placement="top" title="Delete"><i class="far fa-trash-alt"></i></a>
                    </div>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<?php require APPROOT . '/views/includes/foot.php'; ?>