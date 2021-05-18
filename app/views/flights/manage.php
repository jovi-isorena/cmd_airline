<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
    // var_dump($data);
?>
<div class="container">
    <div class="row">
        <h1><?php echo $data['title'];?></h1>
    </div>
    <div class="row pb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header alert-primary"">
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
    <div class="row pb-5">
        <div class="col-4">
            <div class="card">
                <div class="card-header alert-primary">
                    <div class="row ">
                        <div class="col-6 justify-content-left">
                            <h3>Seat Plan</h3>
                        </div>
                        <div class="col-6 justify-content-right">
                            <a href="#" class="btn btn-primary btn-block"><i class="fas fa-cog mr-2"></i>Manage</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Total Seats: 140</h5>
                    <ul class="list-group">
                        <li class="list-group-item">Economy: 80</li>
                        <li class="list-group-item">Premium: 40</li>
                        <li class="list-group-item">Business: 20</li>
                    </ul> 
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header alert-primary">
                    <div class="row justify-content-between">
                        <div class="col-6">
                            <h3>Fares</h3>
                        </div>
                        <div class="col-3">
                            <a href="#" class="btn btn-primary btn-block"><i class="fas fa-cog mr-2"></i>Manage</a>
                        </div>
                    </div>
                </div>
                <div class="card-body row">
                    <div class="col-4">
                        <h5 class="card-title">Economy</h5>
                        <ul class="list-group">
                            <li class="list-group-item">Economy Supersaver</li>
                            <li class="list-group-item">Economy Saver</li>
                            <li class="list-group-item">Economy </li>
                            <li class="list-group-item">Economy Flex</li>
                        </ul>
                    </div>
                    <div class="col-4">
                        <h5 class="card-title">Economy</h5>
                        <ul class="list-group">
                            <li class="list-group-item">Economy Supersaver</li>
                            <li class="list-group-item">Economy Saver</li>
                            <li class="list-group-item">Economy </li>
                            <li class="list-group-item">Economy Flex</li>
                        </ul>
                    </div>
                    <div class="col-4">
                        <h5 class="card-title">Economy</h5>
                        <ul class="list-group">
                            <li class="list-group-item">Economy Supersaver</li>
                            <li class="list-group-item">Economy Saver</li>
                            <li class="list-group-item">Economy </li>
                            <li class="list-group-item">Economy Flex</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row pb-5">
        <h3>Extras</h3>
    </div>    
    <div class="row pb-5">
        <div class="col-12">
            <div class="card w-100" >
                <div class="card-header alert-primary">
                    <div class="row justify-content-between">
                        <div class="col-6">
                            <h4>Baggage</h4>
                        </div>
                        <div class="col-2">
                            <a href="#" class="btn btn-primary"><i class="fas fa-cog mr-2"></i>Manage</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col" style="width:fit-content;">
                        <div class="card text-center p-4">
                            <img class="card-img-top m-auto" src="<?php echo URLROOT;?>/public/img/suitcase.png" alt="Card image cap" style="width: 12rem;">
                            <div class="card-body">
                                <h5 class="card-title">Prepaid 5kg</h5>
                                <p class="card-text">Price: $80</p>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row pb-5">
        <div class="col-12">
            <div class="card w-100" >
                <div class="card-header alert-primary">
                    <div class="row justify-content-between">
                        <div class="col-6">
                            <h4>Meal</h4>
                        </div>
                        <div class="col-2">
                            <a href="#" class="btn btn-primary"><i class="fas fa-cog mr-2"></i>Manage</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col" style="width:fit-content;">
                        <div class="card text-center p-4">
                            <img class="card-img-top m-auto" src="<?php echo URLROOT;?>/public/img/suitcase.png" alt="Card image cap" style="width: 12rem;">
                            <div class="card-body">
                                <h5 class="card-title">Prepaid 5kg</h5>
                                <p class="card-text">Price: $80</p>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row pb-5">
        <div class="col-12">
            <div class="card w-100" >
                <div class="card-header alert-primary">
                    <div class="row justify-content-between">
                        <div class="col-6">
                            <h4>Roaming Service</h4>
                        </div>
                        <div class="col-2">
                            <a href="#" class="btn btn-primary"><i class="fas fa-cog mr-2"></i>Manage</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col" style="width:fit-content;">
                        <div class="card text-center p-4">
                            <img class="card-img-top m-auto" src="<?php echo URLROOT;?>/public/img/suitcase.png" alt="Card image cap" style="width: 12rem;">
                            <div class="card-body">
                                <h5 class="card-title">Prepaid 5kg</h5>
                                <p class="card-text">Price: $80</p>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require APPROOT . '/views/includes/foot.php'; ?>