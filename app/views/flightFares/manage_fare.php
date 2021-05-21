<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
    // var_dump($data);
    // echo $data['title'];
    // echo $data['flight']->flight_no;
?>
<div class="full-h container">
    <div class="row py-5 ">
        <div class="col-12">
            <div class="card">
                <div class="card-header alert-primary">
                    <h3>Flight Details</h3>
                </div>
                <div class="card-body">
                    <p class="card-text">Flight No.: <?php echo $data['flight']->flight_no?></p>
                    <p class="card-text">Origin: <?php echo $data['flight']->airport_origin?></p>
                    <p class="card-text">Destination: <?php echo $data['flight']->airport_destination?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <a href="<?php echo URLROOT . '/flightFares/create/' . $data['flight']->flight_no?>" class="btn btn-outline-success"><i class="far fa-plus-square mr-2"></i>Add Fare</a>
    </div>
    <div class="row pb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header alert-primary">
                    <h3>Economy</h3>
                </div>
                <div class="card-body">
                    <table class="table table-stripped">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Fare</th>
                                <th scope="col">Available Slots</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($data['flightFares'] as $fare):
                                    if($fare->class == 'Economy'):
                            ?>
                                <tr>
                                    <td><?php echo $fare->name;?></td>
                                    <td><?php echo $fare->available_slots;?></td>
                                    <td><?php echo $fare->price;?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo URLROOT . "/flightFares/edit/" . $fare->id;?>" class="btn btn-outline-primary"><i class="far fa-edit"></i></a>
                                            <a href="<?php echo URLROOT . "/flightFares/delete/" . $fare->id;?>" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif;?>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row pb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header alert-primary">
                    <h3>Premium Economy</h3>
                </div>
                <div class="card-body">
                
                <table class="table table-stripped">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Fare</th>
                                <th scope="col">Available Slots</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($data['flightFares'] as $fare):
                                    if($fare->class == 'Premium Economy'):
                            ?>
                                <tr>
                                    <td><?php echo $fare->name;?></td>
                                    <td><?php echo $fare->available_slots;?></td>
                                    <td><?php echo $fare->price;?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo URLROOT . "/flightFares/edit/" . $fare->id;?>" class="btn btn-outline-primary"><i class="far fa-edit"></i></a>
                                            <a href="<?php echo URLROOT . "/flightFares/delete/" . $fare->id;?>" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif;?>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row pb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header alert-primary">
                    <h3>Business</h3>
                </div>
                <div class="card-body">
                
                <table class="table table-stripped">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Fare</th>
                                <th scope="col">Available Slots</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($data['flightFares'] as $fare):
                                    if($fare->class == 'Business'):
                            ?>
                                <tr>
                                    <td><?php echo $fare->name;?></td>
                                    <td><?php echo $fare->available_slots;?></td>
                                    <td><?php echo $fare->price;?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo URLROOT . "/flightFares/edit/" . $fare->id;?>" class="btn btn-outline-primary"><i class="far fa-edit"></i></a>
                                            <a href="<?php echo URLROOT . "/flightFares/delete/" . $fare->id;?>" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif;?>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require APPROOT . '/views/includes/foot.php'; ?>