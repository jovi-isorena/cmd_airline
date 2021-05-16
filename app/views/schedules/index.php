<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>

<div class="container text-center">
    <div class="row">
        <a href="<?php echo URLROOT;?>/schedules/create" class="btn btn-outline-success mt-5"><i class="far fa-plus-square mr-2"></i>Create Schedule</a>
    </div>
    <div class="pt-5">
        <ul class="nav nav-tabs" style="font-size: 24px;">
            <li class="nav-item">
                <a class="nav-link <?php echo $data['status']=='%'?'active font-weight-bold':'';?>" href="<?php echo URLROOT . '/schedules';?>">All</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $data['status']=='scheduled'?'active font-weight-bold':'';?>" href="<?php echo URLROOT . '/schedules/index/scheduled';?>">Scheduled</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $data['status']=='delayed'?'active font-weight-bold':'';?>" href="<?php echo URLROOT . '/schedules/index/delayed';?>">Delayed</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $data['status']=='departed'?'active font-weight-bold':'';?>" href="<?php echo URLROOT . '/schedules/index/departed';?>">Departed</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $data['status']=='arrived'?'active font-weight-bold':'';?>" href="<?php echo URLROOT . '/schedules/index/arrived';?>">Arrived</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $data['status']=='cancelled'?'active font-weight-bold':'';?>" href="<?php echo URLROOT . '/schedules/index/cancelled';?>">Cancelled</a>
            </li>
        </ul>
    </div>
    <table class="table mt-5">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Flight Number</th>
                <th scope="col">Departure Time</th>
                <th scope="col">Departure Date</th>
                <th scope="col">Gate</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data['schedules'] as $schedule):?>
            <tr>
                <th scope="row"><?php echo $schedule->flight_no;?></th>
                <td><?php echo $schedule->departure_time;?></td>
                <td><?php echo $schedule->departure_date;?></td>
                <td><?php echo $schedule->gate;?></td>
                <td><?php echo $schedule->schedule_status;?></td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="<?php echo URLROOT . "/schedules/edit/" . $schedule->schedule_id?>" class="btn btn-outline-primary"><i class="far fa-edit"></i></a>
                        <a href="<?php echo URLROOT . "/schedules/delete/" . $schedule->schedule_id?>" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></a>
                    </div>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>