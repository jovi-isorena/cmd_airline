<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<!-- <pre><?php //var_dump($data);?></pre> -->

<div class="container full-h">
    <a href="<?php echo URLROOT;?>/aircrafts" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i> Back To List</a>
    
    <h1><?php echo $data['title'];?></h1>
    <div class="row mt-5">
        <div class="col-6">
            <div id="responseMessage">
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="layouts">Existing Layouts:</label>
                    <select name="layouts" id="layouts" class="custom-select">
                        <option value=0>Select A Layout</option>
                        <?php foreach($data['layouts'] as $layout):?>
                            <option value="<?php echo $layout->id;?>"><?php echo $layout->name?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="row">
                <button class="btn btn-success">Create New Layout</button>
            </div>
            <div class="row " id="newLayout">
                <form class="p-5 border rounded">
                <fieldset>
                    <legend>New Layout</legend>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <br>
                    <input type="hidden" name="aircraftId" id="aircraftId" value="<?php echo $data['aircraft']->id;?>">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="rows">Rows: </label>
                            <input type="number" name="rows" id="rows" class="form-control">
                        </div>
                        <!-- <br> -->
                        <div class="form-group col-6">
                            <label for="cols">Columns: </label>
                            <input type="number" name="cols" id="cols" class="form-control">
                        </div>
                    </div>
                    <!-- <br> -->
                    <!-- <br> -->
                    <div class="btn-group w-100 my-3">
                        <button id="generate" class="btn btn-warning w-100">Generate Grid</button>
                        <button id="resetgrid" class="btn btn-secondary w-100">Reset Grid</button>
                    </div>
                    <button id="test" class="btn btn-primary btn-block">Save Layout</button>
                </fieldset>
                </form>
            </div>
                                
                
            <!-- <div class="row d-inline mt-5"> -->
                <!-- <br> -->
                <!-- <label for="emptybox"  class="btn btn-secondary"><input type="radio" name="options" id="emptybox" value="0" >  Empty</label> -->
                <!-- <br> -->
                <!-- <label for="economybox" class="btn btn-danger"><input type="radio" name="options" id="economybox" value="1" >  Economy <span class="badge badge-light" id="economy_count">0</span></label> -->
                <!-- <br> -->
                <!-- <label for="premiumbox" class="btn btn-warning"><input type="radio" name="options" id="premiumbox" value="2">  Premium <span class="badge badge-light" id="premium_count">0</span></label> -->
                <!-- <br> -->
                <!-- <label for="businessbox" class="btn btn-primary"><input type="radio" name="options" id="businessbox" value="3">  Business <span class="badge badge-light" id="business_count">0</span></label> -->
                <!-- <br> -->
                <!-- <div class="btn btn-succes"></div> -->
            <!-- </div> -->
        </div>
        <div class="col-6">
            <h2>Layout Preview</h2>
            <div class="btn btn-success m-3">
                Alloted Seat  <span class="badge badge-light" id="capacity">0/<?php echo $data['aircraft']->passenger_capacity?></span>
            </div>
            <div class="col border h-100 p-3">
                <div class="row d-inline mt-5 mx-auto">
                    <!-- <br> -->
                    <label for="emptybox"  class="btn btn-secondary"><input type="radio" name="options" id="emptybox" value="0" class="d-none">  Empty</label>
                    <!-- <br> -->
                    <label for="economybox" class="btn btn-danger"><input type="radio" name="options" id="economybox" value="1" class="d-none">  Economy <span class="badge badge-light" id="economy_count">0</span></label>
                    <!-- <br> -->
                    <label for="premiumbox" class="btn btn-warning"><input type="radio" name="options" id="premiumbox" value="2" class="d-none">  Premium <span class="badge badge-light" id="premium_count">0</span></label>
                    <!-- <br> -->
                    <label for="businessbox" class="btn btn-primary"><input type="radio" name="options" id="businessbox" value="3" class="d-none">  Business <span class="badge badge-light" id="business_count">0</span></label>
                    <!-- <br> -->
                    <!-- <div class="btn btn-succes"></div> -->
                </div>
                <div class="row" id="xCoor">

                </div>
                <div class="row">
                    <div class="" style="width: 1.5rem;" id="yCoor" style="width:fit-content">
                        
                    </div>
                    <div class="ml-3" id="seatgrid-wrapper">
                        <!-- <div class="seatgrid" id="seatgrid">
    
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<?php require APPROOT . '/views/includes/foot.php'; ?>
<script src="<?php echo URLROOT . "/public/js/";?>seats.js"></script>