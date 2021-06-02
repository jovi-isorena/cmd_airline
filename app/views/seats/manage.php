<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';
?>
<div class="container">
    <h1><?php echo $data['title'];?></h1>
    <div class="row mt-5">
        <div class="col-6">
            <div class="row">
                <label for="rows">Rows: </label>
                <input type="number" name="rows" id="rows" class="form-control">
                <br>
                <label for="cols">Columns: </label>
                <input type="number" name="cols" id="cols" class="form-control">
                <br>
                <br>
                <div class="btn-group mt-3">
                    <button id="generate" class="btn btn-primary">Generate</button>
                    <button id="resetgrid" class="btn btn-secondary">Reset</button>
                    <button id="test" class="btn btn-secondary">Test</button>
                </div>
            </div>
                                
            <div class="row d-block mt-5">
                <input type="radio" name="options" id="emptybox" value="empty" >
                <label for="emptybox"  class="btn btn-secondary">Empty</label><br>
                <input type="radio" name="options" id="economybox" value="economy" >
                <label for="economybox" class="btn btn-danger">Economy <span class="badge badge-light" id="economy_count">0</span></label>
                <br>
                <input type="radio" name="options" id="premiumbox" value="premium">
                <label for="premiumbox" class="btn btn-warning">Premium <span class="badge badge-light" id="premium_count">0</span></label><br>
                <input type="radio" name="options" id="businessbox" value="business">
                <label for="businessbox" class="btn btn-primary">Business <span class="badge badge-light" id="business_count">0</span></label><br>
                <div class="btn btn-succes"></div>
            </div>
        </div>
        <div class="col-6">
            <div class="col border h-100" >
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